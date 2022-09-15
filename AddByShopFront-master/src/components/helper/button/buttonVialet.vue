<template>
  <Button style="background: linear-gradient(109.44deg, #325FFF 14.9%, #D356FF 92.39%), #007AFF;">
    <span style="color:white">
      {{ title }}
    </span>
    <slot></slot>
  </Button>
</template>
<script>
import Button from "@/components/helper/button/button";

export default {
  components: {Button},
  props: ['title']
}
</script>