<template>
  <div style="display: flex; justify-content: center">
    <input
        v-if="inputType === 'password'"
        autocomplete="off"
        name="hidden"
        type="text"
        style="display:none;"
    />
    <SingleOtpInput
        v-for="(item, i) in numInputs"
        :key="i"
        :focus="activeInput === i"
        :value="otp[i]"
        :separator="separator"
        :input-type="inputType"
        :input-classes="inputClasses"
        :is-last-child="i === numInputs - 1"
        :should-auto-focus="shouldAutoFocus"
        @on-change="handleOnChange"
        @on-keydown="handleOnKeyDown"
        @on-paste="handleOnPaste"
        @on-focus="handleOnFocus(i)"
        @on-blur="handleOnBlur"
    />
  </div>
</template>

<script>
import SingleOtpInput from './singleOtp.vue'
// keyCode constants
const BACKSPACE = 8
const LEFT_ARROW = 37
const RIGHT_ARROW = 39
const DELETE = 46
export default {
  name: 'baseOtpInput',
  components: {
    SingleOtpInput
  },
  props: {
    numInputs: {
      default: 4,
      type: Number
    },
    separator: {
      type: String,
      default: '**'
    },
    inputClasses: {
      type: String,
      default: ''
    },
    inputType: {
      type: String,
      default: 'number',
      validator(value) {
        return ['number', 'tel', 'password'].includes(value)
      }
    },
    shouldAutoFocus: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      activeInput: 0,
      otp: [],
      oldOtp: []
    }
  },
  methods: {
    handleOnFocus(index) {
      this.activeInput = index
    },
    handleOnBlur() {
      this.activeInput = -1
    },
    // Helper to return OTP from input
    checkFilledAllInputs() {
      if (this.otp.join('').length === this.numInputs) {
        return this.$emit('complete', this.otp.join(''))
      }
      return 'Wait until the user enters the required number of characters'
    },
    // Focus on input by index
    focusInput(input) {
      this.activeInput = Math.max(Math.min(this.numInputs - 1, input), 0)
    },
    // Focus on next input
    focusNextInput() {
      this.focusInput(this.activeInput + 1)
    },
    // Focus on previous input
    focusPrevInput() {
      this.focusInput(this.activeInput - 1)
    },
    // Change OTP value at focused input
    changeCodeAtFocus(value) {
      this.oldOtp = Object.assign([], this.otp)
      this.otp[this.activeInput] = value;
      if (this.oldOtp.join('') !== this.otp.join('')) {
        this.$emit('on-change', this.otp.join(''))
        this.checkFilledAllInputs()
      }
    },
    // Handle pasted OTP
    handleOnPaste(event) {
      event.preventDefault()
      const pastedData = event.clipboardData
          .getData('text/plain')
          .slice(0, this.numInputs - this.activeInput)
          .split('')
      if (this.inputType === 'number' && !pastedData.join('').match(/^\d+$/)) {
        return 'Invalid pasted data'
      }
      // Paste data from focused input onwards
      const currentCharsInOtp = this.otp.slice(0, this.activeInput)
      const combinedWithPastedData = currentCharsInOtp.concat(pastedData)
      this.otp = combinedWithPastedData.slice(0, this.numInputs);
      // this.$set(this, 'otp', )
      this.focusInput(combinedWithPastedData.slice(0, this.numInputs).length)
      return this.checkFilledAllInputs()
    },
    handleOnChange(value) {
      this.changeCodeAtFocus(value)
      this.focusNextInput()
    },
    clearInput() {
      if (this.otp.length > 0) {
        this.$emit('on-change', '')
      }
      this.otp = []
      this.activeInput = 0
    },
    // Handle cases of backspace, delete, left arrow, right arrow
    handleOnKeyDown(event) {
      switch (event.keyCode) {
        case BACKSPACE:
          event.preventDefault()
          this.changeCodeAtFocus('')
          this.focusPrevInput()
          break
        case DELETE:
          event.preventDefault()
          this.changeCodeAtFocus('')
          break
        case LEFT_ARROW:
          event.preventDefault()
          this.focusPrevInput()
          break
        case RIGHT_ARROW:
          event.preventDefault()
          this.focusNextInput()
          break
        default:
          break
      }
    }
  }
}
</script>
<!--<template>-->
<!--  <div style="display: flex">-->
<!--    &lt;!&ndash;    To turn off autocomplete when otp-input is password&ndash;&gt;-->
<!--    <input-->
<!--        v-if="inputType === 'password'"-->
<!--        autocomplete="off"-->
<!--        name="hidden"-->
<!--        type="text"-->
<!--        style="display: none"-->
<!--    />-->
<!--    <SingleOtpInput-->
<!--        v-for="(item, i) in numInputs"-->
<!--        :key="i"-->
<!--        :focus="activeInput === i"-->
<!--        :value="otp[i]"-->
<!--        :separator="separator"-->
<!--        :input-type="inputType"-->
<!--        :input-classes="inputClasses"-->
<!--        :is-last-child="i === (numInputs - 1)"-->
<!--        :should-auto-focus="shouldAutoFocus"-->
<!--        :placeholder="placeholder[i]"-->
<!--        :is-disabled="isDisabled"-->
<!--        @on-change="handleOnChange"-->
<!--        @on-keydown="handleOnKeyDown"-->
<!--        @on-paste="handleOnPaste"-->
<!--        @on-focus="handleOnFocus(i)"-->
<!--        @on-blur="handleOnBlur"-->
<!--    />-->
<!--  </div>-->
<!--</template>-->
<!--<script lang="ts">-->
<!--import {  ref } from "vue";-->

<!--// keyCode constants-->
<!--const BACKSPACE = 8;-->
<!--const LEFT_ARROW = 37;-->
<!--const RIGHT_ARROW = 39;-->
<!--const DELETE = 46;-->

<!--export default /* #__PURE__ */ ({-->
<!--  name: "Vue3OtpInput", // vue component name-->
<!--  components: {-->
<!--  },-->
<!--  props: {-->
<!--    numInputs: {-->
<!--      default: 4,-->
<!--    },-->
<!--    separator: {-->
<!--      type: String,-->
<!--      default: "**",-->
<!--    },-->
<!--    inputClasses: {-->
<!--      type: String,-->
<!--    },-->
<!--    inputType: {-->
<!--      type: String,-->
<!--    },-->
<!--    shouldAutoFocus: {-->
<!--      type: Boolean,-->
<!--      default: false,-->
<!--    },-->
<!--    placeholder: {-->
<!--      type: Array,-->
<!--      default(){-->
<!--        return [];-->
<!--      }-->
<!--    },-->
<!--    isDisabled: {-->
<!--      type: Boolean,-->
<!--      default: false,-->
<!--    },-->
<!--  },-->
<!--  setup(props, { emit }) {-->
<!--    const activeInput = ref<number>(0);-->
<!--    const otp = ref<[]>([]);-->
<!--    const oldOtp = ref<[]>([]);-->

<!--    const handleOnFocus = (index: number) => {-->
<!--      activeInput.value = index;-->
<!--    };-->
<!--    const handleOnBlur = () => {-->
<!--      activeInput.value = -1;-->
<!--    };-->

<!--    // Helper to return OTP from input-->
<!--    const checkFilledAllInputs = () => {-->
<!--      if (otp.value.join("").length === props.numInputs) {-->
<!--        return emit("on-complete", otp.value.join(""));-->
<!--      }-->
<!--      return "Wait until the user enters the required number of characters";-->
<!--    };-->

<!--    // Focus on input by index-->
<!--    const focusInput = (input: number) => {-->
<!--      activeInput.value = Math.max(Math.min(props.numInputs - 1, input), 0);-->
<!--    };-->
<!--    // Focus on next input-->
<!--    const focusNextInput = () => {-->
<!--      focusInput(activeInput.value + 1);-->
<!--    };-->
<!--    // Focus on previous input-->
<!--    const focusPrevInput = () => {-->
<!--      focusInput(activeInput.value - 1);-->
<!--    };-->

<!--    // Change OTP value at focused input-->
<!--    const changeCodeAtFocus = (value: number | string) => {-->
<!--      oldOtp.value = Object.assign([], otp.value);-->

<!--      // @typescript-eslint/ban-ts-comment-->
<!--      // @ts-ignore-->
<!--      otp.value[activeInput.value] = value;-->

<!--      if (oldOtp.value.join("") !== otp.value.join("")) {-->
<!--        emit("on-change", otp.value.join(""));-->
<!--        checkFilledAllInputs();-->
<!--      }-->
<!--    };-->

<!--    // Handle pasted OTP-->
<!--    const handleOnPaste = (event: any) => {-->
<!--      event.preventDefault();-->
<!--      const pastedData = event.clipboardData-->
<!--          .getData("text/plain")-->
<!--          .slice(0, props.numInputs - activeInput.value)-->
<!--          .split("");-->
<!--      if (props.inputType === "number" && !pastedData.join("").match(/^\d+$/)) {-->
<!--        return "Invalid pasted data";-->
<!--      }-->
<!--      // Paste data from focused input onwards-->
<!--      const currentCharsInOtp = otp.value.slice(0, activeInput.value);-->
<!--      const combinedWithPastedData = currentCharsInOtp.concat(pastedData);-->

<!--      combinedWithPastedData-->
<!--          .slice(0, props.numInputs)-->
<!--          .forEach(function (value, i) {-->
<!--            otp.value[i] = value;-->
<!--          });-->

<!--      focusInput(combinedWithPastedData.slice(0, props.numInputs).length);-->
<!--      return checkFilledAllInputs();-->
<!--    };-->

<!--    const handleOnChange = (value: number) => {-->
<!--      changeCodeAtFocus(value);-->
<!--      focusNextInput();-->
<!--    };-->
<!--    const clearInput = () => {-->
<!--      if (otp.value.length > 0) {-->
<!--        emit("on-change", "");-->
<!--      }-->
<!--      otp.value = [];-->
<!--      activeInput.value = 0;-->
<!--    };-->

<!--    // Handle cases of backspace, delete, left arrow, right arrow-->
<!--    const handleOnKeyDown = (event: KeyboardEvent) => {-->
<!--      switch (event.keyCode) {-->
<!--        case BACKSPACE:-->
<!--          event.preventDefault();-->
<!--          changeCodeAtFocus("");-->
<!--          focusPrevInput();-->
<!--          break;-->
<!--        case DELETE:-->
<!--          event.preventDefault();-->
<!--          changeCodeAtFocus("");-->
<!--          break;-->
<!--        case LEFT_ARROW:-->
<!--          event.preventDefault();-->
<!--          focusPrevInput();-->
<!--          break;-->
<!--        case RIGHT_ARROW:-->
<!--          event.preventDefault();-->
<!--          focusNextInput();-->
<!--          break;-->
<!--        default:-->
<!--          break;-->
<!--      }-->
<!--    };-->

<!--    return {-->
<!--      activeInput,-->
<!--      otp,-->
<!--      oldOtp,-->
<!--      clearInput,-->
<!--      handleOnPaste,-->
<!--      handleOnKeyDown,-->
<!--      handleOnBlur,-->
<!--      changeCodeAtFocus,-->
<!--      focusInput,-->
<!--      focusNextInput,-->
<!--      focusPrevInput,-->
<!--      handleOnFocus,-->
<!--      checkFilledAllInputs,-->
<!--      handleOnChange,-->
<!--    };-->
<!--  },-->
<!--});-->
<!--</script>-->


<!--<style scoped>-->
<!--</style>-->
