<template>
  <div style="position: relative">
    <Input :disabled="disableInput" v-model="value" type="text" style="position: absolute"/>
    <Slider @change="e=>{$emit('range-change', e);}" :tooltips="false" v-bind="$props" :min="min" :max="max"
            style="position: relative; top: -4px;"
            v-model="_value"/>
<!--    <div class="triangle-right"></div>-->
  </div>
  <div class="d-flex text-gray text-sm justify-content-between">
    <span>от {{ showLabelMin }}</span>
    <span>до {{ showLabelMax }}</span>
  </div>
</template>

<script setup>
import Slider from '@vueform/slider'
import Input from "@/components/helper/input/input";
import useRange from "@/components/helper/input/range/setup/useRange";
import rangePropAndEmit from "@/components/helper/input/range/setup/rangePropAndEmit";
import price_formatter from "@/mixins/price_formatter";
import {computed} from "vue";

// eslint-disable-next-line no-undef,no-unused-vars
const emits = defineEmits(rangePropAndEmit.emits);
// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  ...rangePropAndEmit.props,
  initialValue: null
});
const showLabelMin = computed(() => price_formatter(props.labelMin || props.min));
const showLabelMax = computed(() => price_formatter(props.labelMax || props.max));
const {value, _value} = useRange(props, emits);


</script>

<style src="@vueform/slider/themes/default.css">

</style>
<style scoped>
.border-input {
  margin-top: 0;
}
</style>
<style src="@/assets/style/style_range_new.css">

</style>