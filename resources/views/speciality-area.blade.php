

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
    <section class="py-10 lg:py-24 relativ ">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
                <div class="pro-detail w-full flex flex-col justify-center order-last lg:order-none max-lg:max-w-[608px] max-lg:mx-auto">                    
                    <h2 class="mb-2 font-manrope font-bold text-3xl leading-10 text-gray-900">
                        PRODUCTO N
                    </h2>
                    <p class="text-gray-500 text-base font-normal mb-8 mt-12">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <div class="block w-full">
                        <p class="font-medium text-lg leading-8 text-gray-900 mb-4">Servicios</p>
                        <div class="text">
                            <div class="flex items-center justify-start gap-3 md:gap-6 relative mb-6 ">
                                <button data-ui="checked active"
                                    class="p-2.5 border border-gray-200 rounded-full transition-all duration-300 hover:border-emerald-500 :border-emerald-500">
                                    <svg width="20" height="20" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="20" cy="20" r="20" fill="#10B981" />
                                    </svg>
                                </button>
                                <button
                                    class="p-2.5 border border-gray-200 rounded-full transition-all duration-300 hover:border-amber-400 focus-within:border-amber-400">
                                    <svg width="20" height="20" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="20" cy="20" r="20" fill="#FBBF24" />
                                    </svg>

                                </button>
                                <button
                                    class="p-2.5 border border-gray-200 rounded-full transition-all duration-300 hover:border-red-500 focus-within:border-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 40 40"
                                        fill="none">
                                        <circle cx="20" cy="20" r="20" fill="#F43F5E" />
                                    </svg>
                                </button>
                                <button
                                    class="p-2.5 border border-gray-200 rounded-full  transition-all duration-300 hover:border-blue-400 focus-within:border-blue-400">
                                    <svg width="20" height="20" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="20" cy="20" r="20" fill="#2563EB" />
                                    </svg>
                                </button>

                            </div>
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
                            {{-- <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">
                                <div class="flex items-center justify-center w-full">
                                    <button
                                        class="group py-4 px-6 border border-gray-400 rounded-l-full shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
                                        <svg class="stroke-gray-700 transition-all duration-500 group-hover:stroke-black"
                                            width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                stroke-linecap="round" />
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                                stroke-linecap="round" />
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                    <input type="text"
                                        class="font-semibold text-gray-900 text-lg py-[13px] px-6 w-full lg:max-w-[118px] border-y border-gray-400 bg-transparent placeholder:text-gray-900 text-center hover:bg-gray-50 focus-within:bg-gray-50 outline-0"
                                        placeholder="1">
                                    <button
                                        class="group py-4 px-6 border border-gray-400 rounded-r-full shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
                                        <svg class="stroke-gray-700 transition-all duration-500 group-hover:stroke-black"
                                            width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                stroke-linecap="round" />
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                stroke-width="1.6" stroke-linecap="round" />
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                stroke-width="1.6" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>
                            
                            </div> --}}
                            <div class="flex items-center gap-3">
                                <button
                                    class="text-center w-full px-5 py-4 rounded-[100px] bg-indigo-600 flex items-center justify-center font-semibold text-lg text-white shadow-sm transition-all duration-500 hover:bg-indigo-700 hover:shadow-indigo-400">
                                    Contactanos
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="">
                    <div class=" product-prev mb-6" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1700471851.png"
                                    alt="Yellow Travel Bag image" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1711514857.png"
                                    alt="Yellow Travel Bag image" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1711514875.png"
                                    alt="Yellow Travel Bag image" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1711514892.png"
                                    alt="Yellow Travel Bag image" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1700471851.png"
                                    alt="Yellow Travel Bag image" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1711514857.png"
                                    alt="Yellow Travel Bag image" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1711514875.png"
                                    alt="Yellow Travel Bag image" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1711514892.png"
                                    alt="Yellow Travel Bag image" class="mx-auto object-cover">
                            </div>
                        </div>

                    </div>
                    <div thumbsSlider="" class="product-thumb max-w-[608px] mx-auto overflow-hidden">
                        <div class=" swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1700471871.png" alt="Travel Bag image"
                                    class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1711514930.png" alt="Travel Bag image"
                                    class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1700471908.png" alt="Travel Bag image"
                                    class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1700471925.png" alt="Travel Bag image"
                                    class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1700471871.png" alt="Travel Bag image"
                                    class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1711514930.png" alt="Travel Bag image"
                                    class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1700471908.png" alt="Travel Bag image"
                                    class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://pagedone.io/asset/uploads/1700471925.png" alt="Travel Bag image"
                                    class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </section>
    <x-slot name="footer"><x-footer/></x-slot>
</x-layouts.landingpage-layout>
php a