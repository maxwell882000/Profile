<template>
  <Slider
      @update="updateValue"
      id="price_slider"
      v-model="value"
      :min="min"
      :max="max"
      class="my-2"
  />
</template>

<script>
import Slider from '@vueform/slider'
import {onMounted, onUnmounted, ref, watch} from "vue";

export default {
  components: {Slider},
  emits: ['update:max', "update:min", "updateFull"],
  props: {
    minThreshold: {
      type: Number,
      default: 0
    },
    maxThreshold: {
      type: Number,
      default: 40
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
  setup(props, {emit}) {
    const value = ref([props.minThreshold, props.maxThreshold]);

    const slider = ref(null);
    // const emit = defineEmits(['update:min', 'update:max'])
    let lowerObserver = undefined;
    let upperObserver = undefined;

    function updateValue(val) {
      emit("updateFull", val);
    }

    let timerId = null;

    function simpleDebounce(fn, delay = 300) {
      // caveat: only 1 timeout at a time because of the timerId;
      // that's why we leave this inside the component scope
      // and not as a global utility
      return ((...args) => {
        // only in browser
        clearTimeout(timerId)
        timerId = setTimeout(() => {
          timerId = null
          fn(...args)
        }, delay)
      })()
    }

    onMounted(() => {
      const parent = document.getElementById("price_slider");
      const lower = parent.querySelector(".slider-handle-lower");
      const upper = parent.querySelector(".slider-handle-upper");
      const options = {attributes: true};
      // eslint-disable-next-line no-unused-vars
      const callbackMutate = (emitName) => (mutationsList) => {
        // simpleDebounce(() => {
        let value = mutationsList[0].target.getAttribute("aria-valuenow");
        emit(emitName, value);
        // })
      };

      lowerObserver = new MutationObserver(callbackMutate('update:min'));
      upperObserver = new MutationObserver(callbackMutate('update:max'));
      lowerObserver.observe(lower, options);
      upperObserver.observe(upper, options);
    });
    onUnmounted(() => {
      lowerObserver.disconnect();
      upperObserver.disconnect();
    })
    watch(() => props.minThreshold,
        (newValue) => simpleDebounce(() => value.value[0] = newValue, 600));
    watch(() => props.maxThreshold,
        (newValue) => simpleDebounce(() => value.value[1] = newValue, 600));

    return {
      value: value,
      slider: slider,
      updateValue: updateValue
    }
  },
}
</script>
<style src="@vueform/slider/themes/default.css">

</style>

<style src="@/assets/style/style_range_new.css">
.slider-horizontal {
  height: 5px;
}
</style>