<template>
  <div class="input-below-border">
    <Input v-bind="Object.assign({}, $props, $attrs)"/>
  </div>
</template>
<script>
import Input from "@/components/helper/input/input";

export default {
  inheritAttrs: false,
  components: {Input}
}
</script>
<style>

.input-below-border .border-input {
  margin: 0 !important;
  border: none !important;
  border-bottom: 1px solid var(--gray100) !important;
  border-radius: 0;
}

.input-below-border .border-input input:focus {
  border-bottom: 1px solid var(--blue);
}

.input-below-border .border-input input:focus + .label {
  color: var(--blue);
}
</style>