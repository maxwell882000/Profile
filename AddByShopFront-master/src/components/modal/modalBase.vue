<template>
  <VueFinalModal name="modal-fade">
    <div class="modal-overlay-first">
      <b-row class="justify-content-center w-100">
        <b-col cols="12" class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
          <div :class="classModal" :style="styleModal" class="modal-second" @click.stop>
            <slot></slot>
          </div>
        </b-col>
      </b-row>
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