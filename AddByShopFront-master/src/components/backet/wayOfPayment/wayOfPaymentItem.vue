<template>
  <section class="section-container mb-3">
    <input-radio v-bind="Object.assign({},$attrs, $props)">
      <div class="payment-font">
        <span class="pb-2 bold">{{ title }}</span>
        <br>
        <span class="text-gray">{{ desc }}</span>
        <slot></slot>
      </div>
    </input-radio>
  </section>
</template>
<script>
import InputRadio from "@/components/helper/input/inputRadio";

export default {
  inheritAttrs: false,
  props: ['title', 'desc'],
  components: {InputRadio},
}
</script>
<style scoped>
.payment-font {
  font-size: 0.875rem;
  line-height: 1.0675rem;
}

.text-gray {
  font-size: 0.75rem;
  line-height: 0.80rem;
}
</style>