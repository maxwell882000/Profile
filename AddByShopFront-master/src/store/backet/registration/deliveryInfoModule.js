import purchaseService from "@/services/purchase/deliveryService";
import deliveryConstant from "@/constants/delivery/deliveryConstant";
import DeliveryConstant from "@/constants/delivery/deliveryConstant";
import deliveryStatusConstant from "@/constants/delivery/deliveryStatusConstant";

export const deliveryInfoModule = {
    namespaced: true,
    state() {
        return {
            cities: [],
            shops: [],
            statusDelivery: deliveryStatusConstant.NOT_CHOSEN,// one variable is enough because it will be changed once
            deliveryInfo: { // we use two deliveryInfo because this one can be changed easily
                // delivery
                // "purchase->delivery_address->city_id" => "1"
                // "purchase->delivery_address->index" => "123456"
                // "purchase->delivery_address->street" => "124124"
                // "purchase->delivery_address->house" => "1244"
                // "purchase->delivery_address->flat" => "2421"
                // "purchase->delivery_address->instructions" => "124214214124"
            },
            errors: {}
        }
    },
    actions: {
        selfDelivery({commit}) {
            commit("clean");
            commit('setStatus', deliveryStatusConstant.SELF_DELIVERY);
            commit("registrationOrderModule/cleanDelivery", null, {root: true});
            return true; // fully valid
        },
        // eslint-disable-next-line no-unused-vars
        submitDelivery({commit, getters, dispatch}) {
            commit('cleanError');
            if (getters.deliveryInfo[deliveryConstant.INDEX]
                && getters.deliveryInfo[deliveryConstant.INDEX].length !== 6) {
                commit("setErrors", {key: 'index', message: "Должен иметь 6 цифр"});
            }
            if (!getters.deliveryInfo[DeliveryConstant.CITY_ID]) {
                commit("setErrors", {key: 'address_name', message: "Выберите город из списка"})
            }
            let result = !Object.entries(getters.errors).length;
            if (result) {
                commit('setStatus', deliveryStatusConstant.DELIVERY);
                commit("registrationOrderModule/setDeliveryInfo", getters.deliveryInfo, {root: true});
                dispatch("registrationOrderModule/getCostOfDelivery", null, {root: true});
            }
            getters.deliveryInfo['delivery'] = 0;
            return result; // checking if the form is valid or not
        },
        async getMapSearchCity({commit}, search) {
            commit("wait/START", "map_city_loaded", {root: true});
            try {
                const result = await purchaseService.mapSearchCity(search);
                commit('setCities', result.city);

            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "map_city_loaded", {root: true});
        },
        async getShops({commit, rootGetters}) {
            commit("wait/START", "map_shop_loaded", {root: true});
            try {
                const product_ids = rootGetters["prepareBasketModule/productIds"];
                const result = await purchaseService.getShops(product_ids);
                commit('setShops', result.shop);
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "map_shop_loaded", {root: true});
        }
    },
    mutations: {
        setAddressName(state, address) {
            state.deliveryInfo[deliveryConstant.ADDRESS_NAME] = address.search;
            state.deliveryInfo[deliveryConstant.CITY_ID] = address.id;
        },
        setErrors(state, {key, message}) {
            state.errors[key] = message;
        },
        setCities(state, cities) {
            state.cities = cities;
        },
        setDeliveryInfo(state, deliveryInfo) {
            state.deliveryInfo = deliveryInfo;
        },
        cleanError(state) {
            state.errors = {}
        },
        setStatus(state, status) {
            state.statusDelivery = status;
        },
        cleanAll(state) {
            state.cities = [];
            state.shops = [];
            state.statusDelivery = deliveryStatusConstant.NOT_CHOSEN;
            state.deliveryInfo = {
                // delivery
                // "purchase->delivery_address->city_id" => "1"
                // "purchase->delivery_address->index" => "123456"
                // "purchase->delivery_address->street" => "124124"
                // "purchase->delivery_address->house" => "1244"
                // "purchase->delivery_address->flat" => "2421"
                // "purchase->delivery_address->instructions" => "124214214124"
            }
            state.errors = {}
        },
        clean(state) {
            state.deliveryInfo = {};
        },
        setShops(state, shops) {
            state.shops = shops;
        }
    },
    getters: {
        errors(state) {
            return state.errors;
        },
        isValid(state) {
            const info = state.deliveryInfo;
            return info['address_name'] &&
                info['purchase->delivery_address->street'] &&
                info['purchase->delivery_address->house'] &&
                info['purchase->delivery_address->flat']
        },
        deliveryInfo(state) {
            return state.deliveryInfo;
        },
        cities(state) {
            return state.cities;
        },
        status(state) {
            return state.statusDelivery;
        },
        shops(state) {
            return state.shops;
        }
    }
}