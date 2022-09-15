import orderService from "@/services/basket/orderService";

export const prepareBasketModule = {
    namespaced: true,
    state() {
        return {
            count: 0,
            allOrders: [
                // shops
                // orders : [
                //    id,
                //    quantity
                //
                // ]
                //
            ],
            interistingProduct: [],
            selectedOrders: {
                // the price and real_price will be set when
                // way of payment will be chosen
                //
                //
                // order_id
                // quantity
                // order
            },
        }
    },
    getters: {
        interistingProduct(state) {
            return state.interistingProduct;
        },
        allSelected(state) {
            return Object.entries(state.selectedOrders).length === state.count;
        },
        isInShopSelected(state) {
            return (index) => Object.entries(state.selectedOrders).filter(e => state.allOrders[index].orders
                .filter(inOrder => inOrder.id === parseInt(e[0])).length).length === state.allOrders[index].orders.length;
        },
        count(state) {
            return state.count;
        },
        getSelectedItem(state) {
            return (index) => state.selectedOrders[index];
        },
        numberSelectedOrders(state) {
            return Object.entries(state.selectedOrders).length;
        },
        calculatePrice(state) {
            return (name) => {
                let selectedOrders = Object.entries(state.selectedOrders);
                if (selectedOrders.length === 1) {
                    let order = selectedOrders[0][1];
                    return order.product[name] * order.quantity;
                }
                return selectedOrders.reduce((prevOrder, currentOrder) => {
                    let price = prevOrder;
                    if (typeof prevOrder !== 'number') {
                        price = prevOrder[1].product[name] * prevOrder[1].quantity;
                    }
                    return price + currentOrder[1].product[name] * currentOrder[1].quantity;
                });
            }
        },
        productIds: (state) => {
            return Object.entries(state.selectedOrders)
                .map((item, index) => `product_ids[${index}]=${item[1].product.id}`).join("&");
        },
        selectedOrders: (state) => {
            return state.selectedOrders;
        },
        ordersId: (state) => {
            return Object.entries(state.selectedOrders).map(e => e[0]);
        },
        countOrders(state) {
            return state.allOrders && state.allOrders.length;
        },
        allOrders(state) {
            return state.allOrders || [];
        }
    },
    actions: {
        async updateQuantityOrder({dispatch, commit}, {order_id, quantity, index}) {
            commit("updateQuantityAllOrders", {index: index, quantity: quantity, order_id: order_id})

            dispatch("updateOrder", {
                id: order_id, data: {
                    quantity: quantity
                }
            });
        },
        async getInteristingProduct({commit}) {
            const result = await orderService.getInteristingProduct();
            commit('setInteristingProduct', result.products);
        },
        async deleteSelectedOrders({dispatch, getters, commit}) {
            let selected = Object.entries(getters.selectedOrders);
            selected.forEach(e => {
                commit('removeAllOrdersWithoutIndex', {order_id: e[1].id});
            });
            let ids = selected.map(e => e[0]);
            dispatch("massDestroyOrder", ids);
            commit("cleanSelectedOrders");
        },
        async deleteOrders({dispatch, commit}, {order_id, index}) {
            dispatch('destroyOrder', order_id);
            commit("removeInAllOrders", {index: index, order_id: order_id});
            commit("removeSelectedOrders", {id: order_id});
        },
        async getOrders({commit}) {
            commit("wait/START", "basket", {root: true});
            try {
                let result = await orderService.getOrders();
                commit('setAllOrders', result.basket);
                commit('setCount', result.count);
            } catch (e) {
                console.log(e)
            }
            commit("wait/END", "basket", {root: true});
        },
        // eslint-disable-next-line no-unused-vars
        async destroyOrder({commit}, id) {
            try {
                await orderService.destroyOrder(id);
            } catch (e) {
                console.log(e);
            }
        },
        // eslint-disable-next-line no-unused-vars
        async updateOrder({commit}, {id, data}) {
            try {
                await orderService.updateOrder(id, data);
            } catch (e) {
                console.log(e);
            }
        },
        // ids = { ids: []}
        // eslint-disable-next-line no-unused-vars
        async massDestroyOrder({commit}, ids) {
            try {
                await orderService.massDestroyOrder({ids: ids});
            } catch (e) {
                console.log(e);
            }
        }
    },
    mutations: {
        setInteristingProduct(state, product) {
            state.interistingProduct = product;
        },
        setAllOrders(state, orders) {
            state.allOrders = orders;
        },
        setCount(state, count) {
            state.count = count;
        },
        addAllInShop(state, index) {
            state.allOrders[index].orders
                .forEach(e => state.selectedOrders[e.id] = e);
        },
        cleanAllInShop(state, index) {
            state.allOrders[index].orders
                .forEach(e => delete state.selectedOrders[e.id]);
        },
        addAllToSelected(state) {
            state.allOrders.forEach(e => {
                e.orders.forEach(order => {
                    state.selectedOrders[order.id] = order;
                });
            });
        },
        updateQuantityAllOrders(state, {index, quantity, order_id}) {
            state.allOrders[index].orders.filter(e => e.id === order_id).forEach(item => {
                item.quantity = quantity;
            });
        },
        addToSelectedOrders(state, order) {
            if (Array.isArray(order)) {
                order.forEach(e => {
                    state.selectedOrders[e.id] = e;
                });
                return;
            }
            state.selectedOrders[order.id] = order;
        },
        removeInAllOrders(state, {index, order_id}) {
            let orders = state.allOrders[index].orders;
            state.allOrders[index].orders = orders.filter(e => e.id !== order_id);
            state.count--;
            if (state.allOrders[index].orders.length === 0) { // if the shop does not have any orders delete the shop
                state.allOrders.splice(index, 1);
            }
        },
        removeAllOrdersWithoutIndex(state, {order_id}) {
            for (let i = state.allOrders.length - 1; i >= 0; i--) { // iterate all array
                for (let k = state.allOrders[i].orders.length - 1; k >= 0; k--) { // iterate from orders in shop
                    if (state.allOrders[i].orders[k].id === order_id) { // check we got correct order
                        state.allOrders[i].orders.splice(k, 1); // remove order
                        state.count--;
                        if (state.allOrders[i].orders.length === 0) { // if the shop does not have any orders delete the shop
                            state.allOrders.splice(i, 1);
                        }
                    }
                }
            }
        },
        removeSelectedOrders(state, order) {
            if (Array.isArray(order)) {
                order.forEach(e => {
                    delete state.selectedOrders[e.id];
                })
                return;
            }
            delete state.selectedOrders[order.id];
        },
        cleanSelectedOrders(state) {
            state.selectedOrders = {};
        },
        deleteSelectedOrders(state, key) {
            delete state.selectedOrders[key];
        },
        clean(state) {
            state.interistingProduct = [];
            state.count = 0;
            state.allOrders = [
                // shops
                // orders : [
                //    id,
                //    quantity
                //
                // ]
                //
            ];
            state.selectedOrders =
                {
                    // order_id
                    // quantity
                    // order
                }
        }
    }
}