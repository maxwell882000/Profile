<template>
  <h6 v-show="error.length !== 0" class="text-font text-error" v-html="error"></h6>
  <h6 v-show="success.length !== 0" class="text-font text-success" v-html="success"></h6>
</template>
<script>
import {mapState} from "vuex";

export default {
  computed: {
    ...mapState({
      error: state => state.authWindow.error,
      success: state => state.authWindow.success,
    }),
  }
}
</script>