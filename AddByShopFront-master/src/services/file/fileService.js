import methods from "@/services/api/methods";

class FileService {
    async manyFiles(files) {
        const form = new FormData();
        form.append("prefix", files.prefix);
        form.append("file", files.file);
        let result = await methods.post("file/many/", form);
        return result.data.result;
    }

    async singleFile(file) {
        const form = new FormData();
        form.append("prefix", file.prefix);
        form.append("file", file.file);
        let result = await methods.uploadFile("file/", form);
        console.log(result);
        return result.data.result;
    }
}

export default new FileService();