<template>
  <base-alert>
    <template #image>
      <div style="width: 3rem">
        <div class="p-1" style="height: 3rem; max-width: 3rem; margin-right: 0.2rem">
          <img class="img-res" :src="alert.image">
        </div>
      </div>
    </template>
    <template #text>
      <span>{{ alert.text }}</span>
    </template>
  </base-alert>
</template>
<script setup>
import BaseAlert from "@/components/alerts/baseAlert";
import {defineProps} from "vue";
// eslint-disable-next-line no-unused-vars
const props = defineProps({
  alert: Object,
});

</script>