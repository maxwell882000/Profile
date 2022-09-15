<template>
  <Button class="bg-gray100">
    <span :class="titleClass" :style="titleStyle">
      {{ title }}
    </span>
  </Button>
</template>
<script>
import Button from "@/components/helper/button/button";

export default {
  name: 'ButtonGray',
  components: {Button},
  props: {
    title: {},
    titleClass: String,
    titleStyle: {
      type: Object,
      default() {
        return {
          color: "var(--gray)"
        }
      }
    }
  }
}
</script>
<style lang="scss" scoped>
.bg-gray100 {
  background-color: var(--gray100);

  &:hover {
    background-color: var(--gray400);
  }
}
</style>