// import {disableScrollBar, enableScrollBar} from "@/utils/bodyScrollBar";

export const navbarModule = {
    state() {
        return {
            categoriesOpened: false,
            showCategoryLine: true,
        }
    },
    getters: {
        categoriesOpened(state) {
            return state.categoriesOpened;
        },
        showCategoryLine(state) {
            return state.showCategoryLine;
        }
    },
    mutations: {
        closeCategoryOpened(state) {
            state.categoriesOpened = false;
        },
        hideCategoryLine(state) {
            state.showCategoryLine = false
        },
        openCategoryLine(state) {
            state.showCategoryLine = true;
        },
        toggleCategoryOpened(state) {
            state.categoriesOpened = !state.categoriesOpened;
            // window.scroll(0, 0);
            // if (state.categoriesOpened) {
            //     disableScrollBar();
            // } else {
            //     enableScrollBar();
            // }
        }
    }
}