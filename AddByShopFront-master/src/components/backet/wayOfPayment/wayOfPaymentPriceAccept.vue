<template>
  <section class="section-container mb-3">
    <div class="d-flex  align-items-center">
      <slot></slot>
      <span class="text-sm"> {{ title }}</span>
    </div>
    <ButtonForm :is-entered="isEntered" @submit="() => $emit('accept')" :title="buttonName"></ButtonForm>
  </section>
</template>

<script setup>
import ButtonForm from "@/components/helper/button/buttonForm";

// eslint-disable-next-line no-undef
defineProps({
  isEntered: {
    type: Boolean,
    default: false,
  },
  buttonName: String,
  title: String
})
</script>