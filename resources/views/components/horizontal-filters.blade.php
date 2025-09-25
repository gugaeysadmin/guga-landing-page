@props(['title', 'filters', 'route' => null, 'filterName' => 'filter'])

<div class="w-full bg-white ">
  <form id="filterForm" method="GET" action="{{ $route ?? url()->current() }}" class="max-w-6xl mx-auto px-4">
    
    <!-- Fila 1: Dropdowns -->
    <div class="flex items-center gap-4 py-3">
      @foreach ($filters as $key => $filter)
        <div class="relative" data-dropdown>
          <button
            type="button"
            data-dropdown-button
            class="flex items-center gap-2 py-2 px-4 font-medium text-md text-sky-600 dark:text-sky-200 hover:bg-slate-300 dark:hover:bg-slate-700 rounded-md"
          >
            {{ $filter->section }}
            <i class="bi bi-caret-down-fill"></i>
          </button>

          <!-- Menú desplegable -->
          <div
            data-dropdown-menu
            class="absolute left-0 top-full w-64 mt-1 hidden z-50 bg-white dark:bg-slate-900 rounded-md shadow-lg"
          >
            <div class="p-3">
              <ul class="space-y-3 max-h-60 overflow-y-auto">
                @foreach ($filter->categories as $subKey => $subcategory)
                  @php
                    $value = is_array($subcategory) ? $subKey : $subcategory;
                    $label = is_array($subcategory) ? $subcategory['name'] : $subcategory;
                    $isChecked = in_array($value, request($filterName.'.'.$filter->section, []));
                  @endphp
                  <li>
                    <label class="flex items-center space-x-3 text-sky-700 dark:text-sky-300 hover:text-sky-900 cursor-pointer select-none">
                      <input
                        type="checkbox"
                        name="{{ $filterName }}[{{ $filter->section }}][]"
                        value="{{ $value }}"
                        class="sr-only peer filter-checkbox"
                        @checked($isChecked)
                        data-label="{{ $label }}"
                        data-section="{{ $filter->section }}"
                      />
                      <span class="w-5 h-5 border-2 border-sky-500 rounded-md flex items-center justify-center peer-checked:bg-sky-600 peer-checked:border-sky-600 transition">
                        <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                      </span>
                      <span class="text-sm">{{ $label }}</span>
                    </label>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Fila 2: Chips -->
    <div class="flex items-center flex-wrap gap-2 py-3 border-t border-slate-300 dark:border-slate-700">
    <div id="chipsContainer" class="flex flex-wrap gap-2"></div>

    <!-- Contenedor de botones oculto al inicio -->
    <div id="buttonsContainer" class="ml-auto flex gap-2 hidden">
        <button 
        type="button" 
        id="resetFilters" 
        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition"
        >
        Limpiar
        </button>
        <button 
        type="submit" 
        class="px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition"
        >
        Aplicar 
        </button>
    </div>
    </div>
  </form>
</div>

<script>
    // --- Dropdown toggle ---
    document.querySelectorAll("[data-dropdown]").forEach(drop => {
        const btn = drop.querySelector("[data-dropdown-button]");
        const menu = drop.querySelector("[data-dropdown-menu]");

        btn.addEventListener("click", () => {
        const isOpen = !menu.classList.contains("hidden");

        // cerrar todos
        document.querySelectorAll("[data-dropdown-menu]").forEach(m => m.classList.add("hidden"));

        if (!isOpen) {
            menu.classList.remove("hidden");
        }
        });
    });

    // cerrar al hacer click fuera
    document.addEventListener("click", (e) => {
        if (!e.target.closest("[data-dropdown]")) {
        document.querySelectorAll("[data-dropdown-menu]").forEach(m => m.classList.add("hidden"));
        }
    });

    // --- Chips dinámicos ---
    const chipsContainer = document.getElementById("chipsContainer");
    const buttonsContainer = document.getElementById("buttonsContainer");
    const checkboxes = document.querySelectorAll(".filter-checkbox");
    const form = document.getElementById("filterForm");

    function renderChips() {
        chipsContainer.innerHTML = "";
        let hasFilters = false;

        checkboxes.forEach(cb => {
        if (cb.checked) {
            hasFilters = true;
            const chip = document.createElement("div");
            chip.className = "flex items-center bg-gradient-to-r from-sky-500 to-sky-600 text-white text-sm px-3 py-1 rounded-full";
            chip.innerHTML = `
            <span class="mr-2">${cb.dataset.section}: ${cb.dataset.label}</span>
            <button type="button" class="ml-1 hover:text-red-200">&times;</button>
            `;
            chip.querySelector("button").addEventListener("click", () => {
            cb.checked = false;
            renderChips();
            });
            chipsContainer.appendChild(chip);
        }
        });

        // mostrar u ocultar botones según haya filtros
        if (hasFilters) {
        buttonsContainer.classList.remove("hidden");
        } else {
        buttonsContainer.classList.add("hidden");
        }
    }

    renderChips();
    checkboxes.forEach(cb => cb.addEventListener("change", renderChips));

    document.getElementById("resetFilters").addEventListener("click", () => {
        checkboxes.forEach(cb => cb.checked = false);
        renderChips();
        form.submit(); 

    });
</script>
