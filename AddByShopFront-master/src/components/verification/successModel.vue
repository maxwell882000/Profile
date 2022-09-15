<template>
  <ModalView
      v-model="success"
      @closeModal="closeModal"
      :title="$t('Отправленно')"
      :description="description"
  >
    <template #prefix>
      <img src="@/assets/modal/accepted.png" alt="check sign">
    </template>
    <template #buttons>
      <ButtonBlue @click="closeModal" class="w-60" :title="buttonTitle"></ButtonBlue>
    </template>
  </ModalView>
</template>
<script setup>
import ModalView from "@/components/modal/modalView";
import ButtonBlue from "@/components/helper/button/buttonBlue";
import {useRouter} from "vue-router";
import {computed} from "vue";
import {useStore} from "vuex";

const route = useRouter();
const store = useStore();
const success = computed(() => store.getters['verificationModule/' + props.successShow]);
const clean = () => store.commit("verificationModule/clean");
// eslint-disable-next-line no-undef
const props = defineProps({
  description: String,
  buttonTitle: String,
  pathName: String,
  successShow: String,
});

function closeModal() {
  clean();
  route.replace({
    name: props.pathName
  });
}

</script>