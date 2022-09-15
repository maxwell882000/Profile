<template>
  <router-link :to="link" class="remove-link">
    <b-button variant="link" class="text-nowrap decoration-none text-sm">
      {{ title }}
      <span class="bi bi-arrow-right"/>
    </b-button>
  </router-link>
</template>

<script setup>
// eslint-disable-next-line no-undef
defineProps({
  link: String,
  title: {
    type: String,
    default() {
      return "Смотреть все";
    }
  }
});
</script>

<style scoped>

</style>