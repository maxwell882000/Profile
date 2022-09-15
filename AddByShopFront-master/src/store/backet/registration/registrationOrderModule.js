import deliveryService from "@/services/purchase/deliveryService";
import deliveryConstant from "@/constants/delivery/deliveryConstant";
import wayOfPaymentConstant from "@/constants/payment/wayOfPaymentConstant";
import purchaseService from "@/services/purchase/purchaseService";
import agreementAndPolicies from "@/constants/basket/agreementAndPolicies";
// payment_type: true, if you want to checkg
export const registrationOrderModule = {
    namespaced: true,
    state() {
        return {
            deliveryCost: {
                different_shop: false
                //'price' => $price,
                // 'days' => $day,
                // 'different_shop' => $products->count() > 1
            },
            wayOfPayment: {
                type: wayOfPaymentConstant.NOT_CHOSEN,
                index_of_credit: -1
                // additional info will be sent depending on what option was selected
                //credit_id -- will be deleted if not installment
                //initial_price -- will be deleted if not installment
                // also will be deleted from selected orders -- wrong
                // all will be stored here
                // price
                // real_price --- must be set using discount_percent from price
                // index_of_credit = installment.index;
                // credit_id = installment.currentCredit.id;
                // initial_price = installment.initialPayment;
                // real_price = overallPrice.value;
                // over_payment = installment.percentageOverPayment;
                // name = mainCredit.value.name;
                // main_credit_id = mainCredit.value.id;
            },
            deliveryInfo: {},
            form: {
                // delivery
                // "purchase->delivery_address->city_id" => "1"
                // "purchase->delivery_address->index" => "123456"
                // "purchase->delivery_address->street" => "124124"
                // "purchase->delivery_address->house" => "1244"
                // "purchase->delivery_address->flat" => "2421"
                // "purchase->delivery_address->instructions" => "124214214124"
            },
            successPurchase: false,
            createdId: null,
            policies: agreementAndPolicies.NOT_CHOSEN
            // set to Choosing , when cash selected or
            // after selecting
        }
    },
    actions: {
        async getCostOfDelivery({commit, getters, rootGetters}) {
            commit("wait/START", "delivery_price_loaded", {root: true});
            try {
                const form = {
                    ...getters.deliveryInfo,
                    "order_ids": rootGetters['prepareBasketModule/ordersId']
                };
                const result = await deliveryService.calculateDeliveryPrice(form);
                commit('setDeliveryCost', result);
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "delivery_price_loaded", {root: true});
        },

        // in this step everything must be ideal
        // because we are validating all data before submitting !
        async purchaseOrders({commit, getters, rootGetters, dispatch}) {
            commit("wait/START", "create_purchases_loaded", {root: true});
            commit("plasticCardModule/setError", null, {root: true});

            try {
                const form = {
                    ...getters.wayOfPayment,
                    ...getters.deliveryInfo,
                    ...getters.form,
                    ...rootGetters["plasticCardModule/plasticId"],
                    orders: rootGetters['prepareBasketModule/ordersId'],

                };
                // console.log("DATA SENDING");
                // console.log("REMOVE PAYMENT TYPE IN PRODUCTION !!!!!!!!");
                form['way_of_payment'] = getters.wayOfPayment.type === wayOfPaymentConstant.INSTALLMENT ?
                    wayOfPaymentConstant.INSTALLMENT + wayOfPaymentConstant.RE_MAP_STATUS_VALUE
                    : getters.wayOfPayment.type === wayOfPaymentConstant.CASH ? 1 : 2;
                console.log(JSON.stringify(form));
                const result = await purchaseService.createPurchases(form);
                console.log(result);
                // decrease basket counter
                commit('setBasketCounter', rootGetters['prepareBasketModule/numberSelectedOrders'], {root: true});
                commit('setSuccessPurchase', result.purchase_id);// open modal
            } catch (e) {
                console.log(e);
                // commit("plasticCardModule/setError", e, {root: true});
                dispatch("showAlert", e, {root: true});
            }
            commit("wait/END", "create_purchases_loaded", {root: true});
        }
    },
    getters: {
        createdId(state) {
            return state.createdId;
        },
        wayOfPayment(state) {
            return state.wayOfPayment;
        },
        deliveryCost(state) {
            return state.deliveryCost
        },
        policies(state) {
            return state.policies === agreementAndPolicies.CHOOSING;
        },
        successPurchase(state) {
            return state.successPurchase;
        },
        deliveryInfo(state) {
            return state.deliveryInfo;
        },
        fullAddress(state) {
            return `${state.deliveryInfo[deliveryConstant.ADDRESS_NAME]}, ${state.deliveryInfo[deliveryConstant.STREET]}`;
        },
        homeInfo(state) {
            return `${state.deliveryInfo[deliveryConstant.HOUSE]} дом, ${state.deliveryInfo[deliveryConstant.FLAT]} квартира`;
        },
    },
    mutations: {
        cleanDelivery(state) {
            state.deliveryCost = {
                different_shop: false
            };
            state.deliveryInfo = {};
        },
        clean(state) {
            state.deliveryCost = {
                different_shop: false
            };
            state.deliveryInfo = {}
            state.wayOfPayment = {
                type: wayOfPaymentConstant.NOT_CHOSEN,
            }
            state.form = {};
            state.successPurchase = false;
            state.policies = agreementAndPolicies.NOT_CHOSEN;
            state.createdId = null;
        },
        openPolicies(state) {
            state.policies = agreementAndPolicies.CHOOSING;
        },
        setPolicies(state, policy) {
            console.log("SETTED");
            state.policies = policy;
        },
        setSuccessPurchase(state, id) {
            state.successPurchase = true;
            state.createdId = id; // after we got purchase;
        },
        deleteWayOfPayment(state, key) {
            delete state.wayOfPayment[key];
        },
        setDeliveryInfo(state, deliveryInfo) {
            state.deliveryInfo = deliveryInfo;
        },
        setDeliveryCost(state, cost) {
            state.deliveryCost = cost;
        }
    }
}

///
// payment_type -- if it was paid in place
// orders : [ 1, 2,3, ] // with ids
// "user_id" => null
// "plastic_id" => "9f57b37f-0359-4f65-bca0-12a3561e30cb"
// "credit_id" => "1"
// "initial_price" => "12125"
// "delivery" => null set delivery if it exists
