<template>
  <div class="d-flex" :class="isReverse && 'flex-row-reverse margin-top'" style="font-size: 13px">
    <cat-hor-gp :categories="categories.slice(0, 3)" :isReverse="isReverse"></cat-hor-gp>
    <cat-ver-gp :categories="categories.slice(3)" :isReverse="isReverse"></cat-ver-gp>
  </div>
</template>

<script setup>
import CatHorGp from "@/components/category/home/catHorGp";
import CatVerGp from "@/components/category/home/catVerGp";

// eslint-disable-next-line no-undef
defineProps({
  isReverse: Boolean,
  categories: Array,
});
</script>

<style scoped>
.margin-top {
  margin-top: 1.429em;
}
</style>