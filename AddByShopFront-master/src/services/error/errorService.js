import store from "../../store/index";

class ErrorService {
    // eslint-disable-next-line no-unused-vars
    constructor() {
        this.error = null;
        this.method = "";
        this.input = null;
    }

    init(method, input, error) {
        this.method = method;
        this.input = input;
        this.error = error;
    }

    sendToServer() {
        if (this.error.response.status === 400) {
            //  send logs to server
        }
    }

    middleware() {
        if (this.error.response.status === 401) {
            store.commit("logoutUser");
            store.commit("authWindow/setLogin");
        }
        console.log("ERROR");
        console.log(this.error.response);
        if (this.error.response.data.code && this.error.response.status === 403) {
            console.log("WORKED OUT USER DATA");
            store.commit("authWindow/setVerifyRegister");
        }
    }

    logError() {
        console.log("\n\n\n\n========================ERROR LOG==================== \n");
        console.log(this.error.response);
        console.log(this.input);
        console.log(this.error.response.data.errors);
        console.log("=====================FINISH ERROR LOG================ \n\n\n\n")
    }

    sendError(method, input, error) {
        this.init(method, input, error);
        this.sendToServer();
        this.middleware();
        this.logError();
        throw  error.response.data.errors;
    }
}

export default new ErrorService();