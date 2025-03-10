<div class="flex items-center justify-center py-[10rem] relative overflow-hidden">
    
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
                <div><h1 class="text-[#5ddae5] font-medium text-lg font-sans">Lograr la completa satisfacción de nuestros clientes mediante una estricta supervisión de calidad en el desarrollo de nuestros servicios.</h1></div>
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
                <div><h1 class="text-[#5ddae5] font-medium text-lg font-sans">Satisfacer las necesidades de nuestros clientes en cuanto servicio de mantenimiento, comercialización de equipo médico de precisión con marcas basadas en la pasión por la innovación.</h1></div>
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
                <div><h1 class="font-bold text-white text-3xl font-sans">Vision</h1></div>
                <div><h1 class="text-[#5ddae5] font-medium text-lg font-sans">Calidad, Trabajo en equipo, Actitud de servicio, Seguridad y compromiso. </h1></div>
            </div>
        </div>
    </div>

    <div class="absolute inset-0 -z-20">
        <img src="{{ asset("/img/enterprise_bg.jpg") }}" class="w-full h-full object-cover"/>
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
</script>