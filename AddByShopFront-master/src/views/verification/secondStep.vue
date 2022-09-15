<template>
  <file-step
      @image-upload="getImage"
      :title="$t('Фото паспорта')"
      :decs="$t('Сделайте фото паспорта. Фотография должна быть четкая,а символы на документе различимые')"
      asset-image="passport.svg"
      waiting="passport"
      :initial-image="initialImage"
      :next="isNext ? '/3': '/2'"
      back="/1">
  </file-step>
</template>
<script setup>
import FileStep from "@/components/verification/fileStep";
import useFileUpload from "@/components/verification/setup/useFileUpload";
import verificationConstant from "@/constants/verification/verificationConstant";

const {getImage, isNext, initialImage} = useFileUpload(verificationConstant.PASSPORT);
// import {useStore} from "vuex";
//
// const store = useStore();
// const fileUpload = (data) => store.dispatch("verificationModule/fileUpload", data);
//
// function getImage(url, fileList) {
//
//   fileUpload({})
//   console.log(url);
//   console.log(fileList);
// }
</script>