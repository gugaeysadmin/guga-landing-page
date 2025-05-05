<template>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-full">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categorías</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Áreas de especialidad</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr 
                    v-for="(product, index) in paginatedProducts" 
                    :key="product.id"
                >
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ (currentPage - 1) * itemsPerPage + index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button
                            @click="sendToUpdateProduct(product.id)"
                            class="text-indigo-600 hover:text-indigo-900 mr-3"
                        >
                            Editar
                        </button>
                        <button
                            @click="emit('delete', product.id)"
                            class="text-red-600 hover:text-red-900"
                        >
                            Eliminar
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select
                            :value="product.active == 1? true: false"
                            @change="emit('status-change', { id: product.id, active: $event.target.value === 'true' })"
                            class="block min-w-20 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                        >
                            <option :value="true">Activo</option>
                            <option :value="false">Inactivo</option>
                        </select>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ product.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ truncateDescription(product?.brand?.name || "") }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ formatCategories(product.category) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ formatSpecAreas(product.product_spec_areas) }}</div>
                    </td>
                </tr>
                <tr v-if="paginatedProducts.length === 0">
                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                        No se encontraron productos
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- Paginación -->
        <div class="flex justify-center items-center gap-4 mt-5 pb-4">
            <button 
                @click="currentPage--" 
                :disabled="currentPage === 1"
                class="px-3 py-1 border border-gray-300 bg-white rounded disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Anterior
            </button>
            <span class="text-gray-700">Página {{ currentPage }} de {{ totalPages }}</span>
            <button 
                @click="currentPage++" 
                :disabled="currentPage === totalPages"
                class="px-3 py-1 border border-gray-300 bg-white rounded disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Siguiente
            </button>
        </div>
    </div>
</template>

<script setup>
    import { ref, computed } from 'vue';
    import { useRouter } from 'vue-router';

    const props = defineProps({
        products: {
            type: Array,
            required: true,
            default: () => []
        }
    });
    const router = useRouter();
        
    const emit = defineEmits(['search', 'status-change', 'edit', 'delete', 'reorder']);

    // Variables para paginación
    const currentPage = ref(1);
    const itemsPerPage = ref(5); // Puedes ajustar este valor

    // Computed properties para paginación
    const totalPages = computed(() => {
        return Math.ceil(props.products.length / itemsPerPage.value);
    });

    const paginatedProducts = computed(() => {
        const start = (currentPage.value - 1) * itemsPerPage.value;
        const end = start + itemsPerPage.value;
        return props.products.slice(start, end);
    });

    // Variables para drag and drop (mantenidas de tu código original)
    const draggedItemIndex = ref(null);
    const dragOverIndex = ref(null);
    const isDragging = ref(false);
    const searchQuery = ref('');
    
    const sendToUpdateProduct = (id, specarea) => {
        router.push(`/app/admin/product/update?id=${id}`)
    }

    const formatCategories = (categories)=>{
        if(categories && categories.length > 0){
            const formated = categories.map((data, index)=>data.name);
            return truncateDescription(formated.join(", "))
            
        }else{
            return ""
        }
    }
    const formatSpecAreas = (specareas)=>{
        if(specareas && specareas.length > 0){
            const formated = specareas.map((data, index)=>data.spec_area.name);
            return truncateDescription(formated.join(", "))
            
        }else{
            return ""
        }
    }
    const truncateDescription = (text) => {
        if (!text) return '';
        return text.length > 50 ? text.substring(0, 50) + '...' : text;
    };
</script>

<script>
    export default {
        name: "BrandTable"
    }
</script>