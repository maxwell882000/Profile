<template>
  <span class="text-sm">{{ category.name }}</span>
  <div class="ml-2">
    <filter-category-second :category="category.children"></filter-category-second>
  </div>
</template>
<script>
import FilterCategorySecond from "@/components/filter/filteration/fliterCategory/filterCategorySecond";

export default {
  props: ['category'],
  components: {FilterCategorySecond}
}
</script>