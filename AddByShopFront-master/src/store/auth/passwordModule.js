import passwordService from "@/services/auth/passwordService";
import codeService from "@/services/auth/codeService";

export const passwordModule = {
    namespaced: true,
    state() {
        return {
            passwordToken: "",
            phone: "",
            errorPassword: "",
            successPassword: "",
            passwordChange: {
                password: "",
                password_new: "",
                password_rep: "",
                password_new_error: ""
            }
        }
    },
    getters: {
        error: (state) => state.errorPassword,
        success: (state) => state.successPassword,
        passToken: (state) => () => state.passwordToken,
        passwordChange: (state) => state.passwordChange
    },
    actions: {
        async changePassword({commit, getters}) {
            commit("wait/START", "password_loaded", {root: true});
            commit('setErrorPassword', "");
            try {
                await passwordService.changePassword(getters.passwordChange);
                commit('setSuccessPassword', "Пароль успешно обновлен");
                commit('cleanPassword');
            } catch (e) {
                console.log(e);
                commit("setErrorPassword", e);
            }
            commit("wait/END", "password_loaded", {root: true});
        },
        async issueToken({commit}, phone) {
            commit("wait/START", "issue_password", {root: true});
            try {
                let token = await passwordService.issueTokenForPassword(phone);
                commit("setPasswordToken", token);
                commit("setPhone", phone.phone);
                commit("authWindow/setVerifyForget", "", {root: true});
            } catch (e) {
                commit('authWindow/setError', e, {root: true});
            }
            commit("wait/END", "issue_password", {root: true});
        },
        async passwordVerify({commit}, code) {
            commit("wait/START", "code", {root: true});
            try {
                await codeService.verifyCode(code);
                commit("authWindow/setNewPassword", "", {root: true});
            } catch (e) {
                commit('authWindow/setError', "Код не верен", {root: true});
            } finally {
                commit("wait/END", "code", {root: true});
            }
        },
        async newPassword({commit}, password) {
            commit("wait/START", "new_password", {root: true});
            try {
                await passwordService.forgetPassword(password);
                commit('finishPassword');
                commit('authWindow/setLogin', "", {root: true});
                commit("authWindow/setSuccess", "Пароль успешно изменён", {root: true});
            } catch (e) {
                commit('authWindow/setError', e, {root: true});
            }
            commit("wait/END", "new_password", {root: true});
        }
    },
    mutations: {
        finishPassword(state) {
            state.passwordToken = "";
            state.phone = "";
        },
        setSuccessPassword(state, success) {
            state.successPassword = success;
        },
        setErrorPassword(state, error) {
            state.errorPassword = error;
        },
        setPasswordToken(state, token) {
            state.passwordToken = token.token;
        },
        cleanPassword(state) {
            state.passwordChange = {
                password: "",
                password_new: "",
                password_rep: "",
                password_new_error: ""
            };
        },
        setPhone(state, phone) {
            state.phone = phone;
        }
    }
}