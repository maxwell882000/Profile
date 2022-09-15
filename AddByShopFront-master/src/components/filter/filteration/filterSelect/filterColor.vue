<template>
  <filter-select-base :title="$t('Цвет')" prefix="color" v-slot="{item}">
    <div class="text-sm d-flex align-items-center">
      <span class="circle" :style="{'background-color': item.hex}"></span>
      {{ item.name }} ({{ item.num_product }})
    </div>
  </filter-select-base>
</template>
<script>
import FilterSelectBase from "@/components/filter/filteration/filterSelect/base/filterSelectBase";

export default {
  components: {FilterSelectBase},

}
</script>
<style scoped>
.circle {
  height: 1.8rem;
  width: 1.8rem;: #bbb;
  border-radius: 50%;
  display: inline-block;
}
</style>