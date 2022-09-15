<template>
  <SuccessModel
      :description="$t('Ваши данные успешно отправленны')"
      :button-title="$t('Вернуться в мои заказы')"
      path-name="orders"
      success-show="successToProfile"
  >
  </SuccessModel>
</template>
<script setup>
import SuccessModel from "@/components/verification/successModel";

</script>