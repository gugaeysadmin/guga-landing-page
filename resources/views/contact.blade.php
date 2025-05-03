
<x-layouts.landingpage-layout>
    <x-slot name="header"> <x-header :pages="$pages"/></x-slot>
    <div class="block relative">
        <!-- Imagen de cabecera -->
        <img src="{{ asset('img/contactbg.jpeg') }}" alt="services_img" class="w-full max-h-[35rem] object-cover" style="object-position: 0 10%;"/>
        
        <!-- Capa de opacidad -->
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <!-- Título -->
        <div class="absolute inset-0 flex items-center justify-center ">
            <div>
                <h1 class="text-white text-[3.5vw] font-sans text-center">Contacto</h1>
                <p class="text-white text-[1.3vw] font-sans text-center">Queremos saber de ti, puedes contactar con nosotros por cualquiera de las siguientes vías.</p>
            </div>
        </div>
    </div>
    <!-- Tarjetas -->
    <div class="relative md:h-64">
        <div class="md:absolute z-10 -top-1/3 flex justify-around w-full xl:px-24 sm:flex-wrap xs:flex-wrap xs:py-4">
            <div class="relative flex flex-wrap ">
                <div class="relative w-80 h-60 rounded-sm bg-white shadow-xl">
                    <div class="absolute flex justify-center w-full -top-12">
                        <div class="h-24 w-24 flex justify-center items-center bg-white rounded-full shadow-md">
                            <i class="bi bi-geo-alt text-blue-400  text-[2.2rem]"></i>
                        </div>
                    </div>
                    <div class="pt-20 flex justify-center h-full">
                        <div class="block">
                            <h1 class="font-sans font-semibold text-lg text-center text-blue-500">Oficina central</h1>
                            <p class="font-sans text-center mt-2">Jazmines 34, Granjas San Pablo, 54930 Tultitlán de Mariano Escobedo, Méx.</p>
                        </div>
                    </div>
                </div>
                <div class="relative w-80 h-60 rounded-sm bg-white shadow-xl md:mx-12">
                    <div class="absolute flex justify-center w-full -top-12">
                        <div class="h-24 w-24 flex justify-center items-center bg-white rounded-full shadow-md">
                            <i class="bi bi-envelope-at text-blue-400  text-[2.2rem]"></i>
                        </div>
                    </div>
                    <div class="pt-20 flex justify-center h-full">
                        <div class="block">
                            <h1 class="font-sans font-semibold text-lg text-center text-blue-500">Email</h1>
                            <p class="font-sans text-center mt-2">info@gugaequiposyservicios.com.mx</p>
                        </div>
                    </div>
                </div>
                <div class="relative w-80 h-60 rounded-sm bg-white shadow-xl">
                    <div class="absolute flex justify-center w-full -top-12">
                        <div class="h-24 w-24 flex justify-center items-center bg-white rounded-full shadow-md">
                            <i class="bi bi-headset text-blue-400  text-[2.2rem]"></i>
                        </div>
                    </div>
                    <div class="pt-20 flex justify-center h-full">
                        <div class="block">
                            <h1 class="font-sans font-semibold text-lg text-center text-blue-500">Teléfono</h1>
                            <p class="font-sans text-center mt-2">55 1543 0499</p>
                            <p class="font-sans text-center">55 5879 6644</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex xs:flex-wrap md:flex-nowrap lg:px-36 w-full mb-14 ">

        <!-- Formulario -->
        <div class="lg:relative xs:w-full lg:w-[40vw] h-[50rem]">
            <div class="lg:absolute z-10 h-full flex items-center">
                <div class=" bg-sky-200 shadow-lg p-6 xs:w-full lg:w-[40vw]  border rounded-lg ">
                    <h2 class="text-md text-center font-sans font-semibold mb-2 text-blue-500">CONTACTA CON NOSOTROS</h2>
                    <h2 class="text-3xl text-center font-sans font-semibold mb-12 text-blue-950">Formulario de contacto</h2>
                    <form action="#" method="post">
                    <form action="#" method="post">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
                        <input id="name" name="name" type="text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                        <input id="email" name="email" type="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="company" class="block text-sm font-medium text-gray-700">Empresa</label>
                        <input id="company" name="email" type="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="company" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input id="company" name="email" type="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="comments" class="block text-sm font-medium text-gray-700">Comentario</label>
                        <textarea id="comments" name="comments" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4">Enviar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Mapa -->
        <div class="xs:w-full xs:p-4 lg:w-[50vw] h-[50rem] ">
            <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d330.64515789098084!2d-99.082913472065!3d19.662795710207423!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f3286c8db41d%3A0xbb7218bc15b13646!2sGUGA%20EQUIPOS%20Y%20SERVICIOS%20SA%20DE%20CV!5e0!3m2!1ses-419!2smx!4v1694476453664!5m2!1ses-419!2smx"
            width="100%"
            height="100%"
            style="border: 0; border-radius: 25px; box-shadow: 0px 12px 20px -10px rgba(0, 0, 0, 0.25);"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </div>
    <x-slot name="footer"><x-footer/></x-slot>
</x-layouts.landingpage-layout>