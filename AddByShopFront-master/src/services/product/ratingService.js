import methods from "@/services/api/methods";

class RatingService {
    async rate(id) {
        let result = await methods.get(`product/${id}/rate/`);
        return result.data.result;
    }
}
export default new RatingService();