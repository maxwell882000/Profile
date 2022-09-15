<template>
  <div class="w-100  buy-now">
    <button @click="buyImmediately" class="w-100">{{ $t("Купить сразу") }}</button>
  </div>
</template>

<script setup>
import usePay from "@/components/product/button/setup/usePay";

const {buyImmediately} = usePay("setShowCredit");

</script>
<style scoped>

</style>