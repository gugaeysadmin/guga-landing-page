

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
    <section class="flex max-w-[70rem] gap-8 m-auto ">
        {{-- Filtros --}}
        <aside class="w-[30%] bg-gray-100 p-4 mt-12">
                <x-filters  :title="'Categorias de producto'" :filters="$filters"/>
        </aside>

        {{-- Contenido --}}
        <main class="flex flex-col gap-24 w-[70%] mt-12 mb-24 ">
            @foreach ($content as $index => $product)

                {{-- Productos --}}
                <div class="flex flex-row gap-8">
                    {{-- Descripcion y modelos --}}
                    @if ($index % 2 != 0)
                        <div class="pro-detail w-7/12 flex flex-col justify-center order-last lg:order-none max-lg:max-w-[608px] max-lg:mx-auto">
                            <h2 class="mb-2 font-manrope font-bold text-3xl leading-10 text-gray-900">
                                {{ $product['name'] }}
                            </h2>
                            <h3 class="mb-2 font-manrope font-semibold text-xl leading-10 text-sky-600">
                                {{ $product['brand'] }}
                            </h3>
                            <p class="text-gray-500 text-base font-normal min-h-44 mb-8 mt-12">
                                {{ $product['description'] }}
                            </p>
                            <div class="block w-full">
                                <div class="text">
                                    <div class="block w-full mb-6">
                                        <p class="font-medium text-lg leading-8 text-gray-900 mb-4">Modelos</p>
                                        <div class="w-full overflow-auto">

                                            <div class="w-full overflow-auto">
                                                <table class="min-w-full  border border-white  shadow-sm overflow-hidden border-separate" style="border-spacing: 0 0.6rem;">
                                                    <thead>
                                                        <tr>
                                                            @foreach ($product["tableHeaders"] as $header)
                                                                @if ($header != 'img')
                                                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider first:rounded-l-lg last:rounded-r-lg bg-[#4180ab] ">
                                                                        {{ $header }}
                                                                    </th>
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200">
                                                        @foreach ($product["table"] as $row)
                                                            <tr class="cursor-pointer group" data-position="{{ $row['img'] }}" onclick="changeCarouselImage('carousel-{{ $index }}', {{ $row['img'] }})">
                                                                @foreach ($product["tableHeaders"] as $header)
                                                                    @if ($header != 'img' && $header != 'PDF'  && isset($row[$header]))
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                            {{ $row[$header] ?? 'N/A' }}
                                                                        </td>
                                                                    @elseif ($header === 'PDF')
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                            <i class="bi bi-file-earmark-pdf-fill   text-red-500"></i>
                                                                            {{-- {{ $row[$header] ?? 'N/A' }} --}}
                                                                        </td>
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- Imagenes y servicios --}}
                    <div class="w-5/12  h-[30rem] rounded-2xl overflow-hidden  shadow-2xl" >
                        <div id="carousel-{{ $index }}" class="relative bg-gray-600 rounded-2xl  overflow-hidden" data-carousel="slide">
                            <!-- Carousel wrapper -->
                            <div class="relative h-full overflow-hidden">
                                @foreach ($product["img"] as $img )
                                    <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                        <img src="{{ $img["src"] }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-[-20]" alt="...">
                                    </div>    
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
                                @foreach ($product["img"] as $img )
                                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide {{ $img["position"] }}" data-carousel-slide-to="{{ $img["position"] }}"></button>
                                @endforeach
                                {{-- <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button> --}}
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
                    @if ($index  % 2 == 0)
                        <div class="pro-detail w-7/12 flex flex-col justify-center order-last lg:order-none max-lg:max-w-[608px] max-lg:mx-auto">
                            <h2 class="mb-2 font-manrope font-bold text-3xl leading-10 text-gray-900">
                                {{ $product['name'] }}
                            </h2>
                            <h3 class="mb-2 font-manrope font-semibold text-xl leading-10 text-sky-600">
                                {{ $product['brand'] }}
                            </h3>
                            <p class="text-gray-500 text-base font-normal min-h-44 mb-8 mt-12">
                                {{ $product['description'] }}
                            </p>
                            <div class="block w-full">
                                <div class="text">
                                    <div class="block w-full mb-6">
                                        <p class="font-medium text-lg leading-8 text-gray-900 mb-4">Modelos</p>
                                        <div class="w-full overflow-auto">

                                            <div class="w-full overflow-auto">
                                                <table class="min-w-full  border border-white  shadow-sm overflow-hidden border-separate" style="border-spacing: 0 0.6rem;">
                                                    <thead>
                                                        <tr>
                                                            @foreach ($product["tableHeaders"] as $header)
                                                                @if ($header != 'img')
                                                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider first:rounded-l-lg last:rounded-r-lg bg-[#4180ab] ">
                                                                        {{ $header }}
                                                                    </th>
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200">
                                                        @foreach ($product["table"] as $row)
                                                            <tr class="cursor-pointer group" data-position="{{ $row['img'] }}" onclick="changeCarouselImage('carousel-{{ $index }}', {{ $row['img'] }})">
                                                                @foreach ($product["tableHeaders"] as $header)
                                                                    @if ($header != 'img' && $header != 'PDF'  && isset($row[$header]))
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                            {{ $row[$header] ?? 'N/A' }}
                                                                        </td>
                                                                    @elseif ($header === 'PDF')
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                            <i class="bi bi-file-earmark-pdf-fill   text-red-500"></i>
                                                                            {{-- {{ $row[$header] ?? 'N/A' }} --}}
                                                                        </td>
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </main>

    </section>


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
</script>