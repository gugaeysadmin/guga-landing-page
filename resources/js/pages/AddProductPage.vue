<template>
    <Title content="AGREGAR PRODUCTO"  />
    <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
        <i class="bi bi-arrow-left-circle-fill text-xl text-blue-500"></i>
        <p class="underline font-medium text-lg text-blue-500 pb-1">Regresar</p>
  </button>

  <div class="mt-12 py-5 px-5 rounded-xl bg-white shadow-sm">
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-6">Formulario de Producto</h1>
      
      <form @submit.prevent="submitForm">
        <!-- Campo Nombre -->
        <div class="mb-6">
          <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
          <input
            v-model="form.nombre"
            type="text"
            id="nombre"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          >
          <p v-if="errors.nombre" class="mt-1 text-sm text-red-600">{{ errors.nombre }}</p>
        </div>

        <!-- Campo Descripción -->
        <div class="mb-6">
          <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción *</label>
          <textarea
            v-model="form.descripcion"
            id="descripcion"
            rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          ></textarea>
          <p v-if="errors.descripcion" class="mt-1 text-sm text-red-600">{{ errors.descripcion }}</p>
        </div>

        <!-- Campo Marca con Modal -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-1">Marca *</label>
          <div class="flex gap-2">
            <select
              v-model="form.marca"
              class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            >
              <option value="" disabled selected>Selecciona una marca</option>
              <option v-for="marca in marcas" :key="marca.id" :value="marca.id">
                {{ marca.nombre }}
              </option>
            </select>
            <button
              type="button"
              @click="showMarcaModal = true"
              class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
            >
              + Nueva
            </button>
          </div>
          <p v-if="errors.marca" class="mt-1 text-sm text-red-600">{{ errors.marca }}</p>
        </div>

        <!-- Campo Categorías -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-1">Categorías</label>
          <select
            v-model="categoriaSeleccionada"
            @change="agregarCategoria"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option value="" disabled selected>Selecciona una categoría</option>
            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
              {{ categoria.nombre }}
            </option>
          </select>
          
          <!-- Chips de categorías seleccionadas -->
          <div class="mt-2 flex flex-wrap gap-2">
            <div
              v-for="(categoria, index) in form.categorias"
              :key="index"
              class="flex items-center bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm"
            >
              {{ obtenerNombreCategoria(categoria) }}
              <button
                type="button"
                @click="eliminarCategoria(index)"
                class="ml-2 text-blue-600 hover:text-blue-800"
              >
                &times;
              </button>
            </div>
          </div>
        </div>

        <div class="mb-6">
          <label class="block text-lg font-bold text-gray-700 mb-1">Multimedia (Imágenes/Videos)</label>
          
          <div class="flex flex-col gap-4">
            <!-- Input para subir archivos -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Subir archivos</label>
              <input 
                type="file" 
                multiple 
                accept="image/*,video/*" 
                @change="handleFileUpload" 
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
              >
            </div>
            
            <!-- Input para agregar URLs -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">O ingresar URL</label>
              <div class="flex gap-2">
                <input 
                  v-model="nuevaUrl" 
                  type="url" 
                  placeholder="https://ejemplo.com/video.mp4" 
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button 
                  @click="agregarUrl" 
                  type="button" 
                  class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
                >
                  Agregar URL
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabla de multimedia ordenable -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-1">Archivos agregados</label>
          
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vista previa</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(item, index) in form.multimedia" :key="item.id" class="hover:bg-gray-50 cursor-move">
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ index + 1 }}</td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                    {{ item.type ||  'URL Externa' }}
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap">
                    <img 
                      v-if="item.type && item.type.startsWith('image')" 
                      :src="item.preview" 
                      class="h-10 w-10 object-cover rounded"
                    >
                    <div v-else-if="item.url" class="flex items-center">
                      <span class="text-blue-500 underline truncate max-w-xs">{{ item.url }}</span>
                    </div>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                    <button 
                      @click="eliminarMultimedia(index)" 
                      type="button" 
                      class="text-red-600 hover:text-red-900"
                    >
                      Eliminar
                    </button>
                  </td>
                </tr>
                <tr v-if="form.multimedia.length === 0">
                  <td colspan="4" class="px-4 py-3 text-center text-sm text-gray-500">No hay archivos agregados</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>


        <DynamicTable v-model="form.detalles"/>
        <!-- Botón de enviar -->
        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors"
        >
          Guardar Producto
        </button>
      </form>

      <!-- Modal para nueva marca -->
      <div v-if="showMarcaModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
          <div class="p-6">
            <h2 class="text-xl font-bold mb-4">Agregar Nueva Marca</h2>
            
            <div class="mb-4">
              <label for="nuevaMarca" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la marca *</label>
              <input
                v-model="nuevaMarca.nombre"
                type="text"
                id="nuevaMarca"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
              >
            </div>
            
            <div class="flex justify-end gap-2">
              <button
                type="button"
                @click="showMarcaModal = false"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
              >
                Cancelar
              </button>
              <button
                type="button"
                @click="agregarMarca"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors"
              >
                Guardar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
export default {


  data() {
    return {
      nuevaUrl: '',
      form: {
        nombre: '',
        descripcion: '',
        marca: '',
        categorias: [],
        multimedia: [],
        detalles: {
          enabled: false, // true si el usuario decide añadirla
          headers: [
            { id: 1, nombre: 'Capacidad', visible: true },
            { id: 2, nombre: 'Dimensiones', visible: true },
            // ...otros headers agregados por el usuario
          ],
          rows: [
            {
              id: 1,
              valores: {
                1: '100 unidades', // Capacidad
                2: '20x30x40 cm', // Dimensiones
                // ...otros valores
              },
              pdf: null // Puede ser File object o URL string
            }
            // ...otras filas
          ]
        }
      },
      errors: {
        nombre: '',
        descripcion: '',
        marca: ''
      },
      categoriaSeleccionada: '',
      marcas: [
        { id: 1, nombre: 'Nike' },
        { id: 2, nombre: 'Adidas' },
        { id: 3, nombre: 'Puma' }
      ],
      categorias: [
        { id: 1, nombre: 'Electrónica' },
        { id: 2, nombre: 'Ropa' },
        { id: 3, nombre: 'Hogar' },
        { id: 4, nombre: 'Deportes' }
      ],
      showMarcaModal: false,
      nuevaMarca: {
        nombre: ''
      }
    }
  },
  methods: {
    goBack() {
      this.$router.go(-1); // Regresa a la página anterior en el historial
    },
    submitForm() {
      // Validación simple
      this.errors = {
        nombre: !this.form.nombre ? 'El nombre es requerido' : '',
        descripcion: !this.form.descripcion ? 'La descripción es requerida' : '',
        marca: !this.form.marca ? 'La marca es requerida' : ''
      };

      // Verificar si hay errores
      const hasErrors = Object.values(this.errors).some(error => error !== '');
      if (hasErrors) return;

      // Enviar formulario (aquí iría tu lógica para enviar a API)
      console.log('Formulario enviado:', this.form);
      alert('Formulario enviado con éxito!');
    },
    agregarCategoria() {
      if (this.categoriaSeleccionada && !this.form.categorias.includes(this.categoriaSeleccionada)) {
        this.form.categorias.push(this.categoriaSeleccionada);
        this.categoriaSeleccionada = '';
      }
    },
    eliminarCategoria(index) {
      this.form.categorias.splice(index, 1);
    },
    obtenerNombreCategoria(id) {
      const categoria = this.categorias.find(c => c.id == id);
      return categoria ? categoria.nombre : '';
    },
    agregarMarca() {
      if (!this.nuevaMarca.nombre) return;

      // Generar un nuevo ID (en una app real esto lo haría el backend)
      const newId = Math.max(...this.marcas.map(m => m.id)) + 1;

      // Agregar la nueva marca
      this.marcas.push({
        id: newId,
        nombre: this.nuevaMarca.nombre
      });

      // Seleccionar la nueva marca automáticamente
      this.form.marca = newId;

      // Resetear y cerrar modal
      this.nuevaMarca.nombre = '';
      this.showMarcaModal = false;
    },
    handleFileUpload(event) {
      const files = event.target.files;
      Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.form.multimedia.push({
            id: Date.now() + Math.random(),
            file,
            type: file.type,
            preview: e.target.result
          });
        };
        reader.readAsDataURL(file);
      });
    },
    agregarUrl() {
      if (this.nuevaUrl) {
        this.form.multimedia.push({
          id: Date.now() + Math.random(),
          url: this.nuevaUrl,
          type: null
        });
        this.nuevaUrl = '';
      }
    },
    eliminarMultimedia(index) {
      this.form.multimedia.splice(index, 1);
    }
  }
}
</script>

<!-- 
No me muestres el codigo qque acabas de generar solo indicame en donde va y dame el codigo que te  voy a pedir,
necesito 
1.- un campo para agregar imagenes o videos, pueden ser muchas, 
2.- tambien debe permitir urls si no se tiene el video
3.- estos se deben mostrar en una pequena

ok al igual que la tabla  no me des el codigo anterior solo indicame lo que va a llevar, necesito una tabla que se llame detalles,  esta tabla  tiene la particuliaridad de que 

1. EL usuario esta libre de poner  tabla o no  poner tabla,
2. los headers de las tablas las puede definir el usuario pero por defecto la tabla llevaria los campos  capacidad dimensiones pero igual pueden ser eliminados por el ususrio
3. el contenido de la tabla puede agregarlo el usuario
4. el unico header que  siempre llevara y siempre aparecera al final de la tabla es uno que diga PDF pero no es obligatorio

-->