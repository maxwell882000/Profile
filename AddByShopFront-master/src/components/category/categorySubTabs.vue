<template>
  <category-base-tabs :name="category.name" :link="`/category/child/${category.slug}`">
    <SalesRoll :per-page="4" :products="category.product"></SalesRoll>
  </category-base-tabs>
</template>
<script>
import CategoryBaseTabs from "@/components/category/categoryBaseTabs";
import SalesRoll from "@/components/shared/SalesRoll";

export default {
  components: {SalesRoll, CategoryBaseTabs},
  props: {
    category: {
      type: Object,
      default() {
        return {
          name: "",
          slug: "",
          product: []
        }
      }
    }
  }
}
</script>