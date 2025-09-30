<template>
    <Title content="Configuraciones de Tablas" />
    <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
        <i class="bi bi-arrow-left-circle-fill text-xl text-[#3e8ad5]"></i>
        <p class="underline font-medium text-lg text-[#3e8ad5] pb-[1px]">Regresar</p>
    </button>

    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-md ">
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

    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-md ">
      <PdfManualTable
          :pdfManuals="filteredpdfManuals"
          @search="handleSearch"
          @edit="handleEdit"
          @delete="confirmDelete"
      />
        
    </div>


    <Modal :visible="showModal" @close="showModal = false" title="Agregar nueva tabla">
      <div  class="w-full">        
        <div class="mb-4">
          <label for="newTableName" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la tabla *</label>
          <input
            v-model="newTableConf.name"
            type="text"
            id="newTableName"
            @change="errorsTable.title = ''"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
          <p v-if="errorsTable.title !== ''" class="mt-1 text-xs font-medium text-red-600  pl-2">{{ errorsTable.title }}</p>
        </div>
        <div class="w-full  py-2">
          <div>
            <label for="name" class="block text-md font-medium text-cyan-800">Nombre de la columna </label>
            <div class="flex gap-2">
              <input
                id="name"
                v-model="newHeader"
                class="mt-1 block flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
              ></input>
              <button
                type="button"
                @click="addTableHeader"
                class="px-3 py-1 rounded-md transition-colors  flex flex-row items-center gap-1 bg-gradient-to-r 
                        from-[#4fd8e2] 
                        to-[#3eb8d7] 
                        hover:from-[#54e4ee] 
                        hover:to-[#3eb8d7]
                    "
              >
                <div>
                  <div class="bg-white flex justify-center items-center content-center h-5 w-5 max-w-5 max-h-5 my-1 rounded-full mr-1">
                <p class="font-bold text-[#80d6b2] text-xl pb-[2px] pl-[1px]">+</p>
            </div>
                </div>
                <p class=" text-slate-50 font-semibold">Nueva</p>
          </button>
            </div>
          </div>
        </div>
        <p class="text-xs"><b>Nota:</b> no se pueden agregar columnas con el mismo nombre</p>


        <div class="overflow-x-auto mt-5">
          <label for="newTableName" class="block text-md font-medium text-cyan-800 mb-1">Vista previa de la tabla</label>
          <table class="min-w-full divide-y divide-gray-200">
            <thead class=" bg-gray-100">
              <tr>
                <th
                  v-for="(item, index) in newTableConf.headers"
                  :key="index"
                  :draggable="item !== 'pdf' && item !== 'IMAGEN'" 
                  @dragstart="item !== 'pdf' && item !== 'IMAGEN' ? handleHeaderDragStart($event, index) : null"
                  @dragover.prevent="item !== 'pdf' && item !== 'IMAGEN' ? handleHeaderDragOver($event, index) : null"
                  @drop="item !== 'pdf' && item !== 'IMAGEN' ? handleHeaderDrop($event, index) : null"
                  class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  :class="{'cursor-move': item !== 'pdf' && item !== 'IMAGEN', 'cursor-default': item === 'pdf' || item === 'IMAGEN'}"
                >
                  <div class="flex flex-row gap-1 px-4 content-center items-center">
                    <button
                      v-if="item !== 'pdf' && item !== 'IMAGEN'" 
                      @click="removeTableHeader(index)"  
                      class="p-1"                        
                    >
                      <i class="bi bi-x-circle text-md  text-red-600"></i>
                    </button>
                    {{ item }}
                  </div>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td :colspan="newTableConf.headers.length" class="px-4 py-3 text-center text-sm text-gray-500">
                  Datos de la tabla
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <p v-if="errorsTable.rows !== ''" class="mt-1 text-xs font-medium text-red-600  pl-2">{{ errorsTable.rows }}</p>
        <div class="flex justify-end gap-2">
          <button
            type="button"
            @click="closeTableHeaderConf"
            class="px-4 py-2 text-white font-medium text-sm rounded-md transition-colors bg-gradient-to-r 
                    from-[#969595]
                    to-[#727270] 
                    hover:from-[#969595]
                    hover:to-[#888885]
                "
          >
            Cancelar
          </button>
          <button
            @click="createTableHeader"
            :disabled = "loading"
            class="inline-flex justify-center rounded-md  py-2 px-4 text-sm font-medium text-white shadow-sm bg-gradient-to-r 
                    from-[#0392ce]
                    to-[#3065b5] 
                    hover:from-[#16a8e7]
                    hover:to-[#3c74c7]
                "
        
          >
            {{ loading? "Guardando" : "Guardar" }}
          </button>
        </div>
      </div>
    </Modal>

    <Modal :visible="showModalEdit" @close="showModalEdit = false" title="Editar tabla">
      <div  class="w-full">        
        <div class="mb-4">
          <label for="newTableName" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la tabla *</label>
          <input
            v-model="newTableConf.name"
            type="text"
            id="newTableName"
            @change="errorsTable.title = ''"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
          <p v-if="errorsTable.title !== ''" class="mt-1 text-xs font-medium text-red-600  pl-2">{{ errorsTable.title }}</p>
        </div>
        <div class="w-full  py-2">
          <div>
            <label for="name" class="block text-md font-medium text-cyan-800">Nombre de la columna </label>
            <div class="flex gap-2">
              <input
                id="name"
                v-model="newHeader"
                class="mt-1 block flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
              ></input>
              <button
                type="button"
                @click="addTableHeader"
                class="px-3 py-1 rounded-md transition-colors  flex flex-row items-center gap-1 bg-gradient-to-r 
                        from-[#4fd8e2] 
                        to-[#3eb8d7] 
                        hover:from-[#54e4ee] 
                        hover:to-[#3eb8d7]
                    "
              >
                <div>
                  <div class="bg-white flex justify-center items-center content-center h-5 w-5 max-w-5 max-h-5 my-1 rounded-full mr-1">
                <p class="font-bold text-[#80d6b2] text-xl pb-[2px] pl-[1px]">+</p>
            </div>
                </div>
                <p class=" text-slate-50 font-semibold">Nueva</p>
          </button>
            </div>
          </div>
        </div>
        <p class="text-xs"><b>Nota:</b> no se pueden agregar columnas con el mismo nombre</p>


        <div class="overflow-x-auto mt-5">
          <label for="newTableName" class="block text-md font-medium text-cyan-800 mb-1">Vista previa de la tabla</label>
          <table class="min-w-full divide-y divide-gray-200">
            <thead class=" bg-gray-100">
              <tr>
                <th
                  v-for="(item, index) in newTableConf.headers"
                  :key="index"
                  :draggable="item !== 'pdf' && item !== 'IMAGEN'" 
                  @dragstart="item !== 'pdf' && item !== 'IMAGEN' ? handleHeaderDragStart($event, index) : null"
                  @dragover.prevent="item !== 'pdf' && item !== 'IMAGEN' ? handleHeaderDragOver($event, index) : null"
                  @drop="item !== 'pdf' && item !== 'IMAGEN' ? handleHeaderDrop($event, index) : null"
                  class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  :class="{'cursor-move': item !== 'pdf' && item !== 'IMAGEN', 'cursor-default': item === 'pdf' || item === 'IMAGEN'}"
                >
                  <div class="flex flex-row gap-1 px-4 content-center items-center">
                    <button
                      v-if="item !== 'pdf' && item !== 'IMAGEN'" 
                      @click="removeTableHeader(index)"  
                      class="p-1"                        
                    >
                      <i class="bi bi-x-circle text-md  text-red-600"></i>
                    </button>
                    {{ item }}
                  </div>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td :colspan="newTableConf.headers.length" class="px-4 py-3 text-center text-sm text-gray-500">
                  Datos de la tabla
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <p v-if="errorsTable.rows !== ''" class="mt-1 text-xs font-medium text-red-600  pl-2">{{ errorsTable.rows }}</p>
        <div class="flex justify-end gap-2">
          <button
            type="button"
            @click="closeTableHeaderConf"
            class="px-4 py-2 text-white font-medium text-sm rounded-md transition-colors bg-gradient-to-r 
                    from-[#969595]
                    to-[#727270] 
                    hover:from-[#969595]
                    hover:to-[#888885]
                "
          >
            Cancelar
          </button>
          <button
            @click="updateTableHeader"
            :disabled = "loading"
            class="inline-flex justify-center rounded-md  py-2 px-4 text-sm font-medium text-white shadow-sm bg-gradient-to-r 
                    from-[#0392ce]
                    to-[#3065b5] 
                    hover:from-[#16a8e7]
                    hover:to-[#3c74c7]
                "
        
          >
            {{ loading? "Guardando" : "Guardar" }}
          </button>
        </div>
      </div>
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
            @click="deletePdfManual"
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
    const currentTable = ref(null);
    const pdfManuals = ref([]);
    const searchTerm = ref('');
    const deleteId = ref(null);
    const loading = ref(false);
    const tableHeaders = ref(null);

    const newHeader = ref(null);
    const newTableConf = ref({
      name: null,
      headers: ["pdf"]
    })

    const errors = ref({
      name: '',
      description: '',
      has_table: false,
      product_services: '',
      brand_id: null,
      table_data: '',
      has_accesrorypdf: false,
      accesoryodf: null,
      has_page: 0,
      has_services: false,
      has_manual: false,
      manualpdf: null,
      services_description: '',
      catalogaccesrorypdf: null,
      productImages: [],
      categories: [],
      specAreas: []
    });

  const errorsPdf = ref({
      title: '',
      image: '',
  });

  const errorsTable = ref({
      title: '',
      rows: '',
  })


    const router = useRouter();

    const emptyOffert = {
      title: '',
      details: '',
      image: null,
      active: true
    };


    onMounted(async () => {
      fetchTableHeaders();
    });

    const filteredpdfManuals = computed(() => {
      if (!searchTerm.value) return pdfManuals.value;
      const term = searchTerm.value.toLowerCase();
      return pdfManuals.value.filter(PdfManual => 
        PdfManual.name.toLowerCase().includes(term) || 
        (PdfManual.description && PdfManual.description.toLowerCase().includes(term))
      )
    });

    const  goBack = () => {
        router.back()
    }

  const fetchTableHeaders = async () => {
      try {
        const response = await fetch('/api/th-conf');
        const data = await response.json();
        if (data.success) {
          pdfManuals.value = data.data;
          console.log(data.data)
        }
      } catch (error) {
        console.error('Error fetching tableHeaders:', error);
      }
    };

    const handleSearch = (term) => {
      searchTerm.value = term;
    };


    const handleEdit = (PdfManual) => {
      let headers;
      try{
        headers = JSON.parse(PdfManual.table_json).headers.filter((e) => e !== "imagen") 
      } catch{}

      newTableConf.value = {
        headers: headers ? headers : ["pdf"],
        name: PdfManual.name,
        id: PdfManual.id
      };
      showModalEdit.value = true;
    };

    const confirmDelete = (id) => {
      deleteId.value = id;
      showDeleteModal.value = true;
    };

    const deletePdfManual = async () => {
      loading.value=true

      try {
        const response = await fetch(`/api/th-conf/${deleteId.value}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        });
        
        if (response.ok) {
          await fetchTableHeaders(); // Refrescar la lista
          showDeleteModal.value = false;
        }
      } catch (error) {
        console.error('Error deleting accesory-pdf:', error);
      }
      loading.value=false

    };

    const createPdfManual = async (formData) => {
      loading.value=true
      try {
        const form = new FormData();
        form.append('title', formData.title);
        form.append('image', formData.image);

        const response = await fetch('/api/th-conf/create', {
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
        await fetchPdfManual();
        
      } catch (error) {
        console.error('Error:', error);
        // Mostrar error al usuario
        loading.value=false
        errors.value.submit = 'Error al guardar la tabla';
      }
      loading.value=false

    };

    const updatePdfManual = async (formData) => {
      try {
        const form = new FormData();
        form.append('title', formData.title);
        form.append('image', formData.image);
        const response = await fetch(`/api/th-conf/${currentTable.value.id}`, {
          method: 'PUT',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: formData
        });
        
        if (response.ok) {
          await fetchPdfManual();
          showModal.value = false;
          currentTable.value = null;
        }
      } catch (error) {
        console.error('Error updating ath-conf:', error);
      }
    };

    
    const closeTableHeaderConf = () => {
      showModal.value = false;
      showModalEdit.value = false;
      newTableConf.value.name = null;
      newTableConf.value.headers = ["pdf"]
    }

    const addTableHeader = () => {
      if(newTableConf.value.headers && newTableConf.value.headers !== "" && !newTableConf.value.headers.includes(newHeader.value) && newHeader.value !== null && newHeader.value !== "" && newHeader.value.trim() !== ""){
        newTableConf.value.headers.pop();
        newTableConf.value.headers.push(newHeader.value);
        newTableConf.value.headers.push("pdf");
      }
      newHeader.value = null

    }

    const createTableHeader = async () => {
      loading.value=true
      try {
        const form = new FormData();
        const headers = {
          headers: ["imagen",...newTableConf.value.headers]
        }
        
        if(!newTableConf.value.name || newTableConf.value.name === ""){
          errorsTable.value.title = "El nombre de la tabla es requerido"
        } else if (newTableConf.value.name.trim() === "") {
          errorsTable.value.title = "El nombre de la tabla es requerido"
        }  else {
          const exist  = pdfManuals.value.some((e) => e.name == newTableConf.value.name.trim());
          if(!exist){
            form.append('name',newTableConf.value.name );
            form.append('table_json', JSON.stringify(headers))
      
            const response = await fetch('/api/th-conf/create', {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              },
              body: form
            });
      
            if (!response.ok) throw new Error('Error al guardar');
            showModal.value = false;
            loading.value=false;
            newTableConf.value.name = null;
            newTableConf.value.headers = ["pdf"]
      
            await fetchTableHeaders();
          } else {
            errorsTable.value.title = "Ya existe una tabla con ese nombre"
          }

        }


        
      } catch (error) {
        console.error('Error:', error);
        errors.value.submit = 'Error al guardar la categoria';
        loading.value=false
  
      }
      loading.value=false
    }

    const updateTableHeader = async () => {
      loading.value=true
      try {
        const form = new FormData();
        const headers = {
          headers: ["imagen",...newTableConf.value.headers]
        }
        
        if(!newTableConf.value.name || newTableConf.value.name === ""){
          errorsTable.value.title = "El nombre de la tabla es requerido"
        } else if (newTableConf.value.name.trim() === "") {
          errorsTable.value.title = "El nombre de la tabla es requerido"
        }  else {
          const exist = false
          if(!exist){
            form.append('name',newTableConf.value.name );
            form.append('table_json', JSON.stringify(headers))
      
            const response = await fetch(`/api/th-conf/update/${newTableConf.value.id}`, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              },
              body: form
            });
      
            if (!response.ok) throw new Error('Error al guardar');
            showModalEdit.value = false;
            loading.value=false;
            newTableConf.value.name = null;
            newTableConf.value.headers = ["pdf"]
      
            await fetchTableHeaders();
          } else {
            errorsTable.value.title = "Ya existe una tabla con ese nombre"
          }

        }


        
      } catch (error) {
        console.error('Error:', error);
        errors.value.submit = 'Error al guardar la categoria';
        loading.value=false
  
      }
      loading.value=false
    }

    // add table conf

    const draggedHeaderIndex = ref(null);

    const handleHeaderDragStart = (event, index) => {
      draggedHeaderIndex.value = index;
    };

    const handleHeaderDragOver = (event, index) => {
      event.preventDefault();
    };

    const handleHeaderDrop = (event, index) => {
      if (draggedHeaderIndex.value === null) return;

      const movedItem = newTableConf.value.headers[draggedHeaderIndex.value];

      // Evitar mover pdf o imagen
      if (movedItem === "pdf" || movedItem === "imagen") return;

      // Evitar reemplazar pdf o imagen al hacer drop
      if (newTableConf.value.headers[index] === "pdf" || newTableConf.value.headers[index] === "imagen") return;

      newTableConf.value.headers.splice(draggedHeaderIndex.value, 1);
      newTableConf.value.headers.splice(index, 0, movedItem);

      draggedHeaderIndex.value = null;
    };

    const removeTableHeader = (index) => {
      const item = newTableConf.value.headers[index];
      if (item === "pdf" || item === "imagen") return;
      newTableConf.value.headers.splice(index, 1);
    };

</script>