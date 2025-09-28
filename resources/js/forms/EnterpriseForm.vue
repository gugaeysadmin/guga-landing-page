<template>
    <form @submit.prevent="submitForm" class=" w-full flex flex-wrap px-4 md:px-12 gap-6">

      <!-- Emterprise description -->
      <div class="w-full py-2">
        <label for="main_description" class="block text-md font-medium text-cyan-800">Descripción de la Empresa *</label>
        <textarea
          id="main_description"
          v-model="formData.main_description"
          required
          rows="4"
          class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
        ></textarea>
      </div>

      <!-- Campo Imagen -->
      <!-- <div class="w-full py-2">
        <label class="block text-md font-medium text-cyan-800">Imagen de inicio*</label>
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
                    accept="video/*, .webm, .mp4, .mov, .avi, .mkv"
                    @change="handleFileChange"
                  />
                </label>
                <p class="pl-1">o arrástralo aquí</p>
              </div>
              <p class="text-xs text-gray-500">MP4 o WEBM, máximo 40000KB</p>
            </template>
            <template v-else>
              <div class="relative">
                <img
                  :src="'/img/video-icon.png'"
                  alt="Preview"
                  t
                  class="mx-auto h-32 w-32 rounded-md object-cover"
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
      </div> -->

      <!-- About us -->
      <div class="w-full py-2">
        <label for="about_us" class="block text-md font-medium text-cyan-800">Acerca de nosotros *</label>
        <textarea
          id="about_us"
          v-model="formData.about_us"
          required
          rows="4"
          class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
        ></textarea>
      </div>

      <!-- Mision -->
      <div class="w-full py-2">
        <label for="mission" class="block text-md font-medium text-cyan-800">Mision *</label>
        <textarea
          id="mission"
          v-model="formData.mission"
          required
          rows="3"
          class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
        ></textarea>
      </div>

      <!-- Vision -->
      <div class="w-full py-2">
        <label for="vission" class="block text-md font-medium text-cyan-800">Vision *</label>
        <textarea
          id="vission"
          v-model="formData.vission"
          required
          rows="3"
          class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
        ></textarea>
      </div>


      <!-- Valores -->
      <div class="w-full py-2">
        <label for="values" class="block text-md font-medium text-cyan-800">Valores *</label>
        <textarea
          id="values"
          v-model="formData.values"
          required
          rows="3"
          class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
        ></textarea>
      </div>

      <!-- Valores -->
      <div class="w-full py-2">
        <label for="services_description" class="block text-md font-medium text-cyan-800">Descripción de servicios *</label>
        <textarea
          id="services_description"
          v-model="formData.services_description"
          required
          rows="3"
          class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
        ></textarea>
      </div>

      <div class="w-full flex gap-8 flex-wrap md:flex-nowrap">
        <!-- Phone -->
        <div class="py-2 w-full">
          <label for="contact_phone" class="block text-md font-medium text-cyan-800">Teléfono de la Empresa *</label>
          <input
            id="contact_phone"
            v-model="formData.contact_phone"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
          ></input>
        </div>
  
        <!-- Secondary phone -->
        <div class="py-2 w-full">
          <label for="contact_phone_alternative" class="block text-md font-medium text-cyan-800">Teléfono auxiliar de la Empresa *</label>
          <input
            id="contact_phone_alternative"
            v-model="formData.contact_phone_alternative"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
          ></input>
        </div>
      </div>

      <!-- email -->
      <div class="w-full py-2">
        <label for="contact_email" class="block text-md font-medium text-cyan-800">Email *</label>
        <input
          id="contact_email"
          v-model="formData.contact_email"
          required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
        ></input>
      </div>

      <!-- Adress -->
      <div class="w-full py-2">
        <label for="address" class="block text-md font-medium text-cyan-800">Dirección *</label>
        <textarea
          id="address"
          v-model="formData.address"
          required
          rows="6"
          class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
        ></textarea>
      </div>

      <!-- Botones -->  
      <div class="w-full h-20">
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
            {{ loading? "Guardando" : "Actualizar" }}
          </button>
        </div>
      </div>

  
    </form>
</template>
<script setup>
  import { ref, watch, onMounted } from 'vue';
  const loading = ref(false);
  const formData = ref({
    mission: '',
    vission: '',
    values: '',
    services_description: '',
    main_description: '', //
    main_video_url: null, //
    about_us: '',
    contact_phone: '',
    contact_phone_alternative: '',
    contact_email: '',
    address: ''
  });

  const errors = ref({
    mission: '',
    vission: '',
    values: '',
    services_description: '',
    main_description: '',
    main_video_url: null,
    about_us: '',
    contact_phone: '',
    contact_phone_alternative: '',
    contact_email: '',
    address: ''
  });

  const dragOver = ref(false);
  const fileInput = ref(null);
  const selectedFile = ref(null);
  const previewImage = ref(null);
  const configData = ref([]);

  onMounted(async () => {
    await fetchConfigData();
  });

  const validate = () => {
      let valid = true;
      errors.value = { 
        mission: '',
        vission: '',
        values: '',
        services_description: '',
        main_description: '',
        main_video_url: null,
        about_us: '',
        contact_phone: '',
        contact_phone_alternative: '',
        contact_email: '',
        address: ''
      };
  
      if (!formData.value.mission.trim()) {
        errors.value.mission = 'La mision es obligatorio';
        valid = false;
      }
      if (!formData.value.vission.trim()) {
        errors.value.vission = 'La vission es obligatorio';
        valid = false;
      }
      if (!formData.value.values.trim()) {
        errors.value.values = 'Los valores son obligatorios';
        valid = false;
      }
      if (!formData.value.services_description.trim()) {
        errors.value.services_description = 'La descripcion de servicios es obligatoria';
        valid = false;
      }
      if (!formData.value.main_description.trim()) {
        errors.value.main_description = 'La descripciónn  generál es obligatoria';
        valid = false;
      }
      if (!formData.value.about_us.trim()) {
        errors.value.about_us = 'Acerca de nosotros es obligatorio';
        valid = false;
      }
      if (!formData.value.contact_phone.trim()) {
        errors.value.contact_phone = 'El teléfono es obligatorio';
        valid = false;
      }
      if (!formData.value.contact_phone_alternative.trim()) {
        errors.value.contact_phone_alternative = 'El teléfono secundario es obligatorio';
        valid = false;
      }
      if (!formData.value.contact_email.trim()) {
        errors.value.contact_email = 'El email es obligatorio';
        valid = false;
      }
      if (!formData.value.address.trim()) {
        errors.value.address = 'La descripción es obligatoria';
        valid = false;
      }
  
  
      if (!selectedFile.value && !props.initialData?.main_video_url) {
        errors.value.main_video_url = 'La imagen principal  es obligatoria';
        valid = false;
      }
  
      return valid;
  };
  const handleSubmit = () => {
    if (validate()) {
      const dataToSubmit = {
          mission: formData.value.mission,
          vission: formData.value.vission,
          values: formData.value.values,
          services_description: formData.value.services_description,
          main_description: formData.value.main_description,
          main_video_url: selectedFile.value,
          about_us: formData.value.about_us,
          contact_phone: formData.value.contact_phone,
          contact_phone_alternative: formData.value.contact_phone_alternative,
          contact_email: formData.value.contact_email,
          address: formData.value.address,
      };
      // props.onSubmit(dataToSubmit);
    }
  };

  const fetchConfigData = async () => {
    try {
      const response = await fetch('/api/lp-config');
      const data = await response.json();
      if (data.success) {
        configData.value = data.data;
        formData.value.main_description = data.data.main_description;
        formData.value.about_us = data.data.about_us;
        formData.value.mission = data.data.mission;
        formData.value.vission = data.data.vission;
        formData.value.values = data.data.values;
        formData.value.services_description = data.data.services_description
        formData.value.contact_phone = data.data.contact_phone;
        formData.value.contact_phone_alternative = data.data.contact_phone_alternative;
        formData.value.contact_email = data.data.contact_email;        
        formData.value.address = data.data.address;
      }
    } catch (error) {
      console.error('Error fetching offerts:', error);
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
      const validTypes = [
        'video/mp4',         // MP4
        'video/quicktime',   // MOV
        'video/x-msvideo',   // AVI
        'video/x-matroska',  // MKV
        'video/webm'         // WEBM
      ];
      if (!validTypes.includes(file.type)) {
        errors.value.image = 'Solo se permiten archivos MP4 o PNG';
        return;
      }
  
      // Validar tamaño
      if (file.size > 20000 * 1024) {
        errors.value.image = 'El archivo no debe superar los 20000KB';
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

  const submitForm = async () => {
    updateOffert();
  }
  const updateOffert = async () => {
    loading.value = true;
    try {
      const form = new FormData();
      form.append('mission', formData.value.mission);
      form.append('vission', formData.value.vission);
      form.append('values', formData.value.values);
      form.append('services_description', formData.value.services_description);
      form.append('main_description', formData.value.main_description);
      // form.append('main_video_url', formData.value.main_video_url);
      form.append('about_us', formData.value.about_us);
      // form.append('special_ofert', formData.value.special_ofert);
      form.append('contact_phone', formData.value.contact_phone);
      form.append('contact_phone_alternative', formData.value.contact_phone_alternative);
      form.append('contact_email', formData.value.contact_email);
      form.append('address', formData.value.address);

      const response = await fetch(`/api/lp-config/update`, {
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
      }
    } catch (error) {
      console.error('Error updating offert:', error);
      loading.value = false;
    }
    loading.value = false;

  };

</script>
<script>
    export default {
      name: "EnterpriseForm"
    }
</script>

<!-- <script>
    export default {
        name: "EnterpriseForm"
    }
</script> -->