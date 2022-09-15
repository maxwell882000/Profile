<template>
  <file-step
      @image-upload="getImage"
      :initial-image="initialImage"
      :title="$t('Страница паспорта с пропиской')"
      :decs="$t('Сделайте фото паспорта. Фотография должна быть четкая,а символы на документе различимые')"
      asset-image="passport2.svg"
      waiting="passport2"
      :next="isNext ? '/4' : '/3'"
      back="/2"
  ></file-step>
</template>
<script setup>
import FileStep from "@/components/verification/fileStep";
import useFileUpload from "@/components/verification/setup/useFileUpload";
import verificationConstant from "@/constants/verification/verificationConstant";

const {getImage, isNext, initialImage} = useFileUpload(verificationConstant.PASSPORT_REVERSE);
</script>