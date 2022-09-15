<template>
  <RangeInputTwo @update-full="exposeValue" @update:min="setMinValue" @update:max="setMaxValue" :min="minConstrain"
                 :max="maxConstrain" :minThreshold="parseInt(min) || 0"
                 :maxThreshold="parseInt(max) || 0">
  </RangeInputTwo>
  <div class="d-flex inputs">
    <div style="flex: 1">
      <Input ref="min_num" type="number" v-model="min">
        <template #prefix>
          {{ $t("от") }}
        </template>
      </Input>
    </div>
    <div class="p-2">
    </div>
    <div style="flex: 1">
      <Input ref="max_num" v-model="max" type="number">
        <template #prefix>
          {{ $t("до") }}
        </template>
      </Input>
    </div>
  </div>
</template>
<script>
import RangeInput from "@/components/helper/input/range/rangeInput";
import Input from "@/components/helper/input/input";
import RangeInputTwo from "@/components/helper/input/range/rangeInputTwo";

export default {
  props: {
    initialMin: Number,
    initialMax: Number,
    minConstrain: {
      type: Number,
      default: 0
    },
    maxConstrain: {
      type: Number,
      default: 100
    }
  },
  data() {
    return {
      min: this.initialMin || this.minConstrain,
      max: this.initialMax || this.maxConstrain,
    }
  },
  components: {
    RangeInputTwo,
    Input,
    // eslint-disable-next-line vue/no-unused-components
    RangeInput
  },
  methods: {
    exposeValue(e) {
      this.$emit("update-full", e);
    },
    setMinValue(e) {
      this.$refs.min_num.$el.querySelector('.input').value = parseInt(e);
    },
    setMaxValue(e) {
      this.$refs.max_num.$el.querySelector('.input').value = parseInt(e);
    },
  },
  emits: ['update-full']
}
</script>
<style>
.custom-border-input {
  margin-top: 10px !important;
}

.inputs {
  margin: 0 !important;
}
</style>