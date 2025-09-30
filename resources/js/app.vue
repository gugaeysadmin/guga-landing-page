<template>
  <div class="flex min-h-screen ">
    <!-- Sidebar SIEMPRE FIXED -->
    <div
      :class="[
        'fixed inset-y-0 left-0 z-30 w-[18rem] bg-gray-800 text-white transition-transform duration-200 ease-in-out',
        showSidebar ? 'translate-x-0' : '-translate-x-full',
        'md:translate-x-0'
      ]"
    >
      <SideBar :close-sidebar="closeSidebar" :show-sidebar="showSidebar" />
    </div>

    <!-- Overlay solo en móvil -->
    <div
      v-if="showSidebar"
      class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
      @click="toggleSidebar"
    />

    <!-- Contenido principal -->
    <div class="flex-1 flex flex-col md:ml-[18rem]">
      <!-- Header -->
      <header class="w-full   px-4 py-3">
        <Header :showSidebar="showSidebar" :toggleSidebar="toggleSidebar" />
      </header>

      <!-- Main -->
      <main class="flex flex-1 mb-14">
        <div class="max-w-[54rem] px-6 mx-auto py-6">
          <router-view />
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import Header from './components/Header.vue';
import SideBar from './components/SideBar.vue';

const showSidebar = ref(false);

const toggleSidebar = () => {
  showSidebar.value = !showSidebar.value;
};

const closeSidebar = () => {
  showSidebar.value = false;
};

// cerrar sidebar cuando pasas a escritorio
onMounted(() => {
  const handleResize = () => {
    if (window.innerWidth >= 768) {
      showSidebar.value = false;
    }
  };
  window.addEventListener('resize', handleResize);
  handleResize();
  onBeforeUnmount(() => window.removeEventListener('resize', handleResize));
});
</script>
