<template>
  <div class="d-flex align-items-center sorting" style="color: var(--gray)">
    <span>
      {{ $t("Вид :") }}
    </span>
    <span class="px-1"></span>
    <list class="pointer" :class="isList && 'active-icon'" @click="setIsList(true)"></list>
    <grid class="pointer" :class="!isList && 'active-icon'" @click="setIsList(false)"></grid>
  </div>
</template>

<script setup>

import List from "@/components/icons/sort/list";
import Grid from "@/components/icons/sort/grid";
import {useStore} from "vuex";
import {computed} from "vue";

const store = useStore();
const isList = computed(() => store.getters['productFilterByModule/isList']);
const setIsList = (value) => store.commit("productFilterByModule/setIsList", value);
</script>

<style>
.sorting .active-icon, .sorting .active-icon path {
  fill: var(--blue);
  stroke: var(--blue);
}
</style>