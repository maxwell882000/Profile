import methods from "@/services/api/methods";

class ShopService {
    async getShop(slug) {
        let result = await methods.get(`shop/${slug}/`);
        return result.data.result;
    }

    async getAllShop() {
        const result = await methods.get("shop/");
        return result.data.result;
    }

}

export default new ShopService();