import methods from "@/services/api/methods";

class FavouriteService {
    async favourite(id) {
        console.log(id);
        let result = await methods.get(`action/favourite/${id}/`);
        return result.data.result;
    }
}

export default new FavouriteService();