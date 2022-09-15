import methods from "@/services/api/methods";

class PolicyService {
    async policy() {
        const result = await methods.get('policies/');
        return result.data.result;
    }
}

export default new PolicyService();