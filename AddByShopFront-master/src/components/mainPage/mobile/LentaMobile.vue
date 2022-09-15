<template>
  <ProductItemMobile :key="'lenta_mobile'+ item.id" v-for="item in lenta"
                     :title="item.text"
                     :products="item.products"
  ></ProductItemMobile>
</template>

<script setup>
import ProductItemMobile from "@/components/mainPage/mobile/ProductItemMobile";
import {useStore} from "vuex";
import {computed} from "vue";

const store = useStore();
const lenta = computed(() => store.getters['mainModule/lenta']);
</script>

<style scoped>

</style>