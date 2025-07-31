<!-- <template>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-full">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

                <tr 
                    v-for="(category, index) in categories" 
                    :key="category.id"
                >
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ index  + 1}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ category.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button
                            @click="emit('delete', category.id)"
                            class="text-red-600 hover:text-red-900"
                        >
                            Eliminar
                        </button>
                    </td>
                </tr>
                <tr v-if="offerts.length === 0">
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                        No se encontraron categorias
                    </td>
                </tr>
            </tbody>
            <div class="flex justify-center items-center gap-4 mt-5">
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
        </table>
    </div>
  </template>
  
<script setup>
    import { ref } from 'vue';
    
    const props = defineProps({
        categories: {
        type: Array,
        required: true,
        default: () => []
        }
    });
    
    const emit = defineEmits(['search', 'status-change', 'edit', 'delete', 'reorder']);
    
    const draggedItemIndex = ref(null);
    const dragOverIndex = ref(null);
    const isDragging = ref(false);

    const searchQuery = ref('');
    
    const truncateDescription = (text) => {
        if (!text) return '';
        return text.length > 50 ? text.substring(0, 50) + '...' : text;
    };
</script>

<script>
    export default {
        name: "CategoriesTable"
    }
</script> -->

<template>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-full">Nombre</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr 
                    v-for="(category, index) in paginatedCategories" 
                    :key="category.id"
                >
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ (currentPage - 1) * itemsPerPage + index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ category.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <button
                            @click="emit('delete', category.id)"
                            class="text-red-600 hover:text-red-900 text-center text-lg mx-auto"
                        >
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr v-if="paginatedCategories.length === 0">
                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                        No se encontraron categorías
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
    
const props = defineProps({
    categories: {
        type: Array,
        required: true,
        default: () => []
    }
});
    
const emit = defineEmits(['search', 'status-change', 'edit', 'delete', 'reorder']);

// Variables para paginación
const currentPage = ref(1);
const itemsPerPage = ref(5); // Puedes ajustar este valor

// Computed properties para paginación
const totalPages = computed(() => {
    return Math.ceil(props.categories.length / itemsPerPage.value);
});

const paginatedCategories = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return props.categories.slice(start, end);
});

// Variables para drag and drop (mantenidas de tu código original)
const draggedItemIndex = ref(null);
const dragOverIndex = ref(null);
const isDragging = ref(false);
const searchQuery = ref('');
    
const truncateDescription = (text) => {
    if (!text) return '';
    return text.length > 50 ? text.substring(0, 50) + '...' : text;
};
</script>

<script>
    export default {
        name: "CategoriesTable"
    }
</script>