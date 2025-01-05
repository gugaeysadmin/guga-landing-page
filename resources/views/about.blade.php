
<x-layouts.landingpage-layout>
    <x-slot name="header"> <x-header :pages="$pages"/></x-slot>
    <div class="block relative">
        <!-- Imagen de cabecera -->
        <img src="{{ asset('img/catalog_img_header.jpg') }}" alt="services_img" class="w-full max-h-[35rem] object-cover" style="object-position: 0 10%;"/>
        
        <!-- Capa de opacidad -->
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <!-- Título -->
        <div class="absolute inset-0 flex items-center justify-center ">
            <h1 class="text-white text-[3.5vw] font-sans">Sobre nosotros</h1>
        </div>
    </div>
    <x-safe-area>
        <div>
            Nosotros
        </div>
    </x-safe-area>

    <x-slot name="footer"><x-footer/></x-slot>
</x-layouts.landingpage-layout>