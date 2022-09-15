import purchaseService from "@/services/user/purchaseService";
import wayOfPaymentConstant from "@/constants/payment/wayOfPaymentConstant";
import statusPayment from "@/constants/payment/statusPayment";

export const purchaseModule = {
    namespaced: true,
    state() {
        return {
            purchases: [],
            errorPayment: {},
            errorInstallment: {},
            chosePlasticCard: false,
            selectedMonth: null,
            successModalView: null,
            errorModalView: null,
        }
    },
    actions: {
        async getPurchases({commit}) {
            commit("wait/START", "purchases_loaded", {root: true});
            try {
                const result = await purchaseService.getPurchases();
                commit('setPurchases', result.purchases);
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "purchases_loaded", {root: true});
        },
        async cancelPayment({commit, getters}, {purchase, reason}) {
            commit("wait/START", "payment_" + purchase.id, {root: true});
            delete getters.errorPayment[purchase.id];
            try {
                await purchaseService.cancelPayment(purchase.id, reason);
                purchase.status = statusPayment.DECLINED;
                purchase.reason = reason.reason;
            } catch (e) {
                console.log(e);
                getters.errorPayment[purchase.id] = e;
            }
            commit("wait/END", "payment_" + purchase.id, {root: true});
        },
        closeModal({commit}) {
            commit('setChosePlasticCard', false);
            commit("setSelectedMonth", null);
        },
        //  purchase:purchase,
        //  month: item.id
        startPayment({commit}, selectedMonth) {
            commit('setSelectedMonth', selectedMonth);
            commit('setChosePlasticCard', true);
            console.log("STARTED PAYMENT");
        },
        async paidForMonth({commit, getters, dispatch}, plastic) {
            const month = getters.selectedMonth.month;
            const purchase = getters.selectedMonth.purchase;
            commit("wait/START", "installment_" + purchase.id, {root: true});
            commit("wait/START", "buying_loaded", {root: true});
            try {
                console.log('get getters');
                console.log(getters);
                const result = await purchaseService.payForMonth({
                    month_paid_id: month.id,
                    plastic: {
                        plastic_id: plastic
                    }
                });
                console.log(result);
                console.log(getters.selectedMonth);
                month.paid = result.paid;
                console.log(month.paid);
                purchase.payble.next_paid_month = result.next_paid_month;
                purchase.payble.status = result.status;
                purchase.payble.already_paid = parseFloat(purchase.payble.already_paid) + parseFloat(result.paid);
                commit('setSuccessModalView', "Успешно произошла оплата");
                /// show success window
            } catch (e) {
                console.log(e);
                commit('setErrorModalView', e);
                /// show error window
            }
            dispatch("closeModal");
            commit("wait/END", "installment_" + purchase.id, {root: true});
            commit("wait/END", "buying_loaded", {root: true});

        },
        async cancelInstallment({commit, getters}, {purchase, reason}) {
            commit("wait/START", "installment_" + purchase.id, {root: true});
            delete getters.errorInstallment[purchase.id];
            try {
                await purchaseService.cancelInstallment(purchase.id, reason);
                purchase.status = statusPayment.DECLINED;
                purchase.reason = reason.reason;
            } catch (e) {
                console.log(e);
                getters.errorInstallment[purchase.id] = e;
            }
            commit("wait/END", "installment_" + purchase.id, {root: true});
        }
    },
    mutations: {
        setSuccessModalView(state, success) {
            state.successModalView = success;
        },
        setErrorModalView(state, error) {
            state.errorModalView = error;
        },
        setChosePlasticCard(state, plastic) {
            state.chosePlasticCard = plastic;
        },
        setPurchases(state, purchases) {
            state.purchases = purchases;
        },
        setSelectedMonth(state, selectedMonth) {
            console.log(selectedMonth);
            state.selectedMonth = selectedMonth;
        },
        clean(state) {
            state.purchases = [];
            state.errorPayment = {};
            state.errorInstallment = {};
            state.chosePlasticCard = false;
            state.selectedMonth = null;
            state.successModalView = null;
            state.errorModalView = null;
        }
    },
    getters: {
        successModalView(state) {
            return state.successModalView;
        },
        errorModalView(state) {
            return state.errorModalView;
        },
        chosePlasticCard(state) {
            return state.chosePlasticCard;
        },
        selectedMonth(state) {
            return state.selectedMonth;
        },
        onlyInstallment(state) {
            return state.purchases.filter(e =>
                e.status === wayOfPaymentConstant.INSTALLMENT
                && (e.payble.status === statusPayment.ACCEPTED || e.payble.status === statusPayment.REQUIRED_SURETY + statusPayment.ACCEPTED));
        },
        errorPayment(state) {
            return state.errorPayment;
        },
        errorInstallment(state) {
            return state.errorInstallment;
        },
        waitingAnswer(state) {
            return state.purchases.filter(e => e.payble.status === statusPayment.WAIT_ANSWER ||
                e.payble.status === statusPayment.REQUIRED_SURETY);
        },
        waitingToPurchase(state) {
            return state.purchases.filter(e => e.payble.status === statusPayment.ACCEPTED
                && e.status !== wayOfPaymentConstant.INSTALLMENT)
        },
        finishedPurchases(state) {
            return state.purchases.filter(e => e.payble.status === statusPayment.FINISHED);
        },
        declinedPurchases(state) {
            return state.purchases.filter(e => e.payble.status === statusPayment.DECLINED);
        },
        purchases(state) {
            return state.purchases;
        }
    }
}