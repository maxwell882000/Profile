import fileService from "@/services/file/fileService";
import validation from "@/mixins/validation";
import verificationConstant from "@/constants/verification/verificationConstant";
import userDataService from "@/services/verification/userDataService";

export const verificationModule = {
    namespaced: true,
    state() {
        const state = {
            takenCreditID: null,
            successToBasket: false,
            successToProfile: false,
            userData: {
                // "avatar->name" => "asd"
                // "phone" => "asfasf"
                // "userCreditData->additional_phone" => "asfsaf"
                // "password" => "safa"
                // "userCreditData->crucialData->firstname" => "qwr"
                // "userCreditData->crucialData->lastname" => "123123"
                // "userCreditData->crucialData->father_name" => "123123"
                // "userCreditData->sex" => "1"
                // "userCreditData->crucialData->series" => "12123"
                // "userCreditData->crucialData->date_of_birth" => "2022-04-06"
                // "userCreditData->crucialData->pnfl" => "213123"
                // "file->id_file->userCreditData->crucialData->passport" => "173"
                // "file->class_name->userCreditData->crucialData->passport" => "App\Domain\File\Entities\FileTemp"
                // "file->id_file->userCreditData->crucialData->passport_reverse" => "174"
                // "file->class_name->userCreditData->crucialData->passport_reverse" => "App\Domain\File\Entities\FileTemp"
                // "file->id_file->userCreditData->crucialData->user_passport" => "175"
                // "file->class_name->userCreditData->crucialData->user_passport" => "App\Domain\File\Entities\FileTemp"
            },
            errorData: {}
        }
        state[verificationConstant.PASSPORT] = {};
        state[verificationConstant.PASSPORT_REVERSE] = {};
        state[verificationConstant.USER_PASSPORT] = {};
        return state;
    },
    actions: {
        async fileUpload({commit}, {prefix, file, img}) {
            commit("wait/START", "file_loaded", {root: true});
            try {
                let result = await fileService.singleFile({prefix: prefix, file: file});
                commit(prefix, {id_server: result, img: img});
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "file_loaded", {root: true});
        },
        async suretySubmitData({commit, getters}) {
            commit("wait/START", "complete_validation", {root: true});
            try {
                await userDataService.createSurety(getters.formSubmit, getters.takenCreditID);
                commit('setSuccessToProfile');
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "complete_validation", {root: true});
        },
        async submitData({commit, getters}) {
            commit("wait/START", "complete_validation", {root: true});
            try {
                await userDataService.createUserData(getters.formSubmit); // get some unnecessary result
                // if there is no error, so go to the next
                commit("setUserData", null, {root: true});
                commit('setSuccessToBasket');
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "complete_validation", {root: true});
        },
        validation({getters}) {
            const type = verificationConstant;
            validation(getters.userData, getters.errorData, type.FIRST_NAME, "Имя");
            validation(getters.userData, getters.errorData, type.LAST_NAME, "Фамилия");
            validation(getters.userData, getters.errorData, type.FATHER_NAME, "Отчевство");
            validation(getters.userData, getters.errorData, type.ADDITIONAL_PHONE, "Доп. номер телефона");
            validation(getters.userData, getters.errorData, type.SERIES, "Серия пасспорта");
            validation(getters.userData, getters.errorData, type.DATE_OF_BIRTH, "Дата рождения");
            validation(getters.userData, getters.errorData, type.SEX, "Пол");
            validation(getters.userData, getters.errorData, type.PNFL, "ПНФЛ");
        }
    },
    getters: {
        [verificationConstant.USER_PASSPORT](state) {
            return state[verificationConstant.USER_PASSPORT];
        },
        [verificationConstant.PASSPORT_REVERSE](state) {
            return state[verificationConstant.PASSPORT_REVERSE];
        },
        [verificationConstant.PASSPORT](state) {
            return state[verificationConstant.PASSPORT];
        },
        takenCreditID(state) {
            return state.takenCreditID;
        },
        formSubmit(state) {
            return {
                ...state.userData,
                ...state[verificationConstant.PASSPORT],
                ...state[verificationConstant.USER_PASSPORT],
                ...state[verificationConstant.PASSPORT_REVERSE]
            };
        },
        userData(state) {
            return state.userData;
        },
        successToProfile(state) {
            return state.successToProfile;
        },
        successToBasket(state) {
            return state.successToBasket;
        },
        errorData(state) {
            return state.errorData;
        }
    },
    mutations: {
        setSuccessToBasket(state) {
            state.successToBasket = true;
        },
        setSuccessToProfile(state) {
            state.successToProfile = true;
        },
        clean(state) {
            state[verificationConstant.PASSPORT] = {};
            state[verificationConstant.PASSPORT_REVERSE] = {};
            state[verificationConstant.USER_PASSPORT] = {};
            state.successToBasket = false;
            state.takenCreditID = null;
            state.successToProfile = false;
            state.userData = {
                // "avatar->name" => "asd"
                // "phone" => "asfasf"
                // "userCreditData->additional_phone" => "asfsaf"
                // "password" => "safa"
                // "userCreditData->crucialData->firstname" => "qwr"
                // "userCreditData->crucialData->lastname" => "123123"
                // "userCreditData->crucialData->father_name" => "123123"
                // "userCreditData->sex" => "1"
                // "userCreditData->crucialData->series" => "12123"
                // "userCreditData->crucialData->date_of_birth" => "2022-04-06"
                // "userCreditData->crucialData->pnfl" => "213123"
                // "file->id_file->userCreditData->crucialData->passport" => "173"
                // "file->class_name->userCreditData->crucialData->passport" => "App\Domain\File\Entities\FileTemp"
                // "file->id_file->userCreditData->crucialData->passport_reverse" => "174"
                // "file->class_name->userCreditData->crucialData->passport_reverse" => "App\Domain\File\Entities\FileTemp"
                // "file->id_file->userCreditData->crucialData->user_passport" => "175"
                // "file->class_name->userCreditData->crucialData->user_passport" => "App\Domain\File\Entities\FileTemp"
            };
            state.errorData = {}
        },
        [verificationConstant.USER_PASSPORT](state, {id_server, img}) {
            state[verificationConstant.USER_PASSPORT] = id_server;
            state[verificationConstant.USER_PASSPORT].image = img
        },
        [verificationConstant.PASSPORT_REVERSE](state, {id_server, img}) {
            state[verificationConstant.PASSPORT_REVERSE] = id_server;
            state[verificationConstant.PASSPORT_REVERSE].image = img

        },
        [verificationConstant.PASSPORT](state, {id_server, img}) {
            state[verificationConstant.PASSPORT] = id_server;
            state[verificationConstant.PASSPORT].image = img
        },
        setTakenCreditID(state, id) {
            state.takenCreditID = id;
        },
        setUserData(state, user) {
            state.userData = user;
        }
    }
}