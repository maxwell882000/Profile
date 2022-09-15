<template>
  <VueFinalModal name="modal-fade">
    <div class="modal-overlay-first">
      <div :class="classModal" :style="styleModal" class="modal-second" @click.stop>
        <slot></slot>
      </div>
    </div>
  </VueFinalModal>
</template>
<script setup>
import {VueFinalModal} from 'vue-final-modal';

// eslint-disable-next-line no-undef
defineProps(['styleModal', 'classModal']);
</script>
<style lang="scss" scoped>
@import "src/assets/style/modal.scss";
</style>