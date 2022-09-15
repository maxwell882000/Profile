import methods from "@/services/api/methods";

class UserDataService {
    async createUserData(data) {
        let result = await methods.post("verification/userData/", data);
        console.log(result);
        return result.data.result;
    }

    async createSurety(data, takenCredit) {
        const result = await methods.post(`verification/suretyData/${takenCredit}/`, data);
        return result.data.result;
    }
}

export default new UserDataService();