<template>
  <filter-with-products></filter-with-products>
</template>
<script>
import FilterWithProducts from "@/components/filter/component/filterWithProducts";
import useFilterWithComponent from "@/components/filter/setup/useFilterWithComponent";
import useFilterBy from "@/components/filter/setup/useFilterBy";
import {useRoute} from "vue-router";

export default {
  components: {FilterWithProducts},
  setup() {
    const route = useRoute();
    return useFilterWithComponent(useFilterBy({key: "category_slug", item: route.params.slug}));
  }
}
</script>