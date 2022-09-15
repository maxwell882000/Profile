import {useStore} from "vuex";
import {computed} from "vue";
import wayOfPaymentConstant from "@/constants/payment/wayOfPaymentConstant";
import usePurchaseFlow from "@/components/backet/purchaseFlow/setup/usePurchaseFlow";

export default function (installment, overallPrice, mainCredit) {
    const store = useStore();
    const wayOfPayment = computed(() => store.getters['registrationOrderModule/wayOfPayment']);

    const deleteWayOfPaymentKey = (key) => store.commit("registrationOrderModule/deleteWayOfPayment", key);
    const {goToDeliveryOrDefault} = usePurchaseFlow();

    function acceptCash() {
        deleteKeys();
        wayOfPayment.value.type = wayOfPaymentConstant.CASH;
        wayOfPayment.value.main_credit_id = wayOfPaymentConstant.CASH - wayOfPaymentConstant.RE_MAP_STATUS_VALUE;
        goToDeliveryOrDefault();
    }

    function deleteKeys() {
        deleteWayOfPaymentKey("credit_id");
        deleteWayOfPaymentKey("index_of_credit");
        deleteWayOfPaymentKey("initial_price");
        deleteWayOfPaymentKey("real_price");
        deleteWayOfPaymentKey("over_payment"); // add this one
        deleteWayOfPaymentKey("name");
        deleteWayOfPaymentKey("main_credit_id");
    }


    function acceptCard() {
        deleteKeys();
        wayOfPayment.value.type = wayOfPaymentConstant.CARD;
        wayOfPayment.value.main_credit_id = wayOfPaymentConstant.CARD - wayOfPaymentConstant.RE_MAP_STATUS_VALUE;
        goToDeliveryOrDefault();
    }

    function acceptInstallment() {
        wayOfPayment.value.type = wayOfPaymentConstant.INSTALLMENT;
        wayOfPayment.value.index_of_credit = installment.index;
        wayOfPayment.value.credit_id = installment.currentCredit.id;
        wayOfPayment.value.initial_price = installment.initialPayment;
        wayOfPayment.value.real_price = overallPrice.value;
        wayOfPayment.value.over_payment = installment.percentageOverPayment;
        wayOfPayment.value.name = mainCredit.value.name;
        wayOfPayment.value.main_credit_id = mainCredit.value.id;
        goToDeliveryOrDefault();
    }

    return {
        acceptCash: acceptCash,
        acceptCard: acceptCard,
        acceptInstallment: acceptInstallment,
    }
}