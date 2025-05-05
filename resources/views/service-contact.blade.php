
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
                <p class="text-white text-[1.3vw] font-sans text-center">Queremos ayudarte, puedes contactar con nosotros para ayudarte en tus necesidades.</p>
            </div>
        </div>
    </div>
    <!-- Tarjetas -->
    <div class="relative md:h-[45rem] ">
        <div class="md:absolute z-10 -top-40 flex justify-around w-full xl:px-24 sm:flex-wrap xs:flex-wrap xs:py-4">
            <!-- Formulario -->
            <div class="lg:relative xs:w-full lg:w-[40vw] h-[50rem]">
                <div class="lg:absolute z-10 h-full flex items-center">
                    <div class=" bg-sky-200 shadow-lg p-6 xs:w-full lg:w-[40vw]  border rounded-lg ">
                        <h2 class="text-md text-center font-sans font-semibold mb-2 text-blue-500">CONTACTA CON NOSOTROS</h2>
                        <h2 class="text-3xl text-center font-sans font-semibold mb-12 text-blue-950">Formulario de contacto</h2>
                        <form action="#" method="post">
                            <div class="mb-4">
                                <label for="service" class="block text-sm font-medium text-gray-700">Servicio</label>
                                <select
                                    id="service"
                                    name="service"
                                    
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="">Selecciona un servicio</option>
                                    @foreach ($services as $service )
                                        <option value="{{ $service->name }}" {{ $service->name == $specialty_name ? 'selected' : '' }} >{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
                                <input id="name" name="name" type="text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="mb-4">
                                <label for="company" class="block text-sm font-medium text-gray-700">Empresa</label>
                                <input id="company" name="email" type="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                                <input id="email" name="email" type="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
        </div>
    </div>

    <x-slot name="footer"><x-footer/></x-slot>
</x-layouts.landingpage-layout>