import questionService from "@/services/user/questionService";

export const questionModule = {
    namespaced: true,
    state() {
        return {
            questions: []
        }
    },
    getters: {
        questions: (state) => state.questions
    },
    actions: {
        async getQuestions({commit}) {
            commit("wait/START", "question_loaded", {root: true});
            try {
                const result = await questionService.getQuestions();
                commit("setQuestions", result.question);
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "question_loaded", {root: true});
        }
    },
    mutations: {
        setQuestions(state, questions) {
            state.questions = questions;
        }
    }
}