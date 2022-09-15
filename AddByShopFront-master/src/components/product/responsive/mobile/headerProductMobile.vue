<template>
  <div class="bg-white p-mobile py-4 mobile-header">
    <pictures-part></pictures-part>
    <hr>
    <h5 class="my-3 text-header-32">{{ name }}</h5>
    <header-product></header-product>

    <price-component class="mt-3"></price-component>
    <buy-button-mobile></buy-button-mobile>
  </div>
</template>

<script setup>
import PicturesPart from "@/components/product/PicturesPart";
import HeaderProduct from "@/components/product/headerProduct";
import PriceComponent from "@/components/product/priceComponent";
import BuyButtonMobile from "@/components/product/responsive/mobile/buyButtonMobile";
import {defineProps} from "vue";

defineProps({
  name: String
})
</script>

<style>
.splide__pagination__page {
  width: 5px;
  height: 5px;
  background-color: var(--gray400) !important;
}

.mobile-header .splide__pagination .is-active {
  background-color: var(--black-dot) !important;
  border-radius: 37px;
  width: 15px;
  height: 5px;
}
</style>