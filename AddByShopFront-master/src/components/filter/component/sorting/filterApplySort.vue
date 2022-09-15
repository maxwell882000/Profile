<template>
  <div class="d-flex">
    <button @click="changeTab(index)" style="all:unset;cursor: pointer; display:block;margin-right: 1.571rem"
            :key="'sort_key_' + index"
            v-for="(item, index) in sortItems">
      <span @click="applySort(index)" class="text-gray" :class="current === index && 'active_sort'">{{ item.name }}
       <span style="font-size: 0.857rem;" v-show="current === index"
             :class=" isDown ? 'bi-chevron-down' : 'bi-chevron-up'"></span>
      </span>
    </button>
  </div>
</template>

<script setup>
import useFilterApply from "@/components/filter/component/sorting/setup/useFilterApply";

const {applySort, current, changeTab, sortItems, isDown} = useFilterApply();
</script>

<style scoped>

.active_sort {
  color: var(--dark) !important;
}
</style>