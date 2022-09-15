<template>
  <div v-show="purchase" :key="keyField + purchase.id" v-for="purchase in items">
    <order v-if="purchase.status !== payment.INSTALLMENT" :purchase="purchase"></order>
    <instalment v-else :purchase="purchase"></instalment>
  </div>
</template>
<script setup>
import Order from "@/components/userPage/orders/order";
import Instalment from "@/components/userPage/orders/instalment";
import wayOfPaymentConstant from "@/constants/payment/wayOfPaymentConstant";

// eslint-disable-next-line no-unused-vars
const payment = wayOfPaymentConstant;
// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  keyField: String,
  items: Array
})

// eslint-disable-next-line no-unused-vars
function visible() {
  console.log("UPDATED");
}
</script>
<style scoped>
.scroller {
  height: 100%;
}

.dynamic-scroller-demo {
  overflow: hidden;
}
</style>