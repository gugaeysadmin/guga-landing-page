<template>
    <div class="border rounded-lg p-4 bg-gray-50">
      <!-- Switch para activar/desactivar tabla -->
      <div class="flex items-center mb-4">
        <label class="flex items-center cursor-pointer">
          <div class="relative">
            <input 
              type="checkbox" 
              class="sr-only" 
              v-model="enabled"
              @change="toggleTable"
            >
            <div class="block bg-gray-300 w-10 h-6 rounded-full"></div>
            <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
          </div>
          <div class="ml-3 text-sm font-medium">Incluir tabla de detalles</div>
        </label>
      </div>
  
      <!-- Contenido de la tabla (solo visible si enabled=true) -->
      <div v-if="enabled" class="space-y-4">
        <!-- Configuración de columnas -->
        <div class="bg-white p-3 rounded border">
          <h4 class="font-medium mb-2">Columnas de la tabla</h4>
          <div class="flex flex-wrap gap-2 mb-3">
            <div 
              v-for="(header, index) in headers" 
              :key="header.id"
              class="flex items-center bg-gray-100 px-3 py-1 rounded-full"
            >
              <span class="mr-2">{{ header.name }}</span>
              <button 
                v-if="header.removable"
                @click="removeHeader(index)"
                class="text-gray-500 hover:text-red-500"
              >
                &times;
              </button>
            </div>
          </div>
          
          <div class="flex gap-2">
            <input
              v-model="newHeaderName"
              placeholder="Nueva columna"
              class="flex-1 px-3 py-1 border rounded"
            >
            <button
              @click="addHeader"
              class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600"
            >
              Agregar
            </button>
          </div>
        </div>
  
        <!-- Tabla de datos -->
        <div class="overflow-x-auto">
          <table class="min-w-full border">
            <thead>
              <tr>
                <th 
                  v-for="header in headers" 
                  :key="header.id"
                  class="px-4 py-2 bg-gray-100 border-b"
                >
                  {{ header.name }}
                </th>
                <th class="px-4 py-2 bg-gray-100 border-b">PDF</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(row, rowIndex) in rows" :key="row.id">
                <td 
                  v-for="header in headers" 
                  :key="header.id"
                  class="px-4 py-2 border-b"
                >
                  <input
                    v-model="row.values[header.id]"
                    class="w-full px-2 py-1 border rounded"
                  >
                </td>
                <td class="px-4 py-2 border-b">
                  <div class="flex items-center gap-2">
                    <input
                      type="file"
                      accept=".pdf"
                      @change="handlePdfUpload($event, rowIndex)"
                      class="hidden"
                      :id="'pdf-upload-'+rowIndex"
                    >
                    <label 
                      :for="'pdf-upload-'+rowIndex"
                      class="cursor-pointer text-blue-500 hover:text-blue-700 text-sm"
                    >
                      {{ row.pdf ? 'Cambiar PDF' : 'Subir PDF' }}
                    </label>
                    <span v-if="row.pdf" class="text-xs text-gray-500">
                      {{ row.pdf.name || 'PDF adjunto' }}
                    </span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
  
        <!-- Controles de filas -->
        <div class="flex justify-between">
          <button
            @click="addRow"
            class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600"
          >
            + Agregar fila
          </button>
          <button
            v-if="rows.length > 0"
            @click="removeLastRow"
            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
          >
            - Eliminar última fila
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      modelValue: {
        type: Object,
        default: () => ({})
      }
    },

    name: 'DynamicTable',
  
    emits: ['update:modelValue'],
  
    data() {
      return {
        enabled: false,
        newHeaderName: '',
        defaultHeaders: [
          { id: 'capacity', name: 'Capacidad', removable: true },
          { id: 'dimensions', name: 'Dimensiones', removable: true }
        ],
        headers: [],
        rows: []
      }
    },
  
    watch: {
      modelValue: {
        immediate: true,
        handler(newVal) {
          if (newVal && newVal.enabled) {
            this.enabled = newVal.enabled;
            this.headers = newVal.headers || [...this.defaultHeaders];
            this.rows = newVal.rows || [this.newEmptyRow()];
          }
        }
      },
      
      deepData: {
        deep: true,
        handler() {
          this.emitUpdate();
        }
      }
    },
  
    computed: {
      deepData() {
        return {
          enabled: this.enabled,
          headers: this.headers,
          rows: this.rows
        };
      }
    },
  
    methods: {
      toggleTable() {
        if (this.enabled && this.rows.length === 0) {
          this.rows = [this.newEmptyRow()];
        }
        this.emitUpdate();
      },
  
      addHeader() {
        if (this.newHeaderName.trim()) {
          const newId = 'custom-' + Date.now();
          this.headers.push({
            id: newId,
            name: this.newHeaderName.trim(),
            removable: true
          });
          this.newHeaderName = '';
          
          // Asegurar que todas las filas tengan el nuevo campo
          this.rows.forEach(row => {
            this.$set(row.values, newId, '');
          });
        }
      },
  
      removeHeader(index) {
        const headerId = this.headers[index].id;
        this.headers.splice(index, 1);
        
        // Eliminar el campo de todas las filas
        this.rows.forEach(row => {
          delete row.values[headerId];
        });
      },
  
      addRow() {
        this.rows.push(this.newEmptyRow());
      },
  
      removeLastRow() {
        if (this.rows.length > 0) {
          this.rows.pop();
        }
      },
  
      newEmptyRow() {
        const values = {};
        this.headers.forEach(header => {
          values[header.id] = '';
        });
        
        return {
          id: Date.now() + Math.random(),
          values,
          pdf: null
        };
      },
  
      handlePdfUpload(event, rowIndex) {
        const file = event.target.files[0];
        if (file) {
          this.rows[rowIndex].pdf = file;
        }
      },
  
      emitUpdate() {
        this.$emit('update:modelValue', {
          enabled: this.enabled,
          headers: this.headers,
          rows: this.rows
        });
      }
    }
  }
  </script>
  
  <style scoped>
  input[type="checkbox"]:checked ~ .dot {
    transform: translateX(100%);
    background-color: #3B82F6;
  }
  input[type="checkbox"]:checked ~ .block {
    background-color: #93C5FD;
  }
  </style>