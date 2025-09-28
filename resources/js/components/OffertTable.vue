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
      <table class="min-w-full divide-y divide-gray-300">
            <thead class=" bg-gradient-to-br from-[#3065b5] to-[#0392ce]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Título</th>
                    <!-- <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Descripción</th> -->
                    <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Imagen</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Estado</th>
                    <th class="px-2 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Promocionar</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Eliminar</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-300">
                <!-- <tr 
                    v-for="offert in offerts" 
                    :key="offert.id" 
                    class="hover:bg-gray-50"
                > -->
                <tr 
                    v-for="(offert, index) in offerts" 
                    :key="offert.id"
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
                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
                    {{ offert.index }}
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ offert.name }}</div>
                    </td>
                    <!-- <td class="px-6 py-2">
                        <div class="text-sm text-gray-500  max-w-xs truncate" :title="offert.description">
                            {{ truncateDescription(offert.description) }}
                        </div>
                    </td> -->
                    <td class="px-6 py-2 whitespace-nowrap ">
                        <a 
                            v-if="offert.img_url" 
                            :href="`/storage/${offert.img_url}`" 
                            target="_blank"
                            class="inline-block mx-auto"
                        >
                            <img 
                            :src="`/storage/${offert.img_url}`" 
                            class="h-10 w-15 rounded-xl object-cover mx-auto"
                            :alt="`Imagen de ${offert.name}`"
                            >
                        </a>
                        <span v-else class="text-sm text-gray-500">Sin imagen</span>
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap">
                        <select
                            :value="offert.active == 1? true: false"
                            @change="emit('status-change', { id: offert.id, active: $event.target.value === 'true' })"
                            class="block min-w-20 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md mx-auto"
                        >
                            <option :value="true">Activo</option>
                            <option :value="false">Inactivo</option>
                        </select>
                    </td>
                    <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">
                        <!-- <button
                            @click="emit('edit', offert)"
                            class="text-indigo-600 hover:text-indigo-900 mr-3"
                        >
                            Editar
                        </button> -->
                        <button
                            @click="emit('promote', offert.img_url)"
                            class="mx-auto inline-flex justify-center rounded-md border border-transparent bg-indigo-600 disabled:bg-indigo-300 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Promover
                        </button>
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap text-center text-sm font-medium">
                        <!-- <button
                            @click="emit('edit', offert)"
                            class="text-indigo-600 hover:text-indigo-900 mr-3"
                        >
                            Editar
                        </button> -->
                        <button
                            @click="emit('delete', offert.id)"
                            class="text-red-600 hover:text-red-900 mx-auto text-lg"
                        >
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr v-if="offerts.length === 0">
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                        No se encontraron ofertas
                    </td>
                </tr>
            </tbody>
      </table>
    </div>
  </template>
  
<script setup>
    import { ref } from 'vue';
    
    const props = defineProps({
        offerts: {
        type: Array,
        required: true,
        default: () => []
        }
    });
    
    const emit = defineEmits(['search', 'status-change', 'edit', 'delete', 'reorder', 'promote']);
    
    const draggedItemIndex = ref(null);
    const dragOverIndex = ref(null);
    const isDragging = ref(false);

    const searchQuery = ref('');
    
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
        
        const reorderedOfferts = [...props.offerts];
        const [movedItem] = reorderedOfferts.splice(draggedItemIndex.value, 1);
        reorderedOfferts.splice(dropIndex, 0, movedItem);
        
        // Actualizar índices
        reorderedOfferts.forEach((offert, idx) => {
            offert.index = idx + 1;
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
        name: "OffertTable"
    }
</script>