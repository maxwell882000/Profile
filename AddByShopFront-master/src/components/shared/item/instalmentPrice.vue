<template>
  <div v-if="Object.keys(credit).length  !== 0" class="price">
    <span class="name-price"> {{ credit.name }}</span>
    <p class="mb-0 actual-number">
      <span class="numbers">{{ credit.price }}</span>
      <span class="month text-nowrap "> x {{ credit.month }} {{ $t("мес") }}</span>
    </p>
  </div>
</template>

<script setup>
// eslint-disable-next-line no-undef
defineProps({
  credit: Object
})
</script>

<style scoped>

.price .actual-number small {
  font-size: 0.8rem;
  font-weight: 400;
  line-height: 15px;
}

.price {
  border: 1px solid #F2F2F2;
  border-radius: 8px;
  padding: 0.5rem 0.571rem;
  margin-right: 8px;
  line-height: 17px;
  height: 100%;
  width: 100%;
}

.price .month {
  font-size: 0.8rem;
}

.price .numbers {
  color: var(--blue);
  font-weight: 700;
}


@media (max-width: 767px) {

  .price {
    border: none !important;
    padding: 0;
    margin-right: 0;
  }

  .name-price {
    font-size: 0.857rem;
    line-height: 1.071rem;
  }

  .price .numbers {
    font-size: 1.143rem;
    line-height: 1.214rem;
  }

  .price .month {
    font-size: 0.929rem;
    line-height: 1.143rem;
  }

}
</style>