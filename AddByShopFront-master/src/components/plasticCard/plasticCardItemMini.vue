<template>
  <div style="padding: 8px; border-radius: 9px"
       class="d-flex flex-column justify-content-between w-100 h-100 back-violet">
    <div class="text-white">
      <span>{{ $t("Номер карты") }}</span>
      <br>
      <span class="text-500">{{ card.pan }}</span>
    </div>
    <div style="font-size: 6px;line-height: 6.2px;" class="d-flex justify-content-between text-gray">
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