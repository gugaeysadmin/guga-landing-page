<template>
    <Title :content="`FILTROS DE ${specarea}`"  />
    <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
        <i class="bi bi-arrow-left-circle-fill text-xl text-[#3e8ad5]"></i>
        <p class="underline font-medium text-lg text-[#3e8ad5] pb-[1px]">Regresar</p>
    </button>
    <div class="flex flex-col gap-4 mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
        <h1 class="text-2xl font-semibold text-[#4180ab]">FILTROS EN CATÁLOGOS</h1>
        <div class="flex flex-col gap-4">
            <div  class="flex justify-end">
              <button
                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 disabled:bg-indigo-300 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                @click="updateConfigData"
                :disabled="filters.length === 0 || loading"
              >
                  Actualizar
              </button>
            </div>

            <div
              v-for="(filter, index) in filters"
              :key="index"
              class="flex-block"
            >
              <div class="flex w-full items-center rounded-lg bg-slate-200 px-4  py-2 gap-4">
                <button 
                  @click="handleDeleteSection(index)"
                  class="h-7 w-7 rounded-full bg-red-400 flex pt-1 justify-center hover:bg-red-900 active:bg-red-600"
                >
                  <i class="bi bi-trash-fill text-white  "></i>
                </button>
                <div class="font-semibold">
                  {{ filter.section }}
                </div>
              </div>
              <div v-for="(category, catindex) in filter.categories" class="flex w-full items-center rounded-lg bg-slate-100 pr-4 pl-12  py-2 gap-4 mt-2">
                <button
                  @click="deleteSubcategory(index, catindex)" 
                  class="h-7 w-7 rounded-full bg-orange-400 flex pt-1 justify-center hover:bg-orange-900 active:bg-orange-600"
                >
                  <i class="bi bi-trash-fill text-white  "></i>
                </button>
                <div>
                  {{ category }}
                </div>
              </div>
              <div class="flex w-full items-center rounded-lg bg-slate-100 pr-4 pl-12 py-3 gap-4 mt-2">
                <select
                  v-model="categorySelected[index]"
                  class="w-64 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="" disabled selected>Selecciona una categoría</option>
                  <option v-for="category in categories" :key="category.id" :value="category.name">
                    {{ category.name }}
                  </option>
                </select>
                <button
                  type="button"
                  @click="addSubCategory(index,categorySelected[index])"
                  class="px-3 py-2 bg-[#4180ab] hover:bg-[#5ca6d8] text-white text-semibold rounded-md transition-colors w-24"
                >
                  + Agregar
                </button>

                <button
                  type="button"
                  @click="showCategoryModal=true"
                  class="px-3 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-semibold rounded-md transition-colors w-40"
                >
                  + Crear categoría
                </button>
              </div>



              <!-- <div class="flex flex-row items-center gap-2 px-4">
                <p class="text-lg text-[#4180ab] font-semibold">{{ section.section_name }}</p>
                <button @click="()=> confirmDelete(section.id)"  class="flex items-center justify-center text-sm rounded-full group  active:bg-slate-100">
                  <i class="bi bi-trash-fill text-red-700 group-hover:text-red-600 group-active:text-red-900"></i>
                </button>
              </div>
              <button class="flex flex-row items-center gap-1 mt-2 pl-8">
                <i class="bi bi-plus-circle-fill text-[#4180ab] text-lg"></i>
                <P class="text-sm text-[#4180ab] align-middle">Agregar</P>
              </button> -->
            </div>
            <div class="flex gap-4 w-full items-center rounded-lg bg-slate-200 px-4  py-3">
              <input
                v-model="currentSecton"
                placeholder="Nómbre de la sección"
                class="border-0 bg-slate-200 rounded-xl"
              />
              <button
                type="button"
                @click="addSection"
                class="px-3 py-1 rounded-md transition-colors w-24 flex flex-row items-center gap-1 bg-gradient-to-r 
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

    <Modal :visible="showCategoryModal" @close="showCategoryModal = false" title="Nueva categoría">
      <CategoryForm
        :onSubmit="createCategories"
        :initialData="emptyOffert"
        :onCancel="() => { showCategoryModal = false; currentOffert = null; }"
        :submitText="Crear"
        :loading="loading"
      />
    </Modal>

    <Modal :visible="showDeleteModal" @close="showDeleteModal = false" title="">
      <div>
        <h2 class="text-lg font-medium mb-4 text-center">¿Estás seguro de eliminar esta sección?</h2>
        <div class="flex justify-center space-x-8">
          <button
            @click="showDeleteModal = false, sectionDelecting = null"
            :disabled="loading"
            class="px-4 py-2 border-2 rounded-md w-32"
          >
            Cancelar
          </button>
          <button
            @click="deleteSection"
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
    const showModal = ref(false);
    const showCategoryModal = ref(false);
    const showDeleteModal = ref(false);
    const currentOffert = ref(null);
    const categorySelected = ref([])
    const dataset = ref([]);
    const searchTerm = ref('');
    const deleteId = ref(null);
    const specarea = ref("");
    const specarea_id = ref(null);
    const currentSecton = ref(null);
    const sectionDelecting = ref(null);
    const loading = ref(false);
    const categories = ref('');

    const filters = ref([])
    const router = useRouter();
    const route = useRoute();


    const emptyOffert = {
        title: '',
    };

    onMounted(async () => {
        specarea_id.value=route.query.id;
        specarea.value=route.query.specarea.toUpperCase();
        fetchCategories();
        fetchConfigData();
    });

    const goBack =() =>{
        router.back();
    }

    const fetchConfigData = async () => {
        try {
        const response = await fetch(`/api/speciality-areas/${specarea_id.value}`);
        const data = await response.json();
        if (data.success) {
            console.log(data.data);
            if(data.data.filters && data.data.filters.length>0){
                filters.value = JSON.parse(data.data.filters);
            }
        }
        } catch (error) {
        console.error('Error fetching offerts:', error);
        }
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

    const updateConfigData = async() => {
        loading.value = true;
        try {
        const form = new FormData();
        form.append('filters', JSON.stringify(filters.value));

        const response = await fetch(`/api/speciality-areas/update/${specarea_id.value}`, {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: form
        });
        
        if (response.ok) {
            await fetchConfigData();
            // showModal.value = false;
            // currentOffert.value = null;
            currentSecton.value = null;
        }
        } catch (error) {
        console.error('Error updating offert:', error);
        loading.value = false;
        }
        loading.value = false;
    }

    const addSection = () => {
        if(currentSecton.value && currentSecton.value!==""){
        filters.value.push({
            section: currentSecton.value,
            categories: []
        });
        categorySelected.value.push("");
        currentSecton.value=null
        }

    }

    const addSubCategory = (index, category )=>{
        if(category!== "" || category){
        filters.value[index].categories.push(category);
        categorySelected.value[index]="";
        }
    }



    const handleDeleteSection= (id)=> {
        showDeleteModal.value=true
        console.log(id)
    }

    const deleteSubcategory = (sectionIndex, subIndex)=>{
        filters.value[sectionIndex].categories.splice(subIndex,1);
    }
    
    const deleteSection = () => {
        filters.value.splice(sectionDelecting, 1);
        sectionDelecting.value=null;
        showDeleteModal.value=false;
    }

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
        loading.value=false

        }
        loading.value=false

    };
</script>