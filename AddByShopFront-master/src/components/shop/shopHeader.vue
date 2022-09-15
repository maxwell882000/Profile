<template>
  <ResponsiveLayout>
    <template #desktop>
      <header-shop-desktop :shop="shop"></header-shop-desktop>
    </template>
    <template #mobile>
      <header-shop-mobile :shop="shop"></header-shop-mobile>
    </template>
  </ResponsiveLayout>
</template>

<script setup>
import ResponsiveLayout from "@/components/responsive/ResponsiveLayout";
import HeaderShopDesktop from "@/components/shop/desktop/headerShopDesktop";
import HeaderShopMobile from "@/components/shop/mobile/headerShopMobile";

// eslint-disable-next-line no-undef
defineProps({
  shop: Object
})
</script>

<style scoped>

</style>