@props(['title', 'filters'])

<div class="w-full bg-[#4180ab] p-4 flex items-center font-sans font-semibold text-sky-50 rounded-xl">
    <h2 class="text-lg font-bold">{{ $title }}</h2>
</div>

<div id="categoriasFilter" class="mt-4">

    <div class="b  dark:border-neutral-600 dark:bg-body-dark flex flex-col gap-2">

    @foreach ($filters as $filter)
        <button
            class="group relative flex w-full rounded-xl items-center border-0 bg-slate-300 px-5 py-4 text-left font-semibold text-lg text-blue-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-body-dark dark:text-white [&:not([data-twe-collapse-collapsed])]:bg-[#8ab3cf] [&:not([data-twe-collapse-collapsed])]:text-sky-50 [&:not([data-twe-collapse-collapsed])]:shadow-border-b dark:[&:not([data-twe-collapse-collapsed])]:bg-surface-dark dark:[&:not([data-twe-collapse-collapsed])]:text-primary dark:[&:not([data-twe-collapse-collapsed])]:shadow-white/10 "
            type="button"
            data-twe-collapse-init
            data-twe-target="#collapseOne{{ $filter['tag'] }}"
            aria-expanded="false"
            aria-controls="collapseOne{{ $filter['tag'] }}"
        >
            {{ $filter['name'] }}
            <span class="-me-1 ms-auto h-5 w-5 shrink-0 rotate-[90deg] transition-transform duration-200 ease-in-out group-data-[twe-collapse-collapsed]:me-0 group-data-[twe-collapse-collapsed]:rotate-0 motion-reduce:transition-none [&>svg]:h-6 [&>svg]:w-6">
                <i class="bi bi-caret-right-fill text-xl"></i>
            </span>
        </button>
        <div
            id="collapseOne{{ $filter['tag'] }}"
            class="!visible"
            data-twe-collapse-item
            data-twe-collapse-show
            aria-labelledby="headingOne"
            data-twe-parent="#accordionExample"
        >
            <div class="px-3 py-4">
                <ul class="mt-2 space-y-4">
                    @foreach ($filter['subcategories'] as $subcategory )
                        <li >
                            <label class="flex items-center space-x-3 text-sky-600 hover:text-sky-900 cursor-pointer">
                                <input type="checkbox" class="hidden peer" />
                                <span class="min-w-5 min-h-5 border-2 border-sky-500 rounded-md flex items-center justify-center peer-checked:bg-sky-600 peer-checked:border-sky-600 transition">
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
                                <span>{{ $subcategory['name'] }}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
    @endforeach
    </div>
</div>