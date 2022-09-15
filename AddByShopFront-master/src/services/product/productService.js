import methods from "@/services/api/methods";

class ProductService {
    async getProduct(id) {
        let result = await methods.get(`product/${id}/`);
        return result.data.result;
    }

    async getProducts(query) {
        console.log(query);
        let result = await methods.get('filter/product/?' + query);
        return result.data.result;
    }
}

export default new ProductService();