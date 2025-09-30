<template>
    <Title content="PROMOCIONES"  />
    <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
        <i class="bi bi-arrow-left-circle-fill text-xl text-[#3e8ad5]"></i>
        <p class="underline font-medium text-lg text-[#3e8ad5] pb-[1px]">Regresar</p>
    </button>
    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-md ">
        <!-- <div>
            <input v-model="searchTerm" id="search" placeholder="Buscar" class="px-6 py-2 text-xl text-slate-700 bg-slate-50 border-slate-400 rounded-full"/>
        </div> -->
        <!-- <div class="relative">
            <i class="bi bi-search absolute left-3 top-3 text-slate-500"></i>
            <input 
                v-model="searchTerm" 
                id="search" 
                placeholder="Buscar" 
                class="pl-10 pr-6 py-2 text-xl text-slate-700 bg-slate-50 border-slate-400 rounded-full w-full"
            />
        </div> -->

        <div>
          <button @click="showModal = true" class="px-3 py-2 flex flex-row gap-2 hover:bg-slate-100 rounded-lg active:bg-slate-200 transition-all duration-100">
            <i class="bi bi-plus-square-fill text-[#0392ce] text-2xl"></i>
            <P class="text-lg text-[#0392ce] font-medium pt-[1px] align-middle">Agregar</P>
          </button>
        </div>
        <div class="pr-4">
          <div class="flex items-center">
              <!-- <img 
                :src="`/storage/${offert.img_url}`" 
                class="h-10 w-15 rounded-xl object-cover"
                :alt="`Imagen de ${offert.name}`"
              > -->
            <label class=" cursor-pointer">
              <div class="relative">
                <input 
                  type="checkbox" 
                  class="sr-only" 
                  v-model="activePromotion"
                  @change="tooglePromotions"
                >
                <div class="block bg-gray-300 w-10 h-6 rounded-full"></div>
                <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
              </div>
            </label>
            <div class="ml-3 text-sm font-medium">Promocion activa</div>
          </div>
        </div>

    </div>


    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-md ">
      <OffertTable
        :offerts="filteredOfferts"
        @search="handleSearch"
        @status-change="updateOffertStatus"
        @edit="handleEdit"
        @delete="confirmDelete"
        @promote= "confirmPromote"
        @reorder="handleReorder"
      />
        
    </div>

    <!-- <Modal :visible="showModal" title="Mi Modal Personalizado" @close="showModal = false">
        <PromotionForm
          :onSubmit="handleSubmit"
          :onCancel="handleCancel"
          submitText="Enviar"
        />
    </Modal> -->

    <!-- <Modal :visible="showModal" @close="showModal = false">
      <PromotionForm
        :onSubmit="currentOffert ? updateOffert : createOffert"
        :initialData="currentOffert || emptyOffert"
        :onCancel="() => { showModal = false; currentOffert = null; }"
        :submitText="currentOffert ? 'Actualizar' : 'Crear'"
      />
    </Modal> -->

    <Modal :visible="showModal" @close="showModal = false" title="Nueva oferta">
      <PromotionForm
        :onSubmit="createOffert"
        :initialData="emptyOffert"
        :onCancel="() => { showModal = false; currentOffert = null; }"
        :submitText="Crear"
        :loading="loading"
      />
    </Modal>

    <Modal :visible="showDeleteModal" @close="showDeleteModal = false" title="" disableHeader>
      <div>
        <h2 class="text-lg font-medium mb-4 text-center">¿Estás seguro de eliminar esta oferta?</h2>
        <div class="flex justify-center space-x-8">
          <button
            @click="showDeleteModal = false"
            :disabled="loading"
            class="px-4 py-2 border-2 rounded-md w-32"
          >
            Cancelar
          </button>
          <button
            @click="deleteOffert"
            :disabled="loading"
            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 disabled:bg-red-400 w-32"
          >
            {{ loading? "...Eliminando" :"Eliminar" }}
          </button>
        </div>
      </div>
    </Modal>

    <Modal :visible="showPromoteModal" @close="showPromoteModal = false" title="">
      <div>
        <h2 class="text-lg font-medium mb-4 text-center">¿Estás seguro de promover esta oferta?</h2>
        <div class="flex justify-center space-x-8">
          <button
            @click="showPromoteModal = false"
            :disabled="loading"
            class="px-4 py-2 border-2 rounded-md w-32"
          >
            Cancelar
          </button>
          <button
            @click="promote"
            :disabled="loading"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 disabled:bg-indigo-500 w-32"
          >
            {{ loading? "Promoviendo" :"Promover" }}
          </button>
        </div>
      </div>
    </Modal>
</template>

<!-- <script setup>
  import { FwbAlert } from 'flowbite-vue'
  import { ref, emit } from 'vue';
  const showModal = ref(false);

  // Para nuevo formulario
  const handleSubmit = async (formData) => {
    console.log(formData)
    try {
      const form = new FormData();
      form.append('title', formData.title);
      form.append('details', formData.details);
      form.append('image', formData.image);
      form.append('active', true);

      const response = await fetch('/api/offerts/create', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: form
      });

      if (!response.ok) throw new Error('Error al guardar');

      const data = await response.json();
      console.log('Oferta guardada:', data);
      showModal.value = false;
      
    } catch (error) {
      console.error('Error:', error);
      // Mostrar error al usuario
      errors.value.submit = 'Error al guardar la oferta';
    }
  };
  // Para edición
  const editData = ref({
    title: '',
    details: '',
    image: '', // URL de la imagen existente
  });

const handleCancel = () => {
  console.log('Formulario cancelado');
  showModal.value = false
};

</script> -->


<script setup>
  import { ref, computed, onMounted } from 'vue';
  import { useRouter } from 'vue-router';

  const router = useRouter();
  const showModal = ref(false);
  const showDeleteModal = ref(false);
  const showPromoteModal = ref(false);
  const activePromotion = ref(false)
  const currentOffert = ref(null);
  const offerts = ref([]);
  const searchTerm = ref('');
  const deleteId = ref(null);
  const promoteUrl = ref(null);
  const loading = ref(false);
  const specOferId= ref(null);
  const formData = ref({
  })
  const specOfert= ref({
    img_url: null,
    name: "",
  })

  const emptyOffert = {
    title: '',
    details: '',
    image: null,
    active: true
  };

  const  goBack = () => {
    router.back()
  }


  onMounted(async () => {
    await fetchOfferts();
    await fetchConfigData();
  });

  const filteredOfferts = computed(() => {
    if (!searchTerm.value) return offerts.value;
    const term = searchTerm.value.toLowerCase();
    return offerts.value.filter(offert => 
      offert.name.toLowerCase().includes(term) || 
      (offert.description && offert.description.toLowerCase().includes(term))
    )
  });

  const fetchConfigData = async () => {
    try {
      const response = await fetch('/api/lp-config');
      const data = await response.json();
      if (data.success) {
        activePromotion.value = data.data.active_special_ofert == 1;
      }
    } catch (error) {
      console.error('Error fetching offerts:', error);
    }
  };

  const fetchOfferts = async () => {
    try {
      const response = await fetch('/api/offerts');
      const data = await response.json();
      if (data.success) {
        offerts.value = data.data;
      }
    } catch (error) {
      console.error('Error fetching offerts:', error);
    }
  };

  const handleSearch = (term) => {
    searchTerm.value = term;
  };

  const updateOffertStatus = async ({ id, active }) => {
    try {
      const response = await fetch(`/api/offerts/${id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ active })
      });
      
      if (response.ok) {
        await fetchOfferts(); // Refrescar la lista
      }
    } catch (error) {
      console.error('Error updating offert status:', error);
    }
  };

  const handleEdit = (offert) => {
    currentOffert.value = {
      ...offert,
      title: offert.name,
      details: offert.description
    };
    showModal.value = true;
  };

  const confirmDelete = (id) => {
    deleteId.value = id;
    showDeleteModal.value = true;
  };

  const confirmPromote = (url) => {
    promoteUrl.value = url
    showPromoteModal.value = true
  }

  const tooglePromotions = async () =>  {
    loading.value = true;
    try {
      const form = new FormData();
      form.append('special_ofert_active', activePromotion.value);
      const response = await fetch(`/api/lp-config/update`, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: form
      });
      
      if (response.ok) {
        console.log(response)
      }
    } catch (error) {
      console.error('Error updating offert:', error);
      loading.value = false;
    }
    loading.value = false;
  }
  const promote = async () => {
    loading.value = true;
    try {
      const form = new FormData();
      form.append('special_ofert', promoteUrl.value);
      form.append('special_ofert_active', true);


      const response = await fetch(`/api/lp-config/update`, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: form
      });
      
      if (response.ok) {
        showPromoteModal.value = false;
        promoteUrl.value = null;
        // showModal.value = false;
        // currentOffert.value = null;
      }
    } catch (error) {
      console.error('Error updating offert:', error);
      loading.value = false;
    }
    loading.value = false;
  }

  const deleteOffert = async () => {
    loading.value=true

    try {
      const response = await fetch(`/api/offerts/${deleteId.value}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });
      
      if (response.ok) {
        await fetchOfferts(); // Refrescar la lista
        showDeleteModal.value = false;
      }
    } catch (error) {
      console.error('Error deleting offert:', error);
    }
    loading.value=false

  };

  const createOffert = async (formData) => {
    loading.value=true
    try {
      const form = new FormData();
      form.append('title', formData.title);
      form.append('details', formData.details);
      form.append('image', formData.image);
      form.append('active', true);

      const response = await fetch('/api/offerts/create', {
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
      await fetchOfferts();
      
    } catch (error) {
      loading.value=false
      console.error('Error:', error);
      // Mostrar error al usuario

    }
    loading.value=false

  };

  const updateOffert = async (formData) => {
    try {
      const response = await fetch(`/api/offerts/${currentOffert.value.id}`, {
        method: 'PUT',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
      });
      
      if (response.ok) {
        await fetchOfferts();
        showModal.value = false;
        currentOffert.value = null;
      }
    } catch (error) {
      console.error('Error updating offert:', error);
    }
  };

  const handleReorder = (newOrder) => {
      updateBackendOrder(newOrder);
      offerts.value = newOrder;
  };

  const updateBackendOrder = async (orderedOfferts) => {

    try {
      const response = await fetch(`/api/offerts/reorder-table`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify( {updates: orderedOfferts} )
      });

    } catch (error) {
      console.error('Error updating offert status:', error);
    }
  };
</script>


<style scoped>
  @import "quill/dist/quill.snow.css";

  input[type="checkbox"]:checked ~ .dot {
    transform: translateX(100%);
    background-color: #3B82F6;
  }
  input[type="checkbox"]:checked ~ .block {
    background-color: #93C5FD;
  }
</style>
