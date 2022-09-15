<template>
  <button class="button-main">
    <span class="button-title">
     <slot></slot>
    </span>
  </button>
</template>
<script>

</script>
<style lang="scss" scoped>

.button-title {
  font-weight: 500;
  font-size: 0.875rem;
  line-height: 1.0675rem;
}

.button-main {
  width: 100%;
  margin-top: var(--marinTop);
  padding: 0.65rem;
  border: 0px;

  border-radius: var(--borderRadius);

}
</style>