{{-- @props(["specareas"])

<h1 class="text-center text-[2.2rem] font-sans font-extralight text-[#0392ceff]">{{ __('Areas de especialidad') }}</h1>
<div class="relative flex flex-wrap justify-center gap-8 mt-14">
    @foreach ($specareas as $specarea  )
        <x-spec-area-button 
            href="/speciality-area/{{$specarea->name }}" 
            text="{{ $specarea->name }}" 
            image="{{ $specarea->icon_file_url }}" 
        />
    @endforeach
</div> --}}

@props(["specareas"])

{{-- <h1 class="text-center text-[2.4rem] italic font-sans font-extralight text-[#0392ceff]">{{ __('Selecciona el área de especialidad') }}</h1> --}}
<div class="relative flex flex-wrap justify-center gap-x-24 gap-y-16 mt-14" id="specareas-container">
    @foreach ($specareas as $specarea)
        <div class="animate-fade-in-right opacity-0" data-delay="{{ $loop->index * 300 }}">
            <x-spec-area-cat-button 
                href="/catalogs?filter[Áreas de ecpecialidad][]={{ $specarea->name }}" 
                text="{{ $specarea->name }}" 
                image="{{ $specarea->icon_file_url }}" 
            />
        </div>
    @endforeach
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const delay = entry.target.getAttribute('data-delay');
                setTimeout(() => {
                    entry.target.classList.remove('opacity-0');
                    entry.target.classList.add('animate-fade-in-right-active');
                }, delay);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('#specareas-container > div').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endpush

{{-- <x-spec-area-button 
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
/> --}}

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
