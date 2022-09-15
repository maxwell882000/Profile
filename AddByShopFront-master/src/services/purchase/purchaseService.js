import methods from "@/services/api/methods";

class PurchaseService {
    async createPurchases(data) {
        const result = await methods.post("purchase/store/", data);

        return result.data.result;
    }
}

export default new PurchaseService();