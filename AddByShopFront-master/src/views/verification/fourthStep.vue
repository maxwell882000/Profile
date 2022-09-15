<template>
  <success-modal-to-order></success-modal-to-order>
  <success-modal-to-basket></success-modal-to-basket>
  <file-step
      @image-upload="getImage"
      :initial-image="initialImage"
      :title="$t('Селфи с паспортом')"
      :decs="$t('Разместите главный разворот вашего паспорта рядом с лицом и сделайте селфи. Фотография должна быть четкая, а символы на документе различимые')"
      asset-image="self_passport.svg"
      waiting="self_passport"
      back="/3"
      @nextPage="submitForm"
      :is-full-next-path="isNext"
      :next="isNext ? '': '/4'">
  </file-step>
</template>
<script setup>
import FileStep from "@/components/verification/fileStep";
import useFileUpload from "@/components/verification/setup/useFileUpload";
import verificationConstant from "@/constants/verification/verificationConstant";
import {useStore} from "vuex";
import {useRoute} from "vue-router";
import SuccessModalToOrder from "@/components/verification/successModalToOrder";
import SuccessModalToBasket from "@/components/verification/successModalToBasket";

const {getImage, isNext, initialImage} = useFileUpload(verificationConstant.USER_PASSPORT);
const store = useStore();
const submitData = () => store.dispatch("verificationModule/submitData");
const submitSuretyData = () => store.dispatch("verificationModule/suretySubmitData");

function submitForm() {
  if (isNext.value) {
    if (isSurety()) {
      submitSuretyData();
    } else
      submitData();
    // open here modal window and go to the next page;
  }
}

const route = useRoute();

function isSurety() {
  const path = route.path.split("/");
  console.log(path.slice(-2)[0]);
  return path.slice(-2)[0] === "surety";
}
</script>