<template>
  <span class="bi" :class="isShow  ? ` bi-chevron-${showClass}` : ` bi-chevron-${closeClass}`"/>
</template>
<script>
export default {
  props: ['showClass', 'closeClass', 'isShow']
}
</script>