@props(['offerts'])

<div>
    <div class="pt-20 ">
        <h1 class="text-center text-[2.2rem] font-sans font-extralight text-[#0392ceff]"> Nuestras ofertas</h1>
    </div>
    <div class=" max-w-[80rem] mx-auto  gap-20 mt-10 pb-32 justify-center items-center">
        {{-- @foreach ($offerts as $offert ) --}}
            {{-- <button class="relative transition-all duration-300 ease-in-out hover:-translate-y-4 hover:cursor-pointer group" 
                type="button"
                onclick="showOfertModal('{{ $offert['title'] }}', '{{ $offert['description'] }}', '{{ $offert['url']}}')"
                data-twe-toggle="modal"
                data-twe-target="#offertModal"
                data-twe-ripple-init
                data-twe-ripple-color="light"
            >
                <!-- Tarjeta -->
                <div class="w-64 h-40 bg-slate-200 border-l-2 border-[#0392ceff] group-hover:bg-[#0392ceff] transform skew-x-[-15deg] flex justify-center items-center pl-11 pr-5   group transition duration-300">
                    <div class="transform skew-x-[15deg] group-hover:text-white">
                        <h4 class="font-semibold text-lg group-hover:font-bold">{{ $offert['title'] }}</h4>
                        <p class="text-xs mt-1 group-hover:font-semibold text-sky-600 underline">VER</p>
                    </div>
                </div>
                
                <!-- Círculo -->
                <div class="absolute -left-10 top-1/4 bg-[#0392ceff] rounded-full h-20 w-20 flex items-center justify-center group-hover:bg-[#0392ceff] border-4 border-white transition  duration-300">
                    <i class="bi bi-percent text-white text-3xl"></i>
                </div>
                
            </button> --}}


            <!-- Slider main container -->

                <div class=" swiper swiper2">  <!-- Cambiado de swiper-container a swiper -->
                    <div class="swiper-wrapper">
                        @foreach($offerts as $offert)
                            <div class="swiper-slide py-9">  
                                <div class="flex justify-center items-center h-full">  
                                    <button class="relative transition-all duration-300 ease-in-out hover:-translate-y-4 hover:cursor-pointer group" 
                                        type="button"
                                        onclick="showOfertModal('{{ $offert['title'] }}', '{{ $offert['description'] }}', '{{ $offert['url']}}')"
                                        data-twe-toggle="modal"
                                        data-twe-target="#offertModal"
                                        data-twe-ripple-init
                                        data-twe-ripple-color="light"
                                    >
                                        <!-- Tu contenido del slide aquí -->
                                        <div class="w-64 h-40 bg-slate-200 border-l-2 border-[#0392ceff] group-hover:bg-[#0392ceff] transform skew-x-[-15deg] flex justify-center items-center pl-11 pr-5 group transition duration-300">
                                            <div class="transform skew-x-[15deg] group-hover:text-white">
                                                <h4 class="font-semibold text-lg group-hover:font-bold">{{ $offert['title'] }}</h4>
                                                <p class="text-xs mt-1 group-hover:font-semibold text-sky-600 underline">VER</p>
                                            </div>
                                        </div>
                                        
                                        <div class="absolute -left-10 top-1/4 bg-[#0392ceff] rounded-full h-20 w-20 flex items-center justify-center group-hover:bg-[#0392ceff] border-4 border-white transition duration-300">
                                            <i class="bi bi-percent text-white text-3xl"></i>
                                        </div>
                                    </button> 
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                    <!-- Paginación -->
                    <div class="swiper-pagination swiper-pagination2"></div>
                    
                    <!-- Botones de navegación (opcional) -->
                    {{-- <div class="swiper-button-prev swiper-button-prev2"></div>
                    <div class="swiper-button-next swiper-button-next2"></div> --}}
                </div>

            {{-- <div class="relative transition-all duration-300 ease-in-out hover:-translate-y-4 hover:cursor-pointer group" 

                <!-- Tarjeta -->
                <div class="w-64 h-40 bg-slate-200 border-l-2 border-[#0392ceff] group-hover:bg-[#0392ceff] transform skew-x-[-15deg] flex justify-center pt-10 pl-11 pr-5   group transition duration-300">
                    <div class="transform skew-x-[15deg] group-hover:text-white">
                        <h4 class="font-semibold text-lg">{{ $offert['title'] }}</h4>
                        <p class="text-xs mt-1">{{ $offert['description'] }}</p>
                    </div>
                </div>
                
                <!-- Círculo -->
                <div class="absolute -left-10 top-1/4 bg-[#0392ceff] rounded-full h-20 w-20 flex items-center justify-center group-hover:bg-white border-4 border-white transition  duration-300">
                    <i class="bi bi-percent text-white text-3xl group-hover:text-[#0392ceff]"></i>
                </div>

            </div> --}}

        {{-- @endforeach --}}
    </div>
</div>

<!--Verically centered scrollable modal-->
{{-- <div
  data-twe-modal-init
  class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
  id="offertModal"
  tabindex="-1"
  aria-labelledby="offertModal"
  aria-modal="true"
  role="dialog">
  <div
    data-twe-modal-dialog-ref
    class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
    <div
      class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none dark:bg-surface-dark">
      <div
        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4 dark:border-white/10">
        <!-- Modal title -->
        <h5
          class="text-xl font-medium leading-normal text-surface dark:text-white"
          id="exampleModalCenteredScrollableLabel">
          Modal title
        </h5>
        <!-- Close button -->
        <button
          type="button"
          class="box-content rounded-none border-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
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
        <p>
          This is some placeholder content to show a vertically centered
          modal. We've added some extra copy here to show how vertically
          centering the modal works when combined with scrollable modals.
          We also use some repeated line breaks to quickly extend the
          height of the content, thereby triggering the scrolling. When
          content becomes longer than the predefined max-height of modal,
          content will be cropped and scrollable within the modal.
        </p>
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        <p>Just like that.</p>
      </div>

      <!-- Modal footer -->
      <div
        class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4 dark:border-white/10">
        <button
          type="button"
          class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400"
          data-twe-modal-dismiss
          data-twe-ripple-init
          data-twe-ripple-color="light">
          Close
        </button>
      </div>
    </div>
  </div>
</div> --}}


<!-- Modal -->
<div
    data-twe-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="offertModal"
    tabindex="-1"
    aria-labelledby="offertModalLabel"
    aria-modal="true"
    role="dialog">
    <div
        data-twe-modal-dialog-ref
        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
        <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
                <!-- Modal title -->
                <h5 class="text-xl font-medium leading-normal text-[#0392ceff]" id="offertModalTitle">
                    Título de la oferta
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
                    <img
                        id="offertImage"
                        alt="Oferta"
                        class="w-full h-full"
                    />
                </div>
            </div>

            <!-- Modal footer -->
        </div>
    </div>
</div>

<script>
function showOfertModal(title, shortDesc, imgurl) {
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