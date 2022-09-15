<template>
  <b-form-radio class="text-size">
    <slot></slot>
  </b-form-radio>
</template>
<style scoped>
.text-size {
  font-size: 1.2rem;
}

.form-check-label {
  width: 100% !important;
}

.form-check-input:checked[type=radio] {
  background-size: 1.2em;
}

.form-check-input {

}
</style>
