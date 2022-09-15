<template>
  <div :style="addFlex" class="d-flex w-max align-items-center mb-sm-1">
    <div v-bind="$attrs" :class="giveColor" class="circle-singleline text-white">
      <!--      <span>57</span>-->
      <slot name="number"></slot>
    </div>
    <div style="flex: 1" class="d-flex w-max pl-2 bold align-items-center">
      <div>
        <span>{{ name }} </span>
        <span> </span>
      </div>
      <div class=" px-2" style="padding-top: 0.4rem; flex: 1">
        <slot></slot>
        <div v-show="!disableLine"
             style="background-color: var(--gray500); height: 1px;"
        ></div>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  inheritAttrs: false,
  props: {
    disableLine: {
      type: Boolean,
      default() {
        return false;
      }
    },
    name: String,
    isFlex: Boolean,
    number: Number,
  },
  computed: {
    giveColor() {
      const number = parseInt(this.$route.path.split("/").at(-1));
      return this.number === number ? "back-blue" : this.number > number ? "back-gray300" : "back-green";
    },
    addFlex() {
      if (this.isFlex) {
        return {
          flex: 1
        }
      }
      return {}
    }
  }
};
</script>
<style scoped>
span {
  font-size: 0.74rem;
  line-height: 0.74rem;
}
</style>