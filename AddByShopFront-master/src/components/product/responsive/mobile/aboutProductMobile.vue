<template>
  <div class="bg-white p-mobile py-4 mt-2">
    <about-product></about-product>
  </div>
</template>

<script>
import AboutProduct from "@/components/product/aboutProduct";

export default {
  name: "aboutProductMobile",
  components: {AboutProduct}
}
</script>

<style>
@media (max-width: 768px) {
  .about-item {
    padding: 0;
    margin: 0 !important;
  }
}

</style>