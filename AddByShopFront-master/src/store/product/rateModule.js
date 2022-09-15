import ratingService from "@/services/product/ratingService";

export const rateModule = {
    namespaced: true,
    state() {
        return {
            rate: {
                //     "mark_5" => $this->markNumber($product, 5),
                // "mark_4" => $this->markNumber($product, 4),
                // "mark_3" => $this->markNumber($product, 3),
                // "mark_2" => $this->markNumber($product, 2),
                // "mark_1" => $this->markNumber($product, 1),
                // "mark" => $product->mark()->avg("mark"),
                // "mark_num" => $product->mark()->count()
                mark_5: 0,
                mark_4: 0,
                mark_3: 0,
                mark_2: 0,
                mark_1: 0,
                mark: 0,
                mark_num: 0,
            }
        }
    },
    getters: {
        rate(state) {
            return state.rate;
        }
    },
    actions: {
        async getRate({commit, rootGetters}) {
            commit("wait/START", "rate", {root: true});
            let id = rootGetters["productModule/product"].id;
            try {
                let result = await ratingService.rate(id);
                commit("setRate", result);
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "rate", {root: true});
        }
    },
    mutations: {
        setRate(state, rate) {
            state.rate = rate;
        },
        clean(state) {
            state.rate = {
                mark_5: 0,
                mark_4: 0,
                mark_3: 0,
                mark_2: 0,
                mark_1: 0,
                mark: 0,
                mark_num: 0,
            }
        }
    }
}