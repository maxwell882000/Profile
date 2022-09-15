<template>
  <modal-filter @closeModal="closeModal" v-model="modal"></modal-filter>
  <modal-sort @closeModal="closeSortModal" v-model="sortModal"></modal-sort>
  <b-col cols="12" class="d-block d-sm-block d-md-none ">
    <div class="d-flex justify-content-between">
      <button @click="showSort" class="d-flex  h-max  button-clear">
        <sort style="width: 22px"></sort>
        <span>
            {{ $t("Сортировка") }}
        </span>
      </button>
      <button @click="showModal" class="button-clear  mb-3 text-right p-mobile">
          <span class="">
      <Filter></Filter> {{ $t("Фильтры") }}
    </span>
      </button>
    </div>

  </b-col>
  <b-col cols="0" class="col-xl-3 col-lg-3 col-md-4 d-none d-sm-none d-md-block ml-r bg-white rounded-st p-4">
    <FiltrationHolder></FiltrationHolder>
  </b-col>
</template>

<script setup>
import FiltrationHolder from "@/components/filter/filteration/filterationHolder";
import Filter from "@/components/icons/filter";
import {ref} from "vue";
import ModalFilter from "@/components/filter/modal/modalFilter";
import Sort from "@/components/icons/sort/sort";
import ModalSort from "@/components/filter/modal/modalSort";

const modal = ref(false);
const sortModal = ref(false);

function showSort() {
  sortModal.value = true;
}

function showModal() {
  modal.value = true;
}

function closeSortModal() {
  sortModal.value = false;
}

function closeModal() {
  console.log('CLOSEED');
  modal.value = false;
}
</script>
<style>
.custom-border-input {
  margin-top: 10px !important;
}

.inputs {
  margin: 0 !important;
}
</style>