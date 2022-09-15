<template>
  <b-avatar v-if="src" :src="src"></b-avatar>
  <b-avatar v-else :text="firstLetters"></b-avatar>
</template>
<script>
export default {
  props: {
    name: {
      type: String
    },
    src: {
      type: String
    }
  },
  computed: {
    firstLetters() {
      console.log(this.name);
      let divide = this.name.split(" ");
      console.log(divide);
      return divide.filter(e => !!e).map(e => e[0].toUpperCase()).join("");
    }
  }
}
</script>