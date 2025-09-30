<template>
    <transition
      enter-active-class="transition-opacity duration-300 ease-out"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition-opacity duration-200 ease-in"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="visible"
        class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title"
        aria-modal="true"
        role="dialog"
      >
        <!-- Fondo oscuro -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
  
        <!-- Contenedor del modal -->
        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
          <transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to-class="opacity-100 translate-y-0 sm:scale-100"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0 sm:scale-100"
            leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          >
            <div
              v-if="visible"
              class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all pt-4 sm:my-8 sm:w-full sm:max-w-lg"
            >
            <div class="bg-white px-4 pb-4 sm:pb-4">
              <div class="">
                <div class="mt-3 text-center sm:m-4 sm:mt-0 sm:text-left">
                    <!-- Encabezado -->
                    <div v-if="!disableHeader" class=" flex flex-row justify-between items-center">
                        <h3
                          id="modal-title"
                          class="text-lg font-semibold leading-6 text-gray-900"
                        >
                          {{ title }}
                        </h3>
                        <button @click="onClose" class="p-2">
                          <i class="bi bi-x-lg text-xl"></i>
                        </button>
                    </div>
                    <!-- Contenido (children) -->
                    <div class="mt-6 w-full ">
                      <slot></slot>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Pie (opcional, puedes agregar botones aquí) -->
              <div class="bg-gray-50 sm:flex sm:flex-row-reverse sm:px-6 ">
                <slot name="footer"></slot>
              </div>
            </div>
          </transition>
        </div>
      </div>
    </transition>
</template>
  
  <script setup>
import { type } from 'jquery';

    defineProps({
        title: {
            type: String,
            default: 'Modal Title'
        },
        visible: {
            type: Boolean,
            default: false
        },
        onClose: {
          type: Function,
          default: null,
        },
        disableHeader: {
          type: Boolean,
          default: false
        }
    });
  </script>

<script>
    export default {
        name: "Header"
    }
</script>