<template>
  <div class="col col-12 pt-3 pt-lg-0 col-lg-4">
    <div class="card py-3 px-4">
      <div v-if="!isSelectedEmpty" class="d-flex align-items-center flex-row">
        <span class="bi bi-info-circle-fill me-3 text-secondary"></span>
        <p class="mb-0">
          {{ $t("Выберите товары, чтобы перейти к оформлению заказа") }}
        </p>
      </div>
      <div v-else>
        <price-already-calculated :title="$t('Ваша корзина')"
        ></price-already-calculated>
      </div>
      <!--        <router-link to="/cart/prepareOrder" class='remove-link'>-->
      <ButtonForm @submit="()=>$router.push('/cart/prepareOrder/')" :is-entered="isSelectedEmpty"
                  :title="$t('Перейти к оформлению')"></ButtonForm>
      <!--        </router-link>-->
    </div>
  </div>
</template>
<script setup>
import ButtonForm from "@/components/helper/button/buttonForm";
import {useStore} from "vuex";
import {computed} from "vue";
import PriceAlreadyCalculated from "@/components/backet/helper/priceAlreadyCalculated";

const store = useStore();
const isSelectedEmpty = computed(() => store.getters['prepareBasketModule/numberSelectedOrders']);

</script>