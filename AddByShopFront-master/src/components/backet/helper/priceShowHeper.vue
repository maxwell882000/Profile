<template>
  <h6 class="mb-3">{{ title }}</h6>
  <div class="mb-3 text-sm">
    <price-show-helper-item
        :price="price"
        color="text-dark"
        :title="`${$t('Товары')} (${numberOfProducts})`"
    />
    <price-show-helper-item
        :price="discountPrice"
        color="text-green"
        :title="$t('Скидка на товары')"
    />
    <price-show-helper-item
        :price="deliveryPrice"
        :title="$t('Доставка')"
    />
    <price-show-helper-item
        :price="overPaymentPrice"
        :title="$t('Сумма переплаты')"
    />

    <!--    <div v-show="productPrice">-->
    <!--      <div class="my-2 d-flex justify-content-between">-->
    <!--        <span> Товары ({{ numberOfProducts }})</span>-->
    <!--        <span class="text-500">{{ productPrice && productPrice.toFixed(2) }} сум</span>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--    <div v-show="discountPrice">-->
    <!--      <div class="my-2 d-flex justify-content-between">-->
    <!--        <span> Скидка на товары</span>-->
    <!--        <span class="text-500 text-red">{{ discountPrice && discountPrice.toFixed(2) }} сум</span>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--    <div v-show="deliveryPrice">-->
    <!--      <div class="my-2 d-flex justify-content-between">-->
    <!--        <span>Доставка</span>-->
    <!--        <span class="text-500">{{ deliveryPrice && deliveryPrice.toFixed(2) }} сум</span>-->
    <!--      </div>-->
    <!--    </div>-->
  </div>

  <div v-show="overallPrice" class="d-flex justify-content-between bold">
    <span>{{ $t("Итого") }}</span>
    <span>{{ overallPrice }} {{$t("сум")}}</span>
  </div>
</template>
<script setup>
// eslint-disable-next-line no-undef
import PriceShowHelperItem from "@/components/backet/helper/priceShowHelperItem";
import price_formatter from "@/mixins/price_formatter";
import {computed} from "vue";

// eslint-disable-next-line no-undef
const props = defineProps({
  title: String,
  productPrice: Number,
  price: Number,
  deliveryPrice: Number,
  discountPrice: Number,
  overPaymentPrice: Number,
  numberOfProducts: Number,
});
const overallPrice = computed(() => price_formatter(props.productPrice + (props.deliveryPrice || 0)));
</script>