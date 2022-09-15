<template>
  <section class="container mb-4">
    <back-button :title="$t('Назад в оформление')"></back-button>
    <h4>{{ $t("Способ оплаты") }}</h4>
    <b-row class="flex-wrap-reverse flex-sm-wrap-reverse flex-md-nowrap">
      <b-col cols="12" class="col-sm-12 col-md-6 col-lg-7 col-xl-8">
        <h6 v-show="showCredit">{{ $t("Тарифы рассрочки") }}</h6>
        <loader :div-style="{height: '20vh'}" waiting="credit_loaded">
          <b-form-group v-show="showCredit" name="radio-options1" id="installment_number" class="mb-3"
                        v-slot="{ ariaDescribedby }">
            <way-of-payment-item :key="'way_of_payment_' + item.id" v-for="item in credits"
                                 :title="item.name"
                                 name="installment"
                                 v-model="selected"
                                 :value="item.id"
                                 @change="setInstallment(item)"
                                 :desc="item.helper_text"
                                 :aria-describedby="ariaDescribedby">
            </way-of-payment-item>
          </b-form-group>
        </loader>
        <h6 v-show="showPayment">{{ $t("Оплата сразу") }}</h6>
        <b-form-group v-show="showPayment"
                      name="radio-options2" id="way_of_payment" v-slot="{ariaDescribedByPrice}">
          <way-of-payment-item :title="$t('Картой Uzcard или HUMO')"
                               name="installment"
                               @change="setCard()"
                               v-model="selected"
                               :value="status.CARD - RE_MAP_STATUS_VALUE"
                               :desc="$t('Без комиссии, мгновенная оплата')"
                               :aria-describedby="ariaDescribedByPrice"></way-of-payment-item>
          <way-of-payment-item :title="$t('Наличными по факту доставки')"
                               name="installment"
                               @change="setCash()"
                               v-model="selected"
                               :value="status.CASH - RE_MAP_STATUS_VALUE"
                               :desc="$t('Без процентов')"
                               :aria-describedby="ariaDescribedByPrice">

            <div class="mt-2 d-flex align-items-center">
              <info width="20" height="20" style="fill: var(--blue)"></info>
              <span class="text-xs text-gray ml-1">{{ $t("Данным методом нельзя оплатить рассрочку") }}</span>
            </div>
          </way-of-payment-item>
        </b-form-group>
      </b-col>
      <b-col cols="12" class="col-sm-12 col-md-6 col-lg-5 col-xl-4">
        <div style="height: 1.7rem"></div>
        <way-of-payment-price></way-of-payment-price>
      </b-col>
    </b-row>
  </section>
</template>
<script setup>
import BackButton from "@/components/helper/button/backButton";
import WayOfPaymentItem from "@/components/backet/wayOfPayment/wayOfPaymentItem";
import Info from "@/components/icons/info";

import {useStore} from "vuex";
import {computed, ref} from "vue";
import WayOfPaymentPrice from "@/components/backet/wayOfPayment/wayOfPaymentPrice";
import wayOfPaymentConstant from "@/constants/payment/wayOfPaymentConstant";
import Loader from "@/components/loading/loader";

const store = useStore();
// const selected = computed({
//   get: () => {
//     const object = {}
//     object[selectedCreditMainly.value.main_credit_id] = true;
//     object[selectedCreditMainly.value.type - RE_MAP_STATUS_VALUE] = true;
//     console.log(object);
//     console.log(`Chosen object from selected`);
//     console.log(selectedCreditMainly.value);
//     return object;
//   },
// });

const status = wayOfPaymentConstant;
const RE_MAP_STATUS_VALUE = status.RE_MAP_STATUS_VALUE;
const selectedCreditMainly = computed(() => store.getters['registrationOrderModule/wayOfPayment']);
const credits = computed(() => store.getters["wayOfPaymentModule/credits"]);
const setInstallment = (credit) => store.commit("wayOfPaymentModule/setMainCreditInstallment", credit);
const setCash = () => store.commit("wayOfPaymentModule/setMainCreditCash", {});
const showCredit = computed(() => store.getters['wayOfPaymentModule/showCredit']);
const showPayment = computed(() => store.getters['wayOfPaymentModule/showPayment']);
const setCard = () => store.commit("wayOfPaymentModule/setMainCreditCard", {});
const selected = ref(selectedCreditMainly.value.main_credit_id);


</script>