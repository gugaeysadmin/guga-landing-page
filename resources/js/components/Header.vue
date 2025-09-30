<template>
  <div class="flex flex-row items-cennter content-center px-2 py-4 justify-between items-center gap-4 ">
    
    <div class="flex flex-row gap-4 items-center justify-center ">
        <!-- Botón para abrir/cerrar el sidebar -->
        <div class="md:hidden">
          <button 
            @click="toggleSidebar" 
            class="rounded-xl shadow-md px-3 py-2 bg-gradient-to-r 
                        from-sky-500  
                        to-sky-600
                        hover:from-sky-500
                        hover:to-sky-500
                    "
          >
            <i 
              class="bi bi-list text-2xl font-bold text-white transition" 
            ></i>
          </button>
        </div>
        <img :src="logo" alt="Logo" class="h-8 mx-auto"/>
    </div>

    <div class="flex flex-row gap-4 ml-auto">
        <!-- Enlace VER LA PÁGINA -->
        <div>
          <a 
            href="/" 
            target="_blank"
            class="flex flex-row gap-3 items-center rounded-xl shadow-md px-4 py-2 group transition-all bg-gradient-to-r 
                        from-sky-500  
                        to-sky-600
                        hover:from-sky-500
                        hover:to-sky-500
                    "
          >
            <i class="bi bi-eye-fill text-xl  text-white transition"></i>
            <h1 class="font-bold text-sm  text-white transition hidden sm:block">
              VER LA PAGINA
            </h1>
          </a>
        </div>
    
        <!-- Botón logout -->
        <div>
          <button 
            @click="logout" 
            class="rounded-xl shadow-md pl-2 pr-3 py-[0.30rem] bg-gradient-to-r 
                    from-sky-500  
                    to-sky-600
                    hover:from-sky-500
                    hover:to-sky-500
                "
          >
            <i class="bi bi-box-arrow-left font-bold text-white text-2xl"></i>
          </button>
        </div>
    </div>
  </div>
</template>

<script setup>
    import logo from '../../../public/img/logo_normal.png'
    import { defineProps } from 'vue'

    const props = defineProps({
        showSidebar: Boolean,          
        toggleSidebar: Function      
    })

    const logout = async () => {
        try {


            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            
            const response = await fetch('/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'include' // Importante para las cookies de sesión
            });

            if (response.ok) {
                window.location.href = '/app/admin'; // Redirige al home
            } else {
                console.error('Error en la respuesta:', await response.json());
            }
        } catch (error) {
        console.error('Error closing session:', error);
        }
    }
</script>
<script>
    export default {
        name: "Header",
    }
</script>