<template>
  <router-link :to="'/shop/' + shop.slug" class=" item-shop-list ">
    <div class="back-shop">
      <img :src="shop.image" class="img-res top-rounded">
    </div>
    <div class="shop-info">
      <div class="bg-white rounded-st shadow-md logo-shop-list">
        <img :src="shop.logo" class="img-res">
      </div>
      <div style="padding-top:1.071rem; padding-bottom: 1.8rem; text-align: center">
        <span class="text-500"> {{ shop.name }}</span>
        <div class="text-muted">
          <span class="bi bi-geo-alt-fill me-1"/>
          <span>{{ shop.address }}</span>
        </div>
      </div>
    </div>
    <div class="d-flex p-2 justify-content-center">
      <div style="width: max-content; margin-right: 0.714rem">
        <div style="height: 10.143rem; width: 10.143rem !important;">
          <img :src="shop.left_image" class="img-res">
        </div>
      </div>
      <div class="d-flex flex-wrap  justify-content-center" style="width: 10.143rem;gap: 0.714rem">
        <div style="width: 4.714rem; height: 4.714rem; padding: 0.2rem" :key="'images_'+ index"
             v-for="(items, index) in shop.right_image">
          <img :src="items" class="img-res">
        </div>
      </div>
    </div>
  </router-link>

</template>

<script setup>
// eslint-disable-next-line no-undef
defineProps({
  shop: Object
});
</script>

<style scoped>
.item-shop-list {
  all: unset;
  display: block;
  height: 27.429rem;
  box-shadow: 0px 4px 12px 1px rgba(27, 31, 53, 0.09);
  width: 24.286rem;
  cursor: pointer;
  background-color: white;
  border-radius: var(--borderRadius);
}

.back-shop {
  height: 7.143rem;
  width: 24.286rem;
}

.top-rounded {
  border-top-left-radius: var(--borderRadius);
  border-top-right-radius: var(--borderRadius);
}

.shop-info {
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
  background-color: white;
  padding-bottom: 0.5rem;
}

.logo-shop-list {
  width: 6.643rem;
  height: 6.643rem;
  padding: 0.714rem;
  margin-top: -4rem;
}
</style>