<template>
  <div>
    <section>
      <b-row>
        <bought-product :key="'bought_product_required_surety_'+ item.id"
                        :product="item"
                        v-for="item in purchase.purchase">
        </bought-product>
      </b-row>
    </section>
    <section class="back-gray rounded-st p-2">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <span class="text-center text-xs-l"><Info></Info> {{ $t("Чтобы получить рассрочку, вам нужно добавить поручителя") }}</span>
        </div>
        <div>
          <ButtonVialet @click="goToAddSurety()" class="m-0 p-1 text-400"
                        :title="$t('Добавить поручителя')"></ButtonVialet>
        </div>
      </div>
    </section>
  </div>
</template>
<script setup>
import ButtonVialet from "@/components/helper/button/buttonVialet";
import Info from "@/components/icons/info";
import BoughtProduct from "@/components/userPage/orders/boughtProduct";
import {useStore} from "vuex";
import {useRouter} from "vue-router";

// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  purchase: Object
})

const store = useStore();
const route = useRouter();
const setTakenCreditId = () => store.commit('verificationModule/setTakenCreditID', props.purchase.payble.id);

function goToAddSurety() {
  setTakenCreditId();
  route.push({
    path: "/verification/surety/1"
  })
}

</script>