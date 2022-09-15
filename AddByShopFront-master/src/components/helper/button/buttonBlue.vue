<template>
  <Button style="background-color: var(--blue)">
    <span style="color:white">
      {{ title }}
    </span>
  </Button>
</template>
<script>
import Button from "@/components/helper/button/button";

export default  {
  components: {Button},
  props: ['title']
}
</script>