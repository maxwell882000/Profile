<template>
  <loader :div-style="{height: 'max-content'}" :waiting="'installment_' + purchase.id">
    <div v-if="!purchase">
      ERROR HAPPENED
    </div>
    <div v-else class="orders">
      <section>
        <order-header :id-order="purchase.id">
          <div class="rounded-st text-sm p-1" :class="status.color">
            <span>{{ status.text }}</span>
          </div>
        </order-header>
      </section>
      <hr>
      <installment-surety
          :purchase="purchase"
          v-if="purchase.payble.status >= statusPayment.REQUIRED_SURETY &&
              purchase.payble.status < statusPayment.REQUIRED_SURETY_ACCEPTED"></installment-surety>
      <div v-else>
        <section>
          <installment-rest-payment :purchase="purchase"></installment-rest-payment>
        </section>
        <installment-about :purchase="purchase"></installment-about>
        <installment-table :purchase="purchase"></installment-table>
        <installment-detail :purchase="purchase"></installment-detail>
      </div>
      <!--    <section class="button-order">-->
      <!--      <ButtonGray title="Оплатить всю рассрочку"></ButtonGray>-->
      <!--    </section>-->
      <section class="w-max d-flex">
        <ButtonGray
            @click="openReason"
            v-show="statusPayment.WAIT_ANSWER === purchase.payble.status"
            :title="$t('Отменить Заказ')"
            title-class="text-dark text-500"
        ></ButtonGray>
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

.about-installment {
  display: flex;
  justify-content: space-between;
}
</style>
<script setup>
import OrderHeader from "@/components/userPage/orders/orderHeader";
import InstallmentRestPayment from "@/components/userPage/orders/installmentRestPayment";
import InstallmentTable from "@/components/userPage/orders/installmentTable";
import InstallmentDetail from "@/components/userPage/orders/installmentDetail";
import InstallmentAbout from "@/components/userPage/orders/installmentAbout";
import statusPaymentToFront from "@/constants/payment/statusPaymentToFront";
import statusPayment from "@/constants/payment/statusPayment";
import {defineProps, ref, watch} from "vue";
import InstallmentSurety from "@/components/userPage/orders/installmentSurety";
import Loader from "@/components/loading/loader";
import ButtonGray from "@/components/helper/button/buttonGray";
import useCancel from "@/components/userPage/orders/setup/useCancel";
import CancelPayment from "@/components/userPage/orders/modal/cancelPayment";
import {useStore} from "vuex";


const props = defineProps({
  purchase: {
    type: Object,
  }
});
const status = ref({});

watch(() => props.purchase.payble.status, function () {
  if (props.purchase) {
    status.value = {
      ...statusPaymentToFront[props.purchase.payble.status >= statusPayment.REQUIRED_SURETY &&
      props.purchase.payble.status < statusPayment.REQUIRED_SURETY_ACCEPTED ?
          statusPayment.REQUIRED_SURETY
          : props.purchase.payble.status >= statusPayment.REQUIRED_SURETY_ACCEPTED
              ? statusPayment.WAIT_ANSWER : props.purchase.payble.status]
    };
    if (props.purchase.payble.status === statusPayment.DECLINED) {
      status.value.text = props.purchase.payble.reason;
    }
  } else
    status.value = {}
}, {immediate: true});

const store = useStore();
const cancelStore = (reason) => store.dispatch("purchaseModule/cancelInstallment", {
  purchase: props.purchase.payble,
  reason: {reason}

})
const {openReason, showReason, cancel, closeReason} = useCancel(cancelStore)
</script>