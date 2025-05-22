<div class="pdf-flipbook-container">
    <div class="flipbook-controls mb-3">
        <button id="prev-page" class="btn btn-secondary">Anterior</button>
        <span id="page-num">Página: <span id="current-page">0</span> de <span id="total-pages">0</span></span>
        <button id="next-page" class="btn btn-secondary">Siguiente</button>
        <input type="file" id="pdf-upload" accept="application/pdf" class="d-none">
        <button id="load-pdf" class="btn btn-primary">Cargar PDF</button>
        <select id="zoom-level" class="form-control d-inline-block" style="width: auto;">
            <option value="0.5">50%</option>
            <option value="0.75">75%</option>
            <option value="1" selected>100%</option>
            <option value="1.25">125%</option>
            <option value="1.5">150%</option>
        </select>
    </div>

    <div class="flipbook-wrapper">
        <div class="flipbook" id="flipbook"></div>
    </div>

    <div class="loading-indicator">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Cargando...</span>
        </div>
        <p>Cargando páginas...</p>
    </div>
</div>

@push('styles')
<style>
    .pdf-flipbook-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .flipbook-wrapper {
        position: relative;
        width: 100%;
        height: 700px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        background: #f0f0f0;
    }

    .flipbook {
        width: 100%;
        height: 100%;
    }

    .flipbook .page {
        background-color: white;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .flipbook-controls {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .loading-indicator {
        display: none;
        text-align: center;
        margin-top: 20px;
    }

.page {
    position: relative;
    overflow: hidden;
}

.loader, .page-loader {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #666;
    font-size: 16px;
}
    /* Estilos para pantallas más pequeñas */
    @media (max-width: 768px) {
        .flipbook-wrapper {
            height: 500px;
        }

        .flipbook-controls {
            flex-direction: column;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.1/turn.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

<script>
// Configurar PDF.js
window.pdfjsLib = pdfjsLib;
window.pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

$(document).ready(function() {
    const flipbook = $('#flipbook');
    const loadingIndicator = $('.loading-indicator');
    let pdfDoc = null;
    let currentPage = 1;
    let totalPages = 0;
    let zoomLevel = 1;
    let renderedPages = {};
    const pagesToPreload = 5;
    const maxRenderedPages = 20;

    // 1. Primero definimos todas las funciones auxiliares
    function updatePageInfo() {
        $('#current-page').text(currentPage);
        $('#total-pages').text(totalPages);
    }

    function renderPage(pageNum) {
        if (renderedPages[pageNum] || !pdfDoc) return;

        renderedPages[pageNum] = true;
        const pageElement = $(`#page-${pageNum}`);
        pageElement.html('<div class="page-loader">Cargando...</div>');

        pdfDoc.getPage(pageNum).then(function(page) {
            const viewport = page.getViewport({ scale: zoomLevel * 1.5 });
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            page.render({
                canvasContext: context,
                viewport: viewport
            }).promise.then(function() {
                const imgData = canvas.toDataURL('image/jpeg', 0.8);
                pageElement.css('background-image', `url('${imgData}')`).html('');

                if (Object.keys(renderedPages).length > maxRenderedPages) {
                    const pagesToRemove = Object.keys(renderedPages)
                        .filter(p => Math.abs(p - currentPage) > pagesToPreload * 2)
                        .slice(0, 5);

                    pagesToRemove.forEach(p => {
                        $(`#page-${p}`).css('background-image', 'none');
                        delete renderedPages[p];
                    });
                }
            });
        });
    }

    function ensurePageRendered(pageNum) {
        if (!renderedPages[pageNum]) {
            renderPage(pageNum);
        }
    }

    function preloadNearbyPages(currentPage) {
        const start = Math.max(1, currentPage - pagesToPreload);
        const end = Math.min(totalPages, currentPage + pagesToPreload);

        for (let i = start; i <= end; i++) {
            if (!renderedPages[i]) {
                renderPage(i);
            }
        }
    }

    function applyZoom() {
        if (!pdfDoc) return;

        renderedPages = {};
        $('.page').css('background-image', 'none');
        renderPage(currentPage);
        if (currentPage > 1) renderPage(currentPage - 1);
        if (currentPage < totalPages) renderPage(currentPage + 1);
    }

    // 2. Luego definimos las funciones principales
    function initFlipbook() {
        const containerWidth = $('.flipbook-wrapper').width();
        const containerHeight = $('.flipbook-wrapper').height();

        flipbook.turn({
            width: containerWidth,
            height: containerHeight,
            autoCenter: true,
            duration: 800,
            acceleration: true,
            gradients: true,
            when: {
                turning: function(e, page) {
                    currentPage = page;
                    updatePageInfo();
                    preloadNearbyPages(page);
                },
                turned: function(e, page) {
                    ensurePageRendered(page);
                }
            }
        });
    }

    function loadPDF(file) {
        loadingIndicator.show();
        flipbook.empty().html('<div class="loader">Preparando flipbook...</div>');
        renderedPages = {};

        const fileReader = new FileReader();
        fileReader.onload = function() {
            const typedArray = new Uint8Array(this.result);

            window.pdfjsLib.getDocument(typedArray).promise.then(function(pdf) {
                pdfDoc = pdf;
                totalPages = pdf.numPages;
                updatePageInfo(); // Ahora está definida cuando se llama

                const pageElements = [];
                for (let i = 1; i <= totalPages; i++) {
                    pageElements.push(`<div class="page" id="page-${i}" data-page-num="${i}"></div>`);
                }

                flipbook.empty().html(pageElements.join(''));

                setTimeout(function() {
                    flipbook.turn('destroy');
                    initFlipbook();

                    renderPage(1);
                    if (totalPages > 1) renderPage(2);

                    loadingIndicator.hide();
                }, 100);

            }).catch(function(error) {
                console.error('PDF error:', error);
                loadingIndicator.hide();
                alert('Error al cargar PDF: ' + error.message);
            });
        };
        fileReader.readAsArrayBuffer(file);
    }

    // 3. Finalmente los event handlers
    $('#load-pdf').click(function() {
        $('#pdf-upload').click();
    });

    $('#pdf-upload').change(function(e) {
        const file = e.target.files[0];
        if (file) {
            loadPDF(file);
        }
    });

    $('#prev-page').click(function() {
        flipbook.turn('previous');
    });

    $('#next-page').click(function() {
        flipbook.turn('next');
    });

    $('#zoom-level').change(function() {
        zoomLevel = parseFloat($(this).val());
        applyZoom();
    });

    $(document).keydown(function(e) {
        if (!pdfDoc) return;

        switch(e.keyCode) {
            case 37: // Flecha izquierda
                flipbook.turn('previous');
                break;
            case 39: // Flecha derecha
                flipbook.turn('next');
                break;
        }
    });
});
</script>
@endpush
