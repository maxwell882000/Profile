<template>
  <filter-select-base :title="$t('Бренд')" prefix="brand" v-slot="{item}">
    <span class="text-sm"> {{ item.name }} ({{ item.num_product }})</span>
  </filter-select-base>

</template>
<script>
import FilterSelectBase from "@/components/filter/filteration/filterSelect/base/filterSelectBase";

export default {
  // eslint-disable-next-line vue/no-unused-components
  components: {FilterSelectBase},
}
</script>