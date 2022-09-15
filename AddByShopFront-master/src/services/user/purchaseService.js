import methods from "@/services/api/methods";

class PurchaseService {
    async getPurchases() {
        const result = await methods.get("purchase/");
        return result.data.result;
    }

    async cancelPayment(payment_id, data) {
        console.log()
        console.log(data);
        const result = await methods.post(`purchase/cancel/payment/${payment_id}/`, data);
        return result.data.result;
    }

    async cancelInstallment(installment_id, reason) {
        const result = await methods.post(`purchase/cancel/installment/${installment_id}/`, reason);
        return result.data.result;
    }

    async payForMonth({month_paid_id, plastic}) {
        const result = await methods.post(`purchase/pay/installment/${month_paid_id}/`, plastic);
        return result.data.result;
    }
}

export default new PurchaseService();