<template>
  <section class="sales-roll">
    <div class="d-flex justify-content-between align-items-end">
      <h5 class=" mt-4 p-0 mb-0 text-sm-center">{{ $t("Магазины") }} ByShop</h5>
      <show-all link="/shop_all"></show-all>
    </div>
    <BaseRoll>
      <SplideSlide :key="'list_of_all_shops_' + shop.slug" v-for="shop in shop_list">
        <shop-items :shop="shop"></shop-items>
      </SplideSlide>
    </BaseRoll>
  </section>
</template>

<script setup>
import ShopItems from "@/components/shop/desktop/shopItems";
import {useStore} from "vuex";
import {computed} from "vue";
import BaseRoll from "@/components/shared/baseRoll";
import ShowAll from "@/components/helper/button/showAll";

const store = useStore();
const shop_list = computed(() => store.getters['mainModule/shop_list']);
</script>

<style scoped>

</style>