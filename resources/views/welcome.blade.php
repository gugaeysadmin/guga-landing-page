
<x-landingpage-layout>
    {{-- Header --}}
    <x-slot name="header"> <x-header :pages="$pages"/></x-slot>
    
    <div class="block">
        <x-landing-video/>
    </div>

    {{-- Carrusel --}}
    {{-- <x-carousel :images="$imagelist" /> --}}
    
    {{-- Alianzas --}}
    <section class="pt-20">
        <h1 class="text-center text-[3rem]  text-blueText">{{ __('Alianzas') }}</h1>
        <div class=" mx-auto w-[60vw] border-t-[3px] border-blue-500 my-3"></div>
        <p class="text-center sm:px-5 md:px-32 text-[1.5rem]">{{ __('En Guga, las alianzas son esenciales. Nos permiten ampliar nuestra oferta, acceder a nuevos mercados, compartir conocimientos, reducir costos, fomentar la innovación y gestionar riesgos de manera efectiva, todo lo cual contribuye a nuestro éxito y crecimiento continuo.') }}</p>
    </section>
    <x-swipper :slides="$aliances" />
    
    {{-- Areas de equipamiento --}}
    <section class="pt-14 px-4 sm:px-12 bg-white">
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
    </section>
    
    {{-- Servicios --}}
    <section>
        <section class="pt-20 pb-40">
            <h1 class="text-center text-[3rem]  text-blueText">{{ __('Servicios') }}</h1>
            <p class="text-center sm:px-5 md:px-32 text-[1.5rem]">{{ __('En Guga, nos destacamos en el mantenimiento y la instalación de equipos médicos. Nuestro compromiso es asegurar que tus equipos funcionen de manera segura y eficiente, desde la instalación inicial hasta el mantenimiento continuo, permitiéndote brindar atención de calidad a los pacientes.') }}</p>
            <div class="flex flex-wrap justify-around  mt-12">
            @foreach ($services as $service)
                <img src={{ $service['image'] }} class="rounded-2xl max-w-[25em] mx-2 my-4 transform transition-transform hover:scale-110 cursor-pointer hover:z-10 hover:shadow-[rgba(72,87,203,0.1)_0px_20px_25px_-5px,rgba(72,87,203,0.04)_0px_10px_10px_-5px]">
            @endforeach
            </div>
        </section>
    </section>
    
    {{-- Footer --}}
    <x-slot name="footer"><x-footer/></x-slot>
</x-landingpage-layout>
