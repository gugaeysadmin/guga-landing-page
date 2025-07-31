<template>
    <div class="flex flex-row justify-between flex-wrap ">
        <div class="mt-8 bg-white rounded-xl shadow-md w-60 flex flex-row">
            <div class="w-2 rounded-l-full bg-sky-500"></div>
            <div class="w-full  py-5 px-5">
                <p class="text-2xl font-semibold">Productos</p>
                <div class="flex flex-row justify-between items-end">
                    <router-link to="/app/admin/product">
                        <p class="text-sky-500 underline text-xs`">Ver</p>
                    </router-link>
                    <p class="text-3xl font-bold text-sky-500 text-end">{{ productsNumber }}</p>
                </div>
            </div>
        </div>
        
        <div class="mt-8 bg-white rounded-xl shadow-md w-60 flex flex-row">
            <div class="w-2 rounded-l-full bg-sky-500"></div>
            <div class="w-full py-5 px-5">
                <p class="text-2xl font-semibold">Promociones</p>
                <div class="flex flex-row justify-between items-end">
                    <router-link to="/app/admin/promotions">
                        <p class="text-sky-500 underline text-xs`">Ver</p>
                    </router-link>
                    <p class="text-3xl font-bold text-sky-500 text-end">{{ promotionsNumber }}</p>
                </div>
            </div>
        </div>
        <div class="mt-8 bg-white rounded-xl shadow-md w-60 flex flex-row">

            <div class="w-2 rounded-l-full bg-sky-500"></div>
            <div class="w-full py-5 px-5">
                <p class="text-2xl font-semibold">Alianzas</p>
                <div class="flex flex-row justify-between items-end">
                    <router-link to="/app/admin/enterprise/alliances">
                        <p class="text-sky-500 underline text-xs`">Ver</p>
                    </router-link>
                    <p class="text-3xl font-bold text-sky-500 text-end">{{ alliancesNumber }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import { RouterLink } from 'vue-router';
    const productsNumber = ref(0)
    const promotionsNumber = ref(0) 
    const alliancesNumber = ref(0) 

    onMounted(async () => {
        fetchAllianceNumber();
        fetchProductNumber();
        fetchOffertNumber();
    });

    const fetchProductNumber = async ()=> {
        try {
            const response = await fetch('/api/product-count/');
            const data = await response.json();
            if (data.success) {
                productsNumber.value = data.data;
            }
        } catch (error) {
            console.error('Error fetching product:', error);
        }
    }

    const fetchAllianceNumber = async ()=> {
        try {
            const response = await fetch('/api/alliances-count/');
            const data = await response.json();
            if (data.success) {
                promotionsNumber.value = data.data;
            }
        } catch (error) {
            console.error('Error fetching alliance:', error);
        }
    }

    const fetchOffertNumber = async ()=> {
        try {
            const response = await fetch('/api/offerts-count/');
            const data = await response.json();
            if (data.success) {
                alliancesNumber.value = data.data;
            }
        } catch (error) {
            console.error('Error fetching offert:', error);
        }
    }


</script>
<script>
    export default {
        name: "Main Statistics"
    }
</script>