import cookies from 'vue-cookies'

class TokenService {
    /**
     * @returns {string}
     */
    getToken() {
        const token = cookies.get('token');
        console.log("GET TOKEN ");
        console.log(token);
        if (token) {
            return token;
        } else if (token && token.token) {
            return token.token;
        } else {
            console.error('[TokenService]: No token found!');
            return "";
        }
    }

    setTokenInHeader() {

    }

    /**
     * @param { obj<{token: string, expiration_date: number | string, token_type: string}> } param0
     */
    setToken({token, expiration_date}) {
        // if there is any token_type, sets it, otherwise sets it to Bearer
        // if expiration date is received, sets is as a cookie, otherwise sets for 1 year
        cookies.set('token', token, expiration_date || 365 * 24 * 3600);
        // setting default header for all requests
    }

    removeToken() {
        cookies.set('token', "", 0);
    }
}

export default new TokenService();