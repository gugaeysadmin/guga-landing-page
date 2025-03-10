

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
<x-layouts.landingpage-layout>

    <x-slot name="header"> <x-header/></x-slot>
    <div class="block relative">
        <!-- Imagen de cabecera -->
        <img src="{{ asset('img/catalog_img_header.jpg') }}" alt="services_img" class="w-full max-h-[35rem] object-cover" style="object-position: 0 10%;"/>

        <!-- Capa de opacidad -->
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <!-- Título -->
        <div class="absolute inset-0 flex items-center justify-center ">
            <h1 class="text-white text-[3.5vw] font-sans">{{ $info }}</h1>
        </div>
    </div>
    <section class="flex max-w-[80rem] m-auto">
        {{-- Filtros --}}
        <aside class="w-1/4 bg-gray-100 p-4 mt-12 sticky">
            <div class="w-full bg-sky-600 p-4 flex items-center font-sans font-semibold text-sky-50">
                <h2 class="text-lg font-bold">Categorías de Producto</h2>
            </div>

            <div id="categoriasFilter" class="mt-4">
                <div class="border border-neutral-200 bg-white dark:border-neutral-600 dark:bg-body-dark gap-4">
                    <h2 class="mb-0" id="headingOne">
                    <button
                        class="group relative flex w-full items-center border-0 bg-slate-200 px-5 py-4 text-left font-semibold text-lg text-blue-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-body-dark dark:text-white [&:not([data-twe-collapse-collapsed])]:bg-sky-400 [&:not([data-twe-collapse-collapsed])]:text-sky-50 [&:not([data-twe-collapse-collapsed])]:shadow-border-b dark:[&:not([data-twe-collapse-collapsed])]:bg-surface-dark dark:[&:not([data-twe-collapse-collapsed])]:text-primary dark:[&:not([data-twe-collapse-collapsed])]:shadow-white/10 "
                        type="button"
                        data-twe-collapse-init
                        data-twe-target="#collapseOne"
                        aria-expanded="true"
                        aria-controls="collapseOne"
                    >
                        Marcas
                        <span class="-me-1 ms-auto h-5 w-5 shrink-0 rotate-[90deg] transition-transform duration-200 ease-in-out group-data-[twe-collapse-collapsed]:me-0 group-data-[twe-collapse-collapsed]:rotate-0 motion-reduce:transition-none [&>svg]:h-6 [&>svg]:w-6">
                            <i class="bi bi-caret-right-fill text-xl"></i>
                        </span>
                    </button>
                    </h2>
                    <div
                        id="collapseOne"
                        class="!visible"
                        data-twe-collapse-item
                        data-twe-collapse-show
                        aria-labelledby="headingOne"
                        data-twe-parent="#accordionExample"
                    >
                        <div class="px-5 py-4">
                            <ul class="pl-4 mt-2 space-y-2">
                                <li>
                                    <label class="flex items-center space-x-3 text-sky-600 hover:text-sky-900 cursor-pointer">
                                        <input type="checkbox" class="hidden peer" />
                                        <span class="w-5 h-5 border-2 border-sky-500 rounded-md flex items-center justify-center peer-checked:bg-sky-600 peer-checked:border-sky-600 transition">
                                            <svg
                                                class="w-4 h-4 text-white hidden peer-checked:block"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>
                                        </span>
                                        <span>Portátiles</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center space-x-3 text-sky-700 hover:text-sky-900 cursor-pointer">
                                        <input type="checkbox" class="hidden peer" />
                                        <span class="w-5 h-5 border-2 border-sky-500 rounded-md flex items-center justify-center peer-checked:bg-sky-600 peer-checked:border-sky-600 transition">
                                            <svg
                                                class="w-4 h-4 text-white hidden peer-checked:block"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>
                                        </span>
                                        <span>Sobremesa</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Contenido --}}
        <main class="flex w-3/4 mt-12">
            @foreach ($content as $product )
                <div class="block">

                    {{-- Imagenes y servicios --}}
                    <div class="w-2/5 px-0 sm:px-8 rounded-2xl overflow-hidden" >
                        <div class="relative bg-gray-600" data-carousel="slide">
                            <!-- Carousel wrapper -->
                            <div class="relative h-full overflow-hidden">
                                <!-- Item 1 -->
                                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
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
                                </div>

                            </div>
                            <!-- Slider indicators -->
                            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                            </div>
                            <!-- Slider controls -->
                            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                    </svg>
                                    <span class="sr-only">Previous</span>
                                </span>
                            </button>
                            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="sr-only">Next</span>
                                </span>
                            </button>
                        </div>
                    </div>

                    {{-- Descripcion y modelos --}}
                    <div class="pro-detail w-1/2 flex flex-col justify-center order-last lg:order-none max-lg:max-w-[608px] max-lg:mx-auto">
                        <h2 class="mb-2 font-manrope font-bold text-3xl leading-10 text-gray-900">
                            {{ $product['name'] }}
                        </h2>
                        <p class="text-gray-500 text-base font-normal mb-8 mt-12">
                            {{ $product['description'] }}
                        </p>
                        <div class="block w-full">
                            <div class="text">
                                <div class="block w-full mb-6">
                                    <p class="font-medium text-lg leading-8 text-gray-900 mb-4">Modelos</p>
                                    <div class="grid grid-cols-2 min-[400px]:grid-cols-3 gap-3">
                                        <button
                                            class="border border-gray-200 text-gray-900 text-lg py-2 rounded-full px-1.5 sm:px-6 w-full font-semibold whitespace-nowrap shadow-sm shadow-transparent transition-all duration-300 hover:shadow-gray-300 hover:bg-gray-50 hover:border-gray-300">56
                                            cm (S)</button>
                                        <button
                                            class="border border-gray-200 text-gray-900 text-lg py-2 rounded-full px-1.5 sm:px-6 w-full font-semibold whitespace-nowrap shadow-sm shadow-transparent transition-all duration-300 hover:shadow-gray-300 hover:bg-gray-50 hover:border-gray-300">67
                                            cm (M)</button>
                                        <button
                                            class="border border-gray-200 text-gray-900 text-lg py-2 rounded-full px-1.5 sm:px-6 w-full font-semibold whitespace-nowrap shadow-sm shadow-transparent transition-all duration-300 hover:shadow-gray-300 hover:bg-gray-50 hover:border-gray-300">77
                                            cm (L)</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </main>

    </section>


    <x-slot name="footer"><x-footer/></x-slot>
</x-layouts.landingpage-layout>
php a
