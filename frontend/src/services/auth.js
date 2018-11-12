export default function (Vue) {
    Vue.auth = {
        setToken(token, refreshToken) {
            localStorage.setItem('user_token', token)
            // localStorage.setItem('refresh_token', refreshToken)
        },
        getToken() {
            let token = localStorage.getItem('user_token')
            // let expiration = localStorage.getItem('refresh_token')

            // if (!token || !expiration) {
            if(!token){
                return null
            }
            // if (Date.now() > parseInt(expiration)) {
            //     this.destroyToken()
            //     return null
            // } 
            else { return token }
        },
        destroyToken() {
            localStorage.removeItem('user_token')
            // localStorage.removeItem('refresh_token')
        },
        isAuthenticated() {
            if (this.getToken()) {
                return true
            } else { return false }
        },

        setUser(obj){
            const user = JSON.stringify(obj);
            localStorage.setItem('user', user);
        },
        
        getUser(){
            const user = JSON.parse(localStorage.getItem('user'));
            return user;
        }

    }

    Object.defineProperties(Vue.prototype, {
        $auth: {
            get() {
                return Vue.auth
            }
        }
    })
}
