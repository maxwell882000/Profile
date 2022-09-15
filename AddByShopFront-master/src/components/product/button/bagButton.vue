<template>
  <CartButton :is-svg="true" :image="product.image" :basket="product.basket" :id="product.id"></CartButton>
</template>
<script setup>
import CartButton from "@/components/buttons/cart/CartButton";
import {computed} from "vue";
import {useStore} from "vuex";

const store = useStore();
const product = computed(() => store.getters['productModule/product']);
</script>