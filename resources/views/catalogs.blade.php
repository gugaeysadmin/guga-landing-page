
<x-layouts.landingpage-layout>
    <x-slot name="header"> <x-header :pages="$pages"/></x-slot>
    <div class="block relative">
        <!-- Imagen de cabecera -->
        <img src="{{ asset('img/catalogsbg.webp') }}" alt="services_img" class="w-full max-h-[35rem] object-cover" style="object-position: 0 10%;"/>

        <!-- Capa de opacidad -->
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <!-- Título -->
        <div class="absolute inset-0 flex items-center justify-center ">
            <h1 class="text-white text-[3.5vw] font-sans">Todos nuestros equipos</h1>
        </div>
    </div>
    <div class="flex max-w-[80rem] m-auto">
        <!-- Filtros -->
        <aside class="w-1/4 bg-gray-100 p-4 mt-12 sticky">
            <div class="w-full bg-sky-600 p-4 flex items-center font-sans font-semibold text-sky-50">
                <h2 class="text-lg font-bold">Categorías de Producto</h2>
            </div>

            <div id="categoriasFilter" class="mt-4">
                <div class="border border-neutral-200 bg-white dark:border-neutral-600 dark:bg-body-dark gap-4">
                    <h2 class="mb-0" id="headingOne">
                    <button
                        class="group relative flex w-full items-center border-0 bg-slate-200 px-5 py-4 text-left font-semibold text-lg text-blue-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-body-dark dark:text-white [&:not([data-twe-collapse-collapsed])]:bg-sky-400 [&:not([data-twe-collapse-collapsed])]:text-sky-50 [&:not([data-twe-collapse-collapsed])]:shadow-border-b dark:[&:not([data-twe-collapse-collapsed])]:bg-surface-dark dark:[&:not([data-twe-collapse-collapsed])]:text-primary dark:[&:not([data-twe-collapse-collapsed])]:shadow-white/10 "
                        type="button"
                        data-twe-collapse-init
                        data-twe-target="#collapseOne"
                        aria-expanded="true"
                        aria-controls="collapseOne"
                    >
                        Marcas
                        <span class="-me-1 ms-auto h-5 w-5 shrink-0 rotate-[90deg] transition-transform duration-200 ease-in-out group-data-[twe-collapse-collapsed]:me-0 group-data-[twe-collapse-collapsed]:rotate-0 motion-reduce:transition-none [&>svg]:h-6 [&>svg]:w-6">
                            <i class="bi bi-caret-right-fill text-xl"></i>
                        </span>
                    </button>
                    </h2>
                    <div
                        id="collapseOne"
                        class="!visible"
                        data-twe-collapse-item
                        data-twe-collapse-show
                        aria-labelledby="headingOne"
                        data-twe-parent="#accordionExample"
                    >
                        <div class="px-5 py-4">
                            <ul class="pl-4 mt-2 space-y-2">
                                <li>
                                    <label class="flex items-center space-x-3 text-sky-600 hover:text-sky-900 cursor-pointer">
                                        <input type="checkbox" class="hidden peer" />
                                        <span class="w-5 h-5 border-2 border-sky-500 rounded-md flex items-center justify-center peer-checked:bg-sky-600 peer-checked:border-sky-600 transition">
                                            <svg
                                                class="w-4 h-4 text-white hidden peer-checked:block"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>
                                        </span>
                                        <span>Portátiles</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center space-x-3 text-sky-700 hover:text-sky-900 cursor-pointer">
                                        <input type="checkbox" class="hidden peer" />
                                        <span class="w-5 h-5 border-2 border-sky-500 rounded-md flex items-center justify-center peer-checked:bg-sky-600 peer-checked:border-sky-600 transition">
                                            <svg
                                                class="w-4 h-4 text-white hidden peer-checked:block"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>
                                        </span>
                                        <span>Sobremesa</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Contenido -->
        <main class="w-3/4 p-4" x-data="{ isGrid: true  }">
            <!-- Botón de cambio de modo -->
            <div class="flex justify-end mb-4">
                <button id="gridView" @click="isGrid = true" class="mr-2 px-4 py-2 bg-sky-600 rounded hover:bg-sky-500" id="gridView">
                    <i class="bi bi-grid text-xl text-sky-50"></i>
                </button>
                <button id="listView" @click="isGrid = false" class="px-4 py-2 bg-sky-600 rounded hover:bg-sky-500" id="listView">
                    <i class="bi bi-list-ul text-xl text-sky-50"></i>
                </button>
            </div>
            <!-- Contenedor de productos -->
                <div   id="productsContainer" class="grid xs:grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 ">
                    @foreach($products as $product)
                        <template x-if="isGrid">
                            <div class="productCard bg-white rounded-xl p-4 text-center shadow-lg hover:shadow-xl hover:shadow-blue-100 w-full aspect-w-9 aspect-h-16">
                                <img src="https://via.placeholder.com/150" alt="Producto" class="w-full h-[85%] object-cover rounded mb-4">
                                <h3 class="font-sans font-semibold xs:text-md md:text-lg text-slate-500">{{ $product->name }}</h3>
                            </div>
                        </template>
                        <template x-if="!isGrid">
                            <div class="productCard bg-white rounded-xl p-4 shadow-lg hover:shadow-xl hover:shadow-blue-100 flex">
                                <img src="https://via.placeholder.com/150" alt="Producto" class="w-40 h-40 object-cover rounded mb-4">
                                <div class="p-4">
                                    <h3 class="font-sans font-semibold text-2xl text-blue-800">{{ $product->name}}</h3>
                                    <h3 class="font-sans text-md text-slate-900 mt-2">{{ $product->description}}</h3>
                                </div>
                            </div>
                        </template>

                    @endforeach
                </div>
                <div class="mt-4 m-auto">
                    {{ $products->links() }}
                </div>
            </div>
        </main>
    </div>

    {{-- Footer --}}
    <x-slot name="footer"><x-footer/></x-slot>

     <script>
        const gridView = document.getElementById('gridView');
        const listView = document.getElementById('listView');

        gridView.addEventListener('click', () => {
            productsContainer.className = 'grid grid-cols-4 gap-4'; // Cambia a modo mosaico
        });

        listView.addEventListener('click', () => {
            productsContainer.className = 'space-y-4'; // Cambia a modo lista
        });
    </script>
</x-layouts.landingpage-layout>
