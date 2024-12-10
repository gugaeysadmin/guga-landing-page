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
    <x-slot name="header"> <x-header :pages="$pages"/></x-slot>
    <x-safe-area>
                                                        

    <section class="py-10 lg:py-24 relative ">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
                <div class="pro-detail w-full flex flex-col justify-center order-last lg:order-none max-lg:max-w-[608px] max-lg:mx-auto">
                    <p class="font-medium text-lg text-indigo-600 mb-4">Descripcion</p>
                
                </div>
                <div class="">
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                        class="swiper product-prev mb-6">
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
                        </div>

                    </div>
                    <div thumbsSlider="" class="swiper product-thumb max-w-[608px] mx-auto">
                        <div class="swiper-wrapper">
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
                                            
    </x-safe-area>
</x-layouts.landingpage-layout>

@push('scripts')
<script>
var swiper3= new Swiper(".product-thumb", {
    loop: true,
    spaceBetween: 12,
    slidesPerView: 4,
    
    freeMode: true,
    watchSlidesProgress: true,
   
});
var swiper2 = new Swiper(".product-prev", {
    loop: true,
    spaceBetween: 32,
    effect: "fade",
   
    thumbs: {
        swiper: swiper,
    },
    });
</script>
@endpush