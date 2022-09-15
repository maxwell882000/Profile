<template>
  <div class="d-flex" :class="isReverse && 'flex-row-reverse'">
    <category-square :category="categories[0]"></category-square>
    <category-vertical :category="categories[1]" style="margin-left: 1.429em; margin-right: 1.429em"></category-vertical>
    <category-vertical :category="categories[2]"></category-vertical>
  </div>
</template>

<script setup>
import CategorySquare from "@/components/category/home/categorySquare";
import CategoryVertical from "@/components/category/home/categoryVertical";

// eslint-disable-next-line no-undef
defineProps({
  isReverse: Boolean,
  categories: Array
});
</script>

<style scoped>

</style>