@props(['slides'])


<!-- Slider main container -->
<div class="swiper px-10 my-10">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    @foreach($slides as $slide)
        <div class="swiper-slide p-10">
          <div class=" flex justify-center items-center px-10 h-40 w-60 bg-white rounded-3xl shadow-5  mb-12">
              <a href="{{ $slide["to"] }}" class="my-auto" >
                  <img src={{ $slide["image"] }} alt="..." class="object-contain" />
              </a>
          </div>
        </div>
        {{-- <div class="swiper-slide block p-10 bg-white rounded-3xl shadow-5  mb-12">
            <div class="flex justify-center h-[200px]">
                <a href="{{ $slide["to"] }}" class="my-auto" >
                    <img src={{ $slide["image"] }} alt="..."/>
                </a>
            </div>
        </div> --}}
    @endforeach
  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

  <!-- If we need navigation buttons -->
  {{-- <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div> --}}

  <!-- If we need scrollbar -->
  <div class="swiper-scrollbar"></div>
</div>