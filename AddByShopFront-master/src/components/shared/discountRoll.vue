<template>
  <BaseRoll :autoWidth="true">
    <SplideSlide v-for="item in discount.items" :key="'discount_roll_' + item.id" class="">
      <discount-item class="" :item="item"></discount-item>
    </SplideSlide>

  </BaseRoll>
</template>
<script>
import BaseRoll from "@/components/shared/baseRoll";
import DiscountItem from "@/components/discount/discountItem";
import {mapGetters} from "vuex";

export default {
  // props: ['discount'],
  components: {DiscountItem, BaseRoll},

  computed: {
    ...mapGetters('mainModule', {
      discount: 'discount'
    })
  },


}
</script>