
<x-layouts.landingpage-layout>
    {{-- Header --}}
    <x-slot name="header"> <x-header/></x-slot>
    
    <div class="block">
        <x-landing-video/>
    </div>

    {{-- Areas de equipamiento --}}
    <section class="pt-14 pb-24 px-4 sm:px-12 bg-slate-50">
        <x-equipment-areas/>
    </section>
    
    {{-- Alianzas --}}

    <section class="bg-slate-700 block px-4 sm:p-16 text-center">
        <h1 class="px-5 sm:px-5 md:px-32 mb-12 text-[3rem] font-sans font-semibold text-slate-50">{{ __('Alianzas') }}</h1>
        <div class="w-full px-4 md:px-24 flex flex-wrap justify-around">
            <div class="bg-white mt-6 rounded-2xl p-6 w-[17rem] h-[17rem] flex justify-center items-center">
               <a href="" class="my-auto" >
                  <img src={{ asset("img/cisa.png") }} alt="..." class="object-contain" />
                </a>
            </div>

            <div class="bg-white mt-6 rounded-2xl p-6 w-[17rem] h-[17rem] flex justify-center items-center">
               <a href="" class="my-auto" >
                  <img src={{ asset("img/amtai.png") }} alt="..." class="object-contain" />
                </a>
            </div>

            <div class="bg-white mt-6 rounded-2xl p-6 w-[17rem] h-[17rem] flex justify-center items-center">
               <a href="" class="my-auto" >
                  <img src={{ asset("img/biodex.jpg") }} alt="..." class="object-contain" />
                </a>
            </div>

            <div class="bg-white mt-6 rounded-2xl p-6 w-[17rem] h-[17rem] flex justify-center items-center">
               <a href="" class="my-auto" >
                  <img src={{ asset("img/fiochetti.jpg") }} alt="..." class="object-contain" />
                </a>
            </div>
        </div>
        <div class="w-full px-4 md:p-24 pb-12 flex">
            <x-swipper :slides="$aliances" />
        </div>
    </section>


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
 
    {{-- Servicios --}}
    <section class="bg-slate-50 flex flex-wrap md:flex-row flex-col">
        <div class="w-full md:w-1/2 py-1 bg-slate-300 flex justify-center items-center">
            <div class="rounded-2xl h-[35rem] w-[28rem] border-[0px] border-slate-200 shadow-5 bg-white  overflow-hidden flex items-center justify-center">
                <img src="{{ asset('img/slider1.jpg') }}" alt="services_img" class="h-full w-full object-cover"/>
            </div>
        </div>
        <div class="w-full md:w-1/2 pb-16 pt-24">
            <h1 class="px-4 sm:px-5 md:px-32 text-[2.5rem] font-sans font-semibold text-[#0392ceff]">{{ __('Servicios') }}</h1>
            <p class="px-4  sm:px-5 md:px-32 text-[1.3rem] mt-8 mb-18">{{ __('En Guga, nos destacamos en el mantenimiento y la instalación de equipos médicos. Nuestro compromiso es asegurar que tus equipos funcionen de manera segura y eficiente, desde la instalación inicial hasta el mantenimiento continuo, permitiéndote brindar atención de calidad a los pacientes.') }}</p>
        
            <div class="relative flex flex-wrap justify-around mt-16 px-5 md:px-20">
                <div class="flex flex-col items-center my-3 transition-transform duration-300 hover:-translate-y-5 hover:border-blue-600 group w-full md:w-1/3">
                    <a class="my-0 py-0 rounded-full border-4 border-[#0392ceff] group-hover:border-blue-600 m-auto">
                        <img src="{{ asset('icons/Installation.png') }}" alt="esterilization_icon" class="w-24 h-24 my-0 py-0"/>
                    </a>
                    <div class="text-center mx-7 mt-4">
                        <p class="text-[1.3rem] text-[#0392ceff] font-sans font-semibold group-hover:text-blue-600">Instalación</p>
                        <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
                    </div>
                </div>

                <div class="flex flex-col items-center my-3 transition-transform duration-300 hover:-translate-y-5 hover:border-blue-600 group w-full md:w-1/3">
                    <a class="my-0 py-0 rounded-full border-4 border-[#0392ceff] group-hover:border-blue-600 m-auto">
                        <img src="{{ asset('icons/mant-preventive.png') }}" alt="esterilization_icon" class="w-24 h-24 my-0 py-0"/>
                    </a>
                    <div class="text-center mx-7 mt-4">
                        <p class="text-[1.3rem] text-[#0392ceff] font-sans font-semibold group-hover:text-blue-600">Mantenimiento<br>Preventivo</p>
                        <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
                    </div>
                </div>

                <div class="flex flex-col items-center my-3 transition-transform duration-300 hover:-translate-y-5 hover:border-blue-600 group w-full md:w-1/3">
                    <a class="my-0 py-0 rounded-full border-4 border-[#0392ceff] group-hover:border-blue-600 m-auto">
                        <img src="{{ asset('icons/mant-corrective.png') }}" alt="esterillization_icon" class="w-24 h-24 my-0 py-0"/>
                    </a>
                    <div class="text-center mx-7 mt-4">
                        <p class="text-[1.3rem] text-[#0392ceff] font-sans font-semibold group-hover:text-blue-600">Mantenimiento<br>Correctivo</p>
                        <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 h-[40rem] flex justify-center items-center">
        <p class="font-snas font-semibold text-[#0392ceff] text-[3rem]">OFERTAS</p>
    </section>
    
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