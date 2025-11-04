<!-- <template>
  <div id="app2" v-if="mounted">
    <Flipbook
      class="flipbook"
      :pages="pages"
      :zooms="null"
    />
  </div>
</template>

<script>
import Flipbook from 'flipbook-vue'
import { markRaw } from 'vue';

export default {
  name: 'FlipBook',
  components: { Flipbook },
  data() {
    return {
      mounted: false,
      pages: markRaw([
        null,
        "https://picsum.photos/200/300?id=1",
        "https://picsum.photos/200/300?id=2",
        "https://picsum.photos/200/300?id=3",
        "https://picsum.photos/200/300?id=4",
        "https://picsum.photos/200/300?id=5",
        "https://picsum.photos/200/300?id=6",
        "https://picsum.photos/200/300?id=7",
        "https://picsum.photos/200/300?id=8",
      ])
    }
  },
  mounted() {
    this.mounted = true
  }
}
</script>


<style>
.flipbook {
  width: 90vw;
  height: 90vh;
}
#app2 {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #333;
  color: #ccc;
  overflow: hidden;
}
</style> -->

<!-- <template>
  <div ref="flipbook" style="width: 600px; height: 800px;"></div>
</template>

<script>
  import { PageFlip } from "page-flip";
  import * as pdfjsLib from "pdfjs-dist";


  pdfjsLib.GlobalWorkerOptions.workerSrc = `//cdnjs.cloudflare.com/ajax/libs/pdf.js/${pdfjsLib.version}/pdf.worker.min.mjs`;

  export default {
    name: "FlipBook",
    async mounted() {
      // 1. Cargar PDF
      const pdf = await pdfjsLib.getDocument({
        url: '/pdf/pdf.pdf',
      }).promise;

      const limit = 6;
      const pages = [];

      for (let i = 1; i <= 5; i++) {
        const page = await pdf.getPage(i);
        const viewport = page.getViewport({ scale: 1.5 }); 
        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");

        canvas.width = viewport.width;
        canvas.height = viewport.height;

        await page.render({ canvasContext: context, viewport }).promise;
        pages.push(canvas.toDataURL("image/png"));
      }

      const flipbook = new PageFlip(this.$refs.flipbook, {
        width: 500,
        height: 700,
        size: "stretch",
        maxShadowOpacity: 0.5,
        showCover: true,
      });

      flipbook.loadFromImages(pages);
    },
  };
</script> -->


<template>
  <div class="bg-gray-300 pt-4 pb-6 relative overflow-hidden h-[75vh] max-h-[75vh]"
    @mousedown="startDrag"
    @mousemove="onDrag"
    @mouseup="endDrag"
    @mouseleave="endDrag"
    @touchstart="startDrag"
    @touchmove="onDrag"
    @touchend="endDrag"
  >
    <div 
      ref="flipbook" 
      class="h-full origin-center transition-transform duration-100"
      :style="{ 
        transform: `translate(${panX}px, ${panY}px) scale(${zoomLevel})` 
      }"
    ></div>
    <!-- Controles -->
    <div class="absolute bottom-3 flex flex-1 w-full">
      <div
        class="flex mx-auto flex-row items-center justify-center gap-2 p-1 bg-slate-50 rounded-md"
      >
        <!-- prev page -->
        <button
          @click="prevPage"
          class="h-10 w-10 hover:bg-slate-100 shadow-xl flex items-center justify-center rounded-lg transition-all duration-100"
        >
          <i class="bi bi-caret-left-fill text-xl"></i>
        </button>

        <!-- zoom out -->
        <button
          @click="zoomOut"
          class="h-10 w-10 hover:bg-slate-100 shadow-xl flex items-center justify-center rounded-lg transition-all duration-100"
        >
          <i class="bi bi-zoom-out"></i>
        </button>

        <!-- zoom in -->
        <button
          @click="zoomIn"
          class="h-10 w-10 hover:bg-slate-100 shadow-xl flex items-center justify-center rounded-lg transition-all duration-100"
        >
          <i class="bi bi-zoom-in"></i>
        </button>

        <!-- page -->
        <div class="flex flex-row items-center gap-1">
          <input
            v-model.number="currentPageInput"
            @keyup.enter="goToPage"
            class="w-14 text-md border rounded px-1"
          />
          <p class="text-md text-slate-700 font-semibold">/{{ totalPages }}</p>
        </div>

        <!-- fullscreen -->
        <button
          @click="toggleFullscreen"
          class="h-10 w-10 hover:bg-slate-100 shadow-xl flex items-center justify-center rounded-lg transition-all duration-100"
        >
          <i :class="isFullscreen ? 'bi bi-fullscreen-exit' : 'bi bi-arrows-fullscreen'"></i>
        </button>

        <button
          @click="downloadPdf"
          title="Descargar PDF"
          class="h-10 w-10 hover:bg-slate-100 shadow-xl flex items-center justify-center rounded-lg transition-all duration-100"
        >
          <i class="bi bi-download"></i>
        </button>

        <!-- next page -->
        <button
          @click="nextPage"
          class="h-10 w-10 hover:bg-slate-100 shadow-xl flex items-center justify-center rounded-lg transition-all duration-100"
        >
          <i class="bi bi-caret-right-fill text-xl"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { PageFlip } from "page-flip";
import * as pdfjsLib from "pdfjs-dist";

pdfjsLib.GlobalWorkerOptions.workerSrc =
  `//cdnjs.cloudflare.com/ajax/libs/pdf.js/${pdfjsLib.version}/pdf.worker.min.mjs`;

export default {
  name: "FlipBook",
  props: {
    src: { type: String, default: "/pdf/pdf.pdf" }, // ruta PDF
  },
  data() {
    return {
      currentPage: 1,
      currentPageInput: 1,
      totalPages: 0,
      zoomScale: 1,
      isFullscreen: false,
      zoomLevel: 1, 
      panX: 0,
      panY: 0,
      isDragging: false,
      lastX: 0,
      lastY: 0,
    };
  },
  async mounted() {
    // 1. Abrir PDF sin renderizar todas las páginas
    this.pdf = await pdfjsLib.getDocument(this.src).promise;
    this.totalPages = this.pdf.numPages;
    // 2. Crear HTML vacío para cada página
    const pagesHTML = [];
    for (let i = 0; i < this.totalPages; i++) {
      const div = document.createElement("div");
      div.classList.add("page");
      div.style.width = "100%";
      div.style.height = "100%";
      pagesHTML.push(div);
    }

    // 3. Inicializar flipbook
    this.flipbook = new PageFlip(this.$refs.flipbook, {
      height: 750,
      width: 550,
      autoSize: true,
      size: "stretch",
      showCover: false,
      mobileScrollSupport: true,
      swipeDistance: 10,
      showPageCorners: false,
      autoSize: true,
      disableFlipByClick: false,
      drawShadow: true,

    });

    this.flipbook.loadFromHTML(pagesHTML);

    // 4. Renderizar la primera página de entrada
    this.renderPage(1);
    this.renderPage(2);
    this.renderPage(3);
    this.renderPage(4);


    // 5. Cuando el usuario pasa página, cargar la nueva si no existe
    this.flipbook.on("flip", (e) => {
      this.currentPage = e.data + 1;
      this.currentPageInput = this.currentPage;
      this.renderPage(this.currentPage + 1); // pdf.js es 1-based
      this.renderPage(this.currentPage + 2); // pdf.js es 1-based
      this.renderPage(this.currentPage + 3); // pdf.js es 1-based
      this.renderPage(this.currentPage + 4); // pdf.js es 1-based

      this.renderPage(this.currentPage - 1); // pdf.js es 1-based
      this.renderPage(this.currentPage - 2); // pdf.js es 1-based
      this.renderPage(this.currentPage - 3); // pdf.js es 1-based
      this.renderPage(this.currentPage - 4); 
    });
  },

  methods: {
    // async renderPage(pageNumber) {
    //   // Evitar renderizar dos veces la misma
    //   const container = this.$refs.flipbook.querySelectorAll(".page")[
    //     pageNumber - 1
    //   ];
    //   if (container.dataset.rendered) return;

    //   const page = await this.pdf.getPage(pageNumber);
    //   const viewport = page.getViewport({ scale: 1.5 });
    //   const canvas = document.createElement("canvas");
    //   const context = canvas.getContext("2d");

    //   canvas.width = viewport.width;
    //   canvas.height = viewport.height;

    //   await page.render({ canvasContext: context, viewport }).promise;

    //   container.appendChild(canvas);
    //   container.dataset.rendered = "true"; // marcar como ya renderizado
    // },

     async renderPage(pageNumber) {
      if (pageNumber < 1 || pageNumber > this.totalPages) return;
      const container = this.$refs.flipbook.querySelectorAll(".page")[
        pageNumber - 1
      ];
      if (container.dataset.rendered) return;

      const page = await this.pdf.getPage(pageNumber);
      const viewport = page.getViewport({ scale: this.zoomScale });
      const canvas = document.createElement("canvas");
      const context = canvas.getContext("2d");

      canvas.width = viewport.width;
      canvas.height = viewport.height;

      await page.render({ canvasContext: context, viewport }).promise;
      container.appendChild(canvas);
      container.dataset.rendered = "true";
    },

    // 🔹 Controles
    nextPage() {
      this.flipbook.flipNext();
    },
    prevPage() {
      this.flipbook.flipPrev();
    },
    goToPage() {
      if (
        this.currentPageInput >= 1 &&
        this.currentPageInput <= this.totalPages
      ) {
        this.renderPage(this.currentPageInput ); // pdf.js es 1-based
        this.renderPage(this.currentPageInput + 1); // pdf.js es 1-based
        this.renderPage(this.currentPageInput - 1); // pdf.js es 1-based
        this.flipbook.flip(this.currentPageInput - 1);

      }
    },
    zoomIn() {
      this.zoomLevel = Math.min(this.zoomLevel + 0.2, 3);
    },
    zoomOut() {
      this.zoomLevel = Math.max(this.zoomLevel - 0.2, 1);
      if (this.zoomLevel === 1) {
        this.panX = 0;
        this.panY = 0;
      }
    },

    downloadPdf() {
      const link = document.createElement('a');
      
      link.href = this.src;
  
      const filename = this.src.split('/').pop() || 'documento.pdf';
      link.download = filename;
  
      link.target = '_blank';
  
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    },

    startDrag(e) {
      if (this.zoomLevel <= 1) return;
      this.isDragging = true;

      const point = e.touches ? e.touches[0] : e;
      this.lastX = point.clientX;
      this.lastY = point.clientY;
    },

    onDrag(e) {
      if (!this.isDragging) return;

      const point = e.touches ? e.touches[0] : e;
      const dx = point.clientX - this.lastX;
      const dy = point.clientY - this.lastY;

      this.panX += dx;
      this.panY += dy;

      this.lastX = point.clientX;
      this.lastY = point.clientY;
    },

    endDrag() {
      this.isDragging = false;
    },
    reloadPages() {
      // reset páginas ya renderizadas para redibujarlas con nuevo zoom
      this.$refs.flipbook
        .querySelectorAll(".page")
        .forEach((p) => (p.dataset.rendered = ""));
      this.renderPage(this.currentPage);
      this.renderPage(this.currentPage + 1);
    },
    toggleFullscreen() {
      const el = this.$el;
      this.isFullscreen = !this.isFullscreen;
      this.reloadPages();
      if (!document.fullscreenElement) {
        el.requestFullscreen();
      } else {
        document.exitFullscreen();
      }
    },
  },
};
</script>

<style>
.page {
  display: flex;
  align-items: center;
  justify-content: center;
  background: white;
}
</style>

