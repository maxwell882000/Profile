import methods from "@/services/api/methods";

class UserService {
    async avatar(data) {
        const form = new FormData();
        form.append('avatar', data);
        const result = await methods.uploadFile("avatar/", form);
        return result.data.result;
    }

    async userData(data) {
        const result = await methods.put("userData/", data);
        return result.data.result;
    }
}

export default new UserService();