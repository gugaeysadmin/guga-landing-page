<x-layouts.landingpage-layout>
    <x-slot name="header"> <x-header :pages="$pages"/></x-slot>
    {{-- Titulo --}}
    <div class="block relative">
        <!-- Imagen de cabecera -->
        <img src="{{ asset('img/servicesbg.webp') }}" alt="services_img" class="w-full max-h-[35rem] object-cover" style="object-position: 0 10%;"/>

        <!-- Capa de opacidad -->
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <!-- Título -->
        <div class="absolute inset-0 flex items-center justify-center ">
            <div>
                <h1 class="text-white text-[3.5vw] font-sans text-center">Nuestros servicios</h1>
                <p class="text-white text-[1.3vw] font-sans text-center">En GUGA Equipos y Servicios ofrecemos la instalación, reinstalacion, mantenimiento correctivo y preventivo de sus equipos.</p>
            </div>
        </div>
    </div>
    
    {{-- Instalacion y reinstalacion --}}
    {{-- <div class="flex justify-center my-12 px-4 lg:px-0">
        <div class=" w-full grid grid-flow-row xs:grid-cols-1 md:grid-cols-2 max-w-[70rem]">

            <div class="relative overflow-hidden w-full min-h-[24rem] flex justify-center items-center">
                <!-- Imagen de fondo -->
                <img src="{{ asset('img/services-bg.jpg') }}" alt="services_img" class="absolute w-full h-full object-cover z-[-1]" style="object-position: 0 10%;" />

                <!-- Capa semitransparente y contenido -->
                <div class="w-full h-full flex flex-col justify-center items-center bg-sky-700 bg-opacity-85 px-8">
                    <div class="bg-sky-50 bg-opacity-15 block text-center p-6">
                        <h1 class="text-3xl font-sans font-semibold text-sky-100">Instalación</h1>
                        <div class="text-sky-50 text-justify mt-4">
                            <p class="font-sans text-sm">
                                Para la instalación de equipos médicos se cuenta con ingenieros especializados en la tecnología médica de los equipos para brindar a los usuarios la confianza de un correcto uso y mantenimiento.
                            </p>
                            <ul class="mt-4 font-sans text-sm list-disc px-4">
                                <li class="py-1 rounded-md"><b>Desinstalación</b> (desensamble, desconexión)</li>
                                <li class="py-1 rounded-md mt-1"><b>Empaque</b> (embalaje de equipos)</li>
                                <li class="py-1 rounded-md mt-1"><b>Traslado</b> (maniobras, reordenamiento y traslado)</li>
                                <li class="py-1 rounded-md mt-1"><b>Instalación</b> (conexión, calibración y ajustes)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full h-[24rem] bg-slate-400 relative overflow-hidden">
                <img src="{{ asset('img/services-install.jpg') }}" alt="services_img" class="absolute w-full h-full object-cover"/>
            </div>
            <div class="w-full h-[24rem] bg-slate-400 relative overflow-hidden">
                <img src="{{ asset('img/services-reinstall.jpg') }}" alt="services_img" class="absolute w-full h-full object-cover"/>
            </div>
             <div class="relative overflow-hidden w-full min-h-[24rem] flex justify-center items-center">
                <!-- Imagen de fondo -->
                <img src="{{ asset('img/services-bg-2.jpg') }}" alt="services_img" class="absolute w-full h-full object-cover z-[-1]" style="object-position: 0 10%;" />

                <!-- Capa semitransparente y contenido -->
                <div class="w-full h-full flex flex-col justify-center items-center bg-sky-700 bg-opacity-85 px-8">
                    <div class="bg-sky-50 bg-opacity-15 block text-center p-6">
                        <h1 class="text-3xl font-sans font-semibold text-sky-100">Reinstalación</h1>
                        <div class="text-sky-50 text-justify mt-4">
                            <p class="font-sans text-sm">
                                Para la instalación y desinstalación de equipos médicos se cuenta con ingenieros especializados en la tecnología médica de los equipos para brindar a los usuarios la confianza de un correcto uso y mantenimiento.
                            </p>
                            <ul class="mt-4 font-sans text-sm list-disc px-4">
                                <li class="py-1 rounded-md"><b>Desinstalación</b> (desensamble, desconexión)</li>
                                <li class="py-1 rounded-md mt-1"><b>Empaque</b> (embalaje de equipos)</li>
                                <li class="py-1 rounded-md mt-1"><b>Traslado</b> (maniobras, reordenamiento y traslado)</li>
                                <li class="py-1 rounded-md mt-1"><b>Reinstalación</b> (conexión, calibración y ajustes)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="flex justify-center my-24">
        <div class="grid grid-cols-1 md:grid-cols-2 max-w-[70rem]">
            <div class="flex items-center justify-center">
                <img src="{{ asset('img/services-install.jpg') }}" alt="services_img" class=" w-[80%] h-[20rem] object-cover rounded-2xl"/>
            </div>
            <div class="font-sans px-8 md:px-12">
                <h1 class="text-2xl font-semibold text-sky-700 mt-6 mb-4">Instalación, desinstalación y reacondicionamiento</h1>
                <p class="text-sky-700">
                    Para la instalación/desinstalación de equipos médicos se cuenta con ingenieros especializados en la tecnología médica de los equipos para brindar a los usuarios la confianza de un servicio confiable en todo momento.
                </p>
                <ul class="mt-4 font-sans text-sm list-disc px-4 text-sky-700 ">
                    <li class="py-1 rounded-md"><b>Desinstalación</b> (desensamble, desconexión)</li>
                    <li class="py-1 rounded-md mt-1"><b>Empaque</b> (embalaje de equipos)</li>
                    <li class="py-1 rounded-md mt-1"><b>Traslado</b> (maniobras, reordenamiento y traslado)</li>
                    <li class="py-1 rounded-md mt-1"><b>Instalación</b> (conexión, calibración y ajustes)</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="flex justify-center my-24">
        <div class="grid grid-cols-1 md:grid-cols-2 max-w-[70rem]">
            <div class="font-sans px-8 md:px-12">
                <h1 class="text-2xl font-semibold text-sky-700 mt-6 mb-4">Reinstalación</h1>
                <p class="text-sky-700">
                    Para la instalación y desinstalación de equipos médicos se cuenta con ingenieros especializados en la tecnología médica de los equipos para brindar a los usuarios la confianza de un correcto uso y mantenimiento.
                </p>
                <ul class="mt-4 font-sans text-sm list-disc px-4 text-sky-700 ">
                    <li class="py-1 rounded-md"><b>Desinstalación</b> (desensamble, desconexión)</li>
                    <li class="py-1 rounded-md mt-1"><b>Empaque</b> (embalaje de equipos)</li>
                    <li class="py-1 rounded-md mt-1"><b>Traslado</b> (maniobras, reordenamiento y traslado)</li>
                    <li class="py-1 rounded-md mt-1"><b>Reinstalación</b> (conexión, calibración y ajustes)</li>
                </ul>
            </div>
            <div class="flex items-center justify-center">
                <img src="{{ asset('img/services-reinstall.jpg') }}" alt="services_img" class=" w-[80%] h-[20rem] object-cover rounded-2xl"/>
            </div>
        </div>
    </div>

    

    {{-- Mantenimientos correctivo y preventivo --}}
    <div class="flex justify-center my-24">
        <div class="grid grid-cols-1 md:grid-cols-2 max-w-[70rem]">
            <div class="flex items-center justify-center">
                <img src="{{ asset('img/services-maintenance.jpg') }}" alt="services_img" class=" w-[80%] h-[20rem] object-cover rounded-2xl"/>
            </div>
            <div class="font-sans px-8 md:px-12">
                <h1 class="text-2xl font-semibold text-sky-700 mt-12 mb-4">Mantenimiento correctivo</h1>
                <p class="text-sky-700">
                    Actividades no planificadas necesarias para restaurar la integridad, seguridad o función del equipo después de una falla.
                </p>
                <h1 class="text-2xl font-semibold text-sky-700 mt-12 mb-4">Mantenimiento preventivo</h1>
                <p class="text-sky-700">
                    Una actividad programada para asegurar que el equipo médico funcione normalmente y continúe desempeñando su función.
                </p>
            </div>
        </div>
    </div>

    {{-- Entregables --}}
    <div class="grid grid-cols-1 sm:grid-cols-2  md:grid-cols-4 font-body text-center my-24">
        <div class="p-8 flex justify-center bg-sky-300 text-sky-800">
            <div class="block">
                <div class="h-24 w-24 rounded-full border-solid border-4 border-sky-800 mx-auto flex justify-center items-center">
                    <i class="bi bi-book-half text-[3.4rem]"></i>
                </div>
                <h1 class="font-semibold mt-8 text-lg">PÓLIZA DE MANTENIMIENTO</h1>
                <p class="text-sm mt-4">Durante el período de vigencia de la póliza, el equipo puede recibir servicios de mantenimiento correctivo y / o preventivo y estos pueden diferirse a mensuales, bimestrales, semestrales o anuales según aplique el tipo de equipo y como sea requerido.</p>
            </div>
        </div>
        <div class="p-8 flex justify-center bg-sky-500 text-sky-50">
            <div class="block">
                <div class="h-24 w-24 rounded-full border-solid border-4 border-sky-200 mx-auto flex justify-center items-center">
                    <i class="bi bi-calendar2-event text-[3.4rem]"></i>
                </div>
                <h1 class="font-semibold mt-8 text-lg">SERVICIO POR EVENTO</h1>
                <p class="text-sm mt-4">Servicio que puede ser en carácter de urgencia  en modalidad  correctiva.</p>
            </div>
        </div>
        <div class="p-8 flex justify-center bg-sky-700 text-sky-50">
            <div class="block">
                <div class="h-24 w-24 rounded-full border-solid border-4 mx-auto flex justify-center items-center">
                    <i class="bi bi-gear text-[3.4rem]"></i>
                </div>
                <h1 class="font-semibold mt-8 text-lg">CALIBRACIONES</h1>
                <p class="text-sm mt-4">Algunos equipos médicos en los que se realizan mediciones de entrada y/o salida de energía requieren de calibración periódica. Toda la instrumentación utilizada cuenta con Certificado de Calibración Vigente, con trazabilidad a patrones Pruebas de Funcionamiento.</p>

            </div>
        </div>
        <div class="p-8 flex justify-center bg-sky-200 text-sky-800">
            <div class="block">
                <div class="h-24 w-24 rounded-full border-solid border-4 border-sky-800 mx-auto flex justify-center items-center">
                    <i class="bi bi-graph-up text-[3.4rem]"></i>
                </div>
                <h1 class="font-semibold mt-8 text-lg">DIAGNÓSTICOS</h1>
                <p class="text-sm mt-4">Utilizamos analizadores y tecnología de ingeniería para diagnosticar fallas y ubicaciones de errores en los equipos para resolver los errores. Todo se hace según la orden de servicio.</p>
            </div>
        </div>
    </div>

    {{-- Servicios de mantenimiento --}}
    <div class="flex justify-center mb-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 max-w-[70rem] gap-4 font-sans">
            <div class="flex w-[20rem] h-[7rem] bg-sky-700 rounded-xl shadow-xl border-solid border-4">
                <div class="w-[35%] flex items-center justify-center bg-sky-100 text-sky-800 ">
                    <i class="bi bi-binoculars text-[3.5rem]"></i>
                </div>
                <div class="w-[65%] flex items-center px-4">
                    <h1 class="text-sky-50">Revisión y limpieza de los componentes del equipo.</h1>
                </div>
            </div>
            <div class="flex w-[20rem] h-[7rem] bg-sky-700 rounded-xl shadow-xl border-solid border-4">
                <div class="w-[35%] flex items-center justify-center bg-sky-100 text-sky-800 ">
                    <i class="bi bi-key text-[3.5rem]"></i>
                </div>
                <div class="w-[65%] flex items-center px-4">
                    <h1 class="text-sky-50">Ajustes de sistemas de seguridad de los equipos.</h1>
                </div>
            </div>
            <div class="flex w-[20rem] h-[7rem] bg-sky-700 rounded-xl shadow-xl border-solid border-4">
                <div class="w-[35%] flex items-center justify-center bg-sky-100 text-sky-800 ">
                    <i class="bi bi-tools text-[3.5rem]"></i>
                </div>
                <div class="w-[65%] flex items-center px-4">
                    <h1 class="text-sky-50">Verificación mecánica y eléctrica.</h1>
                </div>
            </div>
            <div class="flex w-[20rem] h-[7rem] bg-sky-700 rounded-xl shadow-xl border-solid border-4">
                <div class="w-[35%] flex items-center justify-center bg-sky-100 text-sky-800 ">
                    <i class="bi bi-plugin text-[3.5rem]"></i>
                </div>
                <div class="w-[65%] flex items-center px-4">
                    <h1 class="text-sky-50">Reparaciones de placas electrónicas y eléctricas.</h1>
                </div>
            </div>
            <div class="flex w-[20rem] h-[7rem] bg-sky-700 rounded-xl shadow-xl border-solid border-4">
                <div class="w-[35%] flex items-center justify-center bg-sky-100 text-sky-800 ">
                    <i class="bi bi-gear-wide-connected text-[3.5rem]"></i>
                </div>
                <div class="w-[65%] flex items-center px-4">
                    <h1 class="text-sky-50">Reacondicionamiento total de los equipos.</h1>
                </div>
            </div>
            <div class="flex w-[20rem] h-[7rem] bg-sky-700 rounded-xl shadow-xl border-solid border-4">
                <div class="w-[35%] flex items-center justify-center bg-sky-100 text-sky-800 ">
                    <i class="bi bi-wrench text-[3.5rem]"></i>
                </div>
                <div class="w-[65%] flex items-center px-4">
                    <h1 class="text-sky-50">Refacciones con piezas tanto nacionales como de importación.</h1>
                </div>
            </div>
            <div class="flex w-[20rem] h-[7rem] bg-sky-700 rounded-xl shadow-xl border-solid border-4">
                <div class="w-[35%] flex items-center justify-center bg-sky-100 text-sky-800 ">
                    <i class="bi bi-code-square text-[3.5rem]"></i>
                </div>
                <div class="w-[65%] flex items-center px-4">
                    <h1 class="text-sky-50">Actualización de software, según aplique.</h1>
                </div>
            </div>
            <div class="flex w-[20rem] h-[7rem] bg-sky-700 rounded-xl shadow-xl border-solid border-4">
                <div class="w-[35%] flex items-center justify-center bg-sky-100 text-sky-800 ">
                    <i class="bi bi-image text-[3.5rem]"></i>
                </div>
                <div class="w-[65%] flex items-center px-4">
                    <h1 class="text-sky-50">Equipo médico de imagen remanufacturado.</h1>
                </div>
            </div>

            <div class="flex w-[20rem] h-[7rem] bg-sky-700 rounded-xl shadow-xl border-solid border-4">
                <div class="w-[35%] flex items-center justify-center bg-sky-100 text-sky-800 ">
                    <i class="bi bi-person-lines-fill text-[3.5rem]"></i>
                </div>
                <div class="w-[65%] flex items-center justify-center px-4">
                    <div class="rounded-full border-solid border-4 border-sky-50 p-4 bg-sky-100">
                        <h1 class=" font-semibold text-sky-800">CONTACTANOS</h1>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- Equipos --}}
    {{-- <div class="bg-sky-600 py-12 md:px-24 flex justify-center mt-24">
        <div class="w-[100%] max-w-[70rem] flex flex-wrap items-center xs:justify-center lg:justify-between ">
            <div class="px-12 py-12  rounded-3xl h-[20rem] w-[25rem] border-solid border-[3px] border-sky-50 font-sans">
                <h1 class="font-semibold text-3xl text-sky-50">Nuestros Equipos</h1>
                <div class="flex justify-end items-end h-full pb-4 text-sky-50">
                    <i class="bi bi-arrow-right-circle text-[2.5rem]"></i>
                </div>
            </div>

            <div id="default-carousel" class="relative w-[40rem] h-[20rem] rounded-3xl " data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-[20rem] overflow-hidden rounded-3xl ">
                    <!-- Item 1 -->
                    <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                        <img src="{{ asset('img/services-bg.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-[-20]" alt="...">
                        <div class="absolute inset-0 bg-sky-900 bg-opacity-40 -z-10"></div>
                        <div class="h-full flex flex-col justify-between px-24 py-16">
                            <h1 class="font-sans font-bold text-[2.5rem] text-sky-50">EQUIPO 1</h1>
                            <div class= " flex justify-between items-center w-[17rem] px-4 rounded-full border-solid border-4 border-sky-50 ">
                                <h1 class="font-sans font-bold text-xl text-sky-50">MÁS INFORMACIÓN</h1>
                                <i class="bi bi-arrow-right-short text-[2rem] text-sky-50"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                        <img src="{{ asset('img/services-bg-2.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-[-20]" alt="...">
                        <div class="absolute inset-0 bg-sky-900 bg-opacity-40 -z-10"></div>
                        <div class="h-full flex flex-col justify-between px-24 py-16">
                            <h1 class="font-sans font-bold text-[2.5rem] text-sky-50">EQUIPO 2</h1>
                            <div class= " flex justify-between items-center w-[17rem] px-4 rounded-full border-solid border-4 border-sky-50 ">
                                <h1 class="font-sans font-bold text-xl text-sky-50">MÁS INFORMACIÓN</h1>
                                <i class="bi bi-arrow-right-short text-[2rem] text-sky-50"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                        <img src="{{ asset('img/services-install.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-[-20]" alt="...">
                        <div class="absolute inset-0 bg-sky-900 bg-opacity-40 -z-10"></div>
                        <div class="h-full flex flex-col justify-between px-24 py-16">
                            <h1 class="font-sans font-bold text-[2.5rem] text-sky-50">EQUIPO 3</h1>
                            <div class= " flex justify-between items-center w-[17rem] px-4 rounded-full border-solid border-4 border-sky-50 ">
                                <h1 class="font-sans font-bold text-xl text-sky-50">MÁS INFORMACIÓN</h1>
                                <i class="bi bi-arrow-right-short text-[2rem] text-sky-50"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Item 4 -->
                    <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                        <img src="{{ asset('img/services-reinstall.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 z-[-20]" alt="...">
                        <div class="absolute inset-0 bg-sky-900 bg-opacity-40 -z-10"></div>
                        <div class="h-full flex flex-col justify-between px-24 py-16">
                            <h1 class="font-sans font-bold text-[2.5rem] text-sky-50">EQUIPO 4</h1>
                            <div class= " flex justify-between items-center w-[17rem] px-4 rounded-full border-solid border-4 border-sky-50 ">
                                <h1 class="font-sans font-bold text-xl text-sky-50">MÁS INFORMACIÓN</h1>
                                <i class="bi bi-arrow-right-short text-[2rem] text-sky-50"></i>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>
    </div> --}}
    <x-slot name="footer"><x-footer/></x-slot>
</x-layouts.landingpage-layout>

<div class="fixed bottom-10 right-0 z-50">
    <x-contact-button />
</div>
