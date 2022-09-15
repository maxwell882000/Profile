<template>
  <div>
   <slot></slot>
    <b-container style="padding: 0">
      <b-row gutter-x="5">
        <sub-categories :column="column" :key="'category_child_1' + index + 'slug_' + child.slug" :category="child"
                        v-for="(child , index) in item.children"></sub-categories>
      </b-row>
    </b-container>
  </div>
</template>
<script>
import SubCategories from "@/components/header/desktop/subCategories";

export default {
  props: {
    item: {},
    column: {
      type: Number,
      default() {
        return 4;
      }
    }
  },
  data() {
    return {
      path: '/category/parent/' + this.item.slug,
    }
  },
  components: {SubCategories}
}
</script>