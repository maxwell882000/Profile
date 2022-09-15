<template>
  <section class="fixed-pos" style="z-index: 100000; top:7rem; right: 1rem;">
    <div v-for="item in alerts" :key="'unique_alert_' + item.id"
         class="bg-white p-2 border-sm mb-2 shadow-md relative animation"
         :class="item.class" style="width: 22rem">
      <card-error-alert v-if="typeof item.value == 'string'" :alert-text="item.value"></card-error-alert>
      <add-basket-alert v-else-if="typeof item.value == 'object'" :alert="item.value"></add-basket-alert>
    </div>
  </section>
</template>
<script setup>
import {useStore} from "vuex";
import {computed} from "vue";
import CardErrorAlert from "@/components/alerts/cardErrorAlert";
import AddBasketAlert from "@/components/alerts/addBasketAlert";

const store = useStore();
const alerts = computed(() => store.getters['alerts']);
</script>
<style>
.animation {
  transition: 1s;
  left: 23rem;
}

.left-give {
  left: 0;
}

.left-remove {
  left: 23rem;
}
</style>