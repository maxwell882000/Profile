import methods from "@/services/api/methods";

class WayOfPaymentService {
    async getCredits(query) {
        console.log("purchase/wayOfPayment/?" + query);
        const result = await methods.get("purchase/wayOfPayment/?" + query);
        return result.data.result;
    }
}
export default new WayOfPaymentService();