<template>
  <!--  <h6> Откуда заберете заказ?</h6>-->
  <!--  <span class="text-sm text-gray">Выберите пункт выдачи на карте или используйте поиск</span>-->
  <!--  <h6>Пункт выдачи</h6>-->
  <!--  <span class="text-sm text-gray">Выберите пункт выдачи на карте или используйте поиск</span>-->
  <loader waiting="map_shop_loaded">
    <div :key="'shop_self_delivery_show_'
        + item.id"
         v-for="item in shops">
      <div class="mb-3">
        <span class="text-500">{{ item.name }}, {{ item.address }}</span>
      </div>
      <div class="text-sm">
        <div class="mb-2">
          <span class="text-gray ">{{ $t('Время работы') }}</span>
        </div>
        <span :key="'hours_work_shop_'+ index"
              v-for="(hours, index) in Object.entries(item.work_hours)">
        {{ hours[1].length === 1 ? hours[1][0] : hours[1][0] + "-" + hours[1][1] }}
        {{ hours[0] }}
          <span v-show="Object.entries(item.work_hours).length !== index + 1">, </span>
      </span>
      </div>
    </div>
    <ButtonBlue @click="goToPurchaseSelfDelivery" :title="$t('Забрать самому')"></ButtonBlue>
  </loader>

</template>
<script setup>
import {useStore} from "vuex";
import {computed} from "vue";
import Loader from "@/components/loading/loader";
import ButtonBlue from "@/components/helper/button/buttonBlue";
import usePurchaseFlow from "@/components/backet/purchaseFlow/setup/usePurchaseFlow";

const store = useStore();
const shops = computed(() => store.getters['deliveryInfoModule/shops']);
const {goToPurchaseSelfDelivery} = usePurchaseFlow();
// const clean = () => {
//   store.dispatch("deliveryInfoModule/selfDelivery");
//
//   router.replace("/cart/prepareOrder");
// };
</script>