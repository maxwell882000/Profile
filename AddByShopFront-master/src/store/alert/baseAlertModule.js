export const baseAlertModule = {
    state() {
        return {
            alerts: [],
            counter: 0,
        }
    },
    getters: {
        alerts(state) {
            return state.alerts.slice().reverse();
        }
    },
    actions: {
        // eslint-disable-next-line no-unused-vars
        showAlert({commit, state}, alert) {
            // eslint-disable-next-line no-unused-vars
            const currentCounter = state.counter;
            commit('setAlert', alert);
            setTimeout(() => {
                commit("alertAppear", currentCounter);
            }, 200);
            setTimeout(() => {
                commit('alertDisappear', currentCounter);
            }, 4000);
            setTimeout(() => {
                commit('alertDelete', currentCounter)
            }, 6000);
        }
    },
    mutations: {
        setAlert(state, alert) {
            const object = {
                id: state.counter,
                value: alert,
                class: "",
            }
            state.alerts.push(object);
            console.log(state.alerts);
            state.counter++;
            // setTimeout(() => {
            //     console.log("worked");
            //     object.class = "left-give";
            // }, 1000);
        },
        alertAppear(state, counter) {
            const ob = state.alerts.find((el) => el.id === counter);
            ob.class = "left-give";
        },
        alertDisappear(state, counter) {
            const ob = state.alerts.find((el) => el.id === counter);
            console.log("remove");
            ob.class = "left-remove";
        },
        alertDelete(state, counter) {
            state.alerts = state.alerts.filter((el) => el.id !== counter);
        }
    }
}