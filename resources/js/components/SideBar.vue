<template>
    <div class="h-full bg-gradient-to-b from-slate-800 via-slate-800 to-slate-700 shadow-lg w-[18rem] pl-14 pr-12 pt-20">
        <div class="space-y-20 ">
            <div>
                <!-- <img :src="'/img/logo_normal.png'" alt="Logo" class="w-[13rem] mx-auto"> -->
                 <p class="text-2xl font-bold text-[#f5fbff]">Administrador </p>
            </div>
            <nav class="space-y-14">
                <div class="space-y-4">
                    <!-- old text text-[#4180ab] -->
                    <h5 class="font-mono  text-lg text-[#f5fbff]">LANDING PAGE</h5>
                    <div class="space-y-2">

                        <router-link to="/app/admin" class="flex flex-row items-center gap-4 px-5 py-4 bg-slate-800 hover:bg-slate-700  active:bg-gray-900 rounded-md transition duration-200 group">
                            <i class="bi bi-houses  group-acitve:text-black text-md text-[#f5fbff] transition duration-200"></i>
                            <p class="group-hover:font-bold  group-active:font-bold  font-medium text-[#f5fbff] font-sans text-md transition duration-200">
                                Inicio
                            </p>
                        </router-link>

                        <!-- <router-link to="/app/admin/enterprise" class="flex flex-row items-center gap-4 px-5 py-4 bg-white hover:bg-gray-100 active:bg-gray-200 rounded-md transition duration-200 group">
                            <i class="bi bi-buildings-fill group-hover:text-black group-acitve:text-black text-md text-gray-400 transition duration-200"></i>
                            <p class="group-hover:font-bold group-hover:text-black group-active:font-bold group-active:text-black font-medium text-gray-500 font-sans text-md transition duration-200">
                                Empresa
                            </p>
                        </router-link> -->

                        <router-link to="/app/admin/promotions" class="flex flex-row items-center gap-4 px-5 py-4 bg-slate-800 hover:bg-slate-700  active:bg-gray-900 rounded-md transition duration-200 group">
                            <i class="bi bi-percent  group-acitve:text-black text-md text-[#f5fbff] transition duration-200"></i>
                            <p class="group-hover:font-bold  group-active:font-bold  font-medium text-[#f5fbff] font-sans text-md transition duration-200">
                                Promociones
                            </p>
                        </router-link>
                    </div>
                </div>
                <div class="space-y-4">
                    <h5 class="font-mono  text-lg text-[#f5fbff]">ADMINISTRACIÓN</h5>


                    <router-link to="/app/admin/product" class="flex flex-row items-center gap-4 px-5 py-4 bg-slate-800 hover:bg-slate-700  active:bg-gray-900 rounded-md transition duration-200 group">
                            <i class="bi bi-grid  group-acitve:text-black text-md text-[#f5fbff] transition duration-200"></i>
                            <p class="group-hover:font-bold  group-active:font-bold  font-medium text-[#f5fbff] font-sans text-md transition duration-200">
                            Productos
                        </p>
                    </router-link>

                    <router-link to="/app/admin/categories" class="flex flex-row items-center gap-4 px-5 py-4 bg-slate-800 hover:bg-slate-700  active:bg-gray-900 rounded-md transition duration-200 group">
                            <i class="bi bi-tags  group-acitve:text-black text-md text-[#f5fbff] transition duration-200"></i>
                            <p class="group-hover:font-bold  group-active:font-bold  font-medium text-[#f5fbff] font-sans text-md transition duration-200">
                            Categorías
                        </p>
                    </router-link>

                    <router-link to="/app/admin/speciality-areas" class="flex flex-row items-center gap-4 px-5 py-4 bg-slate-800 hover:bg-slate-700  active:bg-gray-900 rounded-md transition duration-200 group">
                            <i class="bi bi-kanban  group-acitve:text-black text-md text-[#f5fbff] transition duration-200"></i>
                            <p class="group-hover:font-bold  group-active:font-bold  font-medium text-[#f5fbff] font-sans text-md transition duration-200">
                            Áreas de Esp.
                        </p>
                    </router-link>

                    <!-- <a href="/register" class="flex flex-row items-center gap-4 px-5 py-4 bg-white hover:bg-gray-100 active:bg-gray-200 rounded-lg transition duration-200 group">
                        <i class="bi bi-person-fill-add group-hover:text-black group-acitve:text-black text-lg text-gray-400 transition duration-200"></i>
                        <p class="group-hover:font-bold group-hover:text-black group-active:font-bold group-active:text-black font-medium text-gray-500 font-sans text-md transition duration-200">
                            Nuevo usuario
                        </p>
                    </a> -->
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
