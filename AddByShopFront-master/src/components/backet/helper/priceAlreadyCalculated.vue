<template>
  <price-show-heper :title="title"
                    :product-price="overallPrice"
                    :delivery-price="deliveryPrice"
                    :price="price"
                    :discount-price="discountPrice"
                    :number-of-products="selectedLength"
                    :over-payment-price="overPaymentPrice"
  ></price-show-heper>
</template>
<script setup>
import PriceShowHeper from "@/components/backet/helper/priceShowHeper";
import usePrepareBasketPrice from "@/components/backet/helper/setup/usePrepareBasketPrice";
// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  title: String,
  deliveryPrice: Number,
  overPaymentPrice: Number
});
const {overallPrice, selectedLength, discountPrice, price} = usePrepareBasketPrice();

</script>