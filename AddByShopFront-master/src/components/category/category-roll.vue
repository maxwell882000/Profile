<template>
  <Splide :options="{pagination:true, perPage:5, arrows:false, gap:4}">
    <SplideSlide :key="keyArg + item.id" v-for="item in categories">
      <slot :item="item">
        <category-item-roll :item="item"></category-item-roll>
      </slot>
    </SplideSlide>
  </Splide>
</template>

<script setup>
// eslint-disable-next-line no-undef
import CategoryItemRoll from "@/components/category/category-item-roll";
// eslint-disable-next-line no-undef
defineProps({
  categories: Array,
  keyArg: String,
})
</script>
