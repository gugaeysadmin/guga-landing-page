<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  content: {
    type: String, // Puede ser VNode, componente o string
    default: null
  }
}) 
</script>
<template>
    <h1 class="text-4xl font-semibold text-[#0392ce]">{{ content }}</h1>
</template>

<script>
export default {
    name: "Title"
}
</script>