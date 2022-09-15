<template>
  <div class="mt-4">
         <span>
      <thumb-up style="fill: var(--green)"/>
      23
    </span>
    <span>
      <thumb-down/>
      23
    </span>
  </div>
</template>
<script>
import ThumbUp from "@/components/icons/thumbUp";
import ThumbDown from "@/components/icons/thumbDown";

export default {
  props: ['liked'],

  components: {ThumbDown, ThumbUp}
}
</script>