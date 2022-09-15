<template>
  <div v-if="component.length" class="bg-white p-mobile py-4 mt-2">
    <div class="product-content">
      <div>
        <color-component button="color-btn"></color-component>
        <select-component v-for="(comp, index) in component"
                          :key="'select_com_ ' + index" :param="comp" :index="comp.id">
        </select-component>
      </div>

    </div>

  </div>
</template>

<script setup>
import ColorComponent from "@/components/product/colorComponent";
import SelectComponent from "@/components/product/selectComponent";

// eslint-disable-next-line no-undef
defineProps({
  component: Array
})
// console.log(props.)
</script>
<style scoped>
.product-content {
  padding: 0;
}
</style>