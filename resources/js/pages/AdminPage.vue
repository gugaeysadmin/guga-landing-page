
<template>
    <MainStatistics/>
    <div class="flex flex-col gap-4 mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
        <h1 class="text-2xl font-semibold text-[#4180ab]">PRODUCTOS</h1>
        <div class="w-full">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-full">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categorías</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr >
                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                            No se encontraron productos
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex flex-col gap-4 mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
        <h1 class="text-2xl font-semibold text-[#4180ab]">PROMOCIONES</h1>
        <div class="w-full">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Promocionar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr >
                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                            No se encontraron productos
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
</template>
