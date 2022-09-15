<template>
  <ProductItemMobile :products="hit_products" :title="$t('Хит продаж')"></ProductItemMobile>
</template>

<script setup>
import {useStore} from "vuex";
import {computed} from "vue";
import ProductItemMobile from "@/components/mainPage/mobile/ProductItemMobile";

const store = useStore();
const hit_products = computed(() => store.getters['mainModule/hit_products']);
</script>

<style>

</style>