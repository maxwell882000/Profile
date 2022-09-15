import methods from "@/services/api/methods";

class DeliveryService {
    async mapSearchCity(search) {
        let result = await methods.get("purchase/search/city/?cityName=" + search);
        return result.data.result;
    }

    async mapSearchShop({longitude, latitude}) {
        let result = await methods.get(`purchase/search/shop/location/?latitude=${latitude}&longitude=${longitude}`);
        return result.data.result;
    }

    async getShops(query) {
        let result = await methods.get('purchase/search/shop/?' + query);
        return result.data.result;
    }

    async calculateDeliveryPrice(data) {
        let result = await methods.post("purchase/delivery/calculate/price/", data);
        return result.data.result;
    }
}

export default new DeliveryService();