<template>
  <ModalView
      v-model="showModal"
      @close-modal="()=> $emit('closeModal')"
      :title="$t('Заявка на отмену заказа')">
    <template #body>
      <div>
        <input-radio :key="'reasons_to_cancel_' + item.id"
                     v-for="item in reasons"
                     v-model="modal"
                     class="text-left"
                     :value="item"
                     name="cancel_order">
          <div class="d-flex justify-content-start">
            <span class="text-dark text-left">{{ item.text }}</span>
          </div>
        </input-radio>
      </div>

      <TextArea
          :placeholder="$t('Опишите проблему')"
          v-show="modal.id === 5" v-model="modal.value"></TextArea>
    </template>
    <template #buttons>
      <ButtonGray v-show="modal.id >= 0"
                  @click="() => $emit('submitReason', modal)"
                  :title-style="{color:'var(--red)'}"
                  :title="$t('Подтвердить отмену')"></ButtonGray>
    </template>
  </ModalView>
</template>
<script setup>
import ModalView from "@/components/modal/modalView";
import InputRadio from "@/components/helper/input/inputRadio";
import {ref, watch} from "vue";
import TextArea from "@/components/helper/text-area/textArea";
import ButtonGray from "@/components/helper/button/buttonGray";
import {useI18n} from "vue-i18n/dist/vue-i18n.esm-browser";

// eslint-disable-next-line no-unused-vars,no-undef
const props = defineProps({
  purchase: Object,
  show: Boolean,
});
const showModal = ref(props.show);
watch(() => props.show, function (val) {
  showModal.value = val;
});
const modal = ref({});
// eslint-disable-next-line no-undef
defineEmits(['submitReason', 'closeModal']);
const t = useI18n().t;
const reasons = [
  {
    id: 0,
    text: t("Заказ размещен по ошибке")
  },
  {
    id: 1,
    text: t("Неправильный размер или цвет")
  },
  {
    id: 2,
    text: t("Указан неверный адрес")
  },
  {
    id: 3,
    text: t("Неправильное понимание описания продукта")
  },
  {
    id: 4,
    text: t("Передумал")
  },
  {
    id: 5,
    text: t("Другое")
  },
];
</script>