<template>
  <div style="position: relative">
    <Input disabled v-model="inputValue" type="number" style="position: absolute"/>
    <Slider @change="e=>$emit('range-change', e)" :tooltips="false" v-bind="$props" :min="min" :max="max"
            style="position: relative; top: -4px;"
            v-model="sliderValues"/>
    <!--    <div class="triangle-right"></div>-->
  </div>
  <div class="d-flex text-gray text-sm justify-content-between">
    <span>от {{ labelMin || min.toString() }}</span>
    <span>до {{ labelMax || max.toString() }}</span>
  </div>
</template>

<script setup>
import Slider from '@vueform/slider'
import Input from "@/components/helper/input/input";
import rangePropAndEmit from "@/components/helper/input/range/setup/rangePropAndEmit";
import useRangeValues from "@/components/helper/input/range/setup/useRangeValues";

// eslint-disable-next-line no-undef,no-unused-vars
const emits = defineEmits(rangePropAndEmit.emits);
// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  ...rangePropAndEmit.props,
  values: Array,
  initialValue: Number,
  reset: Boolean //reset input when necessary
});


const {inputValue, sliderValues} = useRangeValues(props, emits);
</script>
<style scoped>
.border-input {
  margin-top: 0;
}
</style>