<template>
  <success-insertion>
  </success-insertion>
  <loader waiting="card_loaded">
    <empty-card v-if="isEmptyCard">
    </empty-card>
    <section v-else
             class="rounded-st bg-white p-3">
      <h5 class="text-header-32">{{ $t("Сохраненные карты") }}</h5>
      <!--    <b-form-group class="w-30" v-slot="{ ariaDescribedby }">-->
      <!--      <input-radio  :aria-describedby="ariaDescribedby" name="some-radios" value="A">-->
      <div class="mb-2">
        <b-row class="flex-column">
          <b-col cols="12" :key="'plastic_card_pan_' + item.id" v-for="item in cards"
                 class="col-xl-3 col-lg-4 col-md-5 col-sm-6 d-flex justify-content-between align-items-center mb-1">
            <span>{{ item.pan }}</span>
            <!--            <div @click="revokeCard(item.id)" class="pointer">-->
            <!--              <trash></trash>-->
            <!--            </div>-->
          </b-col>
        </b-row>
      </div>
      <!--      </input-radio>-->
      <!--    </b-form-group>-->
      <router-link :to="{
        name: 'insert_card'
      }" class="remove-link d-flex text-link text-blue text-center align-items-end">
        <card-add></card-add>
        <span class="px-2">
          {{ $t("Добавить карту") }}
          </span>
      </router-link>
    </section>
  </loader>
  <!--  <br>-->
  <!--  <insert-card></insert-card>-->
</template>
<script setup>
import EmptyCard from "@/components/userPage/payments/emptyCard";
// import InputRadio from "@/components/helper/input/inputRadio";
// import Trash from "@/components/icons/trash";
import CardAdd from "@/components/icons/card-add";
import {computed} from "vue";
import {useStore} from "vuex";
import Loader from "@/components/loading/loader";
import SuccessInsertion from "@/components/userPage/payments/modal/successInsertion";

const store = useStore();
const isEmptyCard = computed(() => store.getters['plasticCardModule/isEmptyCard']);
const cards = computed(() => store.getters['plasticCardModule/cards']);

// const revokeCard = (id) => store.dispatch("plasticCardModule/revokeCard", id);
</script>