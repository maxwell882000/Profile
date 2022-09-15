<template>
  <div class="relative block">
    <div @click="toggle">
      <slot name="button"></slot>
    </div>
    <div>
      <div v-click-away="onClickAway" v-if="isShow" class="absolute section-container shadow-md"
           :style="styleDropDown">
        <h6 class="text-dark">{{ label }}</h6>
        <hr>
        <slot name="items"></slot>
      </div>
    </div>
  </div>
</template>

<script>
import InputRadio from "@/components/helper/input/inputRadio";

export default {
  // eslint-disable-next-line vue/no-unused-components
  components: {InputRadio},
  emits: ['update:modelValue'],
  props: {
    label: String,
    modelValue: String,
    styleDropDown: {
      type: Object,
      default() {
        return {
          width: "15rem",
          "z-index": 10,
          marginTop: "0.2rem",
          right: "-0.4rem"
        }
      }
    },

  },
  data() {
    return {
      isShow: !!this.modelValue
    }
  },
  watch: {
    modelValue(val) {
      this.isShow = !!val;
    }
  },
  methods: {
    emitValue() {
      this.$emit('update:modelValue', this.isShow ? "true" : "");
    },
    toggle() {
      this.isShow = !this.isShow
      this.emitValue();
    },
    onClickAway() {
      this.isShow = false;
      this.emitValue();
    }
  }
}
</script>