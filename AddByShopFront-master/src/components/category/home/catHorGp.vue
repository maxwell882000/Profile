<template>
  <div class="d-flex" :class="isReverse && 'flex-row-reverse'">
    <category-square :category="categories[0]"></category-square>
    <div style="margin-left: 1.429em; margin-right: 1.429em">
      <category-horizontal :category="categories[1]" style="margin-bottom: 1.429em"></category-horizontal>
      <category-horizontal :category="categories[2]"></category-horizontal>
    </div>
  </div>
</template>

<script setup>
import CategorySquare from "@/components/category/home/categorySquare";
import CategoryHorizontal from "@/components/category/home/categoryHorizontal";

// eslint-disable-next-line no-undef
defineProps({
  isReverse: Boolean,
  categories:Array,
});
</script>

<style scoped>

</style>