<template>
  <div class="d-none d-sm-none d-md-block ">
    <div class="row stocks">
      <discount-item :item="item" class="col-xl-4 col-lg-4 col col-md-6 col-sm-12" v-for="item in discount.items"
                     :key="'disciont_' + item.id"></discount-item>
    </div>
  </div>

  <div class="d-block d-sm-block d-md-none discounts">
    <!--    <Flicking :options="{panelsPerView: 1}">-->
    <!--      <div v-for="item in discount.items" :key="'disciont_' + item.id">-->
    <!--        <div class="d-flex justify-content-center">-->
    <!--          <discount-item :item="item" class="p-2"></discount-item>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--    </Flicking>-->
    <BaseRoll :perPage="2">
      <SplideSlide v-for="item in discount.items" :key="'discount_small_' + item.id" class="w-100">
        <!--        <div class="row stocks">-->
        <div class="d-flex justify-content-center">
          <discount-item :item="item" class="p-md-2 p-sm-0 p-0"></discount-item>
        </div>
        <!--        </div>-->
      </SplideSlide>
    </BaseRoll>
  </div>

</template>
<script>
import {mapGetters} from "vuex";
import DiscountItem from "@/components/discount/discountItem";
import BaseRoll from "@/components/shared/baseRoll";

export default {
  // eslint-disable-next-line vue/no-unused-components
  components: {BaseRoll, DiscountItem},
  computed: {
    ...mapGetters('mainModule', {
      discount: 'discount'
    })
  },
}
</script>
<style>
.home .discounts .splide__list {
  width: 100%;
}

.home .discounts .splide__track {
  padding-left: 0 !important;
  padding-right: 0 !important;
}
</style>
<style lang="scss" scoped>


.stocks .col {
  padding: 10px;
}

.stocks img {
  transition: all 0.3s;
  width: 100%;
  border-radius: 12px;
  cursor: pointer;
  box-shadow: 0 0 0 transparent;
}

.stocks img:hover {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
</style>