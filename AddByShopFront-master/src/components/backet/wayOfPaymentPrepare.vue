<template>
  <section class="section-container mb-3">
    <router-link to="/cart/wayOfPayment" class="remove-link mb-3 d-flex align-items-center justify-content-between">
      <div>
        <div class="mb-3">
          <span class="bold block">{{ $t("Способ оплаты") }}</span>
        </div>
        <div v-if="wayOfPayment.type === type.INSTALLMENT">
          <span>{{ $t("Рассрочка, тариф") }}  <span class="bold">«{{ wayOfPayment.name }}»</span></span>
        </div>
        <div v-else-if="wayOfPayment.type === type.NOT_CHOSEN">
          <span>{{ $t("Выберите способ оплаты") }}</span>
        </div>
        <div v-else-if="wayOfPayment.type === type.CASH">
          <span>{{ $t("Наличными по факту доставки") }}</span>
        </div>
        <div v-else-if="wayOfPayment.type === type.CARD">
          <span>{{ $t("Картой Uzcard или HUMO") }}</span>
        </div>
      </div>
      <div>
        <span class="bi bi-chevron-right"></span>
      </div>
    </router-link>
    <!--    <span>План оплаты рассрочки 21.11.2021 – 20.02.2022</span>-->
  </section>
</template>
<script setup>
import {useStore} from "vuex";
import {computed} from "vue";
import wayOfPaymentConstant from "@/constants/payment/wayOfPaymentConstant";

const store = useStore();
const type = wayOfPaymentConstant;
const wayOfPayment = computed(() => store.getters['registrationOrderModule/wayOfPayment']);
</script>