<template>
    <div class="flex flex-col md:min-w-[54rem]  gap-4 mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
        <!-- <h1 class="text-2xl font-semibold text-[#4180ab]">TODAS LAS CATEGORÍAS</h1> -->
        <div class="flex flex-row justify-between items-center">
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
        
      </div>
      
      <div class="flex flex-row md:min-w-[54rem]  justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-md ">
        
        <CategoriesTable
          :categories="filteredOfferts"
          @search="handleSearch"
          @edit="handleEdit"
          @delete="confirmDelete"
        />
    </div>

    <Modal :visible="showModal" @close="showModal = false" title="Nueva categoría">
      <CategoryForm
        :onSubmit="createCategories"
        :initialData="emptyOffert"
        :onCancel="() => { showModal = false; currentOffert = null; }"
        :submitText="Crear"
        :loading="loading"
      />
    </Modal>

    <Modal :visible="showDeleteModal" @close="showDeleteModal = false" title="" disableHeader>
      <div>
        <h2 class="text-lg font-medium mb-4 text-center">¿Estás seguro de eliminar esta categoría?</h2>
        <div class="flex justify-center space-x-8">
          <button
            @click="showDeleteModal = false"
            :disabled="loading"
            class="px-4 py-2 border-2 rounded-md w-32"
          >
            Cancelar
          </button>
          <button
            @click="deleteCategory"
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

  const showModal = ref(false);
  const showDeleteModal = ref(false);
  const currentOffert = ref(null);
  const dataset = ref([]);
  const searchTerm = ref('');
  const deleteId = ref(null);
  const loading = ref(false);

  const emptyOffert = {
    title: '',
    details: '',
    image: null,
    active: true
  };


  onMounted(async () => {
    await fetchCategories();
  });

  const filteredOfferts = computed(() => {
    if (!searchTerm.value) return dataset.value;
    const term = searchTerm.value.toLowerCase();
    return dataset.value.filter(data => 
        data.name.toLowerCase().includes(term)
    )
  });

  const fetchCategories = async () => {
    try {
      const response = await fetch('/api/category');
      const data = await response.json();
      if (data.success) {
        dataset.value = data.data;
      }
    } catch (error) {
      console.error('Error fetching categories:', error);
    }
  };

  

  const handleSearch = (term) => {
    searchTerm.value = term;
  };


  const handleEdit = (data) => {
    currentOffert.value = {
      ...data,
      title: data.name,
    };
    showModal.value = true;
  };

  const confirmDelete = (id) => {
    deleteId.value = id;
    showDeleteModal.value = true;
  };

  const deleteCategory = async () => {
    loading.value=true

    try {
      const response = await fetch(`/api/category/${deleteId.value}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });
      
      if (response.ok) {
        await fetchCategories(); // Refrescar la lista
        showDeleteModal.value = false;
      }
    } catch (error) {
      console.error('Error deleting category:', error);
      loading.value=false

    }
    loading.value=false

  };

  const createCategories = async (formData) => {
    loading.value=true
    try {
      const form = new FormData();
      form.append('title', formData.title);

      const response = await fetch('/api/category/create', {
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
      await fetchCategories();
      
    } catch (error) {
      console.error('Error:', error);
      // Mostrar error al usuario
      errors.value.submit = 'Error al guardar la categoria';
      loading.value=false

    }
    loading.value=false

  };
</script>

<script>
    export default {
        name: "CategoriesSection"
    }
</script>