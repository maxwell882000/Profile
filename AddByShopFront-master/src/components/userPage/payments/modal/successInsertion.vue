<template>
  <ModalView
      @close-modal="close()"
      v-model="showSuccess"
      :title="$t('Карта добавлена')"
      :description="$t('Теперь вы легко сможете оплачивать покупки')">
    <template #prefix>
      <img src="@/assets/modal/cart_success.png" alt="check sign">
    </template>
    <template #buttons>
      <ButtonBlue
          @click="close()"
          :title="$t('Понятно')"></ButtonBlue>
    </template>
  </ModalView>
</template>
<script setup>
import ModalView from "@/components/modal/modalView";
import ButtonBlue from "@/components/helper/button/buttonBlue";
import {useStore} from "vuex";
import {computed} from "vue";

const store = useStore();

const showSuccess = computed(() => store.getters['plasticCardModule/showSuccessCard']);
const close = () => store.commit('plasticCardModule/setShowSuccessCard', false);
</script>