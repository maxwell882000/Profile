<template>
<span v-show="counter > 0" class="badge-number">
    {{ counter }}</span>
</template>

<script setup>
// eslint-disable-next-line no-undef
defineProps({
  counter: Number
});
</script>

<style scoped>
.badge-number {
  position: absolute;
  top: -5px;
  right: 20px;
  padding: 1px 6px;
  font-size: 0.6875rem;
  border-radius: 50%;
  border: 1px solid #FFFFFF;
  background: var(--red);
  color: white !important;
}

@media (max-width: 768px) {
  .badge-number {
    top: -1px !important;
    left: 20px !important;
    right: initial;
  }
}
</style>