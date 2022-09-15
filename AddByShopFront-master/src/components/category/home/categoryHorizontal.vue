<template>
  <cat-hover :category="category" class="category-horizontal relative">
    <span style="padding: 1.714em;
      font-size: 1.143em;
    line-height: 1.357em;
    z-index: 2;
    color: var(--dark);
    font-weight: 600;
 ">{{ category.category.name }}</span>
    <div>
      <img class="absolute"
           style="bottom: 0;
    right: 0;
    height: max-content;
    max-width: 100%;
 max-height: 100%;" :src="category.category.image">
    </div>
  </cat-hover>
</template>

<script setup>
import CatHover from "@/components/category/home/catHover";

// eslint-disable-next-line no-undef
defineProps({
  category: Object
});
</script>

<style scoped>
.category-horizontal {
  width: 24.286em;
  height: 8.571em;
  display: flex;
  border-radius: var(--borderRadius14);
  background-color: var(--gray900);
}
</style>