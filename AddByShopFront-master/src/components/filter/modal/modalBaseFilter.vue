<template>
  <div class="filter-start d-block d-sm-block d-md-none p-mobile">
    <ModalOld v-bind="Object.assign( {},$props, $attrs)" class-modal="filter-full-class">
      <div style="overflow-y:scroll; max-height: 100%; overflow-x:hidden; ">
        <div
            class="d-flex relative name-modal justify-content-between align-items-center">
          <div></div>
          <button @click="$emit('closeModal')" class="button-clear  absolute block text-left bg-white">
            <span style="cursor: pointer; color: var(--gray300); font-size: 170%" class="bi bi-x"
            ></span>
          </button>
          <div class="text-500">
            <span>{{ $t(title) }}</span>
          </div>
          <div></div>
        </div>
        <section class="container">
          <div class="p-mobile" style="padding-top: 1.071rem">
            <slot></slot>
          </div>
        </section>
      </div>
    </ModalOld>
  </div>
</template>
<script>
export default {
  inheritAttrs: false,
  props: ['title']
}
</script>
<script setup>

import ModalOld from "@/components/modal/modalOld";
// eslint-disable-next-line no-undef
defineEmits(['closeModal']);
</script>
<style>
.filter-start .modal-second {
  border-radius: 0;
  padding: 0
}

@media (max-width: 768px) {
  .name-modal {
    font-size: 1.143rem !important;
    line-height: 1.357rem;
    padding-top: 1.143rem
  }
}

.filter-start .filter-full-class {
  width: 100vw;
  height: 100%;
}
</style>