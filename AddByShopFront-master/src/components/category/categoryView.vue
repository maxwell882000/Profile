<template>
  <b-row class="flat-side-bar">
    <b-col cols="0" class="col-xl-3 col-lg-3 col-md-3 d-none d-sm-none d-md-block  ml-r bg-white rounded-st p-4">
      <category :column="12" :item="category"></category>
    </b-col>
    <b-col cols="12" class="col-xl-9 col-lg-9 col-md-9">
      <slot></slot>
    </b-col>
  </b-row>
</template>
<script>
import {mapGetters} from "vuex";
import Category from "@/components/header/desktop/category";
// import DiscountRoll from "@/components/shared/discountRoll";

export default {
  name: "categoryView",
  props: ['name'],
  data() {
    return {
      category: {},

    }
  },
  components: {Category},
  computed: {
    ...mapGetters([
      'drop_bar',
    ]),

  },
  watch: {
    drop_bar() {
      this.setCategory();
    }
  },
  methods: {

    setCategory() {
      let slug = this.$route.params.slug;
      let parent = this.drop_bar.filter(e => e.slug === slug
          || e.children.filter(ch => ch.slug === slug).length !== 0);
      if (parent.length !== 0) {
        this.category = parent[0];
        return;
      }
      this.category = [];
    },
  },

  created() {
    this.setCategory();
    this.$watch(
        () => this.$route.params.slug,
        () => {
          this.setCategory();
        },
        // fetch the data when the view is created and the data is
        // already being observed
        {immediate: true}
    )

  }
}
</script>
<style>
.flat-side-bar {
  margin-left: 0 !important;
}
</style>