<template>
    <nav class="flex flex-row flex-wrap justify-between gap-4 mt-8">

        <!-- <router-link 
            to="/app/admin/enterprise/alliances"
            class=" items-center justify-center content-center bg-white py-5 px-5  h-32 w-32 rounded-full shadow-md hover:shadow-lg hover:bg-[#fafdff] group "
        > -->

        <router-link 
            to="/app/admin/enterprise/brands"
            class=" group transition-all ease-in-out duration-200 flex-1 min-w-[15rem] max-w-[15rem] hover:-translate-y-1 hover:shadow-xl"
        >
            <div class="flex flex-row items-center gap-4 bg-white  rounded-xl shadow-lg">
                <!-- <i class="bi bi-tag text-4xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Marcas</p> -->
                <div
                    class="h-14 w-14 flex items-center justify-center rounded-l-xl rounded-r-sm
                        bg-gradient-to-r 
                        from-sky-500  
                        to-sky-600
                        group-hover:from-sky-500
                        group-hover:to-sky-700
                    "
                >
                    <i class="bi bi-tag text-3xl text-white scale-x-90 "></i>
                </div>
                <p class="text-xl text-sky-700 font-bold text-center ">Marcas</p>
            </div>
        </router-link>
        <router-link 
            to="/app/admin/enterprise/services"
            class=" group transition-all ease-in-out duration-200 flex-1 min-w-[15rem] max-w-[15rem] hover:-translate-y-1 hover:shadow-xl"
        >
            <div class="flex flex-row items-center gap-4 bg-white rounded-xl shadow-lg">
                <!-- <i class="bi bi-tag text-4xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Marcas</p> -->
                <div
                    class="h-14 w-14 flex items-center justify-center rounded-l-xl rounded-r-sm
                        bg-gradient-to-r 
                        from-sky-500  
                        to-sky-600
                        group-hover:from-sky-500
                        group-hover:to-sky-700
                    "
                >
                    <i class="bi bi-tools text-2xl text-white  scale-x-90"></i>
                </div>
                <p class="text-xl text-sky-700 font-bold text-center ">Servicios</p>
            </div>
        </router-link>
        <router-link 
            to="/app/admin/enterprise/accesories-pdf"
            class=" group transition-all ease-in-out duration-200 flex-1 min-w-[15rem] max-w-[15rem] hover:-translate-y-1 hover:shadow-xl"
        >
            <div class="flex flex-row items-center gap-4 bg-white rounded-xl shadow-lg">
                <!-- <i class="bi bi-tag text-4xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Marcas</p> -->
                <div
                    class="h-14 w-14 flex items-center justify-center rounded-l-xl rounded-r-sm
                        bg-gradient-to-r 
                        from-sky-500  
                        to-sky-600
                        group-hover:from-sky-500
                        group-hover:to-sky-700
                    "
                >
                    <i class="bi bi-file-earmark-pdf text-2xl text-white  scale-x-90"></i>
                </div>
                <p class="text-xl text-sky-700 font-bold text-center ">Accesorios</p>
            </div>
        </router-link>
                <router-link 
            to="/app/admin/enterprise/table-config"
            class=" group transition-all ease-in-out duration-200 flex-1 min-w-[15rem] max-w-[15rem] hover:-translate-y-1 hover:shadow-xl"
        >
            <div class="flex flex-row items-center gap-4 bg-white rounded-xl shadow-lg">
                <!-- <i class="bi bi-tag text-4xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Marcas</p> -->
                <div
                    class="h-14 w-14 flex items-center justify-center rounded-l-xl rounded-r-sm
                        bg-gradient-to-r 
                        from-sky-500  
                        to-sky-600
                        group-hover:from-sky-500
                        group-hover:to-sky-700
                    "
                >
                    <i class="bi bi-table text-2xl text-white  scale-x-90"></i>
                </div>
                <p class="text-xl text-sky-700 font-bold text-center ">Tablas</p>
            </div>
        </router-link>

    </nav>
</template>

<script>
    export default {
        name: "NavSections"
    }
</script>