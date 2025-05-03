<template>
    <div class="flex flex-col gap-4 mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
        <h1 class="text-2xl font-semibold text-[#4180ab]">CATEGORÍAS EN CATÁLOGOS</h1>
        <div class="flex flex-col gap-4">
            <div  class="flex justify-end">
              <button @click="showModal = true" class="px-3 py-2 flex flex-row gap-2 hover:bg-slate-100 rounded-lg active:bg-slate-200 transition-all duration-100">
                  <i class="bi bi-plus-square-fill text-[#4180ab] text-2xl"></i>
                  <P class="text-lg text-[#4180ab] align-middle">Agregar</P>
              </button>
            </div>

            <div
              v-for="(section, index) in dataset"
              :key="section.id"
            >
              <div class="flex flex-row items-center gap-2 px-4">
                <p class="text-lg text-[#4180ab] font-semibold">{{ section.section_name }}</p>
                <button @click="()=> confirmDelete(section.id)"  class="flex items-center justify-center text-sm rounded-full group  active:bg-slate-100">
                  <i class="bi bi-trash-fill text-red-700 group-hover:text-red-600 group-active:text-red-900"></i>
                </button>
              </div>
              <button class="flex flex-row items-center gap-1 mt-2 pl-8">
                <i class="bi bi-plus-circle-fill text-[#4180ab] text-lg"></i>
                <P class="text-sm text-[#4180ab] align-middle">Agregar</P>
              </button>
              <!-- Campo Marca con Modal -->
              <!-- <div class="flex flex-row gap-2">
                <select
                  class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                >
                  <option value="" disabled selected>Selecciona una marca</option>
                  <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                  </option>
                </select>
                <button
                  type="button"
                  @click="showMarcaModal = true"
                  class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
                >
                  + Nueva
                </button>
              </div> -->
            </div>
        </div>
    </div>


    <Modal :visible="showCategoryModal" @close="showCategoryModal = false" title="Nueva categoría">
      <CategoryForm
        :onSubmit="createCategories"
        :initialData="emptyOffert"
        :onCancel="() => { showCategoryModal = false; currentOffert = null; }"
        :submitText="Crear"
        :loading="loading"
      />
    </Modal>

    <Modal :visible="showModal" @close="showModal = false" title="Nueva sección">
      <CatalogSectionForm
        :onSubmit="createCatalogSection"
        :initialData="emptyOffert"
        :onCancel="() => { showModal = false; currentOffert = null; }"
        :submitText="Crear"
        :loading="loading"
      />
    </Modal>

    <Modal :visible="showDeleteModal" @close="showDeleteModal = false" title="">
      <div>
        <h2 class="text-lg font-medium mb-4 text-center">¿Estás seguro de eliminar esta sección?</h2>
        <div class="flex justify-center space-x-8">
          <button
            @click="showDeleteModal = false"
            :disabled="loading"
            class="px-4 py-2 border-2 rounded-md w-32"
          >
            Cancelar
          </button>
          <button
            @click="deleteCatalogSection"
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
  const showCategoryModal = ref(false);
  const showDeleteModal = ref(false);
  const currentOffert = ref(null);
  const dataset = ref([]);
  const searchTerm = ref('');
  const deleteId = ref(null);
  const loading = ref(false);
  const caategorySelected = ref(null);

  const categories = ref('');

  const emptyOffert = {
    title: '',
  };


  onMounted(async () => {
    fetchCategories();
    await fetchData();
  });

  const filteredOfferts = computed(() => {
    if (!searchTerm.value) return dataset.value;
    const term = searchTerm.value.toLowerCase();
    return dataset.value.filter(data => 
        data.section_name.toLowerCase().includes(term)
    )
  });

  const fetchData = async () => {
    // try {
    //   const response = await fetch('/api/catalog-section');
    //   const data = await response.json();
    //   if (data.success) {
    //     dataset.value = data.data;
    //   }
    // } catch (error) {
    //   console.error('Error fetching categories:', error);
    // }
  };

  const fetchCategories = async () => {
    try {
      const response = await fetch('/api/category');
      const data = await response.json();
      if (data.success) {
        categories.value = data.data;
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
      title: data.section_name,
    };
    showModal.value = true;
  };

  const confirmDelete = (id) => {
    deleteId.value = id;
    showDeleteModal.value = true;
  };


  const deleteCatalogSection = async () => {
    loading.value=true

    try {
      const response = await fetch(`/api/catalog-section/${deleteId.value}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });
      
      if (response.ok) {
        await fetchData(); // Refrescar la lista
        showDeleteModal.value = false;
      }
    } catch (error) {
      console.error('Error deleting catalog section:', error);
    }
    loading.value=false

  };


  const createCatalogSection = async (formData) => {
    loading.value=true
    try {
      const form = new FormData();
      form.append('title', formData.title);

      const response = await fetch('/api/catalog-section/create', {
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
      await fetchData();
      
    } catch (error) {
      console.error('Error:', error);
      // Mostrar error al usuario
      errors.value.submit = 'Error al guardar la categoria';
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
      showCategoryModal.value = false;
      await fetchCategories();
      
    } catch (error) {
      console.error('Error:', error);
      // Mostrar error al usuario
      errors.value.submit = 'Error al guardar la categoria';
    }
    loading.value=false

  };
</script>

<script>
    export default {
        name: "CatalogSection"
    }
</script>