<template>
  <VerifyCode
      :custom-close="close"
      v-model="show"
      @code-submit="submit"
      :description="$t('Введите код подтверждения')">
  </VerifyCode>
</template>
<script setup>
import VerifyCode from "@/components/auth/code/verifyCode";
import {useStore} from "vuex";
import {computed} from "vue";
import {useRoute, useRouter} from "vue-router";

const store = useStore();
let show = computed(() => store.getters['plasticCardModule/showVerification']);
const close = () => store.commit("plasticCardModule/closeVerification");
const submitCardForUser = (code) => store.dispatch("plasticCardModule/insertCardForUser", code);
const submitCardForBuy = (code) => store.dispatch("plasticCardModule/insertCardForBuy", code);

// const openPolicies = () => store.commit("registrationOrderModule/openPolicies", true);
// const openSuccessCard = () => store.commit("plasticCardModule/setShowSuccessCard", true);
const route = useRoute();
const router = useRouter();

async function submit(code) {
  if (route.name !== "insert_card")
    await submitCardForBuy(code);
  else {
    code.router = router;
    await submitCardForUser(code);
  }
}
</script>