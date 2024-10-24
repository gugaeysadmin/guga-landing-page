
<x-landingpage-layout>
    <x-slot name="header"> <x-header :pages="$pages"/></x-slot>
    <x-carousel :images="$imagelist" />
    <div class="pt-20 pb-14">
        <h1 class="text-center text-[3rem]  text-blueText">{{ __('Alianzas') }}</h1>
        <div class=" mx-auto w-[60vw] border-t-[3px] border-blue-500 my-3"></div>
        <p class="text-center sm:px-5 md:px-32 text-[1.5rem]">{{ __('En Guga, las alianzas son esenciales. Nos permiten ampliar nuestra oferta, acceder a nuevos mercados, compartir conocimientos, reducir costos, fomentar la innovación y gestionar riesgos de manera efectiva, todo lo cual contribuye a nuestro éxito y crecimiento continuo.') }}</p>
    </div>
    <x-swipper :slides="$aliances" />
    <x-slot name="footer">footer</x-slot>
</x-landingpage-layout>
