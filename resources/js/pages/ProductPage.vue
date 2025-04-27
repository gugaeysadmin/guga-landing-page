<template>
    
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
</script>

<style scoped>
.product-table-container {
  width: 100%;
  overflow-x: auto;
}

.product-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 1rem;
}

.product-table th, .product-table td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.product-table th {
  background-color: #f8f9fa;
  font-weight: 600;
}

.actions {
  display: flex;
  gap: 8px;
}

.edit-btn, .delete-btn {
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
}

.edit-btn {
  background-color: #4e73df;
  color: white;
}

.delete-btn {
  background-color: #e74a3b;
  color: white;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 16px;
  margin-top: 20px;
}

.pagination-btn {
  padding: 6px 12px;
  border: 1px solid #ddd;
  background-color: white;
  border-radius: 4px;
  cursor: pointer;
}

.pagination-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>