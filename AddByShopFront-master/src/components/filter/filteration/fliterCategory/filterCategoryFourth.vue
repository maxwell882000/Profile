<template>
  <span  class="text-sm">{{ category.name }}</span>
  <div class="ml-2">
    <filter-category-third  :category="category.children"></filter-category-third>
  </div>
</template>
<script>
import FilterCategoryThird from "@/components/filter/filteration/fliterCategory/filterCategoryThird";

export default {
  props: ['category'],
  components: {FilterCategoryThird}
}
</script>