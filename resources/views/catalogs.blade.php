
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
    <div class="flex px-4 md:px-16 m-auto mb-40">
        <!-- Filtros -->
        <aside class="w-1/4 bg-gray-100 p-4 mt-12 sticky">
            <x-filters  :title="'Categorias de producto'" :filters="$filters"/>
        </aside>
        {{-- <?php
            $mensaje = "Hola desde PHP";
            echo "<script>console.log(". json_encode($product->services_description ?? "") .");</script>";
        ?> --}}
        <!-- Contenido -->
        <main class="w-3/4 p-4" x-data="{ isGrid: true  }">
            <!-- Botón de cambio de modo -->
            <div class="flex justify-end mb-4">
                <button id="gridView" @click="isGrid = true" class="mr-2 px-4 py-2 bg-sky-600 rounded hover:bg-sky-500" id="gridView">
                    <i class="bi bi-grid text-xl text-sky-50"></i>
                </button>
                <button id="listView" @click="isGrid = false" class="px-4 py-2 bg-sky-600 rounded hover:bg-sky-500" id="listView">
                    <i class="bi bi-list-ul text-xl text-sky-50"></i>
                </button>
            </div>
            <!-- Contenedor de productos -->
                <div   id="productsContainer" class="flex flex-row flex-wrap gap-14">
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
                            <h3 class="font-sans mt-4 font-semibold xs:text-md md:text-2xl text-sky-600 uppercase ">{{ $product->name }}</h3>
                        </button>
                        <button x-show="!isGrid" class="productCard bg-white rounded-xl p-4 shadow-lg hover:shadow-xl  flex transition-all duration-300 ease-in-out hover:-translate-y-4 hover:cursor-pointer group"
                                data-twe-toggle="modal"
                                data-twe-target="#productModal-{{ $index }}"
                                data-twe-ripple-init
                                data-twe-ripple-color="light"
                        >
                            <img src="{{ $img }}" alt="Producto" class="w-40 h-60 object-cover rounded mb-4">
                            <div class="p-4">
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
                                class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] max-w-[97vw] md:max-w-[80vw] ">
                                <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
                                    <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
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
                                    <div class="flex flex-row gap-8 p-4">
                                        {{-- Imagenes y servicios --}}
                                        <template>
                                            <div class="block">
                                                <div class="min-w-[21rem]  min-h-[31rem] rounded-2xl overflow-hidden  shadow-xl" >
                                                    <div id="carousel-{{ $index }}" class="relative bg-gray-600 rounded-2xl  overflow-hidden" data-carousel="static">
                                                        <!-- Carousel wrapper -->
                                                        <div class="relative h-full overflow-hidden">
                                                            @foreach ($productDecode->product_images as $img )

                                                                @php
                                                                    // Quita las comillas dobles alrededor de type
                                                                    $type = trim($img->type, '"');
                                                                @endphp
                                                                @if (str_starts_with($type, 'image'))
                                                                    <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                                                        <img src="/storage/{{ $img->url }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-[-20]" alt="...">
                                                                    </div> 
                                                                @elseif(str_starts_with($type, 'video'))
                                                                    <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                                                        <video 
                                                                            controls    
                                                                            class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-[-20]"
                                                                        >
                                                                            <source src="/storage/{{ $img->url }}" :type="{{ $type}}">
                                                                        </video>
                                                                    </div> 

                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <!-- Slider indicators -->
                                                        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                                                            @foreach ($productDecode->product_images as $img )
                                                                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide {{ $img->index }}" data-carousel-slide-to="{{ $img->index }}"></button>
                                                            @endforeach
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
                                                        <button class="h-28 w-28 rounded-full shadow-lg border flex items-center justify-center  bg-sky-500 hover:bg-sky-600 active:bg-sky-500 translate transition-300"
                                                            type="button"
                                                            {{-- onclick="showOfertModal('{{ $offert['name'] }}', '{{ $offert['description'] }}', '{{ $offert['img_url']}}')" --}}
                                                            data-twe-toggle="modal"
                                                            data-twe-target="#servicesModal-{{ $index }}"
                                                            data-twe-ripple-init
                                                            data-twe-ripple-color="light"
                                                        >
                                                            <div class="h-24 w-24 border-4 border-white rounded-full flex items-center justify-center content-normal ">
                                                                <i class="bi bi-gear text-5xl text-white"></i>
                                                            </div>
                                                        </button>
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
                                                        <div class="h-28 w-28 rounded-full shadow-lg border flex items-center justify-center  bg-sky-500 hover:bg-sky-600 active:bg-sky-500 translate transition-300"
                                                            type="button"
                                                            data-twe-toggle="modal"
                                                            data-twe-target="#accesoryModal-{{ $index }}"
                                                            data-twe-ripple-init
                                                            data-twe-ripple-color="light"
                                                        >
                                                            <div class="h-24 w-24 border-4 border-white rounded-full flex items-center justify-center content-normal">
                                                                <i class="bi bi-bookmark text-6xl text-white"></i>
                                                            </div>
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
                                                                        <h5 class="text-xl font-medium leading-normal text-[#0392ceff]" id="accesoryModalTitle">
                                                                            Accesorios
                                                                        </h5>
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </template>
                                        {{-- Descripcion y modelos --}}
                                        <div class="pro-detail w-full block justify-center order-last lg:order-none max-lg:max-w-[608px] max-lg:mx-auto">
                                            <h2 class="mb-2 font-manrope font-bold text-4xl mt-8 leading-10 text-gray-900 uppercase">
                                                {{ $product->name }}
                                            </h2>
                                            <h3 class="mb-2 font-manrope font-semibold text-2xl mt-6 leading-10 text-sky-600 uppercase">
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
                                                                    <h5 class="text-xl font-medium leading-normal text-[#0392ceff]" id="accesoryModalTitle">
                                                                        Accesorios
                                                                    </h5>
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
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
            </div>
        </main>
    </div>
 

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
