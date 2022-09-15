import {useStore} from "vuex";
import {computed} from "vue";
import {useRouter} from "vue-router";
import agreementAndPolicies from "@/constants/basket/agreementAndPolicies";
import wayOfPaymentConstant from "@/constants/payment/wayOfPaymentConstant";

export default function () {
    const store = useStore();
    const isFastPurchase = computed(() => store.getters['wayOfPaymentModule/isFastPurchase']);
    const route = useRouter();
    const clean = () => store.commit('wayOfPaymentModule/cleanShow');
    const openAgreement = () => store.commit("registrationOrderModule/setPolicies", agreementAndPolicies.CHOOSING);
    const wayOfPayment = computed(() => store.getters['registrationOrderModule/wayOfPayment']);

    function defaultRoute() {
        route.replace("/cart/prepareOrder");
    }

    function goToDeliveryOrDefault() {
        if (isFastPurchase.value)
            route.push("/cart/selectAddress");
        else {
            defaultRoute();
            clean();
        }
    }

    function goToPlasticOrAgreement() {
        if (wayOfPayment.value.type === wayOfPaymentConstant.CASH) {
            openAgreement();
        } else {
            route.push("/cart/plasticCard");
        }
    }

    async function goToPurchase(name) {
        if (isFastPurchase.value) {
            goToPlasticOrAgreement();
        } else {
            const isValid = await store.dispatch("deliveryInfoModule/" + name);
            if (isValid)
                defaultRoute();
        }
    }

    return {
        goToDeliveryOrDefault: goToDeliveryOrDefault,
        goToPurchaseSelfDelivery: () => goToPurchase("selfDelivery"),
        goToPurchaseDelivery: () => goToPurchase("submitDelivery")
    }
}