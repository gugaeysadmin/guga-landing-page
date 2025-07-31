<template>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-full">Nombre</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Pdf</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr 
                    v-for="(pdfAccesory, index) in paginatedPdfAccesories" 
                    :key="pdfAccesory.id"
                >
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ (currentPage - 1) * itemsPerPage + index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ pdfAccesory.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a 
                            v-if="pdfAccesory.pdf_url" 
                            :href="`/storage/${pdfAccesory.pdf_url}`" 
                            target="_blank"
                            class="flex justify-center"
                        >
                            <img 
                            :src="`/img/pdf.webp`" 
                            class="h-7 w-8 rounded-xl object-cover"
                            :alt="`Imagen de ${pdfAccesory.name}`"
                            >
                        </a>
                        <span v-else class="text-sm text-gray-500">Sin imagen</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center  text-sm font-medium">
                        <button
                            @click="emit('delete', pdfAccesory.id)"
                            class="text-red-600 hover:text-red-900 text-xl "
                        >
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr v-if="paginatedPdfAccesories.length === 0">
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
    pdfAccesories: {
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
    return Math.ceil(props.pdfAccesories.length / itemsPerPage.value);
});

const paginatedPdfAccesories = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return props.pdfAccesories.slice(start, end);
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
        name: "PdfAccesoryTable"
    }
</script>