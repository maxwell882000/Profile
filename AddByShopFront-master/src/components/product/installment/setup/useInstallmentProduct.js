import {useStore} from "vuex";
import {computed} from "vue";

export default function () {
    const store = useStore();
    const product = computed(() => store.getters['productModule/product']);
    const installment = computed(() => product.value.installment);
    const priceOld = computed(() => product.value.price);
    const priceNew = computed(() => product.value.real_price);
    const discount = computed(() => product.value.discount);
    const setCredit = (item) => store.commit('productModule/setCredit', item);
    const selectedCredit = computed(() => store.getters['productModule/credit']);
    const priceInstallment = (selected) => {
        let price = parseInt(priceNew.value.replace(/\s/g, ''));
        let calculate_percent = price / 100 * selected.percent;
        console.log(calculate_percent);
        console.log(price);
        let divided = (calculate_percent + price) / selected.month;
        console.log(divided);
        try {
            return divided.toFixed(0).split("")
                .reverse().join("").match(/.{1,3}/g).join(" ").split("").reverse().join("");
        } catch (e) {
            return 0;
        }
    }
    const isInstallment = computed(() => installment.value && installment.value.credits.length);
    const firstCredit = computed(() => installment.value.credits[0]);
    const priceFirstInstallment = computed(() => priceInstallment(firstCredit.value));
    const priceSelectedInstallment = computed(() => priceInstallment(selectedCredit.value));
    return {
        isInstallment: isInstallment,
        priceFirstInstallment: priceFirstInstallment,
        priceInstallment: priceInstallment,
        discount: discount,
        firstCredit: firstCredit,
        priceNew: priceNew,
        installment: installment,
        priceOld: priceOld,
        selectedCredit: selectedCredit,
        priceSelectedInstallment: priceSelectedInstallment,
        setCredit: setCredit,
    }
}