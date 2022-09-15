import {useStore} from "vuex";
import {computed} from "vue";

export default function () {
    const store = useStore();
    const numberSelectedOrders = computed(() => store.getters['prepareBasketModule/numberSelectedOrders']);
    const wayOfPayment = computed(() => store.getters['registrationOrderModule/wayOfPayment']);
    const price = computed(() => store.getters['prepareBasketModule/calculatePrice']('price'));
    const overallPrice = computed(() => {
        if (wayOfPayment.value.real_price) {
            return wayOfPayment.value.real_price;
        }
        return store.getters['prepareBasketModule/calculatePrice']('real_price')
    });
    const discountPrice = computed(() => store.getters['prepareBasketModule/calculatePrice']('discount_price'));
    return {
        overallPrice: overallPrice,
        selectedLength: numberSelectedOrders,
        discountPrice: discountPrice,
        price: price
    }
}