<template>
  <div>
    <div class="w-100" style="height: 12.143rem; z-index: -1">
      <img class="img-res" :src="shop.image">
    </div>
    <div class="header-shop bg-white">
      <div class="rounded-st bg-white shadow-md"
           style="height: 5.286rem; width: 5.286rem; padding:1rem; margin-top: -2.643rem;margin-bottom: 1rem">
        <img class="img-res" :src="shop.logo" alt="logo">
      </div>
      <div>
        <span class="text-18 text-500">{{ shop.name }}</span>
      </div>
      <div class="text-muted">
        <span class="bi bi-geo-alt-fill me-1"/>
        <span>{{ shop.address }}</span>
      </div>

    </div>
  </div>
</template>

<script setup>
// eslint-disable-next-line no-undef
defineProps({
  shop: Object
})
</script>

<style scoped>
.header-shop {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding-bottom: 0.8rem;
}
</style>