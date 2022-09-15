import methods from "@/services/api/methods";

class CategoryService {
    async getCategory(slug) {
        let result = await methods.get(`category/${slug}/`);
        return result.data.result;
    }
    async getProductOfCategoryInSub(slug){
        let result = await  methods.get(`product/category/${slug}/getProduct/`);
        return result.data.result;
    }
}

export default new CategoryService();