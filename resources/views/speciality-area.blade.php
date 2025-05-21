

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
    {{-- <div class="block relative">
        <img src="{{ asset('img/specAreabg.webp') }}" alt="services_img" class="w-full max-h-[35rem] object-cover" style="object-position: 0 10%;"/>
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="absolute inset-0 flex items-center justify-center ">
            <h1 class="text-white text-[3.5vw] font-sans">{{ $info }}</h1>
        </div>
    </div> --}}

    <div class="block" x-data="{accesorypdf: "",pdf_page: 0, accesorypdf_id: 0, services_description: "hola mundo"  }">
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
            <div class="w-full items-center justify-center mt-12 mb-4 ">
                <h1 class="text-slate text-center text-[3.0vw] font-medium font-sans text-sky-700">{{ $info }}</h1>
            </div>
        </section>
        <section class="flex max-w-[98vw]  px-2 md:px-8 gap-8 m-auto ">
            {{-- Filtros --}}
            <aside class="w-3/12 bg-gray-100 p-4 mt-12">
                    <x-filters  :title="'Categorias de producto'" :filters="$filters"/>
            </aside>

            {{-- Contenido --}}
            <main class="flex flex-col gap-72 w-9/12 max-w-9/12 mt-14 mb-72 ">

            @if (count($content) === 0)
                <div class="w-full text-center pt-14">
                    <p class="uppercase text-2xl text-gray-400 font-bold"> no se encontraron productos</p>
                </div>
            @endif
                @foreach ($content as $index => $product)
                {{-- <?php
                    $mensaje = "Hola desde PHP";
                    echo "<script>console.log(". json_encode($mensaje) .");</script>";
                ?> --}}

                    {{-- Productos --}}
                    <div class="flex flex-row gap-24  ">
                        {{-- Descripcion y modelos --}}
                        @if ($index % 2 != 0)
                            <div class="pro-detail w-full block justify-center order-last lg:order-none max-lg:max-w-[608px] max-lg:mx-auto">
                                <h2 class="mb-2 font-manrope font-bold text-4xl mt-8 leading-10 text-gray-900 uppercase">
                                    {{ $product->name }}
                                </h2>
                                <h3 class="mb-2 font-manrope font-semibold text-2xl mt-6 leading-10 text-sky-600">
                                    {{ $product->brand->name }}
                                </h3>
                                <p class="text-gray-500 text-xl font-normal  mb-8 max-w-[40rem] break-words whitespace-pre-line overflow-hidden">
                                    {{ $product->description }}
                                </p>

                                <div class="flex flex-row w-full gap-6 mt-4">
                                    <a href="https://api.whatsapp.com/send?phone=5567099766" target="_blank" class="flex flex-row justify-center items-center content-center rounded-full h-10 px-6 bg-[#25D366] hover:bg-[#3da362] active:bg-[#25D366]  gap-4">
                                        <i class="bi bi-whatsapp text-xl text-white"></i>
                                        <p class="text-lg font-bold text-white">Whatsapp</p>
                                    </a>

                                    <a href="/contact" class="flex flex-row justify-center items-center content-center rounded-full h-10 px-6 bg-blue-700 hover:bg-blue-900 active:bg-blue-700  gap-4">
                                        <i class="bi bi-headset text-xl text-white"></i>
                                        <p class="text-lg font-bold text-white">Contactanos</p>
                                    </a>
                                </div>
                                @if ($product->has_table == 1)
                                @php
                                    // Decodifica el JSON a array asociativo
                                    $tableData = json_decode($product->table_data, true);
                                    $headers   = $tableData['headers'] ?? [];
                                    $rows      = $tableData['table']   ?? [];
                                    echo "<script>console.log(". json_encode($rows) .");</script>";
                                @endphp
                                    @if ($rows != [] && $headers != [])
                                        <div class="block w-full mt-8">
                                            <div class="text">
                                                <div class="block w-full mb-6">
                                                    <p class="font-medium text-2xl leading-8 text-gray-900 mb-4">Modelos</p>
                                                    <div class="w-full overflow-auto">

                                                        <div class="w-full overflow-auto">
                                                            <table class="min-w-full  border border-white  shadow-sm overflow-hidden border-separate" style="border-spacing: 0 0.6rem;">
                                                                <thead>
                                                                    <tr>
                                                                        @foreach ($headers as $header)
                                                                            @if ($header != 'imagen')
                                                                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider first:rounded-l-lg last:rounded-r-lg bg-[#4180ab] ">
                                                                                    {{ $header }}
                                                                                </th>
                                                                            @endif
                                                                        @endforeach
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="divide-y divide-gray-200">
                                                                    @foreach ($rows as $row)
                                                                        @if (isset($row['position']))
                                                                            <tr class="cursor-pointer group" data-position="{{ $row['position'] }}" onclick="changeCarouselImage('carousel-{{ $index }}', {{ $row['position'] }})">
                                                                                @foreach ($headers as $header)
                                                                                    @if ($header != 'imagen' && $header != 'pdf'  && isset($row[$header]))
                                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                                            {{ isset($row[$header])? $row[$header]: 'N/A' }}
                                                                                        </td>
                                                                                    @elseif ($header === 'pdf')
                                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                                            <a href="/storage/{{$row[$header]}}">
                                                                                                <i class="bi bi-file-earmark-pdf-fill   text-red-500"></i>
                                                                                            </a>
                                                                                                {{-- {{ $row[$header] ?? 'N/A' }} --}}
                                                                                        </td>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>
                                                                        @else
                                                                            <tr class="cursor-pointer group">
                                                                                @foreach ($headers as $header)
                                                                                    @if ($header != 'imagen' && $header != 'pdf' )
                                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                                            @if (isset($row[$header]))
                                                                                                {{$row[$header]}}
                                                                                            @else
                                                                                                {{ 'N/A' }}
                                                                                            @endif
                                                                                        </td>
                                                                                    @elseif ($header === 'pdf')
                                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                                            @if ($row[$header])
                                                                                                <a href="/storage/{{$row[$header]}}">
                                                                                                    <i class="bi bi-file-earmark-pdf-fill   text-red-500"></i>
                                                                                                </a>
                                                                                            @else
                                                                                                {{ 'N/A' }}
                                                                                            @endif
                                                                                        </td>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endif
                            </div>
                        @endif
                        {{-- Imagenes y servicios --}}

                        <div class="block sticky top-32 h-fit ">
                            <div class="block min-w-[21rem]  min-h-[31rem] rounded-2xl overflow-hidden  shadow-xl" >
                                <div id="carousel-{{ $index }}" class="relative max-w-[21rem]  max-h-[31rem] bg-gray-600 rounded-2xl  overflow-hidden" data-carousel="static">
                                    <!-- Carousel wrapper -->
                                    <div class=" min-w-[21rem]  min-h-[31rem]  overflow-hidden">
                                        @foreach ($product->product_images as $img )

                                            @php
                                                // Quita las comillas dobles alrededor de type
                                                $type = trim($img->type, '"');
                                            @endphp
                                            @if (str_starts_with($type, 'image'))
                                                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                                    <img src="/storage/{{ $img->url }}" class=" block w-full h-full object-cover " alt="...">
                                                </div>
                                            @elseif(str_starts_with($type, 'video'))
                                                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                                    <video
                                                        controls
                                                        class="absolute block w-full h-full object-cover "
                                                    >
                                                        <source src="/storage/{{ $img->url }}" :type="{{ $type}}">
                                                    </video>
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
                            <div class="flex flex-row justify-center gap-14 w-full mt-8">
                                @if ($product->has_services == 1)
                                    {{-- <?php
                                        $mensaje = "Hola desde PHP";
                                        echo "<script>console.log(". json_encode($product->services_description ?? "") .");</script>";
                                    ?>  --}}
                                    <div>
                                        <button class="h-20 w-20 rounded-full shadow-lg border flex items-center justify-center  bg-sky-500 hover:bg-sky-600 active:bg-sky-500 translate transition-300"
                                            type="button"
                                            {{-- onclick="showOfertModal('{{ $offert['name'] }}', '{{ $offert['description'] }}', '{{ $offert['img_url']}}')" --}}
                                            data-twe-toggle="modal"
                                            data-twe-target="#servicesModal-{{ $index }}"
                                            data-twe-ripple-init
                                            data-twe-ripple-color="light"
                                        >
                                            <div class="h-16 w-16 border-2 border-white rounded-full flex items-center justify-center content-normal ">
                                                <i class="bi bi-gear text-3xl text-white"></i>
                                            </div>
                                        </button>
                                        <p class="text-lg mt-3 font-bold text-sky-600 text-center ">Servicios</p>
                                    </div>
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
                                                <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
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
                                    <div>

                                        <button class="h-20 w-20 rounded-full shadow-lg border flex items-center justify-center  bg-sky-500 hover:bg-sky-600 active:bg-sky-500 translate transition-300"
                                            type="button"
                                            {{-- onclick="showOfertModal('{{ $offert['name'] }}', '{{ $offert['description'] }}', '{{ $offert['img_url']}}')" --}}
                                            data-twe-toggle="modal"
                                            data-twe-target="#accesoryModal-{{ $index }}"
                                            data-twe-ripple-init
                                            data-twe-ripple-color="light"
                                        >
                                            <div class="h-16 w-16 border-2 border-white rounded-full flex items-center justify-center content-normal">
                                                <i class="bi bi-bookmark text-3xl text-white"></i>
                                            </div>
                                        </button>
                                        <p class="text-lg mt-3 font-bold text-sky-600 text-center ">Accesorios</p>
                                    </div>
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
                                            class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                                            <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
                                                <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
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
                                                    <div class="h-[35rem] w-full">
                                                        <iframe
                                                            src="{{ asset("/storage/".$url) }}#page={{ $page }}"
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
                            </div>
                        </div>
                        {{-- Descripcion y modelos --}}
                        @if ($index  % 2 == 0)
                            <div class="pro-detail w-full block justify-center order-last lg:order-none max-lg:max-w-[608px] max-lg:mx-auto">
                                <h2 class="mb-2 font-manrope font-bold text-4xl mt-8 leading-10 text-gray-900 uppercase">
                                    {{ $product->name }}
                                </h2>
                                <h3 class="mb-2 font-manrope font-semibold text-2xl mt-6 leading-10 text-sky-600">
                                    {{ $product->brand->name }}
                                </h3>
                                <p class="text-gray-500 text-xl font-normal  mb-8 max-w-[40rem] break-words whitespace-pre-line overflow-hidden">
                                    {{ $product->description }}
                                </p>

                                <div class="flex flex-row w-full gap-6 mt-4">
                                    <a href="https://api.whatsapp.com/send?phone=5567099766" class="flex flex-row justify-center items-center content-center rounded-full h-10 px-6 bg-[#25D366] hover:bg-[#3da362] active:bg-[#25D366]  gap-4">
                                        <i class="bi bi-whatsapp text-xl text-white"></i>
                                        <p class="text-lg font-bold text-white">Whatsapp</p>
                                    </a>

                                    <a href="/contact" class="flex flex-row justify-center items-center content-center rounded-full h-10 px-6 bg-blue-700 hover:bg-blue-900 active:bg-blue-700  gap-4">
                                        <i class="bi bi-headset text-xl text-white"></i>
                                        <p class="text-lg font-bold text-white">Contactanos</p>
                                    </a>
                                </div>
                                @if ($product->has_table == 1)
                                @php
                                    // Decodifica el JSON a array asociativo
                                    $tableData = json_decode($product->table_data, true);
                                    $headers   = $tableData['headers'] ?? [];
                                    $rows      = $tableData['table']   ?? [];
                                    echo "<script>console.log(". json_encode($rows) .");</script>";
                                @endphp
                                    @if ($rows != [] && $headers != [])
                                        <div class="block w-full mt-8">
                                            <div class="text">
                                                <div class="block w-full mb-6">
                                                    <p class="font-medium text-2xl leading-8 text-gray-900 mb-4">Modelos</p>
                                                    <div class="w-full overflow-auto">

                                                        <div class="w-full overflow-auto">
                                                            <table class="min-w-full  border border-white  shadow-sm overflow-hidden border-separate" style="border-spacing: 0 0.6rem;">
                                                                <thead>
                                                                    <tr>
                                                                        @foreach ($headers as $header)
                                                                            @if ($header != 'imagen')
                                                                                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider first:rounded-l-lg last:rounded-r-lg bg-[#4180ab] ">
                                                                                    {{ $header }}
                                                                                </th>
                                                                            @endif
                                                                        @endforeach
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="divide-y divide-gray-200">
                                                                    @foreach ($rows as $row)
                                                                        @if (isset($row['position']))
                                                                            <tr class="cursor-pointer group" data-position="{{ $row['position'] }}" onclick="changeCarouselImage('carousel-{{ $index }}', {{ $row['position'] }})">
                                                                                @foreach ($headers as $header)
                                                                                    @if ($header != 'imagen' && $header != 'pdf'  && isset($row[$header]))
                                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                                            {{ isset($row[$header])? $row[$header]: 'N/A' }}
                                                                                        </td>
                                                                                    @elseif ($header === 'pdf')
                                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                                            <a href="/storage/{{$row[$header]}}">
                                                                                                <i class="bi bi-file-earmark-pdf-fill   text-red-500"></i>
                                                                                            </a>
                                                                                                {{-- {{ $row[$header] ?? 'N/A' }} --}}
                                                                                        </td>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>
                                                                        @else
                                                                            <tr class="cursor-pointer group">
                                                                                @foreach ($headers as $header)
                                                                                    @if ($header != 'imagen' && $header != 'pdf' )
                                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                                            @if (isset($row[$header]))
                                                                                                {{$row[$header]}}
                                                                                            @else
                                                                                                {{ 'N/A' }}
                                                                                            @endif
                                                                                        </td>
                                                                                    @elseif ($header === 'pdf')
                                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 first:rounded-l-lg last:rounded-r-lg bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                                            @if ($row[$header])
                                                                                                <a href="/storage/{{$row[$header]}}">
                                                                                                    <i class="bi bi-file-earmark-pdf-fill   text-red-500"></i>
                                                                                                </a>
                                                                                            @else
                                                                                                {{ 'N/A' }}
                                                                                            @endif
                                                                                        </td>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endif
                            </div>
                        @endif
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
                    <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
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
                    <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
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
