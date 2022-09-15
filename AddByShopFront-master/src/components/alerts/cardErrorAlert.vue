<template>
  <base-alert>
    <template #image>
      <div style="margin-right: 0.4rem">
        <Alert></Alert>
      </div>
    </template>
    <template #text>
      <span> {{ alertText }}</span>
    </template>
  </base-alert>
</template>
<script setup>
import BaseAlert from "@/components/alerts/baseAlert";
import Alert from "@/components/icons/alert";
// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  alertText: String
});
</script>