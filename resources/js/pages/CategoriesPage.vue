<template>
    <Title content="CATEGORÍAS"  />
    <button @click="goBack" class="py-2 mt-4 flex flex-row items-center justify-center align-middle content-center gap-2">
        <i class="bi bi-arrow-left-circle-fill text-xl text-[#3e8ad5]"></i>
        <p class="underline font-medium text-lg text-[#3e8ad5] pb-[1px]">Regresar</p>
    </button>
    <!-- <CatalogSection/> -->
    <CategoriesSection/>
</template>

<script setup>
    import { useRouter } from 'vue-router';
    const router = useRouter();
    const  goBack = () => {
        router.back()
    }

</script>