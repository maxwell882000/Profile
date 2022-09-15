<template>
  <Button class="bg-red">
   <span style="color:white">
      {{ title }}
    </span>
  </Button>
</template>

<script setup>
import Button from "@/components/helper/button/button";
// eslint-disable-next-line no-undef
defineProps({
  title: String,
});
</script>

<style scoped>

</style>