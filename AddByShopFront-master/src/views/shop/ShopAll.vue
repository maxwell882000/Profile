<template>
  <loader waiting="shop_all_loaded">
    <section class="container mb-3">
      <Badge :path="path"></Badge>
      <h5 class="mb-3 text-header-32">{{ $t("Все магазины") }}</h5>
      <div class="d-flex flex-wrap" style="gap: 0.714rem">
        <shop-items :key="'all_shop_items'+ shop.slug" v-for="shop in shop_all" :shop="shop"></shop-items>
      </div>
    </section>
  </loader>
</template>

<script setup>

import Loader from "@/components/loading/loader";
import Badge from "@/components/shared/Badge";
import ShopItems from "@/components/shop/desktop/shopItems";
import {useStore} from "vuex";
import {computed} from "vue";
import {useI18n} from "vue-i18n";

const t = useI18n().t;
const path = [{
  name: t("Главная"),
  path: "/"
}, {
  name: t("Все магазины"),
  path: "/shop_all"
}];
const store = useStore();
const getAllShops = () => store.dispatch("shopModule/getAllShop");
getAllShops();
const shop_all = computed(() => store.getters['shopModule/shop_all']);
</script>

<style scoped>

</style>