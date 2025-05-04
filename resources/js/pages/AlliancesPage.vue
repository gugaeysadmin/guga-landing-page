<template>
    <Title content="ALIANZAS"  />
    <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
        <i class="bi bi-arrow-left-circle-fill text-xl text-blue-500"></i>
        <p class="underline font-medium text-lg text-blue-500 pb-1">Regresar</p>
    </button>

    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
        <!-- <div>
            <input v-model="searchTerm" id="search" placeholder="Buscar" class="px-6 py-2 text-xl text-slate-700 bg-slate-50 border-slate-400 rounded-full"/>
        </div> -->
        <div class="relative">
            <i class="bi bi-search absolute left-3 top-3 text-slate-500"></i>
            <input 
                v-model="searchTerm" 
                id="search" 
                placeholder="Buscar" 
                class="pl-10 pr-6 py-2 text-xl text-slate-700 bg-slate-50 border-slate-400 rounded-full w-full"
            />
        </div>
        <div>
            <button @click="showModal = true" class="px-3 py-2 flex flex-row gap-2 hover:bg-slate-100 rounded-lg active:bg-slate-200 transition-all duration-100">
                <i class="bi bi-plus-square-fill text-[#4180ab] text-2xl"></i>
                <P class="text-lg text-[#4180ab] align-middle">Agregar</P>
            </button>
        </div>

    </div>

    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
      <AlliancesTable
        :alliances="filteredAlliances"
        @search="handleSearch"
        @status-change="updateAllianceStatus"
        @edit="handleEdit"
        @delete="confirmDelete"
        @reorder="handleReorder"
      />
        
    </div>


    <Modal :visible="showModal" @close="showModal = false" title="Nueva alianza">
      <AllianceForm
        :onSubmit="createAlliance"
        :initialData="emptyOffert"
        :onCancel="() => { showModal = false; currentAlliance = null; }"
        :submitText="Crear"
        :loading="loading"
      />
    </Modal>

    <Modal :visible="showDeleteModal" @close="showDeleteModal = false" title="">
      <div>
        <h2 class="text-lg font-medium mb-4 text-center">¿Estás seguro de eliminar esta alianza?</h2>
        <div class="flex justify-center space-x-8">
          <button
            @click="showDeleteModal = false"
            :disabled="loading"
            class="px-4 py-2 border-2 rounded-md w-32"
          >
            Cancelar
          </button>
          <button
            @click="deleteAlliance"
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
    const showDeleteModal = ref(false);
    const currentAlliance = ref(null);
    const alliances = ref([]);
    const searchTerm = ref('');
    const deleteId = ref(null);
    const loading = ref(false);

    const emptyOffert = {
      title: '',
      details: '',
      image: null,
      active: true,
      url: '',
    };

    const router = useRouter();

    const  goBack = () => {
        router.back()
    }

    onMounted(async () => {
      await fetchAlliances();
    });

    const filteredAlliances = computed(() => {
      if (!searchTerm.value) return alliances.value;
      const term = searchTerm.value.toLowerCase();
      return alliances.value.filter(alliance => 
        alliance.name.toLowerCase().includes(term) || 
        (alliance.description && alliance.description.toLowerCase().includes(term))
      )
    });

    const fetchAlliances = async () => {
    try {
      const response = await fetch('/api/alliances');
      const data = await response.json();
      if (data.success) {
        alliances.value = data.data;
      }
    } catch (error) {
      console.error('Error fetching alliances:', error);
    }
  };

  const handleSearch = (term) => {
    searchTerm.value = term;
  };

  const updateAllianceStatus = async ({ id, active }) => {
    try {
      const response = await fetch(`/api/alliances/${id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ active })
      });
      
      if (response.ok) {
        await fetchAlliances(); // Refrescar la lista
      }
    } catch (error) {
      console.error('Error updating alliance status:', error);
    }
  };

  const handleEdit = (alliance) => {
    currentAlliance.value = {
      ...alliance,
      title: alliance.name,
      details: alliance.description
    };
    showModal.value = true;
  };

  const confirmDelete = (id) => {
    deleteId.value = id;
    showDeleteModal.value = true;
  };

  const deleteAlliance = async () => {
    loading.value=true

    try {
      const response = await fetch(`/api/alliances/${deleteId.value}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });
      
      if (response.ok) {
        await fetchAlliances(); // Refrescar la lista
        showDeleteModal.value = false;
      }
    } catch (error) {
      console.error('Error deleting alliances:', error);
    }
    loading.value=false

  };

  const createAlliance = async (formData) => {
    loading.value=true
    try {
      const form = new FormData();
      form.append('title', formData.title);
      form.append('details', formData.details);
      form.append('image', formData.image);
      form.append('active', true);
      form.append('url', formData.url)

      const response = await fetch('/api/alliances/create', {
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
      await fetchAlliances();
      
    } catch (error) {
      console.error('Error:', error);
      // Mostrar error al usuario
      errors.value.submit = 'Error al guardar la allianza';
      loading.value=false ;
    }
    loading.value=false

  };

  const updateAlliance = async (formData) => {
    const form = new FormData();
      form.append('title', formData.title);
      form.append('details', formData.details);
      form.append('image', formData.image);
      form.append('active', true);
      form.append('url', formData.url)

    try {
      const response = await fetch(`/api/alliances/${currentAlliance.value.id}`, {
        method: 'PUT',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: form
      });
      
      if (response.ok) {
        await fetchAlliances();
        showModal.value = false;
        currentAlliance.value = null;
      }
    } catch (error) {
      console.error('Error updating alliance:', error);
    }
  };

  const handleReorder = (newOrder) => {
      updateBackendOrder(newOrder);
      alliances.value = newOrder;
  };

  const updateBackendOrder = async (orderedAlliances) => {

    try {
      const response = await fetch(`/api/alliances/reorder-table`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify( {updates: orderedAlliances} )
      });

    } catch (error) {
      console.error('Error updating alliances status:', error);
    }
  };
</script>