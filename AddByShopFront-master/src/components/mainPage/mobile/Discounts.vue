<template>
  <div class="p-mobile mob-home-container  mt-2 discount-mobile">
    <name-and-route-all :title="$t('Скидки')"></name-and-route-all>
    <BaseRoll>
      <SplideSlide :key="'discount_mob_'+ discount.id" v-for="discount in discounts.items">
        <div class="discount_mobile">
          <img class="img-res rounded-st" :src="discount.image" alt="discount"/>
        </div>
      </SplideSlide>
    </BaseRoll>
  </div>
</template>

<script setup>
import {useStore} from "vuex";
import {computed} from "vue";
import NameAndRouteAll from "@/components/mainPage/mobile/nameAndRouteAll";
import BaseRoll from "@/components/shared/baseRoll";

const store = useStore();
const discounts = computed(() => store.getters['mainModule/discount']);
console.log(discounts.value);
// eslint-disable-next-line no-unused-vars
const options = {
  arrows: false,
  pagination: false,
  gap: 15,

}
</script>
<style lang="scss">
.discount-mobile {
  .splide__track {
    padding-right: 0 !important;
    padding-left: 0 !important;
  }

  .slick-list {
    padding: 0 20% 0 0 !important;
  }

  .splide__slide {
    width: max-content !important;
  }
}
</style>
<style scoped>
.discount_mobile {
  height: 17.5rem;
  border-radius: 1.143rem;
  width: 9.786rem;
}
</style>