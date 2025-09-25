<template>
    <Title content="PDF DE ACCESORIOS" />
    <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
        <i class="bi bi-arrow-left-circle-fill text-xl text-blue-500"></i>
        <p class="underline font-medium text-lg text-blue-500 pb-1">Regresar</p>
    </button>

    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-md ">
        <!-- <div>
            <input v-model="searchTerm" id="search" placeholder="Buscar" class="px-6 py-2 text-xl text-slate-700 bg-slate-50 border-slate-400 rounded-full"/>
        </div> -->
        <div>
          <button @click="showModal = true" class="px-3 py-2 flex flex-row gap-2 hover:bg-slate-100 rounded-lg active:bg-slate-200 transition-all duration-100">
            <i class="bi bi-plus-square-fill text-[#4180ab] text-2xl"></i>
            <P class="text-lg text-[#4180ab] align-middle">Agregar</P>
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

    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-md ">
      <PdfAccesoryTable
          :pdfAccesories="filteredPdfAccesories"
          @search="handleSearch"
          @edit="handleEdit"
          @delete="confirmDelete"
      />
        
    </div>


    <Modal :visible="showModal" @close="showModal = false" title="Nueva catálogo de accesorios">
      <AccesoryPdfForm
        :onSubmit="createPdfAccesory"
        :initialData="emptyOffert"
        :onCancel="() => { showModal = false; currentOffert = null; }"
        :submitText="Crear"
        :loading="loading"
      />
    </Modal>

    <Modal :visible="showDeleteModal" @close="showDeleteModal = false" title="">
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
            @click="deletePdfAccesory"
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
    const pdfAccesories = ref([]);
    const searchTerm = ref('');
    const deleteId = ref(null);
    const loading = ref(false);


    const router = useRouter();

    const emptyOffert = {
      title: '',
      details: '',
      image: null,
      active: true
    };


    onMounted(async () => {
      await fetchPdfAccesory();
    });

    const filteredPdfAccesories = computed(() => {
      if (!searchTerm.value) return pdfAccesories.value;
      const term = searchTerm.value.toLowerCase();
      return pdfAccesories.value.filter(pdfAccesory => 
        pdfAccesory.name.toLowerCase().includes(term) || 
        (pdfAccesory.description && pdfAccesory.description.toLowerCase().includes(term))
      )
    });

    const  goBack = () => {
        router.back()
    }

    const fetchPdfAccesory = async () => {
      try {
        const response = await fetch('/api/accesory-pdf');
        const data = await response.json();
        if (data.success) {
          pdfAccesories.value = data.data;
        }
      } catch (error) {
        console.error('Error fetching accesory-pdf:', error);
      }
    };

    const handleSearch = (term) => {
      searchTerm.value = term;
    };


    const handleEdit = (pdfAccesory) => {
      currentOffert.value = {
        ...pdfAccesory,
        title: pdfAccesory.name,
        details: pdfAccesory.description
      };
      showModal.value = true;
    };

    const confirmDelete = (id) => {
      deleteId.value = id;
      showDeleteModal.value = true;
    };

    const deletePdfAccesory = async () => {
      loading.value=true

      try {
        const response = await fetch(`/api/accesory-pdf/${deleteId.value}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        });
        
        if (response.ok) {
          await fetchPdfAccesory(); // Refrescar la lista
          showDeleteModal.value = false;
        }
      } catch (error) {
        console.error('Error deleting accesory-pdf:', error);
      }
      loading.value=false

    };

    const createPdfAccesory = async (formData) => {
      loading.value=true
      try {
        const form = new FormData();
        form.append('title', formData.title);
        form.append('image', formData.image);

        const response = await fetch('/api/accesory-pdf/create', {
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
        await fetchPdfAccesory();
        
      } catch (error) {
        console.error('Error:', error);
        // Mostrar error al usuario
        loading.value=false
        errors.value.submit = 'Error al guardar la accesory-pdf';
      }
      loading.value=false

    };

    const updatePdfAccesory = async (formData) => {
      try {
        const response = await fetch(`/api/accesory-pdf/${currentOffert.value.id}`, {
          method: 'PUT',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: formData
        });
        
        if (response.ok) {
          await fetchPdfAccesory();
          showModal.value = false;
          currentOffert.value = null;
        }
      } catch (error) {
        console.error('Error updating accesory-pdf:', error);
      }
    };


</script>