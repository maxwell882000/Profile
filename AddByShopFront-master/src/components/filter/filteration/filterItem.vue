<template>
  <div @click="show = !show" class="d-flex  text-link justify-content-between">
    <h6>{{ title }}</h6>
    <span>
      <span class="bi" :class="show ? 'bi-chevron-up' : 'bi-chevron-down'"/>
    </span>
  </div>
  <div v-if="show">
    <slot></slot>
  </div>
  <hr>
</template>
<script>

export default {
  props: ['title', 'collapse', 'isShow'],
  data() {
    return {
      show: this.isShow || false
    }
  }
}
</script>

<style lang="scss" scoped>

</style>