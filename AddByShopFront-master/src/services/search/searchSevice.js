import methods from "@/services/api/methods";

class SearchService {
    async getSearchHelper(query) {
        let result = await methods.get("search/?search=" + query);
        return result.data.result;
    }
    async getSearchFilter(query) {
        let result = await  methods.get("search/products/?search=" + query);
        return result.data.result;
    }
}
export default new SearchService();