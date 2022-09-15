<template>
  <section class="section-container mb-3">
    <!--    <h6>Доставка</h6>-->
    <!--    <hr>-->
    <div class="d-flex">
      <div v-show="status.NOT_CHOSEN !== currentStatus" class="mr-4">
        <location-pin v-if="status.DELIVERY === currentStatus"></location-pin>
        <box-time v-else-if="status.SELF_DELIVERY === currentStatus"></box-time>
      </div>
      <div class="w-100">
        <div class="mb-3">
          <span class="bold">{{
              status.DELIVERY === currentStatus ? $t("Курьером")
                  : status.SELF_DELIVERY === currentStatus ? $t("Самовызов") : $t('Адрес доставки')
            }} </span>
        </div>
        <router-link to="/cart/selectAddress"
                     class="mb-3 remove-link d-flex w-100 justify-content-between align-items-center">
          <div v-if="currentStatus === status.NOT_CHOSEN">
            <span>
              {{ $t("Добавить адрес доставки") }}
            </span>
          </div>
          <div v-else-if="currentStatus === status.SELF_DELIVERY">
            <div class="mt-3">
              <span class="text-blue">{{$t("Изменить способ доставки")}}</span>
            </div>
          </div>
          <div v-else-if="status.DELIVERY === currentStatus">
            <span>
            {{ address }}
             </span>
            <br>
            <span class=" text-gray">
            {{ homeInfo }}
          </span>
            <br>
            <div class="mt-3">
              <span class="text-blue">{{$t("Изменить способ доставки")}}</span>
            </div>
          </div>
          <div>
            <span class="bi bi-chevron-right"></span>
          </div>
        </router-link>
      </div>
    </div>
  </section>
</template>
<script setup>
import LocationPin from "@/components/icons/locationPin";
import {useStore} from "vuex";
import {computed} from "vue";
import deliveryStatusConstant from "@/constants/delivery/deliveryStatusConstant";
import BoxTime from "@/components/icons/box-time";

const store = useStore();
const status = deliveryStatusConstant;
const address = computed(() => store.getters['registrationOrderModule/fullAddress']);
const homeInfo = computed(() => store.getters['registrationOrderModule/homeInfo'])
// const numberOfProduct = computed(() => store.getters['prepareBasketModule/selectedOrders'])
const currentStatus = computed(() => store.getters['deliveryInfoModule/status']);
</script>