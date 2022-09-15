<template>
  <div v-show="price">
    <div class="my-2 d-flex justify-content-between">
      <span> {{ title }}</span>
      <span :class="'text-500 ' + color">{{ price_formatter(price) }} сум</span>
    </div>
  </div>
</template>
<script setup>
// eslint-disable-next-line no-undef
import price_formatter from "@/mixins/price_formatter";

// eslint-disable-next-line no-undef
defineProps({
  price: Number,
  title: String,
  color: {
    type: String,
    default: "text-red"
  }
});

</script>