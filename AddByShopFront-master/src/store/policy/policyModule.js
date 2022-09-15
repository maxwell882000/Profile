import policyService from "@/services/policy/policyService";

export const policyModule = {
    namespaced: true,
    state() {
        return {
            policy: ""
        }
    },
    getters: {
        policy: (state) => state.policy
    },
    actions: {
        async getPolicy({commit}) {
            commit("wait/START", "policy_load", {root: true});
            try {
                const result = await policyService.policy();
                commit("setPolicy", result.policy);
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "policy_load", {root: true});

        }
    },
    mutations: {
        setPolicy(state, policy) {
            state.policy = policy;
        }
    }
}