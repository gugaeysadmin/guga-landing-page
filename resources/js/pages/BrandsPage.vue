<template>
    <Title content="MARCAS"  />
    <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
        <i class="bi bi-arrow-left-circle-fill text-xl text-[#3e8ad5]"></i>
        <p class="underline font-medium text-lg text-[#3e8ad5] pb-[1px]">Regresar</p>
    </button>

    <div class="flex flex-row justify-between md:min-w-[54rem]  items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-md ">
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
    

    <div class="flex flex-row justify-between md:min-w-[54rem]  items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-md ">
      <BrandTable
        :brands="filteredOfferts"
        @search="handleSearch"
        @edit="handleEdit"
        @delete="confirmDelete"
      />
        
    </div>


    <Modal :visible="showModal" @close="showModal = false" title="Nueva marca">
      <BrandForm
        :onSubmit="createBrand"
        :initialData="emptyOffert"
        :onCancel="() => { showModal = false; currentOffert = null; }"
        :submitText="Crear"
        :loading="loading"
      />
    </Modal>

    <Modal :visible="showDeleteModal" @close="showDeleteModal = false" title="" disableHeader>
      <div>
        <h2 class="text-lg font-medium mb-4 text-center">¿Estás seguro de eliminar esta marca?</h2>
        <div class="flex justify-center space-x-8">
          <button
            @click="showDeleteModal = false"
            :disabled="loading"
            class="px-4 py-2 border-2 rounded-md w-32"
          >
            Cancelar
          </button>
          <button
            @click="deleteBrand"
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
    const currentOffert = ref(null);
    const brands = ref([]);
    const searchTerm = ref('');
    const deleteId = ref(null);
    const loading = ref(false);


    const router = useRouter();

    const emptyOffert = {
      title: '',
      details: '',
      image: null,
    };


    onMounted(async () => {
      await fetchBrand();
    });

    const filteredOfferts = computed(() => {
      if (!searchTerm.value) return brands.value;
      const term = searchTerm.value.toLowerCase();
      return brands.value.filter(brand => 
        brand.name.toLowerCase().includes(term) || 
        (brand.description && brand.description.toLowerCase().includes(term))
      )
    });

    const  goBack = () => {
        router.back()
    }

    const fetchBrand = async () => {
      try {
        const response = await fetch('/api/brand');
        const data = await response.json();
        if (data.success) {
          brands.value = data.data;
        }
      } catch (error) {
        console.error('Error fetching brands:', error);
      }
    };

    const handleSearch = (term) => {
      searchTerm.value = term;
    };

    const handleEdit = (brand) => {
      currentOffert.value = {
        ...brand,
        title: brand.name,
        details: brand.description
      };
      showModal.value = true;
    };

    const confirmDelete = (id) => {
      deleteId.value = id;
      showDeleteModal.value = true;
    };

    const deleteBrand = async () => {
      loading.value=true

      try {
        const response = await fetch(`/api/brand/${deleteId.value}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        });
        
        if (response.ok) {
          await fetchBrand(); // Refrescar la lista
          showDeleteModal.value = false;
        }
      } catch (error) {
        console.error('Error deleting brand:', error);
      }
      loading.value=false

    };

    const createBrand = async (formData) => {
      loading.value=true
      try {
        const form = new FormData();
        // form.append('title', formData.title);
        // form.append('details', formData.details);
        // form.append('image', formData.image);
        form.append('name', formData.title);
        const response = await fetch('/api/brand/create-on', {
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
        await fetchBrand();
        
      } catch (error) {
        console.error('Error:', error);
        // Mostrar error al usuario
        loading.value=false
        // errors.value.submit = 'Error al guardar la marca';
      }
      loading.value=false

    };

    const updateBrand = async (formData) => {
      try {
        const response = await fetch(`/api/brand/${currentOffert.value.id}`, {
          method: 'PUT',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: formData
        });
        
        if (response.ok) {
          await fetchBrand();
          showModal.value = false;
          currentOffert.value = null;
        }
      } catch (error) {
        console.error('Error updating marca:', error);
      }
    };

    const updateBackendOrder = async (orderedOfferts) => {

      try {
        const response = await fetch(`/api/brand/reorder-table`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify( {updates: orderedOfferts} )
        });

      } catch (error) {
        console.error('Error updating brand status:', error);
      }
    };
</script>