<template>
  <div class="price">
    <div class="payment-info">
      <price-component></price-component>
      <div v-if="isInstallment">
        <div class="installment-plan row">
          <div v-for="(items, index) in installment.credits" :key="'monthes_' + index +'_unique_' + items.id"
               @click="setCredit(items)"
               class="col month" :class="[selectedCredit.id === items.id && 'active']">
            {{ items.month }} <br/>
            мес
          </div>
        </div>
        <div class="installment-pay pt-3 text-center">
          <p class="text-muted mb-1">{{ installment.name }}</p>
          <h5>{{ priceSelectedInstallment }} x {{ selectedCredit.month }} мес</h5>
        </div>
      </div>
      <div class="buttons">
        <buy-fast-and-bag></buy-fast-and-bag>
        <div class="row">
          <div class="col-12">
            <buy-installment-button></buy-installment-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
// import {mapGetters, mapMutations} from "vuex";
import PriceComponent from "@/components/product/priceComponent";
import BuyInstallmentButton from "@/components/product/button/buyInstallmentButton";
import BuyFastAndBag from "@/components/product/button/buyFastAndBag";
import useInstallmentProduct from "@/components/product/installment/setup/useInstallmentProduct";

const {
  installment,
  isInstallment,
  priceSelectedInstallment,
  selectedCredit,
  setCredit,
} = useInstallmentProduct();
// export default {
//   components: {BuyFastAndBag, BuyInstallmentButton, PriceComponent},
//   methods: {
//     ...mapMutations({
//       setCredit: "productModule/setCredit"
//     }),
//   },
//   computed: {
//     ...mapGetters({
//       product: "productModule/product",
//       selected: "productModule/credit"
//     }),
//     priceInstallment() {
//       let price = parseInt(this.priceNew.replace(/\s/g, ''));
//       let calculate_percent = price / 100 * this.selected.percent;
//       console.log(calculate_percent);
//       console.log(price);
//       let divided = (calculate_percent + price) / this.selected.month;
//       console.log(divided);
//       try {
//         return divided.toFixed(0).split("")
//             .reverse().join("").match(/.{1,3}/g).join(" ").split("").reverse().join("");
//       } catch (e) {
//         return 0;
//       }
//     },
//     installment() {
//       return this.product.installment;
//     },
//     priceOld() {
//       return this.product.price;
//     },
//     priceNew() {
//       return this.product.real_price;
//     },
//     discount() {
//       return this.product.discount;
//     }
//   }
// }
</script>
<style lang="scss" scoped>
.month {
  cursor: pointer;
}
</style>