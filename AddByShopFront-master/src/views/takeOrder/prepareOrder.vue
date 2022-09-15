<template>
  <section class="container">
    <back-button :title="$t('Назад в корзину')"></back-button>
    <h4>{{ $t("Оформление заказа") }}</h4>
    <b-row>
      <b-col cols="12" class="col-xl-9 col-lg-8 col-md-12">
        <div v-show="deliveryCost.different_shop">
          <div class="section-container d-flex align-items-center mb-3">
            <Info style="fill: var(--green)"></Info>
            <span
                class="ml-2 text-500 text-sm">
              {{ $t("Внимание, мы разделили заказ, потому что товары будут отправлены с разных складов") }}
            </span>
          </div>
        </div>
        <delivery-prepare :class="errorOnDelivery && 'text-error'"/>
        <way-of-payment-prepare :class="errorOnPayment && 'text-error'"/>
        <section class="text-sm section-container mb-3">
          <product-prepare-item :key="'prepare_order_'+ item[0]" :order="item[1]" v-for="item in orders"/>
        </section>
      </b-col>
      <b-col cols="12" class="col-xl-3 col-lg-4">
        <section class="section-container mb-3 ">
          <loader :div-style="{height: '10vh'}" waiting="delivery_price_loaded">
            <price-already-calculated
                :title="$t('Ваш заказ')"
                :delivery-price="deliveryCost.price"
                :over-payment-price="wayOfPayment.over_payment"
            >
            </price-already-calculated>
            <router-link :to="canBePaid ? routerPath: ''">
              <ButtonForm @submit="purchaseOrders" @not-submit="setNotSubmit"
                          :is-entered="canBePaid"
                          :title="$t('Оплатить')"></ButtonForm>
            </router-link>
            <div class="text-center mt-3">
              <div class="d-flex justify-content-center align-items-end text-sm">
                <div>
                  <shields></shields>
                </div>
                <span>
                  {{ $t("Безопасное оформление заказа") }}
              </span>
              </div>
              <span class="text-xs text-gray">{{ $t("Нажимая «Оплатить» вы соглашаетесь с") }}
              <span class="text-dark text-underline pointer"> {{ $t("уcловиями использования") }} </span>
                {{ $t("и") }}
              <span class="text-dark text-underline pointer">{{ $t("оплаты") }}</span>{{ $t("сервиса") }}  ByShop</span>
            </div>
          </loader>
        </section>
      </b-col>
    </b-row>
  </section>
</template>
<script setup>
import BackButton from "@/components/helper/button/backButton";
// import Info from "@/components/icons/info";
import DeliveryPrepare from "@/components/backet/deliveryPrepare";
import WayOfPaymentPrepare from "@/components/backet/wayOfPaymentPrepare";
import ProductPrepareItem from "@/components/backet/productPrepareItem";
import Shields from "@/components/icons/shields";
import PriceAlreadyCalculated from "@/components/backet/helper/priceAlreadyCalculated";
import Loader from "@/components/loading/loader";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import Info from "@/components/icons/info";
import deliveryStatusConstant from "@/constants/delivery/deliveryStatusConstant";
import wayOfPaymentConstant from "@/constants/payment/wayOfPaymentConstant";
import ButtonForm from "@/components/helper/button/buttonForm";
import agreementAndPolicies from "@/constants/basket/agreementAndPolicies";

const store = useStore();
const deliveryCost = computed(() => store.getters['registrationOrderModule/deliveryCost']);
const orders = computed(() => Object.entries(store.getters['prepareBasketModule/selectedOrders']));
const wayOfPayment = computed(() => store.getters['registrationOrderModule/wayOfPayment']);
const deliveryStatus = computed(() => store.getters['deliveryInfoModule/status']);
const getCard = () => store.dispatch('plasticCardModule/getCards');
const openAgreement = () => store.commit("registrationOrderModule/setPolicies", agreementAndPolicies.CHOOSING);
const status = deliveryStatusConstant;
const canBePaid = computed(() =>
    deliveryStatus.value !== status.NOT_CHOSEN
    && wayOfPayment.value.type !== wayOfPaymentConstant.NOT_CHOSEN);
const isNotSumbit = ref(false);
const errorOnPayment = computed(() => isNotSumbit.value
    && wayOfPayment.value.type === wayOfPaymentConstant.NOT_CHOSEN);
const errorOnDelivery = computed(() => isNotSumbit.value && deliveryStatus.value === wayOfPaymentConstant.NOT_CHOSEN);
const routerPath = ref("/cart/plasticCard");
const getCredits = () => store.dispatch('wayOfPaymentModule/getWayOfPayment');

getCredits();

function setNotSubmit() {
  isNotSumbit.value = true;
}

function purchaseOrders() {
  if (wayOfPayment.value.type === wayOfPaymentConstant.CASH) {
    routerPath.value = "";
    openAgreement();
  }

}

getCard();// dispatching beforehand
</script>
<style>
.img-product {
  height: 6rem;
  width: 6rem;
}
</style>