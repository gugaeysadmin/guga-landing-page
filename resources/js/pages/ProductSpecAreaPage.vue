<template>
    <Title :content="`PRODUCTOS DE ${specarea}`"  />
    <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
        <i class="bi bi-arrow-left-circle-fill text-xl text-blue-500"></i>
        <p class="underline font-medium text-lg text-blue-500 pb-1">Regresar</p>
    </button>
    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
      <SpecProductTable
        :specAreas="dataProdSpecAreas"
        @search="handleSearch"
        @edit="handleEdit"
        @delete="confirmDelete"
        @reorder="handleReorder"
      />
        
    </div>

    <Modal :visible="showDeleteModal" @close="showDeleteModal = false" title="">
        <div>
            <h2 class="text-lg font-medium mb-4 text-center">¿Estás seguro de eliminar este producto de {{ specarea }}?</h2>
            <div class="flex justify-center space-x-8">
            <button
                @click="showDeleteModal = false"
                :disabled="loading"
                class="px-4 py-2 border-2 rounded-md w-32"
            >
                Cancelar
            </button>
            <button
                @click="deleteRelation"
                :disabled="loading"
                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 disabled:bg-red-400 w-32"
            >
                {{ loading? "...Eliminando" :"Eliminar" }}
            </button>
            </div>
        </div>
    </Modal>

</template>


<script setup>
    import { ref, computed, onMounted } from 'vue';
    import { useRouter, useRoute } from 'vue-router';


    const specarea = ref("");
    const specarea_id = ref(null);
    const showDeleteModal = ref(false);
    const dataProdSpecAreas = ref([]);
    const deleteId = ref(null);
    const router = useRouter();
    const route = useRoute();
    const loading = ref(false);


    const emptyOffert = {
        title: '',
    };

    onMounted(async () => {
        specarea_id.value=route.query.id;
        specarea.value=route.query.specarea.toUpperCase();
        fechProductSpecAreas();

    });

    const goBack =() =>{
        router.back();
    }

    const handleSearch = (term) => {
        searchTerm.value = term;
    };

    const fechProductSpecAreas = async () => {
        try {
            const response = await fetch('/api/product-specarea');
            const data = await response.json();
        if (data.success) {
            const filtered = data.data.filter((element)=>element.spec_area_id ==specarea_id.value );
            console.log(filtered);
            dataProdSpecAreas.value = filtered;
        }
        } catch (error) {
            console.error('Error fetching categories:', error);
        }
    };



    const handleEdit = (specArea) => {

    };

    const deleteRelation = async () => {
        loading.value=true
        try {
            const response = await fetch(`/api/product-specarea/${deleteId.value}`, {
                method: 'DELETE',
                headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
        
        if (response.ok) {
            await fechProductSpecAreas();
            showDeleteModal.value = false;
        }
        } catch (error) {
            console.error('Error deleting spec area:', error);
            loading.value=false

        }
            loading.value=false
    }

    const confirmDelete = (id) => {
        deleteId.value = id;
        showDeleteModal.value = true;
    };

    const handleReorder = (newProdSpecArea) => {
        updateBackendOrder(newProdSpecArea);
        dataProdSpecAreas.value = newProdSpecArea;
    };

    const updateBackendOrder = async (orderedOfferts) => {
        try {
        const response = await fetch(`/api/product-specarea/reorder-table`, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify( {updates: orderedOfferts} )
        });

        } catch (error) {
        console.error('Error updating speciality areas:', error);
        }
    };


</script>