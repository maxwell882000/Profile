<template>
  <BaseOtp ref="otpInput"
           input-classes="otp-input form-control"
           :num-inputs="6"
           :should-auto-focus="true"
           :is-input-num="true"></BaseOtp>
</template>

<script>
import BaseOtp from "@/components/helper/input/baseOtpInput";

export default {
  name: "OtpInput",
  components: {BaseOtp},
  props: ['modelValue'],
  emits: ['update:modelValue']
}
</script>


<style lang="scss">

.otp-input {
  width: 40px !important;
  height: 40px;
  font-size: 20px;
  border-radius: 4px;
  border: 1px solid rgba(0, 0, 0, 0.3);
  text-align: center;
  @media (max-width: 364px) {
    width: 30px !important;
    height: 30px;
    font-size: 15px;
    padding: 0!important;
  }

  &.error {
    border: 1px solid red !important;
  }
}


.otp-input::-webkit-inner-spin-button,
.otp-input::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>