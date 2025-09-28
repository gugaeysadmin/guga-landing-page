<template>
    <form @submit.prevent="handleSubmit" class="space-y-6">
      <!-- Campo Título -->
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700"
          >Nombre *</label
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

      <!-- Botones -->
      <div class="flex justify-end space-x-3">
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
              details: '',
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
    });
    
    const errors = ref({
        title: '',
    });
    
    
    // Validar formulario
    const validate = () => {
        let valid = true;
        errors.value = { title: ''};
    
        if (!formData.value.title.trim()) {
            errors.value.title = 'El título es obligatorio';
            valid = false;
        }
    
        return valid;
    };
    
    // Manejar envío del formulario
    const handleSubmit = () => {
        if (validate()) {
        const dataToSubmit = {
            title: formData.value.title,
        };
        props.onSubmit(dataToSubmit);
        }
    };
    
</script>

<script>
    export default {
        name: "CatalogSectionForm"
    }
</script>