<template>
  <div class="my-4 d-flex flex-column p-mobile py-4 bg-white"
       style="background-repeat:no-repeat "
       :style="{ backgroundImage: 'url(' + require('@/assets/gradient_bg.png') + ')'}">
    <div class="d-flex justify-content-center align-items-center flex-column text-white mt-4 h-100">
      <h5>{{ $t("Горячая распродажа") }}</h5>
      <p style="opacity: 0.6">{{ $t("Заканчивается через") }} </p>
      <div class="mob-time-show">
        <span class="bg-black-time time-specific relative">
          <span class="">{{ time.hours }}</span>
        </span>
        <span class="bg-black-time time-specific relative">
          <span class="">{{ time.minutes }}</span>
        </span>
        <span class="bg-black-time time-specific relative">
          <span class="">{{ time.seconds }}</span>
        </span>
      </div>
    </div>
    <sales-roll class="mt-4" :is-padding="true" :products="product_of_day.items"></sales-roll>
  </div>
</template>

<script setup>
import {useStore} from "vuex";
import {computed} from "vue";
import SalesRoll from "@/components/shared/SalesRoll";

const store = useStore();
const time = computed(() => store.getters['mainModule/timeObject']);
const product_of_day = computed(() => store.getters['mainModule/product_of_day'])
</script>

<style scoped>
.time-specific {
  border-radius: 7px;
  padding: 0.2rem;
  font-size: 1.8rem;
  font-weight: 700;
}

.time-specific:nth-child(2) {
  margin-right: 0.2rem;
  margin-left: 0.2rem;
}

.time-specific:before {
  content: '';
  position: absolute;
  top: 55%;
  left: 0;
  border-top: 1px solid var(--black);
  background: var(--black);
  width: 100%;
  transform: translateY(-50%);
}
</style>