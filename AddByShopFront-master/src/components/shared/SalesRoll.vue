<template>
  <!--  <div ref="sizeDetermine">-->
  <!--    <Flicking ref="flicking" :options="{align:'prev',panelsPerView: numberOFItems}">-->
  <!--      <div v-for="item in products" :key="slideKey + item.id ">-->
  <!--        <div class="w-100 m-auto d-flex justify-content-center">-->
  <!--          <item-card :product="item"/>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </Flicking>-->
  <!--  </div>-->
  <div class="sales-roll">
    <BaseRoll :breakpoints="breakpoints" :perPage="perPage">
      <SplideSlide v-for="item in products" :key="slideKey + item.id ">
        <div class="w-100 m-auto d-lg-block d-sm-flex d-flex justify-content-center">
          <item-card :class="isPadding && 'product-wide'"
                     :product="item"/>
        </div>
      </SplideSlide>
      <SplideSlide>
        <ResponsiveLayout>
          <template #desktop>

            <div style="width: 10rem"></div>
          </template>
        </ResponsiveLayout>
      </SplideSlide>

    </BaseRoll>
  </div>

</template>
<script setup>
import ItemCard from "./item/ItemCard";

// eslint-disable-next-line no-undef
import BaseRoll from "@/components/shared/baseRoll";
import ResponsiveLayout from "@/components/responsive/ResponsiveLayout";

// eslint-disable-next-line no-undef
defineProps({
  slideKey: {
    type: String,
    default() {
      return "slider";
    }
  },
  breakpoints: {
    type: Object
  },
  isPadding: Boolean,
  products: {
    type: Array,
    default() {
      return []
    }
  },
  perPage: {
    type: Number,
    default() {
      return 5;
    }
  }
});

</script>
<style lang="scss">
.sales-roll {
  .splide__track {
    padding-right: 0 !important;
    padding-left: 0 !important;
  }


}

.sales-roll .splide__slide {
  width: max-content !important;
}

//.sales-roll .item-card {
//  width: 13.8rem !important;
//
//  .splide__slide {
//    width: max-content !important;
//  }
//
//  @media (max-width: 491px) and (min-width: 420px) {
//    width: 13.8rem;
//
//
//  }
//  @media (max-width: 425px) {
//    width: 13.8rem;
//
//  }
//  @media (max-width: 375px) and (min-width: 321px) {
//    width: 13.8rem;
//
//  }
//  @media (max-width: 320px) {
//    width: 13.8rem;
//
//  }
//}
</style>