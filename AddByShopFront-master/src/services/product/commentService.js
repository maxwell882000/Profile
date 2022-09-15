import methods from "@/services/api/methods";

class CommentService {
    async getComments(id, page = 1) {
        let result = await methods.get(`product/${id}/comment/?page=${page}`)
        return result.data.result;
    }

    async leftComment(id, data) {
        let result = await methods.post(`product/${id}/comment/`, data);
        return result.data.result;
    }
}

export default new CommentService();