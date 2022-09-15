<template>
  <back-button class="back-button-remove" :title="$t('Назад в оплату')"></back-button>
  <section class="rounded-st bg-white p-3">
    <!--    <div class="w-40">-->
    <b-row>
      <b-col cols="12" class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
          <h5 class="text-header-32">{{ $t("Привязка банковской карты") }} </h5>
        <br>
        <input-card
            :card_input="selectedCard.card_number"
            :expiry="selectedCard.expiry"
            :error_card="selectedCard.card_error"
            :error_expiry="selectedCard.expiry_error"
            @card-input="setCardNumber"
            @expiry-input="setExpiry">
        </input-card>
        <Error :error="error"></Error>
        <br>
        <span>{{
            $t("Нажимая на кнопку «Привязать», вы соглашаетесь с")
          }}   <span class="text-blue">  {{ $t("условиями привязки карты") }}  </span></span>
        <ButtonForm :is-entered="isEntered()"
                    class="p-2"
                    @submit="submit()"
                    :title="$t('Привязать')"></ButtonForm>
      </b-col>
    </b-row>
    <!--    </div>-->
  </section>
  <verify-card-modal></verify-card-modal>
</template>
<script setup>
import ButtonForm from "@/components/helper/button/buttonForm";
import BackButton from "@/components/helper/button/backButton";
import InputCard from "@/components/helper/input/inputCard";
import usePlastic from "@/components/helper/input/setup/usePlastic";
import Error from "@/components/helper/error/error";
import VerifyCardModal from "@/components/plasticCard/verifyCardModal";
import {useStore} from "vuex";
import {onMounted} from "vue";

function isEntered() {
  return selectedCard.value.card_number && selectedCard.value.expiry;
}

const store = useStore();
const cleanSelectedCard = () => store.commit('plasticCardModule/cleanSelectedCard')
const cleanInsert = () => store.commit("plasticCardModule/cleanForInsert");

function submit() {
  cleanSelectedCard();
  validateCard();
}

onMounted(() => {
  cleanInsert();
});
const {selectedCard, validateCard, error, setCardNumber, setExpiry} = usePlastic();
</script>
<style scoped>
.back-button-remove {
  margin-top: 0 !important;
}
</style>