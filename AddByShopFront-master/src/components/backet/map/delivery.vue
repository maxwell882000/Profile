<template>
  <h6>{{ $t("Куда доставить заказ?") }}</h6>
  <span class="text-sm text-gray">{{ $t('Укажите адрес на карте или используйте поиск') }}</span>
  <div class="my-1" style="position: relative">
    <InputValidation @focusin="onFocus = true"
                     @focusout="debounce(()=> onFocus = false)"
                     v-model="address_name"
                     :error="errors['address_name']"
                     :placeholder="$t('Город доставки')">
      <template #suffix>
        <Location></Location>
      </template>
    </InputValidation>
    <div v-show="onFocus" class="rounded-st bg-white p-2 w-100 shadow mt-1"
         style="position: absolute; z-index: 100;">
      <loader :div-style="{height: '10vw'}" waiting="map_city_loaded">
        <div v-if="cities.length === 0">
          <span>{{ $t("Городов не найдено") }}</span>
        </div>
        <template v-else>
          <button @click="setAddressName(city)" :key="'cities_in_address_' + city.id" v-for="city in cities"
                  class="button-clear w-100 text-left">
            {{ city.search }}
          </button>
        </template>
      </loader>
    </div>
  </div>
  <b-row>
    <b-col class="my-1" cols="6">
      <div class="pr-1">
        <InputValidation :error="errors['street']" v-model="deliveryInfo[delivery.STREET]"
                         class="w-100"
                         :placeholder="$t('Улица')"></InputValidation>
      </div>
    </b-col>
    <b-col class="my-1" cols="6">
      <div class="pl-1">
        <InputValidation type="number" :error="errors['index']"
                         v-model="deliveryInfo[delivery.INDEX]"
                         class="w-100" :placeholder="$t('Индекс')"></InputValidation>
      </div>

    </b-col>
    <b-col class="my-1" cols="6">
      <div class="pr-1">
        <InputValidation :error="errors['house']" v-model="deliveryInfo[delivery.HOUSE]"
                         class="w-100" :placeholder="$t('Дом')"></InputValidation>
      </div>

    </b-col>
    <b-col class="my-1" cols="6">
      <div class="pl-1">
        <InputValidation type="number" :error="errors['flat']" v-model="deliveryInfo[delivery.FLAT]"
                         class="w-100"
                         :placeholder="$t('Квартира')"></InputValidation>
      </div>

    </b-col>
    <b-col class="my-1" cols="12">
      <TextArea v-model="deliveryInfo[delivery.INSTRUCTIONS]"
                rows="4"
                :placeholder="$t('Комментарий для курьера')"></TextArea>
    </b-col>
  </b-row>
  <ButtonForm @submit="goToPurchaseDelivery" :is-entered="isValid" class="p-2"
              :title="$t('Привезти сюда')"></ButtonForm>
</template>
<script setup>
import Location from "@/components/icons/location";
import ButtonForm from "@/components/helper/button/buttonForm";
import TextArea from "@/components/helper/text-area/textArea";
import {useStore} from "vuex";
import {computed, ref} from "vue";
import InputValidation from "@/components/helper/input/inputValidation";
import useDebounce from "@/components/helper/debounce/useDebounce";
import deliveryConstant from "@/constants/delivery/deliveryConstant";
import Loader from "@/components/loading/loader";
import usePurchaseFlow from "@/components/backet/purchaseFlow/setup/usePurchaseFlow";

const store = useStore();
const delivery = deliveryConstant;
const {debounce} = useDebounce();
const deliveryInfo = computed(() => store.getters['deliveryInfoModule/deliveryInfo']);
const cities = computed(() => store.getters['deliveryInfoModule/cities']);
const isValid = computed(() => store.getters['deliveryInfoModule/isValid']);
const errors = computed(() => store.getters['deliveryInfoModule/errors']);
const address_name = computed({
  get: () => deliveryInfo.value[deliveryConstant.ADDRESS_NAME],
  set: (val) => {
    deliveryInfo.value[deliveryConstant.ADDRESS_NAME] = val;
    debounce(() => {
      store.dispatch("deliveryInfoModule/getMapSearchCity", val);
    })
  }
})
// const router = useRouter();
const setAddressName = (address) => store.commit("deliveryInfoModule/setAddressName", address);
const {goToPurchaseDelivery} = usePurchaseFlow();
// const submitForm = async () => {
//   const result = await store.dispatch("deliveryInfoModule/submitDelivery");
//   if (result) // valid or not
//     router.replace("/cart/prepareOrder");
// }
const onFocus = ref(false);

</script>
<style scoped>
.border-input {
  margin-top: 5px;
}

.button-blue {
  border: none;
  background-color: transparent;
}
</style>
