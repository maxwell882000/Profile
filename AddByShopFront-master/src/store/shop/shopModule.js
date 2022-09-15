import shopService from "@/services/shop/shopService";

export const shopModule = {
    namespaced: true,
    state() {
        return {
            shop: {},
            shop_all: []
        }
    },
    getters: {
        shop(state) {
            return state.shop;
        },
        shop_all(state) {
            return state.shop_all;
        }
    },
    actions: {
        async getShop({commit}, slug) {
            commit("wait/START", "shop_loaded", {root: true});
            try {
                let result = await shopService.getShop(slug);
                commit('setShop', result.shop);
                commit('productFilterByModule/setFilterCanBeApplied', result.filter, {root: true});
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "shop_loaded", {root: true});
        },
        async getAllShop({commit}) {
            commit("wait/START", "shop_all_loaded", {root: true});
            try {
                const result = await shopService.getAllShop();
                console.log(result);
                commit('setShopAll', result);
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "shop_all_loaded", {root: true});
        }
    },
    mutations: {
        setShop(state, shop) {
            state.shop = shop;
        },
        setShopAll(state, shop_all) {
            state.shop_all = shop_all.shop_all;
        }
    }
}