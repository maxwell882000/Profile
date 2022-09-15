<template>
  <cat-hover class="category-square relative" :category="category">
       <span style="padding: 1.714em; font-weight: 600;
     font-size: 1.429em;
     width: 50%;
     z-index: 2;
     color: var(--dark);
    line-height: 1.714em"> {{ category.category.name }} </span>
    <div>
      <img style="bottom: 0; right: 0; height: 75%; max-width: 100%" class=" absolute" :src="category.category.image">
    </div>
  </cat-hover>
</template>

<script setup>
// eslint-disable-next-line no-undef
import CatHover from "@/components/category/home/catHover";

// eslint-disable-next-line no-undef
defineProps({
  category: Object
});
</script>

<style scoped>


.category-square {
  width: 24.286em;
  height: 18.571em;
  display: flex;
  background-color: var(--gray900);
  border-radius: var(--borderRadius14);
}
</style>