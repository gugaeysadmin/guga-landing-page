{{-- <a href="{{ $href }}" class="cursor-pointer w-[15rem] flex items-center rounded-full border-[.2rem] border-[#0392ceff] hover:border-blue-600 group py-0 my-5 transition-transform duration-300 hover:-translate-y-5">
    <div class="my-0 py-0 rounded-full border-[#0392ceff]">
        <img src="/storage/{{ $image }}" alt="{{ $text }}_icon" class="w-24 h-24 my-0 py-0"/>
    </div>
    <div class="block text-center mx-auto">
        <p class="text-[1.1rem] text-[#0392ceff] font-sans font-semibold group-hover:text-blue-600">{{ $text }}</p>
        <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
    </div>
</a> --}}

<a href="{{ $href }}" class="cursor-pointer flex flex-col transition-transform duration-300 hover:-translate-y-5 hover:border-blue-600 group">
    <div class="my-0 py-0 rounded-full border-2 border-[#0392ceff] group-hover:border-[3px] m-auto">
        <img src="/storage/{{ $image }}" alt="esterilization_icon" class="w-28 h-28 my-0 py-0 rounded-full"/>
    </div>
    <div class="text-center mx-7 mt-3">
        <p class="text-[1.1rem] max-w-32 text-[#0392ceff] font-sans font-medium">{{ $text }}</p>
        {{-- <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i> --}}
    </div>
</a>