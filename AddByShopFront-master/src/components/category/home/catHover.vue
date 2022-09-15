<template>
  <router-link :to="'/category' + goTo() + category.category.slug" class="hover-cat block remove-link" :style="{
      cursor: 'pointer',
    '--back-color': category.back_color,
  '--color-text': category.color}">
    <slot></slot>
  </router-link>
</template>

<script setup>
// eslint-disable-next-line no-undef
const props = defineProps({
  category: Object
});
const goTo = () => {

  switch (props.category.category.depth) {
    case 1 :
      return "/parent/";
    case 2 :
      return "/sub/";
    case 3 :
      return "/child/";
  }
}
</script>
<style>
.hover-cat:hover span {
  color: var(--color-text) !important;
}
</style>
<style scoped>
.hover-cat:hover {
  background-color: var(--back-color);
}


</style>