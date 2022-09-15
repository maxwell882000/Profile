<template>
  <b-row class="bg-white-sm p-mobile py-2 filter-with-product">
    <filtration-side></filtration-side>
    <b-col cols="12" class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
      <slot></slot>
      <filter-sorting></filter-sorting>
      <loader waiting="product_wrapper_load">
        <product-wrapper></product-wrapper>
      </loader>
    </b-col>
  </b-row>
</template>
<script>
import FiltrationSide from "@/components/filter/filteration/filtrationSide";
import ProductWrapper from "@/components/shared/productWrapper";
import Loader from "@/components/loading/loader";
import FilterSorting from "@/components/filter/component/sorting/filterSorting";

export default {
  components: {
    FilterSorting,
    Loader,
    ProductWrapper, FiltrationSide
  },
}
</script>
<style>
.filter-with-product {
  margin-left: 0 !important;
}
</style>