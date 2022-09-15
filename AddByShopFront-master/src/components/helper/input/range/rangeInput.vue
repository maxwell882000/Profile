<template>
  <div class="content">
    <div id="my-slider" :se-min="minThreshold" :se-step="step" :se-min-value="min" :se-max-value="max"
         :se-max="maxThreshold" class="slider">
      <div class="slider-touch-left">
        <span></span>
      </div>
      <div class="slider-touch-right">
        <span></span>
      </div>
      <div class="slider-line">
        <span></span>
      </div>
    </div>
  </div>
</template>

<script>
import ZbRangeSlider from './zbRangeSlider'

export default {
  props: {
    maxValue: {
      type: Number,
      default: 0,
    },
    minThreshold: {
      type: Number,
      default: 0
    },
    maxThreshold: {
      type: Number,
      default: 300
    },
    step: {
      type: Number,
      default: 1
    },
    min: {
      type: Number,
      required: true
    },
    max: {
      type: Number,
      required: true
    }
  },
  data: function () {
    return {
      instance: undefined
    }
  },
  mounted: function () {
    this.instance = new ZbRangeSlider('my-slider')
    this.instance.onChange = (min, max) => this.updateValues(min, max)
  },
  watch: {
    // eslint-disable-next-line no-unused-vars
    min(value) {
      this.instance.setMinValue(value);
    },
    max(value) {
      this.instance.setMaxValue(value);
    }
  },
  methods: {
    updateValues: function (min, max) {
      this.$emit('update:min', min)
      this.$emit('update:max', max)
    }
  }
}

</script>


<style scoped>
@import "../../../../assets/style/range_input.scss";
</style>