<template>
    <nav class="flex flex-row flex-wrap justify-between gap-4 mt-8">

        <router-link 
            to="/app/admin/enterprise/alliances"
            class=" items-center justify-center content-center bg-white py-5 px-5  h-36 w-36 rounded-full shadow-sm hover:shadow-md hover:bg-[#fafdff]"
        >
            <div class=" text-center">
                <i class="bi bi-person-check text-5xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Alianzas</p>
            </div>
        </router-link>

        <router-link 
            to="/app/admin/enterprise/brands"
            class=" items-center justify-center content-center bg-white py-5 px-5  h-36 w-36 rounded-full shadow-sm hover:shadow-md hover:bg-[#fafdff]"
        >
            <div class=" text-center">
                <i class="bi bi-tag text-5xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Marcas</p>
            </div>
        </router-link>
        <router-link 
            to="/app/admin/enterprise/services"
            class=" items-center justify-center content-center bg-white py-5 px-5  h-36 w-36 rounded-full shadow-sm hover:shadow-md hover:bg-[#fafdff]"
        >
            <div class=" text-center">
                <i class="bi bi-gear text-5xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Servicios</p>
            </div>
        </router-link>
        <router-link 
            to="/app/admin/enterprise/accesories-pdf"
            class=" items-center justify-center content-center bg-white py-5 px-5  h-36 w-36 rounded-full shadow-sm hover:shadow-md hover:bg-[#fafdff]"
        >
            <div class=" text-center">
                <i class="bi bi-file-earmark-pdf text-5xl text-[#366a8d]"></i>
                <p class="text-lg text-[#4180ab] font-semibold text-center mt-2">Accesorios</p>
            </div>
        </router-link>

    </nav>
</template>

<script>
    export default {
        name: "NavSections"
    }
</script>