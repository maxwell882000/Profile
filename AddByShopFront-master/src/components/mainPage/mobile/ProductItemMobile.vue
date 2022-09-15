<template>
  <div v-if="products.length" class="p-mobile mob-home-container mt-2">
    <NameAndRouteAll :title="title"></NameAndRouteAll>
    <SalesRoll :products="products"></SalesRoll>
  </div>
</template>

<script setup>

import NameAndRouteAll from "@/components/mainPage/mobile/nameAndRouteAll";
import SalesRoll from "@/components/shared/SalesRoll";

// eslint-disable-next-line no-undef
defineProps({
  title: String,
  products: Array
})
</script>
<style scoped>

</style>