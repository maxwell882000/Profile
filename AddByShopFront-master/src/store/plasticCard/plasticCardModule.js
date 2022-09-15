import plasticCardService from "@/services/plasticCard/plasticCardService";
import i18n from '@/i18n'

export const plasticCardModule = {
    namespaced: true,
    state() {
        return {
            cards: [],
            selectedCard: {
                id: -1,
                card_number: "",
                expiry: "",
                // "id" => $this->id,
                // "pan" => $this->pan,
                // "expiry" => $this->expiry,
                // "card_holder" => $this->card_holder
            },
            transaction_id: null,
            error: null,
            showVerification: false,
            showSuccessCard: false,
        }
    },
    actions: {
        validatePlasticCard({commit, getters, dispatch}) {
            if (getters.selectedCard.id === -1) {
                const t = i18n.global.t;
                if (getters.selectedCard.card_number.length < 16) {
                    getters.selectedCard.card_error = t("Номер карты должен быть как минимум 16 цифр");
                } else {
                    getters.selectedCard.card_error = "";
                }
                if (getters.selectedCard.expiry.length < 5) {
                    getters.selectedCard.expiry_error = t("Срок действия карты необходима");
                } else {
                    getters.selectedCard.expiry_error = "";
                }
                if (!getters.selectedCard.expiry_error && !getters.selectedCard.card_error) {
                    dispatch("startTransaction");
                }
            } else {
                console.log("GET POLICIES");
                commit("registrationOrderModule/openPolicies", null, {root: true})
            }

        },
        async getCards({commit}) { // dispatched beforehand
            commit("wait/START", "card_loaded", {root: true});
            try {
                const result = await plasticCardService.getCards();
                commit("setCards", result.cards);
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "card_loaded", {root: true});
        },
        async startTransaction({commit, getters, dispatch}) {
            commit("wait/START", "start_transaction_loaded", {root: true});
            commit("setError", "");
            try {
                const result = await plasticCardService.getTransactionForPlastic({
                    card_number: getters.selectedCard.card_number,
                    expiry: getters.selectedCard.expiry
                });
                commit('setTransactionId', result.transaction_id);
                commit('openVerification');
            } catch (e) {
                console.log(e);
                commit('setError', e);
                dispatch("showAlert", e, {root: true});
            }
            commit("wait/END", "start_transaction_loaded", {root: true});
        },
        async insertCard({commit, getters, dispatch}, {code}) {
            commit("wait/START", "code", {root: true});
            commit("setError", null); // clean before use good solution !!
            try {
                const result = await plasticCardService.insertPlasticCard(
                    {
                        code: code,
                        card_number: getters['selectedCard'].card_number,
                        transaction_id: getters['transactionId']
                    }
                )
                commit('setSelectedCard', result);
                commit("addToSelectedCard", result);
                commit("closeVerification");
            } catch (e) {
                console.log(e);
                commit('setError', e);
                dispatch("showAlert", e, {root: true});
            }
            commit("wait/END", "code", {root: true});
        },
        async insertCardForBuy({dispatch, commit, getters}, {code}) {
            await dispatch('insertCard', {code: code});
            if (getters.error === null)
                commit("registrationOrderModule/openPolicies", true, {root: true});
        },
        async insertCardForUser({dispatch, commit, getters}, {code, router}) {
            await dispatch("insertCard", {code: code});
            if (getters.error === null) {
                commit('plasticCardModule/setShowSuccessCard', true, {root: true});
                router.back();
            }
        },
        async dialCode({commit, getters}) {
            commit("wait/START", "code", {root: true});
            commit("setError", "");
            try {
                const transaction_id = getters.transaction_id;
                await plasticCardService.dialCode({transaction_id: transaction_id});
            } catch (e) {
                console.log(e);
                commit('setErrors', e);
            }
            commit('wait/END', "code", {root: true});
        },
        async revokeCard({commit, getters}, plastic_id) {
            commit("wait/START", "revoke_card_" + plastic_id, {root: true});
            commit("setError", "");
            try {
                await plasticCardService.revokeCard(plastic_id);
                commit("setCards", getters.cards.filter(e => e.id !== plastic_id));// cleaning deleting card from the front
            } catch (e) {
                console.log(e);
                commit("setErrors", e);
            }
            commit("wait/END", "revoke_card_" + plastic_id, {root: true});
        }
    },
    getters: {
        error(state) {
            return state.error;
        },
        showSuccessCard(state) {
            return state.showSuccessCard;
        },
        isEmptyCard(state) {
            return !state.cards.length;
        },
        cards(state) {
            return state.cards;
        },
        selectedCard(state) {
            return state.selectedCard;
        },
        showVerification(state) {
            return state.showVerification;
        },
        plasticId(state) {
            if (state.selectedCard.id !== -1)
                return {
                    plastic_id: state.selectedCard.id
                }
            return {}
        },
        transactionId(state) {
            return state.transaction_id;
        }
    },
    mutations: {
        cleanForInsert(state) {
            state.transaction_id = null;
            state.error = null;
        },
        clean(state) {
            state.cards = [];
            state.selectedCard = {
                id: -1
            };
            state.transaction_id = null;
            state.error = null;
        },
        setShowSuccessCard(state, card) {
            state.showSuccessCard = card;
        },
        setCards(state, card) {
            state.cards = card;
        },
        setError(state, error) {
            state.error = error;
        },
        openVerification(state) {
            state.showVerification = true;
        },
        closeVerification(state) {
            state.showVerification = false;
            state.transaction_id = null;
        },
        addToSelectedCard(state, card) {
            state.cards.push(card);
        },
        cleanSelectedCard(state) {
            state.selectedCard.id = -1;
        },
        setSelectedCard(state, card) {
            state.selectedCard = card;
        },
        setTransactionId(state, transaction_id) {
            state.transaction_id = transaction_id;
        }
    }
}