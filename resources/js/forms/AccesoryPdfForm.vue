<template>
    <form @submit.prevent="handleSubmit" class="space-y-6">
      <!-- Campo Título -->
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700"
          >Título *</label
        >
        <input
          type="text"
          id="title"
          v-model="formData.title"
          required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        />
        <p v-if="errors.title" class="mt-1 text-sm text-red-600">
          {{ errors.title }}
        </p>
      </div>
  
      <!-- Campo Imagen -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Pdf *</label>
        <div
          @click="openFilePicker"
          @dragover.prevent="dragOver = true"
          @dragleave="dragOver = false"
          @drop.prevent="handleDrop"
          :class="{
            'border-indigo-500 bg-indigo-50': dragOver,
            'border-gray-300': !dragOver && !previewImage,
            'border-green-500': previewImage && !dragOver,
          }"
          class="mt-1 flex justify-center rounded-md border-2 border-dashed px-6 pt-5 pb-6 transition-colors"
        >
          <div class="space-y-1 text-center">
            <template v-if="!previewImage">
              <div class="flex justify-center">
                <svg
                  class="mx-auto h-12 w-12 text-gray-400"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 48 48"
                  aria-hidden="true"
                >
                  <path
                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </div>
              <div class="flex text-sm text-gray-600">
                <label
                  class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500"
                >
                  <span>Sube un archivo</span>
                  <input
                    ref="fileInput"
                    type="file"
                    class="sr-only"
                    accept=".pdf"
                    @change="handleFileChange"
                  />
                </label>
                <p class="pl-1">o arrástralo aquí</p>
              </div>
              <p class="text-xs text-gray-500">pdf, máximo 4000KB</p>
            </template>
            <template v-else>
              <div class="relative">
                <img
                  :src="'/img/pdf.webp'"
                  alt="Preview"
                  class="mx-auto max-h-48 rounded-md object-cover"
                />
                <button
                  type="button"
                  @click.stop="removeImage"
                  class="absolute -right-2 -top-2 rounded-full bg-red-500 p-1 text-white shadow-sm hover:bg-red-600"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                </button>
              </div>
              <p class="text-xs text-gray-500">
                {{ selectedFile.name }} ({{ formatFileSize(selectedFile.size) }})
              </p>
            </template>
          </div>
        </div>
        <p v-if="errors.image" class="mt-1 text-sm text-red-600">
          {{ errors.image }}
        </p>
      </div>
  
      <!-- Botones -->
      <div class="flex justify-end space-x-3">
        <!-- <button
          v-if="onCancel"
          type="button"
          @click="onCancel"
          class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Cancelar
        </button> -->
        <button
          type="submit"
          :disabled = "loading"
          class="inline-flex justify-center rounded-md   py-2 px-4 text-sm font-medium text-white shadow-sm bg-gradient-to-r 
                        from-[#0392ce]
                        to-[#3065b5] 
                        hover:from-[#16a8e7]
                        hover:to-[#3c74c7]
                    "
            
        >
          {{ props.loading? "Guardando" : submitText }}
        </button>
      </div>
    </form>
</template>
  
<script setup>
    import { ref, watch, onMounted } from 'vue';
    
    const props = defineProps({
        onSubmit: {
          type: Function,
          required: true,
        },
        initialData: {
          type: Object,
          default: () => ({
              title: '',
              image: null,
          }),
        },
        onCancel: {
          type: Function,
          default: null,
        },
        submitText: {
          type: String,
          default: 'Guardar',
        },
        loading: {
          type:  Boolean,
          default: false
        }
    });
    
    const emit = defineEmits(['update:initialData']);
    
    const formData = ref({
        title: '',
        image: null,
    });
    
    const errors = ref({
        title: '',
        image: '',
    });
    
    const dragOver = ref(false);
    const fileInput = ref(null);
    const selectedFile = ref(null);
    const previewImage = ref(null);
    
    // Cargar datos iniciales
    // onMounted(() => {
    //     if (props.initialData) {
    //     formData.value = {
    //         title: props.initialData.title || '',
    //         details: props.initialData.details || '',
    //         image: props.initialData.image || null,
    //     };
    
    //     if (props.initialData.image) {
    //         if (typeof props.initialData.image === 'string') {
    //         // Si es una URL (para edición)
    //         previewImage.value = props.initialData.image;
    //         } else if (props.initialData.image instanceof File) {
    //         // Si es un File (después de recargar)
    //         selectedFile.value = props.initialData.image;
    //         previewImage.value = URL.createObjectURL(props.initialData.image);
    //         }
    //     }
    //     }
    // });
    
    // Validar formulario
    const validate = () => {
        let valid = true;
        errors.value = { title: '', image: '' };
    
        if (!formData.value.title.trim()) {
        errors.value.title = 'El título es obligatorio';
        valid = false;
        }
    
        if (!selectedFile.value && !props.initialData?.image) {
        errors.value.image = 'El pdf es obligatorio';
        valid = false;
        }
    
        return valid;
    };
    
    // Manejar envío del formulario
    const handleSubmit = () => {
        if (validate()) {
        const dataToSubmit = {
            title: formData.value.title,
            image: selectedFile.value || props.initialData?.image,
        };
        props.onSubmit(dataToSubmit);
        }
    };
    
    // Abrir selector de archivo
    const openFilePicker = () => {
        fileInput.value.click();
    };
    
    // Manejar cambio de archivo
    const handleFileChange = (e) => {
        const file = e.target.files[0];
        processFile(file);
    };
    
    // Manejar drop de archivo
    const handleDrop = (e) => {
        dragOver.value = false;
        const file = e.dataTransfer.files[0];
        processFile(file);
    };
    
    // Procesar archivo seleccionado
    const processFile = (file) => {
        if (!file) return;
    
        // Validar tipo de archivo
        const validTypes = ['application/pdf'];
        if (!validTypes.includes(file.type)) {
        errors.value.image = 'Solo se permiten archivos pdf';
        return;
        }
    
        // Validar tamaño
        if (file.size > 4000 * 1024) {
        errors.value.image = 'El archivo no debe superar los 4000KB';
        return;
        }
    
        selectedFile.value = file;
        formData.value.image = file;
        previewImage.value = URL.createObjectURL(file);
        errors.value.image = '';
    };
    
    // Eliminar imagen seleccionada
    const removeImage = (e) => {
        e.stopPropagation();
        selectedFile.value = null;
        previewImage.value = null;
        formData.value.image = null;
        if (fileInput.value) {
        fileInput.value.value = '';
        }
    };
    
    // Formatear tamaño de archivo
    const formatFileSize = (bytes) => {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    };
</script>

<script>
    export default {
        name: "AccesoryPdfForm"
    }
</script>