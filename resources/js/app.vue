<template>
    <!-- <header>
        <Header></Header>
    </header> -->
    <div class="relative flex min-h-screen">
        <aside class="inset-y-0 absolute left-0 md:relative md:-translate-x-0 transform -translate-x-full trasition duration-200 ease-in-out block">
            <SideBar/>
        </aside>
        <div class="block  w-full">
            <header class="w-full">
                <Header></Header>
            </header>
            <div class="flex-1 mb-14">
                <main>
                    <div class="max-w-[56rem] px-14 mx-auto">
                        <router-view/>
                    </div>
                </main>
            </div>

        </div>
    </div>

    <!-- <nav>
        <div>
            <router-link to="/app/homevue">Home</router-link>
            <router-link to="/app/aboutvue">About</router-link>
        </div>
    </nav> -->
</template>

<script>
import { ref } from 'vue';
import Header from './components/Header.vue';

export default {
    setup(){
        const showSidebar = ref(false);
        return {
            showSidebar,
        };
    }
};
</script>
