<template>
  <div class="text-green text-sm ml-2">
    <span v-show="success" v-html="success"></span>
  </div>
</template>
<script setup>
// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  success: String
});
</script>