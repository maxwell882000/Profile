import {useStore} from "vuex";
import {computed} from "vue";

export default function () {
    const store = useStore();
    const selectedCard = computed(() => store.getters['plasticCardModule/selectedCard']);
    const error = computed(() => store.getters['plasticCardModule/error']);
    const validateCard = () => store.dispatch("plasticCardModule/validatePlasticCard");

    function setExpiry(val) {
        selectedCard.value.expiry = val;
    }

    function setCardNumber(val) {
        selectedCard.value.card_number = val;
    }

    return {
        selectedCard: selectedCard,
        error: error,
        setExpiry: setExpiry,
        setCardNumber: setCardNumber,
        validateCard: validateCard
    }
}