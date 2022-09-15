<template>
  <div>
    <span class="text-gray block">{{ $t("Осталось") }}</span>
    <span class="bold text-lg">{{ showAlreadyPaid }} <span
        class="text-400 text-gray">из {{ showAllToPay }} {{ $t("cум") }}</span></span>
    <div class="d-flex mt-3 w-100">
      <div class=" rounded-st lines"
           :key="'month_installment_' + items.id"
           :class="
           items.id <
           purchase.payble.next_paid_month ?
           'back-blue':'back-gray'"
           v-for="items in purchase.payble.months"></div>
      <!--      <div class="back-blue rounded-st lines"></div>-->
      <!--      <div class="back-blue rounded-st lines "></div>-->
    </div>
  </div>
</template>
<script setup>
import {computed, defineProps} from "vue";
import price_formatter from "@/mixins/price_formatter";

const showAlreadyPaid = computed(() => price_formatter(props.purchase.payble.already_paid));
const showAllToPay = computed(() => price_formatter(props.purchase.payble.all_to_pay));
// eslint-disable-next-line no-unused-vars
const props = defineProps({
  purchase: {
    type: Object,
    default() {
      return {
        payble: {
          already_paid: 0,
          all_to_pay: 0,
        }
      }
    }
  }
});
</script>
<style scoped>
.lines {
  flex: 1;
  padding: 0.125rem;
  margin-right: 0.2rem;
  max-width: 5rem;
}
</style>