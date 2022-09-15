import methods from "@/services/api/methods";

class PasswordService {
    async issueTokenForPassword({phone}) {
        let form = new FormData();
        form.append("phone", phone);
        let result = await methods.post("issueTokenForPassword/", form);
        return result.data.result;
    }

    async forgetPassword(password) {
        return await methods.post("forgetPassword/", password);
    }

    async changePassword(data) {
        const result = await methods.post("changePassword/", data);
        return result.data.result;
    }
}

export default new PasswordService();