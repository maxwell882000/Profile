import langService from "@/services/general/langService";

export const langModule = {
    state() {
        return {
            lang: langService.getLang()
        }
    },
    getters: {
        language: (state) => () => state.lang
    },
    mutations: {
        setLang(state, lang) {
            state.lang = lang;
            langService.setLang(lang);
            window.location.reload();
        }
    }
}