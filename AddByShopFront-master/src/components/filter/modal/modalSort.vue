<template>
  <modal-base-filter class="modal-sort" title="Сортировка">
    <div :class="current === index && 'active'" style="padding: 0.571rem" :key="'sort_mobile_' + item.key"
         v-for="(item,index) in sortItems">
      <input-radio
          class="text-left form-check-reverse"
          :value="index"
          @change="applySortEdited(index)"
          name="sort">
        <span class="text-dark text-normal text-left">{{ item.name }}</span>
      </input-radio>
    </div>
  </modal-base-filter>
</template>

<script setup>
import ModalBaseFilter from "@/components/filter/modal/modalBaseFilter";
import useFilterApply from "@/components/filter/component/sorting/setup/useFilterApply";
import InputRadio from "@/components/helper/input/inputRadio";

const {sortItems, applySort, changeTab, current} = useFilterApply(-1);

function applySortEdited(index) {
  changeTab(index);
  applySort(index);
}
</script>

<style lang="scss">

.modal-sort {
  .active {
    background-color: var(--gray100);
    border-radius: var(--borderRadius10);
  }

  .form-check {
    display: flex;
    padding-left: 0;
    flex-direction: row-reverse;
    justify-content: space-between;
  }
}
</style>