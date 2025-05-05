<div x-data="{ open: false, expanded: false }" class="fixed bottom-10 right-0 select-none">
    <!-- Contenedor del botón -->
    <div @click="if (!expanded) { open = !open }" 
         @click.away="expanded = false"
         x-transition:enter="transition-all duration-75 ease-in-out"
         x-transition:leave="transition-all duration-75 ease-in-out"
         class="overflow-hidden transition-all duration-75"
         :class="{
             'cursor-pointer': !expanded, 
             'w-96 h-16 bg-sky-600 rounded-l-xl flex items-center gap-2 pl-2 pr-6 shadow-lg justify-center': open && !expanded,
             'h-16 w-52 bg-sky-600 rounded-l-full flex flex-row items-center gap-2 pl-2 pr-6 shadow-lg justify-start': !open && !expanded,
             'w-80 h-[39rem] bg-sky-600 rounded-l-xl flex flex-col items-center gap-2 p-6 shadow-lg' : expanded
         }"
         style="transition: all 300ms ease-in-out;"> 

        <!-- Icono -->
        <div class="flex items-center justify-center bg-white"
             :class="{
                 'w-12 h-12 rounded-full': !expanded,
                 'w-16 h-16 rounded-full': expanded
             }"
             style="transition: all 300ms ease-in-out;">
            <i class="bi bi-headset text-3xl text-blue-500"></i>
        </div>

        <!-- Texto -->
        <div class="text-white text-lg font-bold font-sans"
             :class="{
                 'text-center ml-2': open && !expanded,
                 'ml-2': !open && !expanded,
                 'text-center text-xl': expanded
             }"
             style="transition: all 300ms ease-in-out;">
            Contáctanos
        </div>

        <!-- Contenido adicional cuando está expandido -->
        <template x-if="expanded">
            <div class="text-white text-center">
                <div class="mt-6 w-72 flex flex-col gap-1">
                    <select required class="w-72 px-3 py-2 border rounded-md focus:ring-2 focus:ring-sky-500 text-blue-800">
                        <option value="VENTAS">Contacte con ventas</option>
                        <option value="VENTAS">Contacte con servicio</option>
                    </select>
                    <input required type="email" placeholder="Nómbre completo" class="w-72 px-3 py-2 border rounded-md focus:ring-2 focus:ring-sky-500 text-blue-800">
                    <input required type="email" placeholder="Empresa" class="w-72 px-3 py-2 border rounded-md focus:ring-2 focus:ring-sky-500 text-blue-800">
                    <input required type="email" placeholder="Correo Electrónico" class="w-72 px-3 py-2 border rounded-md focus:ring-2 focus:ring-sky-500 text-blue-800">
                    <input type="text" placeholder="Teléfono" class="w-72 px-3 py-2 border rounded-md focus:ring-2 focus:ring-sky-500 text-blue-800">
                    <textarea placeholder="Descripción" rows="5" class="w-72 px-3 py-2 border rounded-md focus:ring-2 focus:ring-sky-500 text-blue-800"></textarea>
                </div>
                <div class="flex flex-row justify-between items-center mt-4">
                    <div @click="setTimeout(() => expanded = false, 0)"
                        class="h-8 px-2 flex items-center cursor-pointer"
                    >
                        <p class="text-white font-semibold ">Cancelar</p>
                    </div>

                    <div @click="setTimeout(() => expanded = false, 0)"
                        class="h-8 px-4 rounded-xl bg-white flex items-center hover:ring-2 hover:ring-emerald-300 hover:bg-sky-50 cursor-pointer"
                    >
                        <p class="text-blue-800">Enviar</p>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Lógica para las transiciones en secuencia -->
    <div x-effect="if (open) {
        setTimeout(() => {
            expanded = true;
        }, 300); // Espera a que termine la primera animación
    }"></div>
    <div x-effect="if (!expanded) {
        setTimeout(() => {
            open = false;
        }, 300); // Espera a que termine la segunda animación
    }"></div>
</div>

<script>
    function closeComponent() {
        setTimeout(() => {
            expanded = false;
        }, 300); // Retrasa la contracción para que se haga en orden
    }
</script>