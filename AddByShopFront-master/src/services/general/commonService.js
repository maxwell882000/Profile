import methods from "@/services/api/methods";

class CommonService {
    async headers() {
        let result = await methods.get("home/header/");
        return result.data.result.header;
    }
}

export default new CommonService();