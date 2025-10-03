@props(['title', 'filters', 'route' => null, 'filterName' => 'filter'])

<div class="w-full bg-gradient-to-tr from-sky-600 to-sky-800 p-4 flex items-center font-sans font-semibold text-sky-50 rounded-xl">
    <h2 class="text-md font-bold">{{ $title }}</h2>
</div>

<div id="categoriasFilter2" class="mt-4">
    <form id="filterForm2" method="GET" action="{{ $route ?? url()->current() }}" class="flex flex-col gap-2">
        @foreach ($filters as $key => $filter)
            <button
                class="group relative flex w-full rounded-xl items-center border-0 bg-[#3393cf]
                        px-5 py-3 text-left font-bold text-md text-white transition text-sm 
                        [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none 
                        dark:bg-body-dark dark:text-white 
                        [&:not([data-twe-collapse-collapsed])]:bg-[#60b3df]
                        [&:not([data-twe-collapse-collapsed])]:text-sky-50 
                        [&:not([data-twe-collapse-collapsed])]:shadow-border-b 
                        dark:[&:not([data-twe-collapse-collapsed])]:bg-surface-dark 
                        dark:[&:not([data-twe-collapse-collapsed])]:text-primary 
                        dark:[&:not([data-twe-collapse-collapsed])]:shadow-white/10"
                type="button"
                data-twe-collapse-init
                data-twe-target="#collapseOne{{ $key }}"
                aria-expanded="false"
                aria-controls="collapseOne{{ $key }}"
            >
                {{ $filter->section }}
                <span class="-me-1 ms-auto h-5 w-5 shrink-0 rotate-[90deg] transition-transform duration-200 ease-in-out group-data-[twe-collapse-collapsed]:me-0 group-data-[twe-collapse-collapsed]:rotate-0 motion-reduce:transition-none [&>svg]:h-6 [&>svg]:w-6">
                    <i class="bi bi-caret-right-fill text-sm"></i>
                </span>
            </button>
            <div
                id="collapseOne{{ $key}}"
                class="!visible"
                data-twe-collapse-item
                data-twe-collapse-show
                aria-labelledby="headingOne"
                data-twe-parent="#accordionExample"
            >
                <div class="px-3 pt-2 pb-4">
                    <ul class="mt-2 space-y-4">
                        @foreach ($filter->categories as $subKey => $subcategory)
                            <li>
                                <label class="flex items-center space-x-3 text-sky-600 hover:text-sky-900 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        name="{{ $filterName }}[{{ $filter->section }}][]" 
                                        value="{{ is_array($subcategory) ? $subKey : $subcategory }}"
                                        class="hidden peer filter-checkbox"
                                        @checked(in_array(is_array($subcategory) ? $subKey : $subcategory, request($filterName.'.'.$filter->section, [])))
                                    />
                                    <span class="min-w-5 min-h-5 border-2 border-sky-500 rounded-md flex items-center justify-center peer-checked:bg-sky-600 peer-checked:border-sky-600 transition">
                                        <svg class="w-4 h-4 text-white hidden peer-checked:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </span>
                                    <span class="text-xs font-medium">{{ is_array($subcategory) ? $subcategory['name'] : $subcategory }}</span>
                                </label>
                            </li>
                        @endforeach

                        {{-- @unless($loop->last)
                            <li>
                                <div class="flex justify-around gap-2 mt-4">
                                    <button 
                                        type="button" 
                                        id="resetFilters2" 
                                        class="px-2 py-1 text-xs font-semibold bg-gray-200 text-gray-600 rounded-md hover:bg-gray-300 transition"
                                    >
                                        Limpiar
                                    </button>
                                    <button 
                                        type="submit" 
                                        class="px-3 py-1 text-xs font-semibold bg-[#60b3df] text-white rounded-md hover:bg-[#509ac2] transition"
                                    >
                                        Aplicar 
                                    </button>
                                </div>
                            </li>
                        @endunless --}}
                    </ul>
                </div>
            </div>
        @endforeach
        
        <!-- Botones de acción -->
        <div class="flex justify-between gap-2 mt-4">
            <button 
                type="button" 
                id="resetFilters2" 
                class="px-4 py-2 text-sm bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition"
            >
                Limpiar
            </button>
            <button 
                type="submit" 
                class="px-4 py-2 text-sm bg-[#3393cf] text-white rounded-md hover:bg-sky-00 transition"
            >
                Aplicar 
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enviar formulario automáticamente al cambiar checkboxes (opcional)
    const checkboxes = document.querySelectorAll('.filter-checkbox');

    const params = new URLSearchParams(window.location.search);


    const areas = params.get("filter[Áreas de ecpecialidad][]");

    console.log(areas); // ["Refrigeración"] (array con todos los valores)

    if(areas && areas != null){
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'filter[Áreas de ecpecialidad][]';
        input.value = areas;
        document.getElementById('filterForm2').appendChild(input);
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Si quieres que se envíe automáticamente al seleccionar:
            //document.getElementById('filterForm2').submit();
        });
    });

    // Limpiar filtros
    document.getElementById('resetFilters2').addEventListener('click', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        document.getElementById('filterForm2').submit();
    });
});
</script>
@endpush