@props(["about", "mision", "vision", "values"])

<div class="bg-slate-100">
    <div>
        <div class="block text-center pt-32">
            <h1 class="text-[2.2rem] font-sans font-extralight italic text-[#0392ceff]">{{ __('Sobre Nosotros') }}</h1>
        </div>
        <div class=" my-8 max-w-[50rem] mx-auto ">
            <p class="text-center italic text-xl whitespace-pre-line">{{ $about}}</p>
        </div>
        <div class="pb-24 flex justify-center">
            <a href="/contact" class="rounded-xl py-2 px-4 mx-auto text-[#0392ceff] border-2 border-[#0392ceff]">
                Contactanos
            </a>
        </div>
    </div>
</div>
<div class="flex items-center justify-center py-[10rem] relative overflow-hidden min-h-[40rem]" id="parallax-section">
    
    <div class="flex flex-col max-w-[70rem]">
        <div class="hidden-section  max-w-[80rem] overflow-hidden flex flex-row items-center gap-1 opacity-0  translate-y-10 transition-all duration-[2000ms] ease-in-out animate-fadeIn">
            <div class="flex flex-col justify-center gap-1">
                <div class="h-12 border-solid bg-white w-[0.08rem] mx-auto"></div>
                <div class="h-6 w-6 bg-[#5ddae580] rounded-full flex items-center justify-center">
                    <div class="h-3 w-3 bg-[#5ddae5] rounded-full"></div>
                </div>
                <div class="h-12 border-solid bg-white w-[0.08rem] mx-auto"></div>
            </div>
            <div class="bg-white w-6 h-[0.08rem]"></div>
            <div class="rounded-full full h-[6rem] flex flex-row items-center bg-[#000000CC] gap-6 px-16">
                <div><h1 class="font-bold text-white text-3xl font-sans">Vision</h1></div>
                <div><h1 class="text-[#5ddae5]  font-medium text-[2vw] sm:text-lg font-sans">{{ $mision }}</h1></div>
            </div>
        </div>

        <div class=" hidden-section  max-w-[80rem] overflow-hidden flex flex-row items-center gap-1 opacity-0  translate-y-10 transition-all duration-[2000ms] ease-in-out animate-fadeIn">
            <div class="flex flex-col justify-center gap-1">
                <div class="h-12 border-solid bg-white w-[0.08rem] mx-auto"></div>
                <div class="h-6 w-6 bg-[#5ddae580] rounded-full flex items-center justify-center">
                    <div class="h-3 w-3 bg-[#5ddae5] rounded-full"></div>
                </div>
                <div class="h-12 border-solid bg-white w-[0.08rem] mx-auto"></div>
            </div>
            <div class="bg-white w-6 h-[0.08rem]"></div>
            <div class="rounded-full full h-[6rem] flex flex-row items-center bg-[#000000CC] gap-6 px-16">
                <div><h1 class="font-bold text-white text-3xl font-sans">Misión</h1></div>
                <div><h1 class="text-[#5ddae5] font-medium text-[2vw] sm:text-lg font-sans">{{ $vision }}</h1></div>
            </div>
        </div>

        <div class=" hidden-section  max-w-[80rem] overflow-hidden flex flex-row items-center gap-1 opacity-0  translate-y-10 transition-all duration-[2000ms] ease-in-out animate-fadeIn">
            <div class="flex flex-col justify-center gap-1">
                <div class="h-12 border-solid bg-white w-[0.08rem] mx-auto"></div>
                <div class="h-6 w-6 bg-[#5ddae580] rounded-full flex items-center justify-center">
                    <div class="h-3 w-3 bg-[#5ddae5] rounded-full"></div>
                </div>
                <div class="h-12 border-solid bg-white w-[0.08rem] mx-auto"></div>
            </div>
            <div class="bg-white w-6 h-[0.08rem]"></div>
            <div class="rounded-full full h-[6rem] flex flex-row items-center bg-[#000000CC] gap-6 px-16">
                <div><h1 class="font-bold text-white text-3xl font-sans">Valores</h1></div>
                <div><h1 class="text-[#5ddae5] font-medium text-[2vw] sm:text-lg font-sans">{{ $values }}</h1></div>
            </div>
        </div>
    </div>

    <div class="parallax-bg absolute inset-0 -z-10 h-screen">
        <img src="{{ asset("/img/enterprise_bg.jpg") }}" class="w-full h-full object-cover transform scale-105" id="parallax-image" />
    </div>
    <div class="absolute inset-0 -z-10 bg-[#00000080]"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sections = document.querySelectorAll(".hidden-section");

        const observer = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add("opacity-100", "translate-y-0");
                            entry.target.classList.remove("opacity-0", "translate-y-10");
                            observer.unobserve(entry.target);
                        }, index * 500); // Retraso progresivo (500ms por cada sección)
                    }
                });
            },
            { threshold: 0.3 }
        );

        sections.forEach((section) => {
            observer.observe(section);
        });
    });
    const parallaxImage = document.getElementById('parallax-image');
    const parallaxSection = document.getElementById('parallax-section');

    // 2. Intersection Observer para activar el efecto solo cuando la sección es visible
        const parallaxObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Activa el evento de scroll solo cuando la sección está visible
                        window.addEventListener('scroll', handleParallax);
                    } else {
                        window.removeEventListener('scroll', handleParallax);
                        parallaxImage.style.transform = 'scale(1.05) translateY(0)'; // Reset
                    }
                });
            },
            { threshold: 0.1 }
        );

        parallaxObserver.observe(parallaxSection);

        // 3. Función del efecto parallax
        function handleParallax() {
            const sectionTop = parallaxSection.getBoundingClientRect().top;
            const scrollPosition = window.pageYOffset;
            const viewportHeight = window.innerHeight;
            
            // Solo aplica el efecto cuando la sección está en el viewport
            if (sectionTop < viewportHeight && sectionTop > -parallaxSection.offsetHeight) {
                const parallaxValue = (scrollPosition - parallaxSection.offsetTop) * 0.4;
                parallaxImage.style.transform = `scale(1.05) translateY(${parallaxValue}px)`;
            }
        }
</script>