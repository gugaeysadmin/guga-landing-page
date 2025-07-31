<template>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <!-- Buscador -->
      <!-- <div class="p-4 border-b">
        <input
          v-model="searchQuery"
          @input="emit('search', searchQuery)"
          type="text"
          placeholder="Buscar ofertas..."
          class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
      </div> -->

      <!-- Tabla -->
      <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nómbre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icono</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categorias</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Productos</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>

                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- <tr 
                    v-for="specArea in specAreas" 
                    :key="specArea.id" 
                    class="hover:bg-gray-50"
                > -->
                <tr 
                    v-for="(specArea, index) in specAreas" 
                    :key="specArea.id"
                    draggable="true"
                    @dragstart="handleDragStart($event, index)"
                    @dragover.prevent="handleDragOver($event, index)"
                    @dragenter.prevent="handleDragEnter($event, index)"
                    @dragleave="handleDragLeave($event)"
                    @drop="handleDrop($event, index)"
                    @dragend="handleDragEnd"
                    :class="{
                        'bg-blue-50': dragOverIndex === index,
                        'cursor-move': !isDragging,
                        'opacity-50': isDragging && draggedItemIndex === index
                    }"
                >
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ specArea.index }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ specArea.name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500  max-w-xs truncate" :title="specArea.description">
                            {{ truncateDescription(specArea.description) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                    <a 
                        v-if="specArea.icon_file_url" 
                        :href="`/storage/${specArea.icon_file_url}`" 
                        target="_blank"
                        class="inline-block"
                    >
                        <img 
                        :src="`/storage/${specArea.icon_file_url}`" 
                        class="h-10 w-15 rounded-xl object-cover"
                        :alt="`Imagen de ${specArea.name}`"
                        >
                    </a>
                    <span v-else class="text-sm text-gray-500">Sin imagen</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <!-- <button
                            @click="emit('edit', specArea)"
                            class="text-indigo-600 hover:text-indigo-900 mr-3"
                        >
                            Editar
                        </button> -->
                        <button
                            @click="sendToFilters(specArea.id, specArea.name)"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-500 disabled:bg-indigo-300 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Ver
                        </button>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm  font-medium">
                        <!-- <button
                            @click="emit('edit', specArea)"
                            class="text-indigo-600 hover:text-indigo-900 mr-3"
                        >
                            Editar
                        </button> -->
                        <button
                             @click="sendToProduct(specArea.id, specArea.name)"
                            class="inline-flex justify-center  rounded-md border border-transparent bg-cyan-600  disabled:bg-indigo-300 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Ver
                        </button>
                    </td>


                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <button
                            @click="emit('edit', specArea)"
                            class="text-indigo-600 hover:text-indigo-900 mr-5 text-lg"
                        >
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button
                            @click="emit('delete', specArea.id)"
                            class="text-red-600 hover:text-red-900 text-xl "
                        >
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>

                    
                </tr>
                <tr v-if="specAreas.length === 0">
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                        No se encontraron áreas de especialidad
                    </td>
                </tr>
            </tbody>
      </table>
    </div>
  </template>
  
<script setup>
    import { ref } from 'vue';
    import { useRouter } from 'vue-router';
    const props = defineProps({
        specAreas: {
        type: Array,
        required: true,
        default: () => []
        }
    });
    
    const emit = defineEmits(['search', 'status-change', 'edit', 'delete', 'reorder']);
    
    const router = useRouter();
    const draggedItemIndex = ref(null);
    const dragOverIndex = ref(null);
    const isDragging = ref(false);

    const searchQuery = ref('');
    const sendToFilters = (id, specarea)=> {
        router.push(`/app/admin/speciality-areas/filters?id=${id}&specarea=${specarea}`)
    }
    const sendToProduct = (id, specarea) => {
        router.push(`/app/admin/speciality-areas/products?id=${id}&specarea=${specarea}`)
    }
    
    const truncateDescription = (text) => {
        if (!text) return '';
        return text.length > 50 ? text.substring(0, 50) + '...' : text;
    };
    const handleDragStart = (event, index) => {
        draggedItemIndex.value = index;
        isDragging.value = true;
        event.dataTransfer.effectAllowed = 'move';
        event.dataTransfer.setData('text/plain', index);
    };

    const handleDragOver = (event, index) => {
        event.preventDefault();
        dragOverIndex.value = index;
    };

    const handleDragEnter = (event, index) => {
        event.preventDefault();
        dragOverIndex.value = index;
    };

    const handleDragLeave = () => {
        dragOverIndex.value = null;
    };

    const handleDrop = (event, dropIndex) => {
        event.preventDefault();
        if (draggedItemIndex.value === null || draggedItemIndex.value === dropIndex) return;
        
        const reorderedOfferts = [...props.specAreas];
        const [movedItem] = reorderedOfferts.splice(draggedItemIndex.value, 1);
        reorderedOfferts.splice(dropIndex, 0, movedItem);
        
        // Actualizar índices
        reorderedOfferts.forEach((specArea, idx) => {
            specArea.index = idx + 1;
        });
        
        emit('reorder', reorderedOfferts);
        dragOverIndex.value = null;
    };

    const handleDragEnd = () => {
        isDragging.value = false;
        draggedItemIndex.value = null;
        dragOverIndex.value = null;
    };
</script>

<script>
    export default {
        name: "SpecAreaTable"
    }
</script>