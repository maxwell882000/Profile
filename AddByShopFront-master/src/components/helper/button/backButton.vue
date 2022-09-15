<template>
  <b-button @click="$router.back()" variant="link" class="decoration-none">
    <span class="bootstrap-icon bootstrap-icon--size-sm bi bi-chevron-left"></span>
    <span class="title">{{ title }}</span>
  </b-button>
</template>
<script>
export default {
  props: {
    title: {
      type: String
    },
    click: {
      type: Function,
      default() {
        return this.$router.go(1);
      }
    }
  }
}
</script>
<style scoped>
.title {
  font-weight: 400;
  font-size: 14px;
  padding-left: 0.3rem;
}

button {
  padding: 0;
  margin: 1rem 0;
}
</style>