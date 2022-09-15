<template>
  <div class="select-container">
    <div class="item-select">
      <slot></slot>
    </div>
  </div>
</template>
<script>

export default {
  components: {}
}
</script>
<style scoped>
.select-container {
  display: flex;
  width: 100%;
  margin-top: 0.2rem;
  flex-direction: column;
  max-height: 13rem;
  overflow-y: scroll;
}


.select-container .item-select {
  margin-bottom: 0.2rem;
}
</style>