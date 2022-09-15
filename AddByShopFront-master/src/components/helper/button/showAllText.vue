<template>
  <div class="d-flex justify-content-between align-items-end mb-2">
    <h5 class="mt-4 p-0 mb-0 text-sm-center">{{ title }}</h5>
    <show-all :link="link"></show-all>
  </div>
</template>

<script setup>
import ShowAll from "@/components/helper/button/showAll";
// eslint-disable-next-line no-undef
defineProps({
  link: String,
  title: String
});
</script>

<style scoped>

</style>