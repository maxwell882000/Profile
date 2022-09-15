<template>
  <div>
     <textarea
         rows="7"
         v-bind="$attrs"
         :style="{'border-color' : error && 'var(--red)'}"
         :value="modelValue"
         @input="$emit('update:modelValue', $event.target.value)"
         class="style rounded-st form-control"></textarea>
    <span class="text-red text-sm pl-2" v-show="error">{{ error }}</span>
  </div>

</template>
<script>
export default {
  inheritAttrs: false,
  props: ['modelValue', 'error'],
  emits: ['update:modelValue']
}
</script>
<style>
.style {
  border: 1px solid var(--gray100);
  color: var(--dark) !important;
  font-weight: 500;
}

textarea::placeholder {
  font-weight: 400;
  color: var(--gray200) !important;
}

.form-control:focus {
  border-color: white !important;
}
</style>