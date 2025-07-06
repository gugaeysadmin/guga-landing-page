
<x-layouts.landingpage-layout>
    {{-- Header --}}
    <x-slot name="header"> <x-header/></x-slot>

    {{-- video --}}
    <div class="block">
        <x-landing-video :description="$entepriseInfo->main_description"/>
    </div>
    {{-- <div class="w-full">
        <x-flipbook/>
    </div> --}}


    {{-- Areas de equipamiento --}}
    <section class="py-32 px-4 sm:px-12 bg-slate-50">
        <div class="max-w-[100rem] mx-auto">
            <x-equipment-areas :specareas="$areas"/>
        </div>
    </section>

    {{-- Mission vission --}}
    <div>
        <x-enterprise-info :about="$entepriseInfo->about_us" :mision="$entepriseInfo->mission" :vision="$entepriseInfo->vission" :values="$entepriseInfo->values"/>
    </div>

    {{-- Ofertas --}}
    <section class="bg-slate-50">

        <x-offerts :offerts="$offerts"/>

    </section>
    {{-- Servicios --}}
    <section >
        <x-services-section :description="$entepriseInfo->services_description" :services="$services"/>
    </section>

    {{-- Alianzas --}}
    <section class="bg-slate-50">
        <div class="py-32">
            <div class="block text-center">
                <h1 class="text-[2.4rem] font-sans font-extralight text-[#0392ceff] italic ">{{ __('Alianzas') }}</h1>
            </div>
            {{-- <div class="w-full max-w-[80rem] mx-auto px-4 flex flex-wrap justify-around">
                <div class="bg-white mt-6 rounded-2xl p-6 w-[15rem] h-[15rem] flex justify-center items-center">
                <a href="" class="my-auto" >
                    <img src={{ asset("img/cisa.png") }} alt="..." class="object-contain" />
                    </a>
                </div>

                <div class="bg-white mt-6 rounded-2xl p-6 w-[15rem] h-[15rem] flex justify-center items-center">
                <a href="" class="my-auto" >
                    <img src={{ asset("img/amtai.png") }} alt="..." class="object-contain" />
                    </a>
                </div>

                <div class="bg-white mt-6 rounded-2xl p-6 w-[15rem] h-[15rem] flex justify-center items-center">
                <a href="" class="my-auto" >
                    <img src={{ asset("img/biodex.jpg") }} alt="..." class="object-contain" />
                    </a>
                </div>

                <div class="bg-white mt-6 rounded-2xl p-6 w-[15rem] h-[15rem] flex justify-center items-center">
                <a href="" class="my-auto" >
                    <img src={{ asset("img/fiochetti.jpg") }} alt="..." class="object-contain" />
                    </a>
                </div>
            </div> --}}
            <div class="w-full max-w-[80rem] mx-auto flex mt-4">
                <x-swipper :alliances="$alliances" />
            </div>
        </div>
    </section>

    {{-- <div class="w-full md:w-3/5 py-16">
        <h1 class="px-5 sm:px-5 md:px-32 text-[3rem] font-sans font-semibold text-[#0392ceff]">{{ __('Alianzas') }}</h1>
        <div class="mx-5 sm:mx-5 md:ml-32 md:mr-40 mt-4 mb-10 border-t-[3px] border-slate-400"></div>
        <p class="px-5 sm:px-5 md:px-32 text-[1.5rem]">
            {{ __('En Guga, las alianzas son esenciales. Nos permiten ampliar nuestra oferta, acceder a nuevos mercados, compartir conocimientos, reducir costos, fomentar la innovación y gestionar riesgos de manera efectiva, todo lo cual contribuye a nuestro éxito y crecimiento continuo.') }}
        </p>
    </div> --}}







    {{-- <section class="bg-slate-50 flex flex-wrap md:flex-row flex-col">
        <div class="w-full md:w-3/5 py-16">
            <h1 class="px-5 sm:px-5 md:px-32 text-[3rem] font-sans font-semibold text-[#0392ceff]">{{ __('Alianzas') }}</h1>
            <div class="mx-5 sm:mx-5 md:ml-32 md:mr-40 mt-4 mb-10 border-t-[3px] border-slate-400"></div>
            <p class="px-5 sm:px-5 md:px-32 text-[1.5rem]">
                {{ __('En Guga, las alianzas son esenciales. Nos permiten ampliar nuestra oferta, acceder a nuevos mercados, compartir conocimientos, reducir costos, fomentar la innovación y gestionar riesgos de manera efectiva, todo lo cual contribuye a nuestro éxito y crecimiento continuo.') }}
            </p>
        </div>
        <div class="w-full md:w-2/5 px-4 py-12 flex bg-slate-600">
            <x-swipper :slides="$aliances" />
        </div>
    </section> --}}


    {{-- Footer --}}
    <x-slot name="footer"><x-footer/></x-slot>
</x-layouts.landingpage-layout>


{{-- Viejo codigo --}}


    {{-- Carrusel --}}
    {{-- <x-carousel :images="$imagelist" /> --}}

{{-- Alianzas --}}
    {{-- <section class="pt-20">
        <h1 class="text-center text-[3rem]  text-blueText">{{ __('Alianzas') }}</h1>
        <div class=" mx-auto w-[60vw] border-t-[3px] border-blue-500 my-3"></div>
        <p class="text-center sm:px-5 md:px-32 text-[1.5rem]">{{ __('En Guga, las alianzas son esenciales. Nos permiten ampliar nuestra oferta, acceder a nuevos mercados, compartir conocimientos, reducir costos, fomentar la innovación y gestionar riesgos de manera efectiva, todo lo cual contribuye a nuestro éxito y crecimiento continuo.') }}</p>
    </section>
    <x-swipper :slides="$aliances" /> --}}

{{-- Areas de equipamiento --}}
    {{-- <section class="pt-14 px-4 sm:px-12 bg-white">
        <h1 class="text-center text-[3rem]  text-blueText">{{ __('Areas de equipamiento') }}</h1>
        <div class="flex flex-wrap justify-around  mt-12">
        @foreach ($areas as $area )
            <x-card class=" mx-1 min-h-[33rem] w-[25rem] my-4 transform transition-transform hover:scale-110 cursor-pointer hover:z-10 hover:shadow-[rgba(72,87,203,0.1)_0px_20px_25px_-5px,rgba(72,87,203,0.04)_0px_10px_10px_-5px]">
                <img src={{ $area['image'] }} class="mx-auto h-[20rem] max-w-[25rem] object-cover "/>
                <h2 class="text-center text-[2.2rem]  text-blueText">{{ $area['title'] }}</h1>
                @foreach ($area['equipments'] as $equipment )
                    <p class="text-center text-[1.2rem]">{{ $equipment }}</p>
                @endforeach
            </x-card>
        @endforeach
        </div>
    </section> --}}

{{-- Servicios --}}
{{-- <section>
        <section class="pt-20 pb-40">
            <h1 class="text-center text-[3rem]  text-blueText">{{ __('Servicios') }}</h1>
            <p class="text-center sm:px-5 md:px-32 text-[1.5rem]">{{ __('En Guga, nos destacamos en el mantenimiento y la instalación de equipos médicos. Nuestro compromiso es asegurar que tus equipos funcionen de manera segura y eficiente, desde la instalación inicial hasta el mantenimiento continuo, permitiéndote brindar atención de calidad a los pacientes.') }}</p>
            <div class="flex flex-wrap justify-around  mt-12">
            @foreach ($services as $service)
                <img src={{ $service['image'] }} class="rounded-2xl max-w-[25em] mx-2 my-4 transform transition-transform hover:scale-110 cursor-pointer hover:z-10 hover:shadow-[rgba(72,87,203,0.1)_0px_20px_25px_-5px,rgba(72,87,203,0.04)_0px_10px_10px_-5px]">
            @endforeach
            </div>
        </section>
    </section> --}}



    <!-- Modal -->
@if ($entepriseInfo->active_special_ofert == 1)
    {{-- <button
        id="triggerSpecialOffertModal"
        type="button"

        class="hidden"
        data-twe-toggle="modal"
        data-twe-target="#specialOffertModal"
    ></button>
    <div
        data-twe-modal-init
        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none "
        id="specialOffertModal"
        tabindex="-1"
        aria-labelledby="offertModalLabel"
        aria-modal="true"
        role="dialog">
        <div
            data-twe-modal-dialog-ref
            class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
            <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
                <div class="flex flex-shrink-0 items-center justify-between rounded-t-md  border-neutral-100 p-4">
                    <!-- Modal title -->
                    <div class=" items-center justify-center ">
                        <P>{{ " " }}</P>
                    </div>
                    <h5 class="text-3xl font-bold leading-normal text-[#0392ceff]" id="offertModalTitle">
                        OFERTA ESPECIAL
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
                            src="{{"/storage/".$entepriseInfo->special_ofert }}"
                            alt="Oferta"
                            class="w-full h-full rounded-xl"
                        />
                    </div>
                </div>

                <!-- Modal footer -->
            </div>
        </div>
    </div> --}}

    <!-- Trigger oculto -->
    <button
        id="triggerSpecialOffertModal"
        type="button"
        class="hidden"
        data-twe-toggle="modal"
        data-twe-target="#specialOffertModal">
    </button>

    <!-- Modal -->
    <div
        data-twe-modal-init
        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
        id="specialOffertModal"
        tabindex="-1"
        aria-labelledby="offertModalLabel"
        aria-modal="true"
        role="dialog">
        <div
            data-twe-modal-dialog-ref
            class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
            <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-transparent bg-clip-padding text-current shadow-4 outline-none">
                <!-- Contenido inicial (regalo) -->
                <div id="giftContent" class="flex flex-col items-center justify-center p-8 cursor-pointer">
                    <div class="relative transition-all duration-500 hover:scale-105">
                        <!-- Icono de regalo grande -->
                        <svg version="1.1" id="_x35_"  class="h-[20rem]  w-[20rem] animate-bounce " xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" width="800px" height="800px" fill="#000000">

                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                            <g id="SVGRepo_iconCarrier"> <g> <path style="fill:none;" d="M284.549,127.723h0.814v0.321h79.817l6.322-6.322l-87.471,4.701 C284.223,126.851,284.383,127.288,284.549,127.723z"/> <path style="opacity:0.07;fill:#040000;" d="M383.655,121.069c0.062-0.004,0.111-0.022,0.173-0.026 c2.141-0.125,4.124-0.447,5.983-0.905c0.638-0.158,1.19-0.397,1.795-0.592c1.216-0.39,2.394-0.81,3.464-1.341 c0.61-0.302,1.154-0.652,1.715-0.997c0.922-0.567,1.785-1.171,2.572-1.845c0.489-0.42,0.949-0.85,1.384-1.308 c0.706-0.744,1.316-1.541,1.876-2.379c0.33-0.494,0.676-0.97,0.953-1.495c0.519-0.979,0.894-2.028,1.225-3.104 c0.145-0.471,0.352-0.908,0.46-1.396c0.353-1.598,0.536-3.269,0.479-5.024c-0.006-0.199-0.072-0.413-0.084-0.614 c-0.082-1.398-0.234-2.82-0.585-4.293c-0.02,0.045-0.059,0.078-0.079,0.123c-0.431-1.857-1.09-3.762-1.937-5.7l-31.549,31.549 L383.655,121.069z"/> <g> <g> <path style="fill:#edf8fd;" d="M448.424,198.784v293.948c0,10.577-8.609,19.268-19.268,19.268H45.261 c-10.659,0-19.268-8.691-19.268-19.268V198.784c0-10.577,8.609-19.269,19.268-19.269h383.895 C439.815,179.515,448.424,188.206,448.424,198.784z"/> <path style="opacity:0.1;fill:#061508;" d="M448.424,198.784v98.885H25.992v-98.885c0-10.577,8.609-19.269,19.268-19.269h383.895 C439.815,179.515,448.424,188.206,448.424,198.784z"/> <path style="fill:#edf8fd;" d="M474.416,157.623v73.221c0,2.788-0.41,5.493-1.147,8.117 c-3.198,11.233-12.955,19.761-24.844,21.237c-1.148,0.164-2.378,0.246-3.608,0.246H29.6c-1.23,0-2.46-0.082-3.607-0.246 C11.397,258.393,0,245.848,0,230.843v-73.221c0-16.235,13.283-29.6,29.6-29.6h415.217 C461.133,128.023,474.416,141.388,474.416,157.623z"/> <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="188.4222" y1="135.2383" x2="285.9946" y2="135.2383"> <stop offset="0.0338" style="stop-color:#229FB0"/> <stop offset="0.9903" style="stop-color:#4DC0E2"/> </linearGradient> <path style="fill:url(#SVGID_1_);" d="M285.995,135.239c0,1.721-0.164,3.361-0.656,4.919 c-3.608,15.087-23.778,26.566-48.13,26.566c-24.352,0-44.523-11.479-48.13-26.566c-0.492-1.558-0.656-3.198-0.656-4.919 c0-1.722,0.164-3.362,0.656-4.92c0.164-0.82,0.328-1.558,0.656-2.296c0-0.164,0.082-0.246,0.164-0.328 c0.082-0.41,0.246-0.82,0.492-1.23c2.132-4.838,5.985-9.183,11.151-12.627c5.985-4.181,13.611-7.297,22.302-8.855 c4.182-0.82,8.691-1.23,13.365-1.23c4.674,0,9.183,0.41,13.365,1.23c8.691,1.558,16.317,4.674,22.303,8.855 c5.166,3.444,9.019,7.789,11.151,12.627c0.246,0.41,0.41,0.82,0.492,1.23c0.082,0.082,0.164,0.164,0.164,0.328 c0.328,0.738,0.492,1.476,0.656,2.296C285.831,131.877,285.995,133.516,285.995,135.239z"/> <rect x="189.054" y="259.145" style="fill:#22A1A3;" width="96.309" height="252.643"/> <rect x="189.078" y="127.695" style="fill:#4EBEC6;" width="96.261" height="132.748"/> <g> <g> <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="68.6858" y1="63.7493" x2="228.107" y2="63.7493"> <stop offset="0.0338" style="stop-color:#58C0D0"/> <stop offset="0.9903" style="stop-color:#2DAFC4"/> </linearGradient> <path style="fill:url(#SVGID_2_);" d="M228.107,116.298c0,2.542-0.82,4.755-2.46,6.559c-0.246,0.328-0.656,0.656-0.984,0.902 c-3.198,2.706-8.446,4.018-15.579,3.69l-18.694-0.984l-99.623-5.412c-7.79-0.41-13.775-3.116-17.547-7.379 c-0.82-0.984-1.558-1.968-2.213-3.034c-1.968-3.444-2.706-7.544-2.132-12.053c0-0.41,0.082-0.82,0.246-1.312 c0-0.492,0.082-0.984,0.328-1.476c0.492-2.378,1.394-4.756,2.624-7.215l38.291-74.697c8.609-16.891,25.418-18.612,37.307-3.853 l74.286,92.407c0.738,0.902,1.312,1.722,1.886,2.542c0.82,1.148,1.476,2.213,1.968,3.279c0.41,0.738,0.738,1.476,0.984,2.132 c0.328,0.738,0.574,1.476,0.738,2.132c0.164,0.656,0.328,1.312,0.41,1.968C228.025,115.068,228.107,115.724,228.107,116.298z"/> <path style="opacity:0.07;fill:#061508;" d="M228.107,116.298c0,2.542-0.82,4.755-2.46,6.559 c-0.246,0.328-0.656,0.656-0.984,0.902c-3.198,2.706-8.446,4.018-15.579,3.69l-18.694-0.984l-99.623-5.412 c-7.79-0.41-13.775-3.116-17.547-7.379c-0.82-0.984-1.558-1.968-2.213-3.034c-1.968-3.444-2.706-7.544-2.132-12.053 c0-0.41,0.082-0.82,0.246-1.312c0-0.492,0.082-0.984,0.246-1.558l0.082,0.082c2.952,6.805,10.167,11.479,20.498,11.971 l111.594,6.067l6.723,0.328c8.937,0.492,15.005-1.804,17.547-5.904c0.41,0.738,0.738,1.476,0.984,2.132 c0.328,0.738,0.574,1.476,0.738,2.132c0.164,0.656,0.328,1.312,0.41,1.968C228.025,115.068,228.107,115.724,228.107,116.298z"/> </g> <g> <linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="246.3099" y1="63.7815" x2="405.731" y2="63.7815"> <stop offset="0.0338" style="stop-color:#58C0D0"/> <stop offset="0.9903" style="stop-color:#2DAFC4"/> </linearGradient> <path style="fill:url(#SVGID_3_);" d="M403.41,110.64c-0.656,1.066-1.394,2.05-2.214,3.034 c-3.771,4.263-9.757,6.969-17.546,7.379l-99.623,5.412l-18.695,0.984c-7.133,0.328-12.381-0.984-15.579-3.69 c-0.328-0.246-0.738-0.574-0.984-0.902c-1.64-1.804-2.46-4.018-2.46-6.559c0-0.574,0.082-1.23,0.164-1.804 c0.082-0.656,0.246-1.312,0.41-1.968c0.164-0.656,0.41-1.394,0.738-2.132c0.246-0.656,0.574-1.394,0.984-2.132 c0.492-1.066,1.148-2.132,1.968-3.279c0.574-0.82,1.148-1.64,1.886-2.542l74.286-92.407c6.641-8.281,14.841-11.315,22.302-9.43 c5.822,1.394,11.233,5.822,15.005,13.283l1.804,3.526l36.487,71.171c1.23,2.46,2.132,4.837,2.624,7.215 c0.246,0.492,0.328,0.984,0.328,1.476c0.164,0.492,0.246,0.902,0.246,1.312C406.116,103.097,405.378,107.196,403.41,110.64z"/> <path style="opacity:0.07;fill:#061508;" d="M265.291,127.429l118.363-6.363c16.167-0.867,24.668-11.666,21.413-25.316 c-2.986,6.851-10.196,11.493-20.559,12.051l-118.357,6.356c-8.969,0.481-14.985-1.791-17.567-5.888 C242.421,120.045,248.957,128.309,265.291,127.429z"/> </g> </g> </g> <path style="opacity:0.03;fill:#061508;" d="M474.416,157.623v73.221c0,2.788-0.41,5.493-1.147,8.117 c-3.198,11.151-12.955,19.597-24.844,21.072v232.699c0,10.577-8.609,19.268-19.268,19.268H45.261 c-10.659,0-19.268-8.691-19.268-19.268v-25.5l163.085-163.086l6.478-6.477l37.225-37.225l80.928-80.928l51.492-51.492h79.616 C461.133,128.023,474.416,141.388,474.416,157.623z"/> </g> </g> </g>

                        </svg>
                        <!-- Etiqueta "Oferta" -->
                        <span class="absolute -top-0 -right-0 bg-red-500 text-white text-sm font-bold px-2 py-1 rounded-full animate-bounce">OFERTA</span>
                    </div>
                    <p class="mt-4 text-white text-xl font-bold">¡Haz clic para ver tu oferta especial!</p>
                </div>

                <!-- Contenido de la oferta (oculto inicialmente) -->
                <div id="offertContent" class="hidden bg-white rounded-md">
                    <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-neutral-100 p-4">
                        <h5 class="text-3xl font-bold leading-normal text-[#0392ceff]">
                            OFERTA ESPECIAL
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
                        <img
                            id="offertImage"
                            src="{{ '/storage/'.$entepriseInfo->special_ofert }}"
                            alt="Oferta"
                            class="w-full h-full rounded-xl transform scale- transition-transform duration-500"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const giftContent = document.getElementById('giftContent');
            const offertContent = document.getElementById('offertContent');
            const offertImage = document.getElementById('offertImage');
            
            giftContent.addEventListener('click', function() {
                // Animación de desvanecimiento del regalo
                giftContent.style.opacity = '0';
                giftContent.style.transform = 'scale(0.8)';
                
                // Esperamos a que termine la animación de salida
                setTimeout(() => {
                    giftContent.classList.add('hidden');
                    
                    // Mostramos el contenido de la oferta
                    offertContent.classList.remove('hidden');
                    offertContent.parentElement.classList.remove('bg-transparent');
                    offertContent.parentElement.classList.add('bg-white');
                    
                    // Animación de entrada de la imagen
                    setTimeout(() => {
                        offertImage.classList.remove('scale-0');
                        offertImage.classList.add('scale-100');
                    }, 50);
                }, 500);
            });
            
            // Cuando se cierra el modal, reseteamos el contenido
            document.getElementById('specialOffertModal').addEventListener('hidden.twe.modal', function() {
                // Restablecemos el regalo
                giftContent.style.opacity = '1';
                giftContent.style.transform = 'scale(1)';
                giftContent.classList.remove('hidden');
                
                // Ocultamos la oferta
                offertContent.classList.add('hidden');
                offertContent.parentElement.classList.add('bg-transparent');
                offertContent.parentElement.classList.remove('bg-white');
                
                // Preparamos la imagen para la próxima animación
                offertImage.classList.remove('scale-100');
                offertImage.classList.add('scale-0');
            });
        });
    </script>

    <style>
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }
        .animate-bounce {
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        #giftContent {
            transition: all 0.5s ease;
        }
        #offertImage {
            transform-origin: center;
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
    </style>


@endif


