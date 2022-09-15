<template>
  <way-of-payment-price-accept
      v-if="mainCredit.type === status.NOT_CHOSEN"
      :title="$t('Выберите способ оплаты')"
      :button-name="$t('Выберите способ оплаты')">
    <div class="mr-4">
      <Info style="fill: var(--gray300)"></Info>
    </div>
  </way-of-payment-price-accept>
  <way-of-payment-price-accept
      v-else-if="mainCredit.type === status.CARD"
      :title="$t('Картой Uzcard или HUMO')"
      :is-entered="true"
      @accept="acceptCard"
      :button-name="$t('Подтвердить')">
  </way-of-payment-price-accept>

  <way-of-payment-price-accept
      v-else-if="mainCredit.type === status.CASH"
      :title="$t('Наличными по факту доставки')"
      :is-entered="true"
      @accept="acceptCash"
      :button-name="$t('Подтвердить')">
  </way-of-payment-price-accept>


  <section v-else-if="mainCredit.type === status.INSTALLMENT" class="section-container">
    <div v-show="mainCredit.initial_percent" class="mb-3">
      <span class="mb-1 block">{{ $t('Первый взнос') }} </span>
      <range-input-one
          @update:modelValue="getInitialPayment"
          :initial-value="parseFloat(initialPriceValue().toFixed(2))"
          :min="initialPriceWithPercents"
          :max="priceWithPercents"
          :labelMin="initialPriceWithPercents.toFixed(2)"
          :labelMax="priceWithPercents.toFixed(2)">
      </range-input-one>
    </div>
    <div>
      <span class="mb-1 block">{{ $t("Срок рассрочки") }}</span>
      <range-input-one-values
          @range-change="setOverallPriceWithPercentage"
          :disable-input="true"
          :initial-value="installment.index"
          :reset="resetIndex"
          :label-min="credits.min"
          :label-max="credits.max"
          :values="credits.values"
          :min="0"
          :max="credits.length">
      </range-input-one-values>
    </div>
    <div class="mt-3 section-container back-gray text-sm">
      <div class="d-flex justify-content-between mb-2 font-key">
        <span>{{ $t("Ежемесячный платеж:") }}</span>
        <span class="text-500">
                {{ showEachMonthPayment }} {{ $t("сум") }}
              </span>
      </div>
      <div class="d-flex justify-content-between mb-2 font-key">
        <span>{{ $t("Процент переплаты:") }}</span>
        <span class="text-500 text-red">
             {{ installment.currentPercentage }}%
              </span>
      </div>
      <div class="d-flex justify-content-between mb-2 font-key">
        <span>{{ $t("Сумма переплаты:") }}</span>
        <span class="text-500 text-red">
                {{ showPercentageOverPayment }} {{ $t("сум") }}
              </span>
      </div>
      <div class="d-flex justify-content-between  font-key">
        <span>{{ $t("Общая сумма оплаты:") }}</span>
        <span class="text-500">
                  {{ showOverallPrice }} {{ $t("сум") }}
              </span>
      </div>
    </div>
    <div class="text-xs mt-2">
      <em class="small-text">{{ $t("Продолжная, вы соглашаетесь с") }}
        <span class="text-blue small-text">
          {{ $t("Условиями использования") }}</span> {{ $t("и") }} <span
            class="text-blue small-text">{{ $t("Политикой конфиденциальности") }} </span>
        {{ $t("ByShop") }} </em>
    </div>
    <ButtonBlue @click="acceptInstallment" :title="$t('Подтвердить способ оплаты')"></ButtonBlue>
  </section>
</template>
<script setup>
import ButtonBlue from "@/components/helper/button/buttonBlue";
import RangeInputOne from "@/components/helper/input/range/rangeInputOne";
import {useStore} from "vuex";
import {computed, onBeforeMount, onBeforeUnmount, reactive, ref, watch} from "vue";
import wayOfPaymentConstant from "@/constants/payment/wayOfPaymentConstant";
import Info from "@/components/icons/info";
import RangeInputOneValues from "@/components/helper/input/range/rangeInputOneValues";
import WayOfPaymentPriceAccept from "@/components/backet/wayOfPayment/wayOfPaymentPriceAccept";
import useSelectedWayOfPayment from "@/components/backet/wayOfPayment/setup/useSelectedWayOfPayment";
import price_formatter from "@/mixins/price_formatter";

const store = useStore();
const status = wayOfPaymentConstant;
const mainCredit = computed(() => store.getters['wayOfPaymentModule/mainCredit']);
const wayOfPayment = computed(() => store.getters['registrationOrderModule/wayOfPayment']);
const credits = computed(() => store.getters['wayOfPaymentModule/getMonth']);
const overallPrice = ref(store.getters['prepareBasketModule/calculatePrice']('real_price'));
const fixed_price = overallPrice.value;
const percent = ref(0); // in selected credit we have percent which additionally must be applied to overallcost
const resetIndex = ref(true);// resetting slider when credit changed
const showEachMonthPayment = computed(() => price_formatter(installment.eachMonthPayment));
const showPercentageOverPayment = computed(() => price_formatter(installment.percentageOverPayment));
const showOverallPrice = computed(() => price_formatter(overallPrice.value));

function setInitialType() {
  mainCredit.value.type = wayOfPayment.value.type;
  console.log(mainCredit.value);
  console.log(wayOfPayment.value);
}

const priceWithPercents = computed(() => {
  const percentPrice = percent.value * overallPrice.value;
  return percentPrice + overallPrice.value;
});

const initialPriceWithPercents = computed(() => {
  return overallPrice.value * (mainCredit.value.initial_percent ?? 0) / 100;
});
const installment = reactive({
  currentPercentage: 0,
  percentageOverPayment: 0,
  eachMonthPayment: 0,
  initialPayment: initialPriceWithPercents.value,
  currentCredit: {},
  index: 0,
});

function initialPriceValue() {
  if (wayOfPayment.value.initial_price && wayOfPayment.value.initial_price <= priceWithPercents.value
      && wayOfPayment.value.initial_price >= initialPriceWithPercents.value) {
    return wayOfPayment.value.initial_price;
  }
  return initialPriceWithPercents.value;
}

function onStart() {
  setInitialType();
  if (wayOfPayment.value.index_of_credit >= 0) {
    setOverallPriceWithPercentage(wayOfPayment.value.index_of_credit);
    getInitialPayment(wayOfPayment.value.initial_price);
    calculateEachMonthPayment();
  }
}

onStart();

function checkIsIndexOnInstallment(index) {
  if (mainCredit.value.type === status.INSTALLMENT
      && (index === 0 || index)
      && mainCredit.value.credits.length) {
    installment.index = index;
    return true;
  }
  return false;
}

function setCurrentCredit() {
  console.log(mainCredit.value);
  installment.currentCredit = mainCredit.value.credits[installment.index]; // getting correct current credit from index

}

function setOverallPrice() {
  installment.currentPercentage = installment.currentCredit.percent / 100;
  installment.percentageOverPayment = fixed_price * installment.currentPercentage;
  overallPrice.value = fixed_price + installment.percentageOverPayment;
}

function setOverallPriceWithPercentage(index) {
  console.log(`INDEX OF THE FILE ${index}`);
  if (checkIsIndexOnInstallment(index)) {
    setCurrentCredit();
    setOverallPrice();
    calculateEachMonthPayment();
  }
  resetSliderForPrice(index);
}

function resetSliderForPrice(index) { // when we change credit we have to return slider to initial value
  if (index === 0) {
    resetIndex.value = !resetIndex.value;
  }
}

let unWatch;
onBeforeMount(() => {
  console.log("MOUNTED ELEMENT");
  unWatch = watch(() => store.getters['wayOfPaymentModule/mainCredit'], () => { // when we change the credit we have to put appropriate prices
    console.log("START WATCH");
    setOverallPriceWithPercentage(0);       // give correct percent , so he is able to choose price
  });
})
onBeforeUnmount(() => {
  unWatch();
})

function calculateEachMonthPayment() {

  installment.eachMonthPayment = (overallPrice.value - installment.initialPayment) / installment.currentCredit.month;
  console.log(`MONTH ${installment.currentCredit}`);
  console.log(`INITIAL PAYMENT ${installment.initialPayment}`);
}


// get initial payment if it is installment
function getInitialPayment(price) {
  console.log("initial price");
  console.log(price);
  installment.initialPayment = price;
  calculateEachMonthPayment();
}

// I have selected credits
const {
  acceptCash,
  acceptCard,
  acceptInstallment
} = useSelectedWayOfPayment(installment, overallPrice, mainCredit);
</script>
<style scoped>
.font-key {
  font-weight: 400;
  font-size: 12px !important;
  line-height: 20px;
}

.small-text {
  font-weight: 400;
  font-size: 12px;
  line-height: 15px;
}
</style>