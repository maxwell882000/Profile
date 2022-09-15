<template>
  <b-col cols="6" class="col-xl-3 col-lg-3 col-md-4 col-sm-6 my-1">
    <div class="d-flex justify-content-start">
      <div class="mini-order-image pr-3">
        <img class="img-res" :src="product.image" alt="">
      </div>
      <div class="about">
        <span class="title text-400">{{ product.title }}</span>
        <br>
        <span class="number">{{ product.quantity }} {{ $t("шт") }}</span>
      </div>
    </div>
  </b-col>
</template>
<script setup>
// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  product: {
    type: Object,
    default() {
      return {
        "id": 16,
        "quantity": 1,
        "image": "http://127.0.0.1:8000/storage/card/image/funel.svg",
        "title": "asdfdf"
      }
    }
  }
})
</script>
<style scoped>
.about {
  margin: 0;
  padding: 0;
  line-height: 0.6em !important;
}

.title {
  font-size: 0.75rem;
  line-height: 0.9rem;
}

.mini-order-image {
  width: 5rem;
  height: 2.7rem;
}

.number {
  font-size: 0.6rem;
  color: var(--gray);
}
</style>