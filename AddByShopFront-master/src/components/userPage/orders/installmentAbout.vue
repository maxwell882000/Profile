Ï
<template>
  <section class="about-installment">
    <div>
        <span class="text-gray block">
         {{ $t("Ежемесячный платеж") }}
        </span>
      <span class="bold">
          {{ showMonthPaid }} {{ $t("сум") }}
        </span>
    </div>
    <div class="text-end">
        <span class="text-gray block">
          Осталось
        </span>
      <span class="bold">{{ purchase.payble.rest_month }} {{ $t("платежа") }}</span>
    </div>
  </section>
</template>
<script setup>
// eslint-disable-next-line no-undef,no-unused-vars

import {computed} from "vue";
import price_formatter from "@/mixins/price_formatter";

const showMonthPaid = computed(() => price_formatter(props.purchase.payble.month_paid));
// eslint-disable-next-line no-undef
const props = defineProps({
  purchase: {
    type: Object,
    default() {
      return {}
    }
  }
});
</script>