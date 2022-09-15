import commentService from "@/services/product/commentService";

export const commentModule = {
    namespaced: true, state() {
        return {
            comment: [// "id" => $this->id,
                // "name" => $this->user->avatar->name,
                // "avatar" => $this->user->avatar->avatar->getFilePath(),
                // "mark" => $this->product->mark()->where("user_id", $this->user_id)->first()->mark,
                // "created_at" => $this->created_at,
                // "message" => $this->message,
                // "num_likes" => $this->likes()->count(),
                // "num_dislikes" => $this->dislikes()->count()
            ], commentPagination: {
                current_page: 0, last_page: 1,
            },
            error: "",
            showSuccess: false,
        }
    }, getters: {
        showSuccess(state){
          return state.showSuccess;
        },
        error(state) {
            return state.error;
        }, comment(state) {
            return state.comment;
        }, isLastPage(state) {
            return state.commentPagination.current_page === state.commentPagination.last_page;
        }, nextPage(state) {
            return state.commentPagination.current_page + 1;
        }
    }, actions: {
        async getNewComments({commit, getters, rootGetters}) {
            commit("wait/START", 'new_comment', {root: true});
            let id = rootGetters["productModule/product"].id;
            try {
                let result = await commentService.getComments(id, getters.nextPage);
                commit('setComment', result);
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", 'new_comment', {root: true});
        }, async getComments({commit, rootGetters}) {
            commit("wait/START", 'comment', {root: true});
            let id = rootGetters["productModule/product"].id;
            try {
                let result = await commentService.getComments(id);
                commit('setComment', result);
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", 'comment', {root: true});
        }, async leftComment({commit, rootGetters}, data) {
            commit("wait/START", "left_comment", {root: true});
            let result = true;
            let id = rootGetters['productModule/product'].id;
            try {
                await commentService.leftComment(id, data);
                commit("setShowSuccess", true);
            } catch (e) {
                commit("setError", e);
            }
            commit("wait/END", "left_comment", {root: true});

            return result;
        }
    }, mutations: {
        setShowSuccess(state, result) {
          state.showSuccess = result;
        },
        setError(state, error) {
            state.error = error;
        }, setComment(state, comment) {
            state.comment.push(...comment.data);
            state.commentPagination = comment;
        }, clean(state) {
            state.comment = [];
            state.commentPagination = {
                current_page: 0, last_page: 1,
            }
        }
    }
}