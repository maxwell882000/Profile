<template>
  <section class="text-500">
    <p class="bold mb-3">{{ $t("Состав заказа") }}</p>
    <b-row>
      <bought-product :key="'bought_product_'+ item.id"
                      :product="item"
                      v-for="item in purchase.purchase">
      </bought-product>
    </b-row>
    <section v-show="purchase.isDelivery" class="text-500">
      <order-detail
          :address="purchase.address ?? ''"
          :date-creation="purchase.payble.accepted_time ?? ''"
          :instructions="purchase.address_comment || ''"
          :id-toggle="'order_payment_id' + purchase.id">
      </order-detail>
      <hr>
    </section>
    <b-row class="py-2">
      <b-col cols="12" class="col-xl-5 col-lg-6 col-md-7 col-sm-12">
        <div class="key-value">
          <span class="text-400">{{ $t("Срок рассрочки") }}</span>
          <span>{{ purchase.payble.number_month }} {{ $t("месяцев") }}</span>
        </div>
        <div class="key-value">
          <span class="text-400">{{ $t("Оплачено") }}</span>
          <span>{{ paid }} {{ $t("сум") }}</span>
        </div>
        <div class="key-value">
          <span class="text-400">{{ $t("Общая оплата") }}</span>
          <span>{{ showPayblePrice }} {{ $t("сум") }}</span>
        </div>
      </b-col>

    </b-row>
  </section>
</template>
<style scoped>
@import "../../../assets/style/order.scss";

</style>
<script setup>
import BoughtProduct from "@/components/userPage/orders/boughtProduct";
import {computed, defineProps} from "vue";
import OrderDetail from "@/components/userPage/orders/orderDetail";
import price_formatter from "@/mixins/price_formatter";

// eslint-disable-next-line no-unused-vars
const props = defineProps({
  purchase: {
    type: Object,
    default() {
      return {}
    }
  }
});
const paid = computed(() => price_formatter(
    parseInt(props.purchase.payble.already_paid) + parseInt(props.purchase.payble.initial_pay)))
const showPayblePrice = computed(() => price_formatter(props.purchase.payble.price));

</script>