<template>
  <ModalView
      class-modal=""
      @close-modal="customClose ? customClose() : close()">
    <template #body>

      <form @submit.prevent="">
        <loader :div-style="{height: 'max-content'}" :waiting="waiting">
          <Status/>
          <slot name="inputs"></slot>
        </loader>
      </form>
    </template>
  </ModalView>
</template>
<script>
import ModalView from "@/components/modal/modalView";
import {mapMutations, mapState} from "vuex";
import Status from "@/components/helper/status/status";
import Loader from "@/components/loading/loader";

export default {
  props: ["waiting", "customClose"],
  computed: {
    ...mapState({
      loading: (state) => state.auth.loading,
    }),
  },
  methods: {
    ...mapMutations({
      close: "authWindow/close",
    }),
  },
  components: {Loader, Status, ModalView,},
};
</script>
<style>
.responsive-modal {
  width: 30% !important;
}

</style>