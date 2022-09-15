import methods from "@/services/api/methods";
import {isMobile} from "@/constants/responsive/responsive";

class MainService {
    async main() {
        let result = await methods.get(`home/?isMobile=${isMobile}`);
        return result.data.result;
    }

    async lenta() {
        let result = await methods.get("home/lenta/");
        return result.data.result;
    }

    async products() {
        let result = await methods.get("home/products/");
        return result.data.result;
    }

    // already given in main
    async popular_category() {
        let result = await methods.get("home/category/");
        return result.data.result;
    }

    async category_in_home() {
        const result = await methods.get("home/category-in-home/");
        return result.data.result;
    }
}

export default new MainService();