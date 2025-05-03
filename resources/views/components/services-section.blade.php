@props(["description", "services"])

 <div class="bg-slate-50 flex flex-wrap md:flex-row flex-col">
        <div class="w-full md:w-5/12  bg-slate-100 flex justify-center items-center">
            <div class="h-full rounded-r-2xl w-full border-[0px] border-slate-200 shadow-5 bg-white  overflow-hidden flex items-center justify-center">
                <img src="{{ asset('img/slider1.jpg') }}" alt="services_img" class="h-full w-full object-cover"/>
            </div>
        </div>
        <div class="w-full md:w-7/12 pb-16 pt-24 bg-slate-100 ">
            <div class=" max-w-[50rem] mx-auto">
                <h1 class="px-4 sm:px-5 md:px-32 text-[2.2rem] font-sans font-extralight text-[#0392ceff]">{{ __('Servicios') }}</h1>
                <p class="px-4  sm:px-5 md:px-32 text-md mt-8 mb-18">{{ $description }}</p>
            
                <div id="specareas-container" class="relative flex flex-wrap justify-around mt-16 px-5 md:px-20">
                    @foreach ($services as $service )
                        <div class="flex flex-col items-center my-3 transition-transform duration-300 hover:-translate-y-5 hover:border-blue-600 group w-full md:w-1/3">
                            <a class="my-0 py-0 rounded-full border-2 border-[#0392ceff] group-hover:border-blue-600 m-auto">
                                <img src="/storage/{{ $service->img_url }}" alt="esterilization_icon" class="w-24 h-24 my-0 py-0"/>
                            </a>
                            <div class="text-center mx-7 mt-4">
                                <p class="text-[1.1rem] text-[#0392ceff] font-sans font-semibold group-hover:text-blue-600">{{ $service->name }}</p>
                            </div>
                        </div> 
                    @endforeach
                </div>
            </div>
        </div>
    </div>
