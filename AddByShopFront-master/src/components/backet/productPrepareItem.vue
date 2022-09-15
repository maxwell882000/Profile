<template>
  <div class="d-flex align-items-center">
    <div class="img-product p-2 mr-4">
      <img class="img-res" :src="order.product.image">
    </div>
    <div>
      <small v-show="order.product.discount_price" class="old-price d-block">
        {{ showPrice }} {{$t("сум")}}
      </small>
      <h6>{{ order.quantity }} x {{ showRealPrice }} {{$t("сум")}}</h6>
      <span class="w-50">{{ order.product.title }}</span>
    </div>
  </div>
  <!--  <div class="my-2 d-flex justify-content-between">-->
  <!--    <span>Ожидаемая доставка:</span>-->
  <!--    <span>07.11 – 08.11</span>-->
  <!--  </div>-->
  <!--  <div class="prices d-flex justify-content-between">-->
  <!--    <span>Стоимость доставки:</span>-->
  <!--    <span>28 752 сум</span>-->
  <!--  </div>-->
  <hr>
</template>
<script setup>
// eslint-disable-next-line no-undef,no-unused-vars
import {computed} from "vue";
import price_formatter from "@/mixins/price_formatter";

// eslint-disable-next-line no-undef
const props = defineProps({
  order: Object
});
const showPrice = computed(() => price_formatter(props.order.product.price));
const showRealPrice = computed(() => price_formatter(props.order.product.real_price));
</script>
