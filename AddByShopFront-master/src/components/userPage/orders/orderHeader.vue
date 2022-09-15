<template>
  <div class="d-flex justify-content-between align-items-center">
    <div class="text-nowrap mr-2">
      <h6 class="p-0 m-0"> {{ $t("Заказ") }} № {{ idOrder }} </h6>
    </div>
    <div class="text-wrap" style="overflow: hidden; text-overflow: ellipsis; max-width: 15rem">
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  idOrder: Number
})
</script>