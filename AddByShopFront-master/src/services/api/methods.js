import api from "@/services/api/api";
import errorService from "@/services/error/errorService";

// check on error from the results
class Methods {
    async put(path, data) {
        try {
            return await api.put(path, data);
        } catch (e) {
            errorService.sendError(path, data, e);
        }
    }

    async get(path) {
        try {
            return await api.get(path);
        } catch (e) {
            errorService.sendError(path, "", e);
        }
    }

    async post(path, data) {
        try {
            return await api.post(path, data);
        } catch (e) {
            console.log("POST ERRRRORS");
            errorService.sendError(path, data, e);
        }
    }

    async uploadFile(path , formData) {
        try {
            return await api.post(path,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            );
        } catch (e) {
            errorService.sendError('uploadFile', formData, e);
        }
    }


    async delete(path, data) {
        try {
            return await api.delete(path, data);
        } catch (e) {
            errorService.sendError(path, data, e);
        }
    }
}

export default new Methods();