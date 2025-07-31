<template>
    <div class="flex flex-row h-36 px-6 md:pr-14 justify-end items-center gap-4">
        <div>
            <!-- <a href="/" class="flex flex-row gap-3 items-center rounded-2xl border-[3px] bg-white  px-4 py-2 group transition-all transition=300 hover:bg-[#4180ab]"> -->
            <a href="/" class="flex flex-row gap-3 items-center rounded-2xl  shadow-md bg-white  px-4 py-2 group transition-all transition=300 hover:bg-sky-500">
                <div>
                    <!-- <i class="bi bi-eye-fill text-xl text-[#4180ab] group-hover:text-white transition transition-300"></i> -->
                    <i class="bi bi-eye-fill text-xl text-sky-500 group-hover:text-white transition transition-300"></i>

                </div>
                <div>
                    <!-- <h1 class="font-bold text-sm text-[#4180ab] group-hover:text-white transition transition-300">VER LA PAGINA</h1> -->
                    <h1 class="font-bold text-sm text-sky-500 group-hover:text-white transition transition-300">VER LA PAGINA</h1>
                </div>
                <div></div>
            </a>
        </div>
        <div>
            <button @click="logout" class="rounded-xl shadow-md pl-2 pr-3 py-[0.30rem] bg-white hover:bg-sky-500 active:bg-white group">
                <!-- <i class="bi bi-box-arrow-left font-bold text-[#4180ab] text-2xl"></i> -->
                <i class="bi bi-box-arrow-left font-bold text-sky-500 group-hover:text-white text-2xl"></i>
            </button>

        </div>
        <!-- <img :src="'/img/logo_normal.png'" alt="Logo"> -->
    </div>
</template>

<script setup>

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
        name: "Header"
    }
</script>