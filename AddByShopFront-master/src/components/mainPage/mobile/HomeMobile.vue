<template>
  <section>
    <div style="z-index: 1" class="bg-white banner-category py-4">
      <banner-and-item-mobile></banner-and-item-mobile>
      <popular-categories></popular-categories>
    </div>
    <hit-products></hit-products>
    <Discounts></Discounts>
    <product-of-day></product-of-day>
    <lenta-mobile></lenta-mobile>
  </section>
</template>

<script>

export default {
  name: "MobileHome",
}
</script>
<script setup>
import BannerAndItemMobile from "@/components/mainPage/mobile/BannerAndItemMobile";
import PopularCategories from "@/components/mainPage/mobile/PopularCategories";
// eslint-disable-next-line no-unused-vars
import HitProducts from "@/components/mainPage/mobile/HitProducts";
// eslint-disable-next-line no-unused-vars
import Discounts from "@/components/mainPage/mobile/Discounts";
// eslint-disable-next-line no-unused-vars
import ProductOfDay from "@/components/mainPage/mobile/ProductOfDay";
import LentaMobile from "@/components/mainPage/mobile/LentaMobile";
</script>
<style lang="scss">
.banner-category {
  border-radius: 0 0 var(--borderRadius24) var(--borderRadius24);
}

.mob-home-container {
  border-radius: var(--borderRadius24);
  background-color: white;
  padding-top: 1.5rem;
  padding-bottom: 1.5rem;

}

</style>