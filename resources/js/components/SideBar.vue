<template>
    <div class="h-full bg-white rounded-r-md shadow-lg w-[18rem] px-14 pt-20">
        <div class="h-full space-y-20 ">
            <div>
                <!-- <img :src="'/img/logo_normal.png'" alt="Logo" class="w-[13rem] mx-auto"> -->
                 <p class="text-2xl font-bold">Administrador </p>
            </div>
            <nav class="space-y-14">
                <div class="space-y-4">
                    <h5 class="font-mono  text-lg text-gray-400">LANDING PAGE</h5>
                    <div class="space-y-2">

                        <router-link to="/app/admin" class="flex flex-row items-center gap-4 px-5 py-4 bg-white hover:bg-gray-100 active:bg-gray-200 rounded-md transition duration-200 group">
                            <i class="bi bi-houses-fill group-hover:text-black group-acitve:text-black text-md text-gray-400 transition duration-200"></i>
                            <p class="group-hover:font-bold group-hover:text-black group-active:font-bold group-active:text-black font-medium text-gray-500 font-sans text-md transition duration-200">
                                Inicio
                            </p>
                        </router-link>

                        <router-link to="/app/admin/enterprise" class="flex flex-row items-center gap-4 px-5 py-4 bg-white hover:bg-gray-100 active:bg-gray-200 rounded-md transition duration-200 group">
                            <i class="bi bi-buildings-fill group-hover:text-black group-acitve:text-black text-md text-gray-400 transition duration-200"></i>
                            <p class="group-hover:font-bold group-hover:text-black group-active:font-bold group-active:text-black font-medium text-gray-500 font-sans text-md transition duration-200">
                                Empresa
                            </p>
                        </router-link>

                        <router-link to="/app/admin/promotions" class="flex flex-row items-center gap-4 px-5 py-4 bg-white hover:bg-gray-100 active:bg-gray-200 rounded-md transition duration-200 group">
                            <i class="bi bi-percent group-hover:text-black group-acitve:text-black text-md text-gray-400 transition duration-200"></i>
                            <p class="group-hover:font-bold group-hover:text-black group-active:font-bold group-active:text-black font-medium text-gray-500 font-sans text-md transition duration-200">
                                Promociones
                            </p>
                        </router-link>
                    </div>
                </div>
                <div class="space-y-4">
                    <h5 class="font-mono  text-lg text-gray-400">CATÁLOGOS</h5>


                    <router-link to="/app/admin/product" class="flex flex-row items-center gap-4 px-5 py-4 bg-white hover:bg-gray-100 active:bg-gray-200 rounded-md transition duration-200 group">
                        <i class="bi bi-box2-fill group-hover:text-black group-acitve:text-black text-md text-gray-400 transition duration-200"></i>
                        <p class="group-hover:font-bold group-hover:text-black group-active:font-bold group-active:text-black font-medium text-gray-500 font-sans text-md transition duration-200">
                            Productos
                        </p>
                    </router-link>

                    <router-link to="/app/admin/categories" class="flex flex-row items-center gap-4 px-5 py-4 bg-white hover:bg-gray-100 active:bg-gray-200 rounded-lg transition duration-200 group">
                        <i class="bi bi-tags-fill group-hover:text-black group-acitve:text-black text-md text-gray-400 transition duration-200"></i>
                        <p class="group-hover:font-bold group-hover:text-black group-active:font-bold group-active:text-black font-medium text-gray-500 font-sans text-md transition duration-200">
                            Categorías
                        </p>
                    </router-link>

                    <router-link to="/app/admin/speciality-areas" class="flex flex-row items-center gap-4 px-5 py-4 bg-white hover:bg-gray-100 active:bg-gray-200 rounded-lg transition duration-200 group">
                        <i class="bi bi-grid-1x2-fill group-hover:text-black group-acitve:text-black text-md text-gray-400 transition duration-200"></i>
                        <p class="group-hover:font-bold group-hover:text-black group-active:font-bold group-active:text-black font-medium text-gray-500 font-sans text-md transition duration-200">
                            Áreas de Esp.
                        </p>
                    </router-link>
                </div>

            </nav>

        </div>
    </div>
</template>

<script>
export default {
    name: "SideBar"
}
</script>
