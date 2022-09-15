<template>
  <ButtonBlue @click="$emit('submit')" v-if="isEntered" :title="title"></ButtonBlue>
  <ButtonGray @click="$emit('not-submit')" :title-style="titleStyle" v-else :title="title"></ButtonGray>
</template>
<script>
import ButtonBlue from "@/components/helper/button/buttonBlue";
import ButtonGray from "@/components/helper/button/buttonGray";

export default {
  props: ['title', 'isEntered', 'titleStyle'],
  components: {ButtonGray, ButtonBlue}
}
</script>