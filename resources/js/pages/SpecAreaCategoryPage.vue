<template>
    <Title content="CATEGORÍAS EN ÁREAS DE ESPECIALIDAD"  />
    <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
        <i class="bi bi-arrow-left-circle-fill text-xl text-blue-500"></i>
        <p class="underline font-medium text-lg text-blue-500 pb-1">Regresar</p>
    </button>

    
</template>

<script setup>
    import { ref } from 'vue';
    const  goBack = () => {
        this.$router.go(-1); // Regresa a la página anterior en el historial
    }
</script>