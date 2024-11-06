<h1 class="text-center text-[3rem]  font-sans font-semibold text-[#0392ceff]">{{ __('Areas de especialidad') }}</h1>
<div class="relative flex flex-wrap justify-around  mt-16">
    
    <div x-data="{ open: false }" class="cursor-pointer w-96 flex items-center rounded-full border-4 border-[#0392ceff] hover:border-blue-600 group py-0 my-5 transition-transform duration-300 hover:-translate-y-5" @click="open = !open">
        <a class="my-0 py-0 rounded-full  border-gray-200 ">
            <img src="{{ asset('icons/esterilization.png') }}" alt="esterilization_icon" class="w-32 h-32 my-0 py-0"/>
        </a>
        <div class="block text-center mx-7">
            <p class="text-[1.5rem] text-[#0392ceff]  font-sans font-semibold group-hover:text-blue-600">Esterilización</p>
            <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
        </div>
    </div>

    {{-- <div x-show="open" x-transition class="absolute left-0 top-full mt-2 w-full bg-gray-100 rounded-b-lg border border-gray-200 shadow-lg p-5">
        <div class="flex flex-col items-start">
            <!-- Primer ícono y texto -->
            <div class="flex items-center mb-4">
                <img src="{{ asset('icons/icon1.png') }}" alt="icon1" class="w-8 h-8 mr-3"/>
                <span class="text-gray-700 font-medium">Texto 1</span>
            </div>
            <!-- Segundo ícono y texto -->
            <div class="flex items-center mb-4">
                <img src="{{ asset('icons/icon2.png') }}" alt="icon2" class="w-8 h-8 mr-3"/>
                <span class="text-gray-700 font-medium">Texto 2</span>
            </div>
            <!-- Tercer ícono y texto -->
            <div class="flex items-center">
                <img src="{{ asset('icons/icon3.png') }}" alt="icon3" class="w-8 h-8 mr-3"/>
                <span class="text-gray-700 font-medium">Texto 3</span>
            </div>
        </div>
    </div> --}}

    <div class="cursor-pointer w-96 flex items-center rounded-full border-4 border-[#0392ceff] hover:border-blue-600 group py-0 my-5 transition-transform duration-300 hover:-translate-y-5">
        <a class="my-0 py-0 rounded-full  border-[#0392ceff] ">
            <img src="{{ asset('icons/operating-room.png') }}" alt="esterilization_icon" class="w-32 h-32 my-0 py-0"/>
        </a>
        <div class="block text-center mx-7">
            <p class="text-[1.5rem] text-[#0392ceff]  font-sans font-semibold group-hover:text-blue-600">Quirófano</p>
            <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
        </div>
    </div>

    <div class="cursor-pointer w-96 flex items-center rounded-full border-4 border-[#0392ceff] hover:border-blue-600 group py-0 my-5 transition-transform duration-300 hover:-translate-y-5">
        <a class="my-0 py-0 rounded-full  border-[#0392ceff] ">
            <img src="{{ asset('icons/imaging.png') }}" alt="esterilization_icon" class="w-32 h-32 my-0 py-0"/>
        </a>
        <div class="block text-center mx-7">
            <p class="text-[1.5rem] text-[#0392ceff]  font-sans font-semibold group-hover:text-blue-600">Imagenología</p>
            <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
        </div>
    </div>

    <div class="cursor-pointer w-96 flex items-center rounded-full border-4 border-[#0392ceff] hover:border-blue-600 group py-0 my-5 transition-transform duration-300 hover:-translate-y-5">
        <a class="my-0 py-0 rounded-full  border-[#0392ceff] ">
            <img src="{{ asset('icons/refrigeration.png') }}" alt="esterilization_icon" class="w-32 h-32 my-0 py-0"/>
        </a>
        <div class="block text-center mx-7">
            <p class="text-[1.5rem] text-[#0392ceff]  font-sans font-semibold group-hover:text-blue-600">Refrigeración</p>
            <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
        </div>
    </div>
</div>

<div class="mx-5 sm:mx-5 md:ml-32 md:mr-40 mt-14 mb-10 border-t-[3px] border-slate-400"></div>

<div class="relative flex flex-wrap sm:flex-wrap md:flex-shrink justify-around mt-16">
    <div class="cursor-pointer flex flex-col transition-transform duration-300 hover:-translate-y-5 hover:border-blue-600 group">
        <a class="my-0 py-0 rounded-full border-4 border-[#0392ceff] group-hover:border-blue-600 m-auto">
            <img src="{{ asset('icons/esterilization.png') }}" alt="esterilization_icon" class="w-32 h-32 my-0 py-0"/>
        </a>
        <div class="text-center mx-7">
            <p class="text-[1.5rem] text-[#0392ceff]  font-sans font-semibold group-hover:text-blue-600">Esterilización</p>
            <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
        </div>
    </div>

    <div class="cursor-pointer flex flex-col transition-transform duration-300 hover:-translate-y-5 hover:border-blue-600 group">
        <a class="my-0 py-0 rounded-full border-4 border-[#0392ceff] group-hover:border-blue-600 m-auto">
            <img src="{{ asset('icons/operating-room.png') }}" alt="esterilization_icon" class="w-32 h-32 my-0 py-0"/>
        </a>
        <div class="text-center mx-7">
            <p class="text-[1.5rem] text-[#0392ceff]  font-sans font-semibold group-hover:text-blue-600">Quirófano</p>
            <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
        </div>
    </div>

    <div class="cursor-pointer flex flex-col transition-transform duration-300 hover:-translate-y-5 hover:border-blue-600 group">
        <a class="my-0 py-0 rounded-full border-4 border-[#0392ceff] group-hover:border-blue-600 m-auto">
            <img src="{{ asset('icons/imaging.png') }}" alt="esterilization_icon" class="w-32 h-32 my-0 py-0"/>
        </a>
        <div class="text-center mx-7">
            <p class="text-[1.5rem] text-[#0392ceff]  font-sans font-semibold group-hover:text-blue-600">Imagenología</p>
            <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
        </div>
    </div>

    <div class="cursor-pointer flex flex-col transition-transform duration-300 hover:-translate-y-5 hover:border-blue-600 group">
        <a class="my-0 py-0 rounded-full border-4 border-[#0392ceff] group-hover:border-blue-600 m-auto">
            <img src="{{ asset('icons/refrigeration.png') }}" alt="esterilization_icon" class="w-32 h-32 my-0 py-0"/>
        </a>
        <div class="text-center mx-7">
            <p class="text-[1.5rem] text-[#0392ceff]  font-sans font-semibold group-hover:text-blue-600">Refrigeración</p>
            <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
        </div>
    </div>
</div>
