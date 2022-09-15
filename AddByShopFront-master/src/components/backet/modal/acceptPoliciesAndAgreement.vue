<template>
  <ModalView
      v-model="isAgreement"
      @close-modal="close"
  >
    <template #prefix>
      <loader waiting="policy_load">
        <span class="block bold text-center">{{ $t("Условия и положения") }}</span>
        <div class="text-left">
          <div v-html="policy"></div>
        </div>
        <!--                <div class="text-left">-->
        <!--                  <h6>Поручительство, ответственность поручителя по кредиту</h6>-->
        <!--                  <p class="text-sm">-->
        <!--                    Поручительство – вид обеспечения исполнения обязательств по кредиту. Поручитель – человек, обязующийся перед-->
        <!--                    банком в случае неисполнения обязательств, возложенных по кредиту на заемщика, выполнить их за него-->
        <!--                    полностью-->
        <!--                    или частично. Отношения между банком и поручителем (условия, сумма и срок) закрепляются договором-->
        <!--                    поручительства. Чем больше сумма кредита, тем больше банк требует поручителей. Таким образом кредитная-->
        <!--                    организация снижает риск невозврата ссуды.-->
        <!--                  </p>-->
        <!--                  <h6>Поручительство, ответственность поручителя по кредиту</h6>-->
        <!--                  <p class="text-sm">-->
        <!--                    Поручительство – вид обеспечения исполнения обязательств по кредиту. Поручитель – человек, обязующийся перед-->
        <!--                    банком в случае неисполнения обязательств, возложенных по кредиту на заемщика, выполнить их за него-->
        <!--                    полностью-->
        <!--                    или частично. Отношения между банком и поручителем (условия, сумма и срок) закрепляются договором-->
        <!--                    поручительства. Чем больше сумма кредита, тем больше банк требует поручителей. Таким образом кредитная-->
        <!--                    организация снижает риск невозврата ссуды.-->
        <!--                  </p>-->
        <!--                </div>-->
        <ButtonBlue @click="agree" :title="$t('Я прочитал и согласен')"></ButtonBlue>
      </loader>

    </template>
  </ModalView>
</template>
<script setup>
import ModalView from "@/components/modal/modalView";
import ButtonBlue from "@/components/helper/button/buttonBlue";
import {useStore} from "vuex";
import {computed} from "vue";
import agreementAndPolicies from "@/constants/basket/agreementAndPolicies";
import Loader from "@/components/loading/loader";

const store = useStore();
const isAgreement = computed(() => store.getters['registrationOrderModule/policies']);
const setAgreement = (val) => store.commit("registrationOrderModule/setPolicies", val);
const purchaseOrder = () => store.dispatch("registrationOrderModule/purchaseOrders");
const getPolicy = () => store.dispatch("policyModule/getPolicy");
getPolicy();
const policy = computed(() => store.getters['policyModule/policy']);

// const setSuccess = computed(() => store.get)
function close() {
  setAgreement(agreementAndPolicies.NOT_CHOSEN);
}

function agree() {
  setAgreement(agreementAndPolicies.AGREE);
  purchaseOrder();
}
</script>