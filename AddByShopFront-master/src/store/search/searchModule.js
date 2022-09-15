import searchSevice from "@/services/search/searchSevice";

export const searchModule = {
    namespaced: true,
    state() {
        return {
            search: {
                products: []
            }
        }
    },
    getters: {
        searchHelpers(state) {
            return state.search.products || [];
        },
        search(state) {
            return state.search
        }
    },
    actions: {
        async getSearchHelper({commit}, value) {
            try {
                let result = await searchSevice.getSearchHelper(value);
                console.log(result);
                commit("setSearch", result);
            } catch (e) {
                console.log(e);
            }
        },
        async getSearchFilter({commit, dispatch}, value) {
            commit("wait/START", "search_loaded", {root: true});
            commit("productFilterByModule/clean", null, {root: true})
            try {
                let result = await searchSevice.getSearchFilter(value);
                commit("productFilterByModule/setFilterCanBeApplied", result, {root: true});
                dispatch("productFilterByModule/addFilterAndGetProduct", {key: 'search', item: value}, {root: true});
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "search_loaded", {root: true});
        }
    },
    mutations: {
        setSearch(state, search) {
            state.search = search;
        }
    }
}