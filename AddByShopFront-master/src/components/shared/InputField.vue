<template>
  <div class="input">
    <input
      :type="type"
      :class="[
        modelValue || type == 'date' || type == 'time' ? 'has-text' : '',
      ]"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <span>{{ placeholder }}</span>
  </div>
</template>

<script>
export default {
  props: {
    placeholder: String,
    type: String,
    modelValue: {
      type: String,
      default: "",
    },
  },
};
</script>

<style scoped lang="scss">
.input {
  width: 270px;
  span {
    transition: all 0.3s;
    display: block;
    position: relative;
    z-index: 0;
    top: -35px;
    height: 16px;
    left: 10px;
    color: grey;
    width: 100%;
  }
  input {
    width: 100%;
    display: block;
    position: relative;
    z-index: 2;
    height: 50px;
    border-radius: 10px;
    background: transparent;
    border: 1px solid #f2f2f2;
    outline: none;
    padding: 10px 5px 0 5px;

    &:focus {
      border: 1px solid rgb(204, 204, 204);
    }
  }
  input:focus + span,
  input.has-text + span {
    top: -46px;
    left: 5px;
    font-size: 12px;
  }
}
</style>