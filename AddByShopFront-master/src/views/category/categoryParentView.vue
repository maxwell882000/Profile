<template>
  <CategoryView :name="parent.name">
    <category-sub-tabs :key="'parent_sub_categories_'+ item.id" v-for="item in parent.product_in_categories"
                       :category="item"/>
  </CategoryView>
</template>
<script>
import CategoryView from "@/components/category/categoryView";
import CategorySubTabs from "@/components/category/categoryParentTabs";
import {mapGetters} from "vuex";

export default {
  components: {CategorySubTabs, CategoryView},
  computed: {
    ...mapGetters({
      parent: "categoryModule/parent"
    })
  },
  created() {

  }
}
</script>