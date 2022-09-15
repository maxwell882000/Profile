import methods from "@/services/api/methods";

class PlasticCardService {
    async getCards() {
        const result = await methods.get("plastic-card/");
        return result.data.result;
    }

    //card_number
    //expiry mm/yy
    async getTransactionForPlastic(data) {
        console.log(data);
        const result = await methods.post("plastic-card/getTransactionForPlastic/", data);
        return result.data.result;
    }

    //transaction_id
    async dialCode(data) {
        const result = await methods.post("plastic-card/dialCode/", data);
        return result.data.result;
    }

    // transaction_id
    // code
    // card_number
    async insertPlasticCard(data) {
        const result = await methods.post("plastic-card/insertCard/", data);
        return result.data.result;
    }

    async revokeCard(plastic_id) {
        const result = await methods.delete(`plastic-card/${plastic_id}/`);
        return result.data.result;
    }
}

export default new PlasticCardService();