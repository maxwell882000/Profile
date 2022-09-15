<template>
  <filter-select-base :title="$t('Продавец')" prefix="shop" v-slot="{item}">
    <span class="text-sm"> {{ item.name }} ({{ item.num_product }})</span>
  </filter-select-base>
</template>
<script>

import FilterSelectBase from "@/components/filter/filteration/filterSelect/base/filterSelectBase";

export default {
  components: {FilterSelectBase},
}
</script>