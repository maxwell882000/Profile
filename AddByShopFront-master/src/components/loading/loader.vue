<template>
  <v-wait :for="waiting">
    <template #waiting>
      <div class="d-flex justify-content-center align-items-center" :style="divStyle">
        <b-spinner class=""></b-spinner>
      </div>
    </template>
    <slot></slot>
  </v-wait>
</template>
<script>
export default  {
  inheritAttrs: false,
  props: {
    waiting: {
      type: String
    },
    divStyle: {
      type: Object,
      default() {
        return {
          height: "70vh"
        }
      }
    }
  }
}
</script>