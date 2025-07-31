<template>
    <nav class="flex flex-row flex-wrap justify-around gap-4 mt-8">

        <!-- <router-link 
            to="/app/admin/enterprise/alliances"
            class=" items-center justify-center content-center bg-white py-5 px-5  h-32 w-32 rounded-full shadow-md hover:shadow-lg hover:bg-[#fafdff] group "
        > -->

        <router-link 
            to="/app/admin/enterprise/brands"
            class=" items-center justify-center content-center bg-white py-5 px-5  h-32 w-32 rounded-full shadow-md hover:shadow-lg hover:bg-sky-600 group transition-all duration-200"
        >
            <div class=" text-center">
                <!-- <i class="bi bi-tag text-4xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Marcas</p> -->
                <i class="bi bi-tag text-4xl text-sky-600 group-hover:text-white"></i>
                <p class="text-lg text-sky-600 font-semibold text-center mt-2 group-hover:text-white">Marcas</p>
            </div>
        </router-link>
        <router-link 
            to="/app/admin/enterprise/services"
            class=" items-center justify-center content-center bg-white py-5 px-5  h-32 w-32 rounded-full shadow-md hover:shadow-lg hover:bg-sky-600 group transition-all duration-200"
        >
            <div class=" text-center">
                <!-- <i class="bi bi-gear text-4xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Servicios</p> -->
                <i class="bi bi-gear text-4xl text-sky-600 group-hover:text-white"></i>
                <p class="text-lg text-sky-600 font-semibold text-center mt-2 group-hover:text-white">Servicios</p>
            </div>
        </router-link>
        <router-link 
            to="/app/admin/enterprise/accesories-pdf"
            class=" items-center justify-center content-center bg-white py-5 px-5  h-32 w-32 rounded-full shadow-md hover:shadow-lg hover:bg-sky-600 group transition-all duration-200"
        >
            <div class=" text-center">
                <!-- <i class="bi bi-file-earmark-pdf text-4xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Accesorios</p> -->
                <i class="bi bi-file-earmark-pdf text-4xl text-sky-600 group-hover:text-white"></i>
                <p class="text-lg text-sky-600 font-semibold text-center mt-2 group-hover:text-white">Accesorios</p>
            </div>
        </router-link>
                <router-link 
            to="/app/admin/enterprise/table-config"
            class=" items-center justify-center content-center bg-white py-5 px-5  h-32 w-32 rounded-full shadow-md hover:shadow-lg hover:bg-sky-600 group transition-all duration-200"
        >
            <div class=" text-center">
                <!-- <i class="bi bi-person-check text-4xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Alianzas</p> -->
                <i class="bi bi-table text-3xl text-sky-600 group-hover:text-white"></i>
                <p class="text-lg text-sky-600 font-semibold text-center mt-2 group-hover:text-white">Tablas</p>
            </div>
        </router-link>

    </nav>
</template>

<script>
    export default {
        name: "NavSections"
    }
</script>