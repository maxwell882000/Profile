<template>
  <loader waiting="question_loaded">
    <section class="section-container" :key="'question_id' + question.id" v-for="question in questions">
      <button v-b-toggle.question class="w-100 remove-button d-flex justify-content-between p-0">
        <h6 class="m-0">{{ question.question }}</h6>
        <div>
          <span class="bi bi-chevron-down"></span>
        </div>
      </button>
      <b-collapse id="question" class="mt-2">
    <span class="text-gray">
        {{ question.answer }}
    </span>
      </b-collapse>
    </section>
  </loader>

</template>
<script setup>
import {useStore} from "vuex";
import {computed} from "vue";
import Loader from "@/components/loading/loader";

const store = useStore();
const questions = computed(() => store.getters["questionModule/questions"]);

</script>
<style scoped>
.section-container {
  margin-bottom: 0.4rem;
}

.remove-button {
  background-color: inherit;
  border: none;
  color: inherit;
}
</style>