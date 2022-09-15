<template>
  <ModalView
      @close-modal="close()"
      v-model="showModal"
      :title="$t('Успешно оплачено')"
      :description="showSuccess">
    <template #prefix>
      <img src="@/assets/modal/accepted.png" alt="check sign">
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
const showModal = computed({
  get: () => {
    return showSuccess.value !== null && showSuccess.value.length > 0;
  }
})
const showSuccess = computed(() => store.getters['purchaseModule/successModalView']);
const close = () => store.commit('purchaseModule/setSuccessModalView', null);
</script>