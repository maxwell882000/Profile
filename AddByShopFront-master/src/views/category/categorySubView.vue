<template>
  <CategoryView :name="categories.name">
    <category-sub-tabs :key="'category_sub_rolls_' + item.slug"
                       v-for="item in categories.sub_categories"
                       :category="item"></category-sub-tabs>
  </CategoryView>
</template>
<script>
import CategoryView from "@/components/category/categoryView";
import CategorySubTabs from "@/components/category/categorySubTabs";
import {mapGetters} from "vuex";

export default {
  components: {CategorySubTabs, CategoryView},
  computed: {
    ...mapGetters({
      categories: "categoryModule/sub"
    })
  }
}
</script>