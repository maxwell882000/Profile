import methods from "@/services/api/methods";

class CodeService {
    async sendCode() {
        await methods.get("sendCode/");
    }

    async verifyCode(code) {
        return await methods.post("verifyCode/", code);
    }

    async phoneCodeVerify(code) {
        return await methods.post('phoneCodeVerify/', code);
    }

}

export default new CodeService();