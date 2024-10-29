@props(['images'])

<div>
    <div
        id="carouselExampleCaptions"
        class="relative min-h-[90vh]"
        data-twe-carousel-init
        data-twe-ride="carousel">
        <!--Carousel indicators-->
        <div
            class="absolute bottom-0 left-0 right-0 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0"
            data-twe-carousel-indicators>
            @foreach ($images as $index => $image )
                <button
                type="button"
                data-twe-target="#carouselExampleCaptions"
                data-twe-slide-to={{ $index }}
                {{ $loop->first ? 'data-twe-carousel-active' : '' }}
                class="mx-[8px] box-content h-[23px] w-[23px] flex-initial  rounded-full cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
                aria-current={{ $loop->first ? 'true' : 'false' }}
                aria-label={{ $index }}></button>
            @endforeach
        </div>

        <!--Carousel items-->
        <div
            class="relative w-full block min-h-[90vh]  overflow-hidden after:clear-both after:block after:content-['']">

            @foreach ($images as $index => $image )
                <div
                    class="relative float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
                    data-twe-carousel-item
                    {{ $loop->first ? 'data-twe-carousel-active' : '' }}
                    style="backface-visibility: hidden">
                        <img
                            src={{  $image['image'] }}
                            class="block h-[90vh] object-cover"
                            alt="..." />
                        {{-- <div
                            class="absolute inset-x-[15%] bottom-5 hidden py-5 text-center text-white md:block">
                            <h5 class="text-xl">{{ $image['description'] }}</h5>
                        </div> --}}
                    </div>
            @endforeach
        </div>

        <!--Carousel controls - prev item-->
        {{-- <button
            class="absolute bottom-0 left-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
            type="button"
            data-twe-target="#carouselExampleCaptions"
            data-twe-slide="prev">
            <span class="inline-block h-8 w-8">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6">
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            </span>
            <span
            class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
            >Previous</span
            >
        </button> --}}
        
        <!--Carousel controls - next item-->
        {{-- <button
            class="absolute bottom-0 right-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
            type="button"
            data-twe-target="#carouselExampleCaptions"
            data-twe-slide="next">
            <span class="inline-block h-8 w-8">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6">
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
            </span>
            <span
            class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
            >Next</span
            >
        </button> --}}
    </div>
</div>