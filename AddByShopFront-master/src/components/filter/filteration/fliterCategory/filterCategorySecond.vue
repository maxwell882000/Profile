<template>
  <span class="text-sm">{{ category.name }}</span>
  <div class="ml-2">
    <filter-category-first :key="'filter_category_first_items' + item.slug"
                           v-for="item in category.children"
                           :category="item"></filter-category-first>
  </div>
</template>
<script>
import FilterCategoryFirst from "@/components/filter/filteration/fliterCategory/filterCategoryFirst";

export default  {
  props: ['category'],
  components: {FilterCategoryFirst},
  methods: {

  }
}
</script>