import methods from "@/services/api/methods";

class FavouriteService {
    async getFavourite() {
        let result = await methods.get("favourite/");
        return result.data.result;
    }
}

export default new FavouriteService();