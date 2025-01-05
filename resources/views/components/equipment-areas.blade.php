<h1 class="text-center text-[3rem]  font-sans font-semibold text-[#0392ceff]">{{ __('Areas de especialidad') }}</h1>
<div class="relative flex flex-wrap justify-around  mt-16">
    <x-spec-area-button 
        href=" {{ config('routes.sterilization') }}" 
        text="Esterilización" 
        image="icons/esterilization.png" 
    />
    <x-spec-area-button 
        href=" {{ config('routes.operating-room') }}" 
        text="Quirófano" 
        image="icons/operating-room.png" 
    />
    <x-spec-area-button 
        href=" {{ config('routes.imageneology') }}" 
        text="Imagenología" 
        image="icons/imaging.png" 
    />
    <x-spec-area-button 
        href=" {{ config('routes.refrigeration') }}" 
        text="Refrigeración" 
        image="icons/refrigeration.png" 
    />
</div>

{{-- <div class="mx-5 sm:mx-5 md:ml-32 md:mr-40 mt-14 mb-10 border-t-[3px] border-slate-400"></div>

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
</div> --}}
