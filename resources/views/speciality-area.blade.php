
<style>

    .swiper-wrapper {
        height: max-content !important;
        width: max-content;

    }

    .swiper-button-prev:after,
    .swiper-rtl .swiper-button-next:after {
        content: "" !important;
    }

    .swiper-button-next:after,
    .swiper-rtl .swiper-button-prev:after {
        content: "" !important;

    }

    .product-thumb .swiper-slide.swiper-slide-thumb-active>.slide\:border-indigo-600 {
        --tw-border-opacity: 1;
        border-color: rgb(79 70 229 / var(--tw-border-opacity));
    }
</style>
<x-layouts.landingpage-layout >

    <x-slot name="header"> <x-header/></x-slot>
    {{-- <div class="block relative">
        <img src="{{ asset('img/specAreabg.webp') }}" alt="services_img" class="w-full max-h-[35rem] object-cover" style="object-position: 0 10%;"/>
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="absolute inset-0 flex items-center justify-center ">
            <h1 class="text-white text-[3.5vw] font-sans">{{ $info }}</h1>
        </div>
    </div> --}}

    <div class="w-full" x-data="{accesorypdf: "",pdf_page: 0, accesorypdf_id: 0, services_description: "", filters: false  }">
        <div class="relative max-h-[50rem]  w-full overflow-hidden flex bg-black">
            <div class="w-full max-h-[50rem]  object-cover">
                <video autoplay muted loop playsinline preload="auto" class="w-full max-h-[50rem]  object-cover">
                    <source src="/storage/{{$video_url}}" type="video/webm">
                </video>
            </div>
            <div class="absolute w-full max-h-[50rem] inset-0  block bg-opacity-40 bg-black">
            </div>
        </div>
        <section>
            <div class="w-full items-center justify-center pt-12 pb-4 bg-white ">
                <h1 class="text-slate text-center text-[3.2vw] font-bold font-sans text-sky-700 uppercase">{{ $info }}</h1>
            </div>
        </section>
        {{-- <section>
            <div class="pl-4 sm:pl-6 md:pl-14 lg:pl-64 bg-white">
                <button id="gridView" @click="filters = true" class="mr-2 h-10 w-10 flex justify-center items-center  bg-[#3eb8d7] rounded hover:bg-sky-500" id="gridView">
                    <i class="bi bi-filter text-xl text-sky-50"></i>
                </button>
            </div>
        </section> --}}
        <section class="">

            {{-- Contenido --}}
            <main class="relative bg-white">

                {{-- Filtros --}}
                {{-- <aside class=" absolute left-12 max-w-[18rem] bg-white-100 p-4 mt-12 bg-white rounded-xl shadow-xl ">
                    <x-filters  :title="'Categorias de producto'" :filters="$filters"/>
                </aside> --}}
                @vite('resources/js/applaravel.js')
                {{-- <div id="flipbook-container"></div> --}}
                <div >
                    <x-horizontal-filters  :title="'Categorias de producto'" :filters="$filters"/>
                </div>

                @if (count($content) === 0)
                    <div class="w-full text-center pt-14 bg-white h-screen">
                        <p class="uppercase text-2xl text-gray-400 font-bold"> no se encontraron productos</p>
                    </div>
                @endif
                @foreach ($content as $index => $product)
                    {{-- Productos --}}
                    <div class="{{ $index  === 0 ? 'pb-28' : 'py-28' }} flex  {{ $index % 2 === 0 ? 'bg-white' : 'bg-slate-200' }}">
                        <div class="flex w-full justify-center flex-row gap-10  pr-6 xl:pr-0 ">
                            {{-- <div class="min-w-[20rem] pl-4 h-full pr-4 ">
                            </div> --}}
                            {{-- Descripcion y modelos --}}
                            @if ($index % 2 != 0)
                                <x-product-data :index="$index" :product="$product" />
                            @endif
                            {{-- Imagenes y servicios --}}
                            <div class="sticky top-32 h-fit ">
                                <div class="w-[21rem]  min-h-[31rem] rounded-2xl overflow-hidden bg-stone-800 items-center  shadow-xl" >
                                    <div id="carousel-{{ $index }}" class="relative max-w-[21rem]  max-h-[31rem] bg-stone-800 rounded-2xl  overflow-hidden" data-carousel="static">
                                        <!-- Carousel wrapper -->
                                        <div class=" w-[21rem]  min-h-[31rem]  overflow-hidden">
                                            @foreach ($product->product_images as $img )

                                                @php
                                                    // Quita las comillas dobles alrededor de type
                                                    $type = trim($img->type, '"');
                                                @endphp
                                                @if (str_starts_with($type, 'image'))
                                                    <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                                        <img src="/storage/{{ $img->url }}" class=" block w-full h-full object-contain bg-stone-800 " alt="...">
                                                    </div>
                                                @elseif(str_starts_with($type, 'video'))
                                                    <div class="hidden duration-1000 ease-in-out py-8 bg-stone-800" data-carousel-item>
                                                        {{-- <video
                                                            controls
                                                            class="absolute block w-full h-full object-contain "
                                                        >
                                                            <source src="/storage/{{ $img->url }}" :type="{{ $type}}">
                                                        </video> --}}
                                                        <div class="relative w-full h-full bg-black">
                                                            <!-- Video -->
                                                            <video
                                                                id="customVideo"
                                                                controls
                                                                class="w-full h-full object-contain"
                                                            >
                                                                <source src="/storage/{{ $img->url }}" type="{{ $type }}">
                                                            </video>

                                                            <!-- Controles personalizados -->
                                                            {{-- <div 
                                                                id="controls" 
                                                                class="absolute bottom-0 left-0 w-full flex items-center justify-between px-4 pb-12 opacity-0 transition-opacity duration-300 bg-gradient-to-t from-black/40 to-transparent"
                                                            >
                                                                <!-- Play/Pause -->
                                                                <button 
                                                                id="playPauseBtn" 
                                                                class="text-white text-lg hover:scale-110 transition"
                                                                >
                                                                ▶️
                                                                </button>

                                                                <!-- Barra de progreso -->
                                                                <input 
                                                                id="progress" 
                                                                type="range" 
                                                                value="0" 
                                                                class="w-full mx-4 accent-white"
                                                                />

                                                                <!-- Volumen -->
                                                                <input 
                                                                id="volume" 
                                                                type="range" 
                                                                min="0" 
                                                                max="1" 
                                                                step="0.1" 
                                                                value="1" 
                                                                class="w-24 accent-white"
                                                                />
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    
                                                @endif
                                            @endforeach
                                            <!-- Item 1 -->
                                            {{-- <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                                <img src="{{ asset('img/services-bg.jpg') }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-[-20]" alt="...">
                                            </div>
                                            <!-- Item 2 -->
                                            <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                                <img src="{{ asset('img/services-bg-2.jpg') }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-[-20]" alt="...">
                                            </div>
                                            <!-- Item 3 -->
                                            <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                                <img src="{{ asset('img/services-install.jpg') }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-[-20]" alt="...">
                                            </div>
                                            <!-- Item 4 -->
                                            <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                                <img src="{{ asset('img/services-reinstall.jpg') }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-[-20]" alt="...">
                                            </div> --}}

                                        </div>
                                        <!-- Slider indicators -->
                                        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                                            @foreach ($product->product_images as $img )
                                                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide {{ $img->index }}" data-carousel-slide-to="{{ $img->index }}"></button>
                                            @endforeach
                                            {{-- <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button> --}}
                                        </div>
                                        <!-- Slider controls -->
                                        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                                <svg class="w-4 h-4 text-slate-200 dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                                </svg>
                                                <span class="sr-only">Previous</span>
                                            </span>
                                        </button>
                                        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                                <svg class="w-4 h-4 text-slate-200 dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                                </svg>
                                                <span class="sr-only">Next</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-center gap-14 w-[21rem] mt-8">
                                    @if ($product->has_services == 1)
                                        <div>
                                            <button 
                                                class="h-14 w-14 mx-auto rounded-xl shadow-lg border flex items-center justify-center
                                                    bg-gradient-to-r from-[#3eb8d7] to-sky-600
                                                    hover:from-[#3eb8d7] hover:to-sky-700
                                                    transition-all duration-500  ease-in-out"  
                                                type="button"
                                                {{-- onclick="showOfertModal('{{ $offert['name'] }}', '{{ $offert['description'] }}', '{{ $offert['img_url']}}')" --}}
                                                data-twe-toggle="modal"
                                                data-twe-target="#servicesModal-{{ $index }}"
                                                data-twe-ripple-init
                                                data-twe-ripple-color="light"
                                            >
                                                <div class="h-14 w-14rounded-full flex items-center justify-center content-normal ">
                                                    <i class="bi bi-tools text-2xl text-white scale-x-90"></i>
                                                </div>
                                            </button>
                                            <p class="text-md max-w-16 mt-1 font-bold text-sky-500 text-center ">Servicios</p>
                                        </div>
                                    @endif
                                    @if ($product->has_accesrorypdf == 1)
                                        <div class="">

                                            <button 
                                                 class="h-14 w-14 mx-auto rounded-xl shadow-lg border flex items-center justify-center
                                                        bg-gradient-to-r from-[#3eb8d7] to-sky-600
                                                        hover:from-[#3eb8d7] hover:to-sky-700
                                                        transition-all duration-500  ease-in-out"                                                
                                                type="button"
                                                {{-- onclick="showOfertModal('{{ $offert['name'] }}', '{{ $offert['description'] }}', '{{ $offert['img_url']}}')" --}}
                                                data-twe-toggle="modal"
                                                data-twe-target="#accesoryModal-{{ $index }}"
                                                data-twe-ripple-init
                                                data-twe-ripple-color="light"
                                            >
                                                <div class="h-14 w-14  rounded-full flex items-center justify-center content-normal">
                                                    {{-- <i class="bi bi-bookmark text-3xl text-white"></i> --}}
                                                    <i class="bi bi-file-earmark-ruled  text-3xl text-white scale-x-90"></i>
                                                </div>
                                            </button>
                                            <p class="text-md max-w-16 mt-1 font-bold text-sky-500 text-center ">Ficha Técnica</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if ($product->has_services == 1)
                                <div
                                    data-twe-modal-init
                                    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                                    id="servicesModal-{{ $index }}"
                                    tabindex="-1"
                                    aria-labelledby="serviceModalLabel-{{ $index }}"
                                    aria-modal="true"
                                    role="dialog">
                                    <div
                                        data-twe-modal-dialog-ref
                                        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                                        <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
                                            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 px-4 pt-2 pb-1">
                                                <!-- Modal title -->
                                                <h5 class="text-xl font-medium leading-normal text-[#0392ceff]" id="servicesModalTitle">
                                                    Servicios
                                                </h5>
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
                                            <div class="relative p-4">
                                                {{-- <div>
                                                    <img
                                                        id=""
                                                        alt="Oferta"
                                                        class="w-full h-full"
                                                    />
                                                </div> --}}
                                                {!! $product->services_description !!}
                                            </div>

                                            <!-- Modal footer -->
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($product->has_accesrorypdf == 1)
                                <div
                                    data-twe-modal-init
                                    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                                    id="accesoryModal-{{ $index }}"
                                    tabindex="-1"
                                    aria-labelledby="accesoryModalLabel"
                                    aria-modal="true"
                                    role="dialog">
                                    <div
                                        data-twe-modal-dialog-ref
                                        class="pointer-events-none flex min-h-screen w-full translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto ">
                                        <div class="pointer-events-auto  min-h-screen flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
                                            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 px-4 pt-2 pb-1">
                                                <!-- Modal title -->
                                                <h5 class="text-xl font-medium leading-normal text-[#0392ceff]" id="accesoryModalTitle">
                                                    Ficha Técnica
                                                </h5>
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
                                            <div class="flex flex-1 p-4">
                                                <?php
                                                    $url = "";
                                                    $page = 0;
                                                    if($product->accesorypdf && $product->accesorypdf != "" ){
                                                        $url =  $product->accesorypdf;

                                                    }else{
                                                        foreach($accesoryPdf as $pdf){
                                                            if($pdf->id == $product->accesorypdf_id){
                                                                $url = $pdf->pdf_url;
                                                            }
                                                        }
                                                        if($product->pdf_page != 0){
                                                            $page = $product->pdf_page;
                                                        }
                                                    }
                                                ?>
                                                <div class="flex flex-1 w-full">
                                                    <iframe
                                                        src="{{ asset("/storage/".$url) }}#page={{ $page }}&zoom=100"
                                                        class="w-full h-full"
                                                        frameborder="0"
                                                    ></iframe>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Descripcion y modelos --}}
                            @if ($index  % 2 == 0)
                                <x-product-data :index="$index" :product="$product" />
                            @endif
                        </div>
                    </div>

                @endforeach
            </main>

        </section>

        {{-- modales --}}
        <div
            data-twe-modal-init
            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
            id="servicesModal"
            tabindex="-1"
            aria-labelledby="serviceModalLabel"
            aria-modal="true"
            role="dialog">
            <div
                data-twe-modal-dialog-ref
                class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
                    <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 px-4 pt-2 pb-1">
                        <!-- Modal title -->
                        <h5 class="text-xl font-medium leading-normal text-[#0392ceff]" id="servicesModalTitle">
                            Servicios
                        </h5>
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
                    <div class="relative p-4">
                        {{-- <div>
                            <img
                                id=""
                                alt="Oferta"
                                class="w-full h-full"
                            />
                        </div> --}}
                        <p x-text="services_description"></p>
                    </div>

                    <!-- Modal footer -->
                </div>
            </div>
        </div>
        <div
            data-twe-modal-init
            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
            id="accesoryModal"
            tabindex="-1"
            aria-labelledby="accesoryModalLabel"
            aria-modal="true"
            role="dialog">
            <div
                data-twe-modal-dialog-ref
                class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
                    <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 px-4 pt-2 pb-1">
                        <!-- Modal title -->
                        <h5 class="text-xl font-medium leading-normal text-[#0392ceff]" id="accesoryModalTitle">
                            Accesorios
                        </h5>
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
                    <div class="relative p-4">
                        <div>
                            {{-- <img
                                id="offertImage"
                                alt="Oferta"
                                class="w-full h-full"
                            /> --}}
                        </div>
                    </div>

                    <!-- Modal footer -->
                </div>
            </div>
        </div>
    </div>


    <x-slot name="footer"><x-footer/></x-slot>
</x-layouts.landingpage-layout>

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
<script>
  const video = document.getElementById("customVideo");
  const playPauseBtn = document.getElementById("playPauseBtn");
  const progress = document.getElementById("progress");
  const volume = document.getElementById("volume");
  const controls = document.getElementById("controls");

  // Mostrar controles al mover mouse
  let timeout;
  video.parentElement.addEventListener("mousemove", () => {
    controls.classList.add("opacity-100");
    clearTimeout(timeout);
    timeout = setTimeout(() => controls.classList.remove("opacity-100"), 2000);
  });

  // Play/Pause
  playPauseBtn.addEventListener("click", () => {
    if (video.paused) {
      video.play();
      playPauseBtn.textContent = "⏸️";
    } else {
      video.pause();
      playPauseBtn.textContent = "▶️";
    }
  });

  // Actualizar barra de progreso
  video.addEventListener("timeupdate", () => {
    progress.value = (video.currentTime / video.duration) * 100 || 0;
  });

  // Buscar en el video
  progress.addEventListener("input", () => {
    video.currentTime = (progress.value / 100) * video.duration;
  });

  // Control de volumen
  volume.addEventListener("input", () => {
    video.volume = volume.value;
  });
</script>