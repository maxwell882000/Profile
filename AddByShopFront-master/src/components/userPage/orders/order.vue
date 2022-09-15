<template>
  <loader :waiting="'payment_' + purchase.id">
    <div class="orders">
      <section>
        <order-header :id-order="purchase.id">
          <div class="rounded-st text-sm p-1" :class="status.color">
            <span>{{ status.text }}</span>
          </div>
        </order-header>
      </section>
      <hr>
      <section class="text-500">
        <b-row>
          <bought-product
              :key="'gotted_product_purchase_' + item.id"
              v-for="item in purchase.purchase"
              :product="item">
          </bought-product>
        </b-row>
      </section>
      <hr>
      <section v-show="purchase.isDelivery" class="text-500">
        <order-detail
            :address="purchase.address ?? ''"
            :date-creation="purchase.payble.accepted_time ?? ''"
            :instructions="purchase.address_comment || ''"
            :id-toggle="'order_payment_id' + purchase.id">
        </order-detail>
        <hr>
      </section>
      <section class="row text-500">
        <b-col cols="12" class="col-xl-5 col-lg-6 col-md-7">
          <p class="bold mb-1">{{ $t("Состав заказа") }}</p>
          <div class="key-value">
            <span>{{ $t("Товары") }} - {{ purchase.allQuantity }} {{ $t("шт") }}</span>
            <span>{{ showOriginalPrice }} {{ $t("сум") }}</span>
          </div>
          <div v-show="showDiscount">
            <div class="key-value">
              <span>{{ $t("Скидка") }}</span>
              <span class="text-green">{{ showDiscount }} {{ $t("сум") }}</span>
            </div>
          </div>
          <div v-show="purchase.sumDelivery > 0">
            <div class="key-value">
              <span>{{ $t("Доставка") }}</span>
              <span class="">{{ showSumDelivery }} {{ $t("сум") }}</span>
            </div>
          </div>

          <div class="key-value py-2 last">
            <span class="bold">{{ $t("Итого к оплате") }}</span>
            <span class="text-blue">{{ showPayblePrice }} {{ $t("сум") }}</span>
          </div>
        </b-col>
      </section>
      <section
          class="button-order d-flex">
        <ButtonGray
            v-show="statusPayment.ACCEPTED  === purchase.payble.status
                          ||  statusPayment.WAIT_ANSWER === purchase.payble.status"
            @click="openReason"
            :title="$t('Отменить Заказ')"
            title-class="text-dark text-500"
        ></ButtonGray>
        <!--      <ButtonBlue v-show="statusPayment.FINISHED === purchase.payble.status"-->
        <!--                  title="Повторить заказ"-->
        <!--                  class="p-2 m-0">-->
        <!--      </ButtonBlue>-->
      </section>
    </div>
    <cancel-payment :show="showReason"
                    @close-modal="closeReason"
                    @submit-reason="cancel"
    ></cancel-payment>
  </loader>
</template>

<style lang="scss" scoped>
@import "../../../assets/style/order.scss";
</style>
<script setup>
import BoughtProduct from "@/components/userPage/orders/boughtProduct";
// import ButtonBlue from "@/components/helper/button/buttonBlue";
import OrderHeader from "@/components/userPage/orders/orderHeader";

// eslint-disable-next-line no-unused-vars
import OrderDetail from "@/components/userPage/orders/orderDetail";
import statusPaymentToFront from "@/constants/payment/statusPaymentToFront";
import {computed, ref, watch} from "vue";
import {useStore} from "vuex";
import statusPayment from "@/constants/payment/statusPayment";
import Loader from "@/components/loading/loader";
import CancelPayment from "@/components/userPage/orders/modal/cancelPayment";
import useCancel from "@/components/userPage/orders/setup/useCancel";
import ButtonGray from "@/components/helper/button/buttonGray";
import price_formatter from "@/mixins/price_formatter";


// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  purchase: {
    type: Object,
  }
});
// const discount = computed(() => props.purchase.originalPrice * props.purchase.allQuantity - props.purchase.productPrice);
const status = ref({});
watch(() => props.purchase.payble.status, function (val) {
  status.value = {
    ...statusPaymentToFront[val]
  };
  if (val === statusPayment.DECLINED && props.purchase.payble.reason) {
    status.value.text = props.purchase.payble.reason;
  }
}, {immediate: true});
// eslint-disable-next-line no-unused-vars
const store = useStore();
// const showReason = ref(false);
// const openReason = () => showReason.value = true;
// const closeReason = () => showReason.value = false;
// eslint-disable-next-line no-unused-vars
const cancelStore = (reason) => store.dispatch("purchaseModule/cancelPayment", {
  purchase: props.purchase.payble,
  reason: {reason}
});
const {showReason, openReason, closeReason, cancel} = useCancel(cancelStore);

// eslint-disable-next-line no-unused-vars
const showOriginalPrice = computed(() => price_formatter(props.purchase.originalPrice));
const showDiscount = computed(() => price_formatter(props.purchase.originalPrice - props.purchase.productPrice));
const showSumDelivery = computed(() => price_formatter(props.purchase.sumDelivery));
// eslint-disable-next-line no-unused-vars
const showPayblePrice = computed(() => price_formatter(props.purchase.payble.price));
// function cancel(val) {
//   cancelStore(val.id === 5 ? val.value : val.text);
// }
</script>