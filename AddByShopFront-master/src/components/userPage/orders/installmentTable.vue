<template>
  <section class="extended-content-container">
    <table class="w-100">
      <tr
          :key="'table_installment_'+ item.id"
          v-for="(item, index) in purchase.payble.months"
          class="table-installment"
          :class="index % 2 === 0 && 'table-gray'">
        <td class="text-nowrap">{{ item.month }}</td>
        <td class="text-nowrap">{{ price_formatter(item.paid) }}</td>
        <td class="w-100">
          <div class="w-100 text-nowrap text-right">
               <span v-if="status.WAIT_ANSWER === purchase.payble.status">
           {{ $t("Ожидаеться") }}
          </span>
            <ButtonBlue
                v-else-if="checkIfInstallment(item)"
                @click="payForMonth(item)"
                class="button m-0"
                :title="$t('Оплатить')">
            </ButtonBlue>
            <span v-else-if="status.DECLINED === purchase.payble.status">{{ $t("Отказано") }}</span>
            <span v-else-if="item.must_pay === item.paid" class="text-green"> {{ $t("Оплачено!") }}</span>
            <span v-else> {{ $t("Не оплачено") }}</span>
          </div>

        </td>
      </tr>
    </table>
  </section>
  <hr>
</template>
<script setup>
import {useStore} from "vuex";
import statusPayment from "@/constants/payment/statusPayment";
import ButtonBlue from "@/components/helper/button/buttonBlue";
import price_formatter from "@/mixins/price_formatter";
// import ButtonBlue from "@/components/helper/button/buttonBlue";
// eslint-disable-next-line no-unused-vars,no-undef
const props = defineProps({
  purchase: {
    type: Object,
    default() {
      return {}
    }
  }
});
const store = useStore();
const payment = (selectedMonth) => store.dispatch('purchaseModule/startPayment', selectedMonth);
const status = statusPayment;

function checkIfInstallment(item) {
  return item.must_pay !== item.paid
      && status.ACCEPTED === props.purchase.payble.status
      && item.id <= props.purchase.payble.next_paid_month
}

function payForMonth(item) {
  payment({
    purchase: props.purchase,
    month: item
  })
}
</script>

<style lang="scss" scoped>
@import "../../../assets/style/order.scss";

.table-gray {
  background-color: var(--gray100);

}

.table-white {
  background-color: white;
}

.extended-content-container {
  width: calc(100% + #{$padding} * 2);
  margin-left: -$padding;
  padding: 0 !important;
}

.table-installment .button {
  margin: 0;
  padding: 0.2rem;
  width: max-content !important;
}

table tr td:nth-child(1) {
  padding-left: $paddingTable;
}

table tr td {
  font-size: 0.85rem;
}

table tr td:nth-child(3) {
  padding-right: $paddingTable;
  display: flex;
  align-items: end;
  justify-content: end;
  width: 100%;
}

table tr td:nth-child(3) * {
  width: 30%;
}

table tr td {
  padding-top: $paddingTable * 0.45;
  padding-bottom: $paddingTable * 0.45;
}
</style>
