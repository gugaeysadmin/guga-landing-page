<template>
  <Title content="NUEVO PRODUCTO"  />
  <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
      <i class="bi bi-arrow-left-circle-fill text-xl text-blue-500"></i>
      <p class="underline font-medium text-lg text-blue-500 pb-1">Regresar</p>
  </button>
  
  <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
    <form @submit.prevent="submitForm" class=" w-full flex flex-wrap px-4 md:px-12 gap-6">
      
      <!-- name -->
      <div class="w-full py-2">
        <label for="name" class="block text-md font-medium text-cyan-800">Nombre *</label>
        <input
          id="name"
          v-model="formData.name"
          required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
        ></input>
      </div>

      <!-- description -->
      <div class="w-full py-2">
        <label for="description" class="block text-md font-medium text-cyan-800">Descripción *</label>
        <textarea
          id="description"
          v-model="formData.description"
          required
          rows="4"
          class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
        ></textarea>
      </div>

      <!-- brand -->
      <div class="mb-6 w-full ">
        <label class="block text-md font-medium text-cyan-800">Marca *</label>
        <div class="flex gap-2 mt-1">
          <select
            v-model="formData.brand_id"
            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          >
            <option value="" disabled selected>Selecciona una marca</option>
            <option v-for="brand in brands" :key="brand.id" :value="brand.id">
              {{ brand.name }}
            </option>
          </select>
          <button
            type="button"
            @click="showBrandModal = true"
            class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors w-24"
          >
            + Nueva
          </button>
        </div>
        <p v-if="errors.marca" class="mt-1 text-sm text-red-600">{{ errors.marca }}</p>
      </div>

      <!-- categories -->
      <div class="mb-6 w-full ">
        <label class="block text-md font-medium text-cyan-800">Categorías *</label>
        <div class="flex gap-2 mt-1">
          <select
            v-model="selectedCategorie"
            @change="addCategory"
            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option value="" disabled selected>Selecciona una categoría</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">
              {{ category.name }}
            </option>
          </select>
          <button
            type="button"
            @click="showCategoryModal = true"
            class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors w-24"
          >
            + Nueva
          </button>

        </div>
        
        <div class="mt-4 flex flex-wrap gap-2">
          <div
            v-for="(category, index) in formData.categories"
            :key="index"
            class="flex items-center bg-blue-100 text-blue-800 px-4 py-1 rounded-full text-sm"
          >
            {{ getCategoryName(category) }}
            <button
              type="button"
              @click="deleteCategory(index)"
              class="ml-2 text-blue-600 hover:text-blue-800"
            >
              &times;
            </button>
          </div>
        </div>
      </div>

      <!-- specAreas -->
      <div class="mb-6 w-full  ">
        <label class="block text-md font-medium text-cyan-800">Áreas de especialidad *</label>
        <div class="flex gap-2 mt-1">
          <select
            v-model="selectedSpecArea"
            @change="addSpecArea"
            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option value="" disabled selected>Selecciona una área de especialidad</option>
            <option v-for="specArea in specAreas" :key="specArea.id" :value="specArea.id">
              {{ specArea.name }}
            </option>
          </select>
        </div>
        
        <div class="mt-4 flex flex-wrap gap-2">
          <div
            v-for="(specArea, index) in formData.specAreas"
            :key="index"
            class="flex items-center bg-blue-100 text-blue-800 px-4 py-1 rounded-full text-sm"
          >
            {{ getSpecAreaName(specArea) }}
            <button
              type="button"
              @click="deleteSpecArea(index)"
              class="ml-2 text-blue-600 hover:text-blue-800"
            >
              &times;
            </button>
          </div>
        </div>
      </div>

      <!-- Switch para activar/desactivar accesorios -->
      <div class="flex items-center">
        <label class="flex items-center cursor-pointer">
          <div class="relative">
            <input 
              type="checkbox" 
              class="sr-only" 
              v-model="accesoryPdfEnabled"
              @change="toggleAccesoryPdf"
            >
            <div class="block bg-gray-300 w-10 h-6 rounded-full"></div>
            <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
          </div>
          <div class="ml-3 text-sm font-medium">Tiene accesorios</div>
        </label>
      </div>

      <!-- Accesorios -->
      <div v-if="accesoryPdfEnabled" class="mb-4 pl-8 w-full md:gap-4 flex flex-col ">
        <div class="flex gap-8 items-end">
          <div class="w-full">
            <label class="block text-md font-medium text-cyan-800">Selecciona el pdf con el catálogo de accesorios</label>
            <div class="flex gap-2">
              <div class="flex gap-2 mt-1 w-full">
                <select
                  v-model="formData.catalogaccesrorypdf"
                  class="flex-1 px-3 py-[0.39rem] border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="" disabled selected>Selecciona una pdf</option>
                  <option v-for="accesoryDoc in accesoryDocs" :key="accesoryDoc.id" :value="accesoryDoc.id">
                    {{ accesoryDoc.name }}
                  </option>
                </select>
              </div>
              <button
                type="button"
                @click="showPdfModal = true"
                class="px-3 py-2 mt-1 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors min-w-24"
              >
                + Nueva
              </button>
            </div>
          </div>
          <div class="">
            <label for="name" class="block text-md font-medium text-cyan-800">Número de página *</label>
            <input
              id="name"
              type="number"
              v-model="formData.has_page"
              
              required
              class="mt-1 rounded-md  border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            ></input>
          </div>
        </div>

        <div class="w-full mt-4">
          <div>
              <label class="block text-md font-medium text-cyan-800">ó Sube el pdf con los accesorios específicos para este producto. </label>
              <input 
                type="file" 
                multiple 
                accept=".pdf" 
                @change="handleFileUploadAccesoryPdf" 
                class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
              >
            </div>
        </div>
      </div>

      <!-- Switch para activar/desactivar servicios -->
      <div class="flex w-full">
        <label class="flex items-center cursor-pointer">
          <div class="relative">
            <input 
              type="checkbox" 
              class="sr-only" 
              v-model="servicesEnabled"
              @change="toggleServices"
            >
            <div class="block bg-gray-300 w-10 h-6 rounded-full"></div>
            <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
          </div>
          <div class="ml-3 text-sm font-medium">Tiene servicios</div>
        </label>
      </div>
      <div v-if="servicesEnabled" class=" flex pl-8  flex-col w-full">
        <label class="block text-md font-medium text-cyan-800">Ingresa la descripción de los servicios</label>
        <QuillEditor 
          v-model:content="formData.services_description" 
          content-type="html"
          theme="snow" 
          :toolbar="[
             [{ 'font': [] }, { 'size': [] }],
              [ 'bold', 'italic', 'underline', 'strike' ],
              [{ 'color': [] }, { 'background': [] }],
              [, 'blockquote' ],
              [{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
              [ 'direction', { 'align': [] }],
              [ 'link', 'image' ]
    
          ]" 
  
        />
      </div>

      <!-- Switch para activar/desactivar la tabla -->
      <div class="flex w-full">
        <label class="flex items-center cursor-pointer">
          <div class="relative">
            <input 
              type="checkbox" 
              class="sr-only" 
              v-model="tableEnabled"
              @change="toggleTable"
            >
            <div class="block bg-gray-300 w-10 h-6 rounded-full"></div>
            <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
          </div>
          <div class="ml-3 text-sm font-medium">Tiene tabla</div>
        </label>
      </div>
      
      <!-- Tabla -->
      <div v-if="tableEnabled" class="flex pl-8 flex-col w-full">

        <div class="mb-6 w-full ">
          <label class="block text-md font-medium text-cyan-800">Selecciona las columnas de la tabla *</label>
          <div class="flex gap-2 mt-1">
            <select
              @change = "handleSelectTableHeader"
              v-model="selectedTableHeader"
              class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            >
              <option value="" disabled selected>Selecciona una configuración de columnas</option>
              <option v-for="tableHeader in tableHeaders" :key="tableHeader.id" :value="tableHeader.id">
                {{ tableHeader.name }}
              </option>
              
            </select>
            <button
              type="button"
              @click="showTableConfigModal = true"
              class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors w-24"
            >
              + Nueva
            </button>
          </div>
        </div>

        <div v-if="selectedTableHeader !== ''" class="overflow-x-auto">
          <label for="newTableName" class="block text-md font-medium text-cyan-800 mb-1">Vista previa de la tabla</label>
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Eliminar</th>
                <th v-for="(header, index) in formData.table_data.headers" :key="index" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ header }}</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(row, rowIndex) in formData.table_data.table" :key="rowIndex">
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                    <button
                        @click="handleRemoveTableRow( rowIndex)"
                        class="text-red-600 hover:text-red-900"
                    >
                        Eliminar
                    </button>
                  </td>
                  <td v-for="(header, headerIndex) in formData.table_data.headers" :key="headerIndex">
                    <div v-if="header == 'imagen'" class="flex items-center gap-2 px-1">
                      <input
                        type="file"
                        accept="image/*"
                        @change="handleRowImgUpload($event, rowIndex)"
                        class="hidden"
                        :id="'image-upload-'+rowIndex"
                      >
                      <label 
                        :for="'image-upload-'+rowIndex"
                        class="cursor-pointer w-28 inline-flex justify-center rounded-md border border-transparent bg-indigo-400 disabled:bg-indigo-300 py-1 px-4 text-xs font-medium text-white shadow-sm hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                      >
                        {{ row.imagen ? 'Cambiar Imagen' : 'Subir Imagen' }}
                      </label>
                      <span v-if="row.imagen" class="text-xs text-gray-500">
                        {{ row.imagen.name || 'Imagen adjunto' }}
                      </span>
                    </div>
                    <div v-else-if="header == 'pdf'" class="flex items-center gap-2 px-1">
                      <input
                        type="file"
                        accept=".pdf"
                        @change="handleRowPdfUpload($event, rowIndex)"
                        class="hidden"
                        :id="'pdf-upload-'+rowIndex"
                      >
                      <label 
                        :for="'pdf-upload-'+rowIndex"
                        class="cursor-pointer w-28 inline-flex justify-center rounded-md border border-transparent bg-indigo-400 disabled:bg-indigo-300 py-1 px-4 text-xs font-medium text-white shadow-sm hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                      >
                        {{ row.pdf ? 'Cambiar PDF' : 'Subir PDF' }}
                      </label>
                      <span v-if="row.pdf" class="text-xs text-gray-500 min-w-20">
                        {{ row.pdf.name || 'PDF adjunto' }}
                      </span>
                    </div>
                    <div v-else class="px-1">
                      <input
                        v-model="row[header]"
                        :placeholder="tupla"
                        class="mt-1 block rounded-md  w-40 min-w-40 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                      ></input>

                    </div>
                
                  </td>
              </tr>
            </tbody>
          </table>
          <div v-if="selectedTableHeader !== ''" class=" py-3 px-1 flex justify-center text-sm text-gray-500">
            <button
              type="button"
              @click="handleAddTableRow"
              class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 disabled:bg-indigo-300 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
              + Nueva fila
            </button>
          </div >
        </div>
      </div>


      <!-- image or url upload -->
      <div class="w-full mt-8"> 
        <!-- Uploads -->
        <div class="mb-6">
          <label class="block text-md font-medium text-cyan-800">Multimedia (Imágenes/Videos)</label>
          
          <div class="flex flex-col gap-4 mt-4">
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
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1 mt-4">O ingresar URL</label>
              <div class="flex gap-2 ">
                <input 
                  v-model="newUrl" 
                  type="url" 
                  placeholder="https://ejemplo.com/video.mp4" 
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button 
                  @click="addUrl" 
                  type="button" 
                  class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
                >
                  Agregar URL
                </button>
              </div>
            </div>
          </div>
        </div>
  
        <!-- table -->
        <div class="mb-6">
          <label class="block text-md font-medium text-cyan-800 mb-1">Archivos agregados</label>
          
          <div class="overflow-x-auto mt-2">
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
                <tr 
                  v-for="(item, index) in formData.productImages" 
                  :key="item.id" 
                  draggable="true"
                  @dragstart="handleDragStart($event, index)"
                  @dragover.prevent="handleDragOver($event, index)"
                  @dragenter.prevent="handleDragEnter($event, index)"
                  @dragleave="handleDragLeave($event)"
                  @drop="handleDrop($event, index)"
                  @dragend="handleDragEnd"
                  :class="{
                      'bg-blue-50': dragOverIndex === index,
                      'cursor-move': !isDragging,
                      'opacity-50': isDragging && draggedItemIndex === index
                  }"
                >
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ item.index }}</td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                    {{ item.type ||  'URL Externa' }}
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap">
                    <img 
                      v-if="item.type && item.type.startsWith('image')" 
                      :src="item.preview" 
                      class="h-10 w-10 object-cover rounded"
                    >
                    <div 
                      v-else-if="item.type && item.type.startsWith('video')" 
                      class="flex items-center"
                    >
                      <span class="text-blue-500 underline truncate max-w-xs">{{ item.name }}</span>
                    </div>
                    <div v-else-if="item.url" class="flex items-center">
                      <span class="text-blue-500 underline truncate max-w-xs">{{ item.url }}</span>
                    </div>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                    <button 
                      @click="deletePriductImage(index)" 
                      type="button" 
                      class="text-red-600 hover:text-red-900"
                    >
                      Eliminar
                    </button>
                  </td>
                </tr>
                <tr v-if="formData.productImages.length === 0">
                  <td colspan="4" class="px-4 py-3 text-center text-sm text-gray-500">No hay archivos agregados</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <!-- Botones  -->
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
            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 disabled:bg-indigo-300 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          >
            {{ loading? "Guardando" : "Guardar" }}
          </button>
        </div>
      </div>
    </form>

    <div v-if="showBrandModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
          <h2 class="text-xl font-bold mb-4">Agregar Nueva Marca</h2>
          
          <div class="mb-4">
            <label for="nuevaMarca" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la marca *</label>
            <input
              v-model="newBrand"
              type="text"
              id="nuevaMarca"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            >
          </div>
          
          <div class="flex justify-end gap-2">
            <button
              type="button"
              @click="showBrandModal = false, newBrand = null"
              class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
            >
              Cancelar
            </button>
            <button
              @click="createBrand"
              :disabled = "loading"
              class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 disabled:bg-indigo-300 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
              {{ loading? "Guardando" : "Guardar" }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <div v-if="showCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
          <h2 class="text-xl font-bold mb-4">Agregar Nueva Categoría</h2>
          
          <div class="mb-4">
            <label for="newCategory" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la categoría *</label>
            <input
              v-model="newCategory"
              type="text"
              id="newCategory"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            >
          </div>
          
          <div class="flex justify-end gap-2">
            <button
              type="button"
              @click="showCategoryModal = false, newCategory = null"
              class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
            >
              Cancelar
            </button>
            <button
              @click="createCategories"
              :disabled = "loading"
              class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 disabled:bg-indigo-300 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
              {{ loading? "Guardando" : "Guardar" }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <div v-if="showTableConfigModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg shadow-xl w-full max-w-xl">
        <form  class="p-6 w-full">
          <h2 class="text-xl font-bold mb-4">Agregar nueva tabla</h2>
          
          <div class="mb-4">
            <label for="newTableName" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la tabla *</label>
            <input
              v-model="newTableConf.name"
              type="text"
              id="newTableName"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            >
          </div>
          <div class="w-full  py-2">
            <div>
              <label for="name" class="block text-md font-medium text-cyan-800">Nombre de la columna </label>
              <div class="flex gap-2">
                <input
                  id="name"
                  v-model="newHeader"
                  required
                  class="mt-1 block flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                ></input>
                <button
                  type="button"
                  @click="addTableHeader"
                  class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors w-24"
                >
                  + Nueva
                </button>
              </div>
            </div>
          </div>
          <p class="text-xs"><b>Nota:</b> no se pueden agregar columnas con el mismo nombre</p>


          <div class="overflow-x-auto mt-5">
            <label for="newTableName" class="block text-md font-medium text-cyan-800 mb-1">Vista previa de la tabla</label>
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th v-for="(item, index) in newTableConf.headers" :key="index" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ item }}</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                  <td colspan="4" class="px-4 py-3 text-center text-sm text-gray-500">Datos de la tabla</td>
                </tr>
              </tbody>
            </table>
          </div>
          
          <div class="flex justify-end gap-2">
            <button
              type="button"
              @click="closeTableHeaderConf"
              class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
            >
              Cancelar
            </button>
            <button
              @click="createTableHeader"
              type="submit"
              :disabled = "loading"
              class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 disabled:bg-indigo-300 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
              {{ loading? "Guardando" : "Guardar" }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <div v-if="showPdfModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg shadow-xl w-full max-w-xl">
        <form  class="p-6 w-full">
          <h2 class="text-xl font-bold mb-4">Agregar nuevo catálogo de accesorios</h2>
          <div  class="space-y-6">
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700"
                >Título *</label
              >
              <input
                type="text"
                id="title"
                v-model="formDataPdf.title"
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
              />
              <p v-if="errors.title" class="mt-1 text-sm text-red-600">
                {{ errorsPdf.title }}
              </p>
            </div>
        
            <div>
              <label class="block text-sm font-medium text-gray-700">Pdf *</label>
              <div
                @click="openFilePicker"
                @dragover.prevent="dragOver = true"
                @dragleave="dragOver = false"
                @drop.prevent="handleDropPdf"
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
              <p v-if="errorsPdf.image" class="mt-1 text-sm text-red-600">
                {{ errorsPdf.image }}
              </p>
            </div>
        
          </div>
          <div class="flex justify-end gap-2 mt-4">
            <button
              type="button"
              @click="closePdfModal"
              class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
            >
              Cancelar
            </button>
            <button
              @click="handleSubmitPdf"
              type="submit"
              :disabled = "loading"
              class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 disabled:bg-indigo-300 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
              {{ loading? "Guardando" : "Guardar" }}
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</template>
<script setup>
  import { FwbProgress } from 'flowbite-vue';
  import { ref, computed, onMounted, reactive } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  import { Ckeditor, useCKEditorCloud } from '@ckeditor/ckeditor5-vue';

  const editorOptions = {
    theme: 'snow',
    placeholder: 'Escribe algo bonito...',
  };

  const loading = ref(false);
  const categories = ref(null);
  const selectedCategorie = ref("");
  const selectedSpecArea = ref("");
  const selectedTableHeader = ref("");


  const specAreas = ref(null);
  const brands = ref(null);
  const accesoryDocs = ref(null);
  const tableHeaders = ref(null);

  const showBrandModal = ref(false);
  const showPdfModal = ref(false)
  const showCategoryModal = ref(false);
  const showTableConfigModal = ref(false);

  
  const newBrand = ref(null);
  const newCategory = ref(null);
  const newUrl = ref(null);
  const newHeader = ref(null);
  const newTableConf = ref({
    name: null,
    headers: ["pdf"]
  })

  const draggedItemIndex = ref(null);
  const dragOverIndex = ref(null);
  const isDragging = ref(false);


  const dragOver = ref(false);
  const fileInput = ref(null);
  const selectedFile = ref(null);
  const previewImage = ref(null);



  const accesoryPdfEnabled = ref(false)
  const servicesEnabled = ref(false)
  const tableEnabled = ref(false)
  const formData = ref({
    name: '',
    description: '',
    has_table: false,
    product_services: '',
    brand_id: '',
    table_data: {
      headers: [],
      table: []
    },
    has_accesrorypdf: false,
    accesorypdf: null,
    has_page: 0,
    has_services: false,
    services_description: '',
    catalogaccesrorypdf: "",
    productImages: [],
    categories: [],
    specAreas: []
  })

  const formDataPdf = ref({
    title: '',
    image: null,
  });

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


  const router = useRouter();

  onMounted(async () => {
    fetchCategories();
    fetchSpecAreas();
    fetchBrands();
    fetchAccesoryDocs();
    fetchTableHeaders();
  });
  
  const  goBack = () => {
    router.back()
  }

  const submitForm = async (data) => {
    loading.value=true;
    console.log(formData.value);
    try{
      const form = new FormData();
      form.append('name', formData.value.name);
      form.append('description', formData.value.description);
      form.append('services_description', formData.value.services_description);
      form.append('has_table', formData.value.has_table);
      form.append('has_services', formData.value.has_services);
      form.append('has_page', formData.value.has_page); //page
      form.append('has_accesrorypdf', formData.value.has_accesrorypdf);
      form.append('catalogaccesrorypdf', formData.value.catalogaccesrorypdf); //cat accesory pdf id
      form.append('brand_id', formData.value.brand_id);
      form.append('product_services', formData.value.product_services);
      form.append('accesorypdf', formData.value.accesorypdf);
      form.append('table_data_headers', JSON.stringify(formData.value.table_data.headers));
      form.append('categories', JSON.stringify(formData.value.categories));
      form.append('specAreas', JSON.stringify(formData.value.specAreas));
      form.append('table_data', formData.value.table_data.table);
      formData.value.table_data.table.forEach((row,index) => {
        formData.value.table_data.headers.forEach((header, HeaderIndex) => {
          form.append(`table_data[${index}][${header}]`, row[header]);
        })
      })
      formData.value.productImages.forEach((image, index) => {
        // Si necesitas enviar metadatos adicionales
        form.append(`productImages[${index}][file]`, image.file);
        form.append(`productImages[${index}][name]`, image.name);
        form.append(`productImages[${index}][url]`, image.url);
        form.append(`productImages[${index}][type]`, image.type);
        form.append(`productImages[${index}][index]`, image.index);
        // ... otros metadatos
      });

      const response = await fetch('/api/product/create', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: form
      })

      // const response = await axios.post('/api/product/create', formData.value, {
      //   headers: {
      //     'Content-Type': 'application/json', // Importante
      //     'Accept': 'application/json',
      //     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      //   }
      // })
      if(response.ok){
        console.log(response);
        router.back()
      }

    } catch (error) {
      console.error('Error:', error);
      // Mostrar error al usuario
      errors.value.submit = 'Error al guardar el producto';
      loading.value=false

    }
    loading.value=false
  }

  // Fetching data

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

  const fetchSpecAreas = async () => {
    try {
      const response = await fetch('/api/speciality-areas');
      const data = await response.json();
      if (data.success) {
        specAreas.value = data.data;
      }
    } catch (error) {
      console.error('Error fetching speciality-areas:', error);
    }
  };

  const fetchAccesoryDocs = async () => {
    try {
      const response = await fetch('/api/accesory-pdf');
      const data = await response.json();
      if (data.success) {
        accesoryDocs.value = data.data;
      }
    } catch (error) {
      console.error('Error fetching accesory-pdf:', error);
    }
  };

  const fetchTableHeaders = async () => {
    try {
      const response = await fetch('/api/th-conf');
      const data = await response.json();
      if (data.success) {
        tableHeaders.value = data.data;
      }
    } catch (error) {
      console.error('Error fetching tableHeaders:', error);
    }
  };

  const fetchBrands = async () => {
    try {
      const response = await fetch('/api/brand');
      const data = await response.json();
      if (data.success) {
        brands.value = data.data;
      }
    } catch (error) {
      console.error('Error fetching brand:', error);
    }
  };


  // Brands

  const createBrand = async () => {
    loading.value=true
    try {
      const form = new FormData();
      form.append('name', newBrand.value);

      const response = await fetch('/api/brand/create-on', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: form
      });

      if (!response.ok) throw new Error('Error al guardar');

      const data = await response.json();
      showBrandModal.value = false;
      loading.value=false;
      newBrand.value = null;
      await fetchBrands();
      
    } catch (error) {
      console.error('Error:', error);
      // Mostrar error al usuario
      errors.value.submit = 'Error al guardar la marca';
      loading.value=false

    }
    loading.value=false

  };


  // Categories

  const addCategory= ()=> {
    if (selectedCategorie && !formData.value.categories.includes(selectedCategorie.value)) {
      formData.value.categories.push(selectedCategorie.value);
    }
    selectedCategorie.value = "";
  }

  const deleteCategory = (index) => {
    formData.value.categories.splice(index, 1);
  }

  const getCategoryName = (id)=> {
    const category = categories.value.find(c => c.id == id);
    return category ? category.name : '';
  }

  const createCategories = async (formData) => {
    loading.value=true
    try {
      const form = new FormData();
      form.append('title',newCategory.value );

      const response = await fetch('/api/category/create', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: form
      });

      if (!response.ok) throw new Error('Error al guardar');
      showCategoryModal.value = false;
      loading.value=false;
      newCategory.value = null;
      await fetchCategories();
      
    } catch (error) {
      console.error('Error:', error);
      errors.value.submit = 'Error al guardar la categoria';
      loading.value=false

    }
    loading.value=false

  };


  // SpecArea
  const addSpecArea= ()=> {
    if (selectedSpecArea && !formData.value.specAreas.includes(selectedSpecArea.value)) {
      formData.value.specAreas.push(selectedSpecArea.value);
      selectedSpecArea.value = "";
    }
  }

  const deleteSpecArea = (index) => {
    formData.value.specAreas.splice(index, 1);
  }

  const getSpecAreaName = (id)=> {
    const specArea = specAreas.value.find(c => c.id == id);
    return specArea ? specArea.name : '';
  }


// accesorios pdf
  const toggleAccesoryPdf = () => {
    
    if(!accesoryPdfEnabled.value){
      formData.value.catalogaccesrorypdf = "";
      formData.value.has_page = 0;
      formData.value.has_accesrorypdf = false ;
      formData.value.accesorypdf = null
    }
    formData.value.has_accesrorypdf = accesoryPdfEnabled.value;

  }

  const handleFileUploadAccesoryPdf = (event) => {
    const file = event.target.files[0];;
    formData.value.accesorypdf = file;
  }

  const closePdfModal = () => {
    previewImage.value = null
    formDataPdf.value.image = null;
    formDataPdf.value.title = "";
    fileInput.value = null;
    selectedFile.value = null;
    showPdfModal.value = false;
  }

  const validatePdf = () => {
      let valid = true;
      errorsPdf.value = { title: '', image: '' };
  
      if (!formDataPdf.value.title.trim()) {
      errorsPdf.value.title = 'El título es obligatorio';
      valid = false;
      }
  
      if (!selectedFile.value) {
      errorsPdf.value.image = 'El pdf es obligatorio';
      valid = false;
      }
  
      return valid;
  };

  const openFilePicker = () => {
      fileInput.value.click();
  };

  const handleFileChange = (e) => {
      const file = e.target.files[0];
      processFile(file);
  };

  const handleDropPdf = (e) => {
      dragOver.value = false;
      const file = e.dataTransfer.files[0];
      processFile(file);
  };

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
      formDataPdf.value.image = file;
      previewImage.value = URL.createObjectURL(file);
      errors.value.image = '';
  };

  const removeImage = (e) => {
    e.stopPropagation();
    selectedFile.value = null;
    previewImage.value = null;
    formDataPdf.value.image = null;
    if (fileInput.value) {
      fileInput.value.value = '';
    }
  };

  const formatFileSize = (bytes) => {
      if (bytes === 0) return '0 Bytes';
      const k = 1024;
      const sizes = ['Bytes', 'KB', 'MB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
  };

  const handleSubmitPdf = () => {
      if (validatePdf()) {
      const dataToSubmit = {
        title: formDataPdf.value.title,
        image: selectedFile.value || props.initialData?.image,
      };
      createPdfAccesory(dataToSubmit);
      }
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
      showPdfModal.value = false;
      formDataPdf.value.image = null;
      formDataPdf.value.title = "";
      fileInput.value = null;
      selectedFile.value = null;
      previewImage.value = null;
      await fetchAccesoryDocs();
      
    } catch (error) {
      console.error('Error:', error);
      // Mostrar error al usuario
      loading.value=false
      errors.value.submit = 'Error al guardar la accesory-pdf';
    }
    loading.value=false

  };
  


  // services text
  const toggleServices = () => {

    if(!servicesEnabled.value){
      formData.value.services_description = ""
      formData.value.has_services = false ;
    }
    formData.value.has_services = servicesEnabled.value;
  }


  // Table

  const toggleTable = () => {
    if(!tableEnabled.value){
      formData.value.has_table = false
      formData.value.table_data.headers = [] ;
      formData.value.table_data.table = [] ;
      selectedTableHeader.value = ""
    }
    formData.value.has_table = tableEnabled.value;
  }

  const closeTableHeaderConf = () => {
    showTableConfigModal.value = false;
    newTableConf.value.name = null;
    newTableConf.value.headers = ["pdf"]
  }

  const addTableHeader = () => {
    if(newTableConf.value.headers && newTableConf.value.headers !== "" && !newTableConf.value.headers.includes(newHeader.value)){
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
      showTableConfigModal.value = false;
      loading.value=false;
      newTableConf.value.name = null;
      newTableConf.value.headers = ["pdf"]

      await fetchTableHeaders();
      
    } catch (error) {
      console.error('Error:', error);
      errors.value.submit = 'Error al guardar la categoria';
      loading.value=false

    }
    loading.value=false
  }

  const handleSelectTableHeader = () => {
    const tableConf = tableHeaders.value.find((e) => e.id == selectedTableHeader.value );
    formData.value.table_data.headers = JSON.parse(tableConf.table_json).headers
    formData.value.table_data.table = []    
  }

  const handleAddTableRow = () => {

    const rowObject = Object.fromEntries(
      formData.value.table_data.headers.map(header => [header,""])
    )
    formData.value.table_data.table.push(rowObject);
  }

  const handleRemoveTableRow = (index) => {
    formData.value.table_data.table.splice(index,1)
  }

  const handleRowPdfUpload = (event, rowIndex) => {
    const file = event.target.files[0];
    if (file) {
      formData.value.table_data.table[rowIndex].pdf = file;
    }
  }

  const handleRowImgUpload = (event, rowIndex) => {
    const file = event.target.files[0];
    if (file) {
      formData.value.table_data.table[rowIndex].imagen = file;
    }
  }



  // images

  const handleFileUpload = (event) => {
    const files = event.target.files;
    Array.from(files).forEach(file => {
      const reader = new FileReader();
      reader.onload = (e) => {
        formData.value.productImages.push({
          id: Date.now() + Math.random(),
          file,
          type: file.type,
          name: file.name,
          preview: e.target.result,
          index: formData.value.productImages.length + 1,
        });
      };
      reader.readAsDataURL(file);
    });
  }

  const addUrl = () => {
    if (newUrl) {
      formData.value.productImages.push({
        id: Date.now() + Math.random(),
        url: newUrl.value,
        type: 'url',
        index: formData.value.productImages.length + 1,
      });
      newUrl.value = '';
    }
  }

  const deletePriductImage = (index) => {
    // formData.value.productImages.splice(index, 1);
    formData.value.productImages = formData.value.productImages
        .filter((_, i) => i !== index)
        .map((item, idx) => ({ ...item, index: idx + 1 }));
  }

  const handleDragStart = (event, index) => {
      draggedItemIndex.value = index;
      isDragging.value = true;
      event.dataTransfer.effectAllowed = 'move';
      event.dataTransfer.setData('text/plain', index);
  };

  const handleDragOver = (event, index) => {
      event.preventDefault();
      dragOverIndex.value = index;
  };

  const handleDragEnter = (event, index) => {
      event.preventDefault();
      dragOverIndex.value = index;
  };

  const handleDragLeave = () => {
      dragOverIndex.value = null;
  };

  const handleDrop = (event, dropIndex) => {
      event.preventDefault();
      if (draggedItemIndex.value === null || draggedItemIndex.value === dropIndex) return;
      
      const reorderedOfferts = [...formData.value.productImages];
      const [movedItem] = reorderedOfferts.splice(draggedItemIndex.value, 1);
      reorderedOfferts.splice(dropIndex, 0, movedItem);
      
      // Actualizar índices
      reorderedOfferts.forEach((offert, idx) => {
          offert.index = idx + 1;
      });
      formData.value.productImages = [...reorderedOfferts];
      dragOverIndex.value = null;
  };
  
  const handleDragEnd = () => {
      isDragging.value = false;

      draggedItemIndex.value = null;
      dragOverIndex.value = null;
  };




</script>

<style scoped>
  @import "quill/dist/quill.snow.css";

  input[type="checkbox"]:checked ~ .dot {
    transform: translateX(100%);
    background-color: #3B82F6;
  }
  input[type="checkbox"]:checked ~ .block {
    background-color: #93C5FD;
  }
</style>
