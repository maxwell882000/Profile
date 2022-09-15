<template>
  <ModalView @close-modal="close()" v-model="showPlastic" :title="$t('Выберите способ оплаты')">
    <template #body>
      <loader waiting="card_loaded">
        <input-radio :key="'plastic_card_selected_' + item.id"
                     v-for="item in plastic"
                     :value="item.id"
                     name="plastic_card"
                     v-model="selectedPlastic">
          <span class="text-sm">{{ item.pan }}</span>
        </input-radio>
        <button @click="goToPlastic" class="text-button d-flex text-sm align-items-center text-blue">
          <span class="bootstrap-icon bootstrap-icon--size-lg bi bi-plus"></span>
          <span>{{ $t("Добавить карту") }}</span>
        </button>
      </loader>
    </template>
    <template #buttons>
      <loader :div-style="{height: 'max-content'}" waiting="buying_loaded">
        <ButtonForm @submit="pay" :is-entered="isEntered()" :title="$t('Отплатить')"></ButtonForm>
      </loader>
    </template>
  </ModalView>
</template>
<script setup>
import ModalView from "@/components/modal/modalView";
import {useStore} from "vuex";
import {computed, ref} from "vue";
import InputRadio from "@/components/helper/input/inputRadio";
import Loader from "@/components/loading/loader";
import ButtonForm from "@/components/helper/button/buttonForm";
import {useRouter} from "vue-router";

const selectedPlastic = ref(null);

function isEntered() {
  return selectedPlastic.value;
}

const showPlastic = computed(() => store.getters['purchaseModule/chosePlasticCard']);
const store = useStore();
const plastic = computed(() => store.getters['plasticCardModule/cards']);
const close = () => store.dispatch("purchaseModule/closeModal");
const pay = () => store.dispatch("purchaseModule/paidForMonth", selectedPlastic.value);
// eslint-disable-next-line no-unused-vars
const route = useRouter();

function goToPlastic() {
  close();
  route.push("/user/insertCard");
}
</script>