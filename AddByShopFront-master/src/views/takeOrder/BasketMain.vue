<template>
  <loader waiting="user">
    <router-view></router-view>
  </loader>
  <accept-policies-and-agreement></accept-policies-and-agreement>
  <success-purchase-modal></success-purchase-modal>
</template>
<script>
import {mapMutations} from "vuex";
import Loader from "@/components/loading/loader";
import AcceptPoliciesAndAgreement from "@/components/backet/modal/acceptPoliciesAndAgreement";
import SuccessPurchaseModal from "@/components/backet/modal/successPurchaseModal";

export default {
  // eslint-disable-next-line vue/no-unused-components
  components: {SuccessPurchaseModal, AcceptPoliciesAndAgreement, Loader},
  methods: {
    ...mapMutations({
      hideCategoryLine: 'hideCategoryLine',
      openCategoryLine: 'openCategoryLine',
      clean: 'prepareBasketModule/clean',
      cleanAddress: "deliveryInfoModule/clean",
      cleanRegistration: "registrationOrderModule/clean",
      cleanPayment: "wayOfPaymentModule/clean",
      cleanCard: "plasticCardModule/clean"
    })
  },
  mounted() {
    this.hideCategoryLine();
  },
  unmounted() {
    this.openCategoryLine();
    this.clean();
    this.cleanAddress();
    this.cleanRegistration();
    this.cleanPayment();
    this.cleanCard();
  }
}
</script>
<style lang="scss">
.card {
  border: none;
  border-radius: 12px;

  display: flex;
  justify-content: flex-end;
  flex-direction: column;
  @media (max-width: 768px) {
    border-radius: 0px !important;
  }

  &.empty-card {
    align-items: center;
    padding: 20px;
  }

  .goto-catalogue {
    padding: 10px 40px;
    border-radius: 12px;
  }

  .line {
    margin: 10px 0;
    background: #f2f2f2;
    width: 100%;
    height: 1px;
  }

  .btn {
    font-size: 14px;

    &[disabled] {
      background-color: #f2f2f2;
      color: var(--grey);
      border-color: transparent;
    }
  }
}
</style>