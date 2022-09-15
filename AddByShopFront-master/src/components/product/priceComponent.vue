<template>
  <div>
    <p v-show="changedPrice" class="old-price">
      <small>{{ priceOld }} {{ $t("сум") }} </small>
    </p>
    <h5 class="price">
      {{ priceNew }} {{ $t("сум") }} <small class="sale-percent" v-show="discount">-{{ discount }}%</small>
    </h5>
  </div>

</template>
<script>
import {mapGetters} from "vuex";

export default {
  computed: {
    ...mapGetters({
      product: "productModule/product",
    }),
    changedPrice() {
      return this.priceOld !== this.priceNew;
    },
    priceOld() {
      return this.product.price;
    },
    priceNew() {
      return this.product.real_price;
    },
    discount() {
      return this.product.discount;
    }
  }
}
</script>
<style scoped lang="scss">
.price {
  font-weight: 600;
  padding-bottom: 20px;
  @media (max-width: 768px) {
    padding-bottom: 0 !important;
  }

  .sale-percent {
    padding: 2px 10px;
    font-weight: 400;
    position: relative;
    bottom: 3.8px;
    background-color: var(--red);
    border-radius: 20px;
    color: white;
    font-size: 12px;
  }

}
</style>