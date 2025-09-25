<!-- <template>
    
    <Title content="PRODUCTOS"  />
    <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-sm ">
        <div>
            <input id="search" placeholder="Buscar" class="px-12 py-3 text-2xl text-slate-700 bg-slate-50 border-slate-400 rounded-full"/>
        </div>
        <div>
            <router-link to="/app/admin/product/add" class="px-3 py-2 flex flex-row items-center gap-3">
                <i class="bi bi-plus-square-fill text-[#4180ab] text-3xl"></i>
                <P class="text-2xl text-[#4180ab] align-middle ">Agregar</P>
            </router-link>
        </div>

        
    </div>
    <div class="mt-4 bg-white py-5 px-5 rounded-xl shadow-sm">
        <div class="product-table-container">
            <table class="product-table">
            <thead>
                <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Categorías</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in paginatedProducts" :key="product.id">
                <td>{{ product.id }}</td>
                <td>{{ product.nombre }}</td>
                <td>{{ product.marca }}</td>
                <td>{{ product.categorias.join(', ') }}</td>
                <td class="actions">
                    <button @click="editarProducto(product.id)" class="edit-btn">
                    Editar
                    </button>
                    <button @click="eliminarProducto(product.id)" class="delete-btn">
                    Eliminar
                    </button>
                </td>
                </tr>
            </tbody>
            </table>

            <div class="pagination">
            <button 
                @click="currentPage--" 
                :disabled="currentPage === 1"
                class="pagination-btn"
            >
                Anterior
            </button>
            <span>Página {{ currentPage }} de {{ totalPages }}</span>
            <button 
                @click="currentPage++" 
                :disabled="currentPage === totalPages"
                class="pagination-btn"
            >
                Siguiente
            </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      products: [
        { id: 1, nombre: 'Producto 1', marca: 'Marca A', categorias: ['Electrónica', 'Hogar'] },
        { id: 2, nombre: 'Producto 2', marca: 'Marca B', categorias: ['Ropa'] },
        { id: 3, nombre: 'Producto 3', marca: 'Marca C', categorias: ['Alimentos', 'Bebidas'] },
        { id: 4, nombre: 'Producto 4', marca: 'Marca A', categorias: ['Electrónica'] },
        { id: 5, nombre: 'Producto 5', marca: 'Marca D', categorias: ['Hogar'] },
        { id: 6, nombre: 'Producto 6', marca: 'Marca B', categorias: ['Juguetes'] },
        { id: 7, nombre: 'Producto 7', marca: 'Marca C', categorias: ['Electrónica', 'Oficina'] },
        { id: 8, nombre: 'Producto 8', marca: 'Marca E', categorias: ['Bebidas'] },
        { id: 9, nombre: 'Producto 9', marca: 'Marca A', categorias: ['Hogar', 'Cocina'] },
        { id: 10, nombre: 'Producto 10', marca: 'Marca F', categorias: ['Jardín'] },
      ],
      currentPage: 1,
      itemsPerPage: 5
    }
  },
  computed: {
    totalPages() {
      return Math.ceil(this.products.length / this.itemsPerPage)
    },
    paginatedProducts() {
      const start = (this.currentPage - 1) * this.itemsPerPage
      const end = start + this.itemsPerPage
      return this.products.slice(start, end)
    }
  },
  methods: {
    editarProducto(id) {
      console.log('Editar producto con ID:', id)
      // Aquí iría la lógica para editar
    },
    eliminarProducto(id) {
      console.log('Eliminar producto con ID:', id)
      // Aquí iría la lógica para eliminar
    }
  }
}
</script> -->


<template>
  <Title content="TODOS LOS PRODUCTOS"  />

  <div class="flex flex-row justify-between items-center mt-8 bg-white py-5 px-5 rounded-xl shadow-md ">
      <!-- <div>
          <input v-model="searchTerm" id="search" placeholder="Buscar" class="px-6 py-2 text-xl text-slate-700 bg-slate-50 border-slate-400 rounded-full"/>
      </div> -->
      <div>
        <router-link to="/app/admin/product/add" class="px-3 py-2 flex flex-row gap-2 hover:bg-slate-100 rounded-lg active:bg-slate-200 transition-all duration-100">
          <i class="bi bi-plus-square-fill text-[#4180ab] text-2xl"></i>
          <P class="text-lg text-[#4180ab] align-middle">Agregar</P>
        </router-link>
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
    <ProductTable
      :products="filteredProducts"
      :brands="brands"
      :categories="categories"
      :specareas="specAreas"
      @status-change="updateProductStatus"
      @search="handleSearch"
      @edit="handleEdit"
      @delete="confirmDelete"
    />
      
  </div>


  <Modal :visible="showDeleteModal" @close="showDeleteModal = false" title="">
    <div>
      <h2 class="text-lg font-medium mb-4 text-center">¿Estás seguro de eliminar este producto?</h2>
      <div class="flex justify-center space-x-8">
        <button
          @click="showDeleteModal = false"
          :disabled="loading"
          class="px-4 py-2 border-2 rounded-md w-32"
        >
          Cancelar
        </button>
        <button
          @click="deleteProduct"
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
  const products = ref([]);
  const searchTerm = ref('');
  const deleteId = ref(null);
  const loading = ref(false);
  const categories = ref(null);
  const specAreas = ref(null);
  const brands = ref(null);

  const router = useRouter();

  const emptyOffert = {
    title: '',
    details: '',
    image: null,
  };


  onMounted(async () => {

    fetchProducts();
  });

  const filteredProducts = computed(() => {
    if (!searchTerm.value) return products.value;
    const term = searchTerm.value.toLowerCase();
    return products.value.filter(product => 
      product.name.toLowerCase().includes(term) || 
      (product.description && product.description.toLowerCase().includes(term))
    )
  });

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

  const updateProductStatus = async ({ id, active }) => {
    try {
      const response = await fetch(`/api/product/${id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ active })
      });

    } catch (error) {
      console.error('Error updating offert status:', error);
    }
  };


  const fetchProducts = async () => {
    try {
      const response = await fetch('/api/product');
      const data = await response.json();
      if (data.success) {
        products.value = data.data;
        console.log(data.data);
      }
    } catch (error) {
      console.error('Error fetching product:', error);
    }
  };

  const handleSearch = (term) => {
    searchTerm.value = term;
  };

  const handleEdit = (product) => {
    currentOffert.value = {
      ...product
    };
    showModal.value = true;
  };

  const confirmDelete = (id) => {
    deleteId.value = id;
    showDeleteModal.value = true;
  };

  const deleteProduct = async () => {
    loading.value=true

    try {
      const response = await fetch(`/api/product/${deleteId.value}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });
      
      if (response.ok) {
        await fetchProducts(); // Refrescar la lista
        showDeleteModal.value = false;
      }
    } catch (error) {
      console.error('Error deleting product:', error);
    }
    loading.value=false

  };



</script>
