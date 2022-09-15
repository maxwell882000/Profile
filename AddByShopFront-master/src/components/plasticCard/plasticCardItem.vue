<template>
  <div class="d-flex flex-column justify-content-between w-100 h-100 rounded-st back-violet p-4">
    <div class="text-white text-lg">
      <h6 class="text-500">{{ $t("Номер карты") }}</h6>
      <span class="bold">{{ card.pan }}</span>
    </div>
    <div class="d-flex justify-content-between text-gray">
      <span>{{ card.card_holder }}</span>
      <span>{{ card.expiry }}</span>
    </div>
  </div>
</template>
<script setup>
// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  card: {
    type: Object,
    default() {
      return {
        id: 0,
        pan: "8600 49** **** 2299",
        card_holder: "Mr. Heisenberg",
        expiry: "Mr. Heisenberg"
      }
    }
  }
})
</script>