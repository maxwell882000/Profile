<template>
  <div class="input-select">
    <b-form-checkbox v-bind="Object.assign({}, $props, $attrs)">
      <slot></slot>
    </b-form-checkbox>
  </div>

</template>
<script>
export default {}
</script>
<style>
.input-select .form-check {
  font-size: 1.2rem;

}

.input-select .form-check .form-check-label {
  display: block;
  /*padding-top: 2px;*/
}


.input-select .form-check-input {
  cursor: pointer;
}

.input-select .form-check-input:focus {
  box-shadow: none;
}

.input-select .form-check span {
  line-height: normal;
  margin-right: 10px;
}

.input-select .form-check-input {
  border-color: var(--gray400);
  width: 1.2em;
  height: 1.2em;
  margin-right: 10px;
}
</style>