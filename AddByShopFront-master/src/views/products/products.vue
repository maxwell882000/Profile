<template>
  <section class="container my-3">
    <h5 class="mb-3 text-header-32">{{ $t("Товары") }}</h5>
    <filter-with-products></filter-with-products>
  </section>
</template>

<script setup>
import FilterWithProducts from "@/components/filter/component/filterWithProducts";
import useFilterWithComponent from "@/components/filter/setup/useFilterWithComponent";
import useFilterBy from "@/components/filter/setup/useFilterBy";
import {useRoute} from "vue-router";

const route = useRoute();

useFilterWithComponent(useFilterBy({key: route.params.key, item: route.params.slug}))
</script>
<style scoped>

</style>