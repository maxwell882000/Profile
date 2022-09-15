import axiosInstance from "./api";


const setup = (getToken) => {
    axiosInstance.interceptors.request.use(
        (config) => {
            const token = getToken;
            if (token) {
                config.headers["Authorization"] = 'Bearer ' + token;
                console.log(config);
            } else {
                delete config.headers['Authorization'];
            }
            return config;
        },
        (error) => {
            return Promise.reject(error);
        }
    );
};

export default setup;