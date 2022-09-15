<template>
  <section>
    <header-product-mobile :name="name"></header-product-mobile>
    <component-mobile :component="selectComponent"></component-mobile>
    <about-product-mobile></about-product-mobile>
    <shop-product-mobile></shop-product-mobile>
    <comment-mobile></comment-mobile>
  </section>
</template>

<script setup>

import useItemProduct from "@/components/product/responsive/setup/useItemProduct";
import HeaderProductMobile from "@/components/product/responsive/mobile/headerProductMobile";
import ComponentMobile from "@/components/product/responsive/mobile/componentMobile";
import AboutProductMobile from "@/components/product/responsive/mobile/aboutProductMobile";
import ShopProductMobile from "@/components/product/responsive/mobile/shopProductMobile";
import CommentMobile from "@/components/product/responsive/mobile/commentMobile";

// eslint-disable-next-line no-unused-vars
const {selectComponent, path, name} = useItemProduct();
</script>

<style scoped>

</style>