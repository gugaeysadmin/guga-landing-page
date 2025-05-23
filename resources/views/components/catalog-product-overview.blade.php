@props(["product", "index", "productDecode", "accesoryPdf" ])
<div class="mx-auto md:flex md:flex-row gap-12 ">
    {{-- Imagenes y servicios --}}
    <div class="block">
        <div class="block sticky top-32 h-fit ">
            <div class="block min-w-[21rem]  min-h-[31rem] rounded-2xl overflow-hidden bg-white items-center  shadow-xl" >
                <div id="carousel-{{ $index }}" class="relative max-w-[21rem]  max-h-[31rem] bg-white rounded-2xl  overflow-hidden" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class=" min-w-[21rem]  min-h-[31rem]  overflow-hidden">
                        @foreach ($productDecode->product_images as $img )

                            @php
                                // Quita las comillas dobles alrededor de type
                                $type = trim($img->type, '"');
                            @endphp
                            @if (str_starts_with($type, 'image'))
                                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                    <img src="/storage/{{ $img->url }}" class="absolute block w-full h-full object-contain bg-white" alt="...">
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
                @endif
            </div>
        </div>
        
        <div class="flex flex-row justify-center gap-14 w-full mt-8">
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
                        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[70%]">
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
    <x-product-data :index="$index" :product="$product" />
</div>