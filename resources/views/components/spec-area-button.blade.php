<a href="{{ $href }}" class="cursor-pointer w-96 flex items-center rounded-full border-4 border-[#0392ceff] hover:border-blue-600 group py-0 my-5 transition-transform duration-300 hover:-translate-y-5">
    <div class="my-0 py-0 rounded-full border-[#0392ceff]">
        <img src="{{ asset($image) }}" alt="{{ $text }}_icon" class="w-32 h-32 my-0 py-0"/>
    </div>
    <div class="block text-center mx-7">
        <p class="text-[1.5rem] text-[#0392ceff] font-sans font-semibold group-hover:text-blue-600">{{ $text }}</p>
        <i class="bi bi-caret-down-fill text-[#0392ceff] group-hover:text-blue-600"></i>
    </div>
</a>