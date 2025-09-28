<template>
    <Title content="AREAS DE ESPECIALIDAD"  />
    <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
        <i class="bi bi-arrow-left-circle-fill text-xl text-[#3e8ad5]"></i>
        <p class="underline font-medium text-lg text-[#3e8ad5] pb-[1px]">Regresar</p>
    </button>
    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
        <!-- <div>
            <input v-model="searchTerm" id="search" placeholder="Buscar" class="px-6 py-2 text-xl text-slate-700 bg-slate-50 border-slate-400 rounded-full"/>
        </div> -->
        <div>
          <button @click="showModal = true" class="px-3 py-2 flex flex-row gap-2 hover:bg-slate-100 rounded-lg active:bg-slate-200 transition-all duration-100">
            <i class="bi bi-plus-square-fill text-[#0392ce] text-2xl"></i>
            <P class="text-lg text-[#0392ce] font-medium pt-[1px] align-middle">Agregar</P>
          </button>
        </div>
        <div class="relative">
            <i class="bi bi-search absolute left-3 top-3 text-slate-500"></i>
            <input 
                v-model="searchTerm" 
                id="search" 
                placeholder="Buscar" 
                class="pl-10 pr-6 py-2 text-xl text-slate-700 bg-slate-50 border-slate-400 rounded-full w-full"
            />
        </div>

    </div>


    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
      <SpecAreaTable
        :specAreas="filteredSpecAreas"
        @search="handleSearch"
        @edit="handleEdit"
        @delete="confirmDelete"
        @reorder="handleReorder"
      />
        
    </div>

    <Modal :visible="showModal" @close="showModal = false" title="Nueva área de especialidad">
      <SpecAreaForm
        :onSubmit="createSpecArea"
        :initialData="emptySpecArea"
        :onCancel="() => { showModal = false; currentSpecArea = null; }"
        :submitText="Crear"
        :loading="loading"
        :editing="false"
      />
    </Modal>

    <Modal :visible="showModalEdit" @close="showModalEdit = false" title="Editar área de especialidad">
      <SpecAreaForm
        :onSubmit="updateSpecArea"
        :initialData="currentSpecArea"
        :onCancel="() => { showModal = false; currentSpecArea = null; }"
        :submitText="Editar"
        :loading="loading"
        :editing="true"
      />
    </Modal>

    <Modal :visible="showDeleteModal" @close="showDeleteModal = false" title="">
      <div>
        <h2 class="text-lg font-medium mb-4 text-center">¿Estás seguro de eliminar esta área de especialidad?</h2>
        <div class="flex justify-center space-x-8">
          <button
            @click="showDeleteModal = false"
            :disabled="loading"
            class="px-4 py-2 border-2 rounded-md w-32"
          >
            Cancelar
          </button>
          <button
            @click="deleteSpecArea"
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
  import { useRouter } from 'vue-router';

  const showModal = ref(false);
  const showModalEdit = ref(false);

  const showDeleteModal = ref(false);
  const currentSpecArea = ref(null);
  const specAreas = ref([]);
  const searchTerm = ref('');
  const deleteId = ref(null);
  const loading = ref(false);
  
  const router = useRouter();

  const  goBack = () => {
    router.back()
  }


  const emptySpecArea = {
    title: '',
    details: '',
    image: null,
  };


  onMounted(async () => {
    await fetchSpecAreas();
  });

  const filteredSpecAreas = computed(() => {
    if (!searchTerm.value) return specAreas.value;
    const term = searchTerm.value.toLowerCase();
    return specAreas.value.filter(specArea => 
      specArea.name.toLowerCase().includes(term) || 
      (specArea.description && specArea.description.toLowerCase().includes(term))
    )
  });

  const fetchSpecAreas = async () => {
    try {
      const response = await fetch('/api/speciality-areas');
      const data = await response.json();
      if (data.success) {
        specAreas.value = data.data;
      }
    } catch (error) {
      console.error('Error fetching speciality-areas:', error);
    }
  };

  const handleSearch = (term) => {
    searchTerm.value = term;
  };



  const handleEdit = (specArea) => {
    currentSpecArea.value = {
      ...specArea,
      title: specArea.name,
      details: specArea.description,
      image: specArea.icon_file_url,
      video: specArea.video_url,
    };
    showModalEdit.value = true;
  };

  const confirmDelete = (id) => {
    deleteId.value = id;
    showDeleteModal.value = true;
  };

  const deleteSpecArea = async () => {
    loading.value=true

    try {
      const response = await fetch(`/api/speciality-areas/${deleteId.value}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });
      
      if (response.ok) {
        await fetchSpecAreas(); // Refrescar la lista
        showDeleteModal.value = false;
      }
    } catch (error) {
      console.error('Error deleting spec area:', error);
      loading.value=false
    }
    loading.value=false

  };

  const createSpecArea = async (formData) => {
    loading.value=true
    try {
      const form = new FormData();
      form.append('title', formData.title);
      form.append('details', formData.details);
      form.append('image', formData.image);
      form.append('video', formData.video);

      const response = await fetch('/api/speciality-areas/create', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: form
      });

      if (!response.ok) throw new Error('Error al guardar');

      const data = await response.json();
      showModal.value = false;
      await fetchSpecAreas();
      
    } catch (error) {
      loading.value=false

      console.error('Error:', error);
      // Mostrar error al usuario
      loading.value=false

    }
    loading.value=false

  };

  const updateSpecArea = async (formData) => {
    loading.value=true

    console.log(currentSpecArea.value)
    console.log(formData)
    try {
      const form = new FormData();
      form.append('title', formData.title);
      form.append('details', formData.details);
      form.append('image', formData.image);
      form.append('video', formData.video);
      const response = await fetch(`/api/speciality-areas/update/${currentSpecArea.value.id}`, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: form
      });
      
      if (response.ok) {
        await fetchSpecAreas();
        showModalEdit.value = false;
        currentSpecArea.value = null;
      }
    } catch (error) {
      loading.value=false

      console.error('Error updating speciality areas:', error);
    }
    loading.value=false

  };

  const handleReorder = (newOrder) => {
      updateBackendOrder(newOrder);
      specAreas.value = newOrder;
  };

  const updateBackendOrder = async (orderedOfferts) => {

    try {
      const response = await fetch(`/api/speciality-areas/reorder-table`, {
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