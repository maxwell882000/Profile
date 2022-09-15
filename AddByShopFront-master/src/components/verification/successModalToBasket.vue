<template>
  <SuccessModel
      :description="$t('Ваши данные успешно отправленны')"
      :button-title="$t('Вернуться в корзину')"
      path-name="basket"
      success-show="successToBasket">
  </SuccessModel>
</template>
<script setup>
import SuccessModel from "@/components/verification/successModel";</script>