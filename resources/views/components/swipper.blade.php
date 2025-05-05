@props(['alliances'])


<!-- Slider main container -->
<div class="swiper swiper1 px-10 ">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    @foreach($alliances as $alliance)
        <div class="swiper-slide p-10">
          <div class=" flex justify-center items-center px-10 h-[11rem] w-[18rem] bg-white rounded-2xl shadow-5  mb-12">
              @if ($alliance->url)  
                <a href="{{ $alliance->url }}" class="my-auto" >
                    <img src="/storage/{{ $alliance->img_url }}" alt="..." class="object-contain" />
                </a>
              @else
                <div class="my-auto" >
                    <img src="/storage/{{ $alliance->img_url }}" alt="..." class="object-contain" />
                </div>
              @endif
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
  <div class="swiper-pagination swiper-pagination1"></div>

  <!-- If we need navigation buttons -->
  {{-- <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div> --}}

  <!-- If we need scrollbar -->
  <div class="swiper-scrollbar swiper-scrollbar1"></div>
</div>