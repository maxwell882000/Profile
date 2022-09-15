import authService from "@/services/auth/authService";
import codeService from "@/services/auth/codeService";
import tokenService from "@/services/auth/tokenService";
import userService from "@/services/user/userService";

export const authModule = {
    state() {
        return {
            token: tokenService.getToken(),
            loading: false,
            user: {
                name: "",
                phone: "",
                basket_counter: 0,
                favourite_counter: 0,
                // user_credit: true,
                // phone_verified
            },
        }
    },
    getters: {
        authToken: (state) => () => state.token,
        isAuthenticated(state) {
            return !!state.token;
        },
        isUserData(state) {
            return state.user.user_credit;
        },
        user(state) {
            return state.user;
        }
    },
    actions: {
        async getUser({commit, getters}) {
            if (getters.isAuthenticated && getters.user.name === "") {
                commit("wait/START", "user");
                let result = await authService.getUser();
                commit('setInitialUser', result);
                if (!result.phone_verified) {
                    commit("authWindow/setVerifyRegister");
                }
                commit("wait/END", "user");
            }
        },
        async changeAvatar({commit, getters}, avatar) {
            commit("wait/START", "avatar");
            try {
                console.log(avatar);
                const result = await userService.avatar(avatar);
                console.log(result);
                getters.user.avatar = result.avatar;
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "avatar");
        },
        async changeUserData({commit, getters}, {phone, name}) {
            const request = {
                name: name,
                phone: phone
            }
            commit("wait/START", "user_data_loaded");
            try {
                await userService.userData(request);
                if (getters.user.phone !== phone)
                    commit("authWindow/setVerifyRegister");
                getters.user.phone = phone;
                getters.user.name = phone;
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "user_data_loaded");
        },
        async logout({commit}) {
            await authService.logout();
            commit("logoutUser");
            window.location.reload();
        },
        async login({commit, dispatch}, request) {
            commit("wait/START", "login");
            commit("authWindow/cleanStatus");
            try {
                let token = await authService.login(request);
                commit('setToken', token.token);
                commit("authWindow/close");
                dispatch('getUser');
                // window.location.reload();
            } catch (e) {
                console.log(e.stack);
                commit("authWindow/setError", e);
            }
            commit("wait/END", "login");
        },
        // eslint-disable-next-line no-unused-vars
        async register({commit}, request) {
            commit("wait/START", "register");
            commit("authWindow/cleanStatus");
            try {
                let result = await authService.register(request);
                result.phone = request.phone;
                result.name = request.name;
                commit("setUser", result);
                commit('setToken', result.token);
                commit("authWindow/setVerifyRegister");
            } catch (e) {

                commit('authWindow/setError', e);
            } finally {
                commit("wait/END", "register");
            }
        },
        async sendCode({commit}) {
            commit("wait/START", "code");
            try {
                await codeService.sendCode();
                commit("authWindow/setSuccess", "Код успешно был отправлен");
            } catch (e) {
                commit("authWindow/setError", "Не удалось отправить код");
                console.log(e);
            } finally {
                commit("wait/END", "code");
            }
        },
        async verifyCode({commit}, code) {
            commit("wait/START", "code");
            try {
                await codeService.verifyCode(code);
            } catch (e) {
                commit('authWindow/setError', e);
            } finally {
                commit("wait/END", "code");
            }
        },
        logoutAndClose({commit, dispatch}) {
            commit("authWindow/close");
            dispatch("logout");
        },
        async phoneCodeVerify({commit}, code) {
            commit("wait/START", "code");
            try {
                await codeService.phoneCodeVerify(code);
                commit("authWindow/close");
            } catch (e) {
                console.log(e);
                commit('authWindow/setError', e);
            } finally {
                commit("wait/END", "code");
            }
        }
    },
    mutations: {
        setLoading(state, value) {
            state.loading = value;
        },
        setInitialUser(state, user) {
            state.user = user;
            console.log(state.user);
        },
        setUserData(state) {
            state.user.user_credit = true;
        },
        setUser(state, user) {
            state.user.name = user.name;
            state.user.phone = user.phone;
        },
        logoutUser(state) {
            state.user = {name: "", phone: ""};
            state.token = "";
            tokenService.removeToken();
        },
        setToken(state, token) {
            state.token = token;
            tokenService.setToken({token: token})
        },
        setBasketCounter(state, number) {
            state.user.basket_counter -= number;
        },
        decreaseBasketCounter(state) {
            state.user.basket_counter--;
        },
        increaseBasketCounter(state) {
            state.user.basket_counter++;
        },
        decreaseFavouriteCounter(state) {
            state.user.favourite_counter--;
        },
        increaseFavouriteCounter(state) {
            state.user.favourite_counter++;
        }
    }
}