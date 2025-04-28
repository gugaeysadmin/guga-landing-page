<template>
    <form @submit.prevent="submitForm" class=" w-full flex flex-wrap">
      <!-- Misión -->
      <div class="w-full md:w-1/2 px-4 py-2">
        <label for="mission" class="block text-sm font-medium text-gray-700">Misión</label>
        <textarea
          id="mission"
          v-model="form.mission"
          rows="6"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        ></textarea>
      </div>
  
      <!-- Visión -->
      <div class="w-full md:w-1/2 px-4 py-2">
        <label for="vission" class="block text-sm font-medium text-gray-700">Visión</label>
        <textarea
          id="vission"
          v-model="form.vission"
          rows="6"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        ></textarea>
      </div>
  
      <!-- Valores -->
      <div class="w-full md:w-1/2 px-4 py-2">
        <label for="values" class="block text-sm font-medium text-gray-700">Valores</label>
        <textarea
          id="values"
          v-model="form.values"
          rows="6"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        ></textarea>
      </div>
  
      <!-- Descripción de Servicios -->
      <div class="w-full md:w-1/2 px-4 py-2">
        <label for="services_description" class="block text-sm font-medium text-gray-700">Descripción de Servicios</label>
        <textarea
          id="services_description"
          v-model="form.services_description"
          rows="6"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        ></textarea>
      </div>
  
      <!-- Descripción Principal -->
      <div class="w-full md:w-1/2 px-4 py-2">
        <label for="main_description" class="block text-sm font-medium text-gray-700">Descripción Principal</label>
        <textarea
          id="main_description"
          v-model="form.main_description"
          rows="6"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        ></textarea>
      </div>
  
      <!-- Sobre Nosotros -->
      <div class="w-full md:w-1/2 px-4 py-2">
        <label for="about_us" class="block text-sm font-medium text-gray-700">Sobre Nosotros</label>
        <textarea
          id="about_us"
          v-model="form.about_us"
          rows="6"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        ></textarea>
      </div>

      <!-- URL del Video -->
      <div class="w-full md:w-1/2 px-4 py-2">
        <label for="main_video_url" class="block text-sm font-medium text-gray-700">URL del Video Principal</label>
        <input
          type="text"
          id="main_video_url"
          v-model="form.main_video_url"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        />
        <p class="mt-2 text-sm text-gray-500">Sube el video al storage y pega la URL aquí</p>
      </div>
  
      <!-- Teléfono de Contacto -->
      <div class="w-full md:w-1/2 px-4 py-2">
        <label for="contact_phone" class="block text-sm font-medium text-gray-700">Teléfono Principal</label>
        <input
          type="tel"
          id="contact_phone"
          v-model="form.contact_phone"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        />
      </div>
  
      <!-- Teléfono Alternativo -->
      <div class="w-full md:w-1/2 px-4 py-2">
        <label for="contact_phone_alternative" class="block text-sm font-medium text-gray-700">Teléfono Alternativo</label>
        <input
          type="tel"
          id="contact_phone_alternative"
          v-model="form.contact_phone_alternative"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        />
      </div>
  
      <!-- Email de Contacto -->
      <div class="w-full md:w-1/2 px-4 py-2">
        <label for="contact_email" class="block text-sm font-medium text-gray-700">Email de Contacto</label>
        <input
          type="email"
          id="contact_email"
          v-model="form.contact_email"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        />
      </div>
  
      <!-- Dirección -->
      <div class="w-full px-4 py-2">
        <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
        <textarea
          id="address"
          v-model="form.address"
          rows="3"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        ></textarea>
      </div>
  
      <!-- Botón de Envío -->
      <div class="flex justify-end w-full px-4 my-4">
        <button
          type="submit"
          class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
          Guardar Información
        </button>
      </div>
    </form>
  </template>
  
  <script>
  export default {
    name: "EnterpriseForm",
    data() {
      return {
        form: {
          mission: '',
          vission: '',
          values: '',
          services_description: '',
          main_description: '',
          main_video_url: '',
          about_us: '',
          contact_phone: '',
          contact_phone_alternative: '',
          contact_email: '',
          address: ''
        }
      }
    },
    methods: {
      async submitForm() {
        try {
          // Aquí iría la lógica para enviar los datos al backend
          const response = await axios.post('/api/company-info', this.form)
          
          // Manejar la respuesta exitosa
          this.$toast.success('Información guardada correctamente')
        } catch (error) {
          // Manejar errores
          this.$toast.error('Error al guardar la información')
          console.error(error)
        }
      },
      // Método para cargar datos existentes si es necesario
      async loadData() {
        try {
        //   const response = await axios.get('/api/company-info')
        //   this.form = response.data
        } catch (error) {
          console.error('Error al cargar datos:', error)
        }
      }
    },
    // Cargar datos al montar el componente
    mounted() {
      this.loadData()
    }
  }
  </script>

<!-- <script>
    export default {
        name: "EnterpriseForm"
    }
</script> -->