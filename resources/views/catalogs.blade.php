
<x-layouts.landingpage-layout>
    <x-slot name="header"> <x-header :pages="$pages"/></x-slot>
    <div class="block relative">
        <!-- Imagen de cabecera -->
        <img src="{{ asset('img/catalogsbg.webp') }}" alt="services_img" class="w-full max-h-[25rem] object-cover" style="object-position: 0 10%;"/>

        <!-- Capa de opacidad -->
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <!-- Título -->
        <div class="absolute inset-0 flex items-center justify-center ">
            <h1 class="text-white text-[3.5vw] font-sans">Todos nuestros equipos</h1>
        </div>
    </div>
    <section class="py-32 px-4 sm:px-12 bg-slate-50">
        <div class="max-w-[100rem] mx-auto">
            <x-equipment-areas-catalogs :specareas="$specareas"/>
        </div>
    </section>

    @php
        $filtroEspecialidad = request()->input('filter.Áreas de ecpecialidad.0');
    @endphp

    @if($filtroEspecialidad)
        <div id="seccion-filtro" class="flex px-4 md:px-16 m-auto pb-40 bg-slate-50 scroll-mt-36">
            <!-- Filtros -->
            <aside class="w-1/4 bg-slate-50 p-4 mt-12 sticky">
                <x-filters  :title="'Categorias de producto'" :filters="$filters"/>
            </aside>
            {{-- <?php
                $mensaje = "Hola desde PHP";
                echo "<script>console.log(". json_encode($product->services_description ?? "") .");</script>";
            ?> --}}
            <!-- Contenido -->
            <main class="w-3/4 p-4 mt-12" x-data="{ isGrid: false  }">
                <!-- Botón de cambio de modo -->
                {{-- <div class="flex justify-end mb-4">
                    <button id="gridView" @click="isGrid = true" class="mr-2 px-4 py-2 bg-sky-600 rounded hover:bg-sky-500" id="gridView">
                        <i class="bi bi-grid text-xl text-sky-50"></i>
                    </button>
                    <button id="listView" @click="isGrid = false" class="px-4 py-2 bg-sky-600 rounded hover:bg-sky-500" id="listView">
                        <i class="bi bi-list-ul text-xl text-sky-50"></i>
                    </button>
                </div> --}}
                <!-- Contenedor de productos -->
                <div  id="productsContainer" class="flex flex-row flex-wrap gap-14">
                    @if (count($products) === 0)
                        <div class="w-full text-center pt-14">
                            <p class="uppercase text-2xl text-gray-400 font-bold"> no se encontraron productos</p>
                        </div>
                    @endif
                    @foreach($products as $index => $product)
                        <?php
                            $img = "";
                            $encodeProduct = json_encode($product ?? "");
                            $productDecode = json_decode($encodeProduct);

                            foreach($productDecode->product_images as $image){
                                    $type = trim($image->type ?? '', "\"' \t\n\r\0\x0B");

                                // Imprime en consola para verificar exactamente lo que llega
                                echo "<script>console.log('type → ' + " . json_encode($type) . ");</script>";

                                // strpos devuelve 0 (cero) si 'image/' está al principio
                                if (strpos($type, 'image/') === 0) {
                                    $img = '/storage/' . $image->url;
                                    break;
                                }
                            }


                        ?>
                        <button x-show="isGrid" class="productCard  p-4 text-center w-60 h-80 transition-all duration-300 ease-in-out hover:-translate-y-4 hover:cursor-pointer group "
                            data-twe-toggle="modal"
                            data-twe-target="#productModal-{{ $index }}"
                            data-twe-ripple-init
                            data-twe-ripple-color="light"
                        >
                                <img src="{{ $img}}" alt="Producto" class=" object-cover h-full shadow-sm rounded-lg mb-4 group-hover:shadow-lg ">
                                <div >
                                    <h3 class=" font-sans mt-4 font-semibold xs:text-md md:text-2xl text-sky-600 uppercase ">{{ $product->name }}</h3>
                                </div>
                        </button>
                        <button x-show="!isGrid" class="productCard bg-white w-full rounded-xl p-4 shadow-lg hover:shadow-xl  flex transition-all duration-300 ease-in-out hover:-translate-y-4 hover:cursor-pointer group"
                                data-twe-toggle="modal"
                                data-twe-target="#productModal-{{ $index }}"
                                data-twe-ripple-init
                                data-twe-ripple-color="light"
                        >
                            <div class="w-52 h-64">
                                <img src="{{ $img }}" alt="Producto" class="h-full w-full object-contain rounded mb-4">
                            </div>
                            <div class="p-4 w-full">
                                <h1 class="font-sans font-semibold text-3xl text-sky-600 uppercase">{{ $product->name}}</h1>
                                <h2 class="font-sans font-semibold text- mt-2 text-sky-500 uppercase">{{ $product->brand->name}}</h2>
                                <p class="font-sans text-md text-slate-900 mt-4 break-words whitespace-pre-line overflow-hidden">{{ $product->description}}</p>
                            </div>
                        </button>

                        <div
                            data-twe-modal-init
                            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                            id="productModal-{{ $index }}"
                            tabindex="1"
                            aria-labelledby="productModalLabel"
                            aria-modal="true"
                            role="dialog">
                            <div
                                data-twe-modal-dialog-ref
                                class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] max-w-[97vw] md:max-w-[100vw] ">
                                <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
                                    <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4 ml-auto">
                                        <!-- Close button -->
                                        <button
                                            type="button"
                                            class="box-content rounded-none border-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none"
                                            data-twe-modal-dismiss
                                            aria-label="Close">
                                            <span class="[&>svg]:h-6 [&>svg]:w-6">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </span>
                                        </button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="flex flex-row gap-8 p-4 md:p-12">
                                       <x-catalog-product-overview :product="$product" :index="$index" :productDecode="$productDecode" :accesoryPdf="$accesoryPdf"/>
                                    </div>

                                    <!-- Modal footer -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 m-auto">
                    {{ $products->links() }}
                </div>
            </main>
        </div>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const seccion = document.getElementById('seccion-filtro');
                    if(seccion) {
                        // Scroll suave con offset para el header
                        window.scrollTo({
                            top: seccion.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            </script>
        @endpush
    @endif


    {{-- Footer --}}
    <x-slot name="footer"><x-footer/></x-slot>

     <script>
        const gridView = document.getElementById('gridView');
        const listView = document.getElementById('listView');

        gridView.addEventListener('click', () => {
            productsContainer.className = 'flex flex-row flex-wrap gap-14'; // Cambia a modo mosaico
        });

        listView.addEventListener('click', () => {
            productsContainer.className = 'flex flex-col  gap-8'; // Cambia a modo lista
        });
    </script>
</x-layouts.landingpage-layout>

<div class="fixed bottom-10 right-0 z-50">
    <x-contact-button />
</div>


<script>
    function changeCarouselImage(carouselId, position) {
        // Obtener el carrusel específico
        const carousel = document.getElementById(carouselId);
        if (!carousel) return;

        // Obtener el botón correspondiente al indicador del carrusel
        const button = carousel.querySelector(`button[data-carousel-slide-to="${position}"]`);

        // Simular un clic en el botón para cambiar la imagen del carrusel
        if (button) {
            button.click();
        }
    }

    function showAccesoryModal(title, shortDesc, imgurl) {
        document.getElementById('offertImage').src = "";
        // Actualizar el contenido del modal
        document.getElementById('offertModalTitle').textContent = title;
        console.log(imgurl)
        const fullImageUrl = '/storage/' + imgurl;

        document.getElementById('offertImage').src = fullImageUrl;

        document.getElementById('offertModalLongDesc').textContent = shortDesc;

        // Si necesitas manejar condiciones dinámicas:
        // const conditionsList = document.getElementById('offertModalConditions');
        // conditionsList.innerHTML = conditions.map(c => `<li>${c}</li>`).join('');
    }

    function showServiceModal(title, shortDesc, imgurl) {
        document.getElementById('offertImage').src = "";
        // Actualizar el contenido del modal
        document.getElementById('offertModalTitle').textContent = title;
        console.log(imgurl)
        const fullImageUrl = '/storage/' + imgurl;

        document.getElementById('offertImage').src = fullImageUrl;

        document.getElementById('offertModalLongDesc').textContent = shortDesc;

        // Si necesitas manejar condiciones dinámicas:
        // const conditionsList = document.getElementById('offertModalConditions');
        // conditionsList.innerHTML = conditions.map(c => `<li>${c}</li>`).join('');
    }
</script>