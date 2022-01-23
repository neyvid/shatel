export default {
    state: {
        user: window.user,
        isLoggedIn: !!window.user,

    },
    getters: {},
    mutations: {
        LOGOUT(state) {
            state.isLoggedIn = false;
            state.user = '';
        },
        LOGIN(state, payload) {
            state.isLoggedIn = true;
            state.user = payload;
            state.user.isVerified = payload.email_verified_at == null ? 1 : 2;
            state.user.isMobileVerified = payload.mobile_verified_at == null ? 1 : 2;
        },
        REGISTER(state, payload) {
            state.isLoggedIn = true;
            state.user = payload;
            state.user.isVerified = 1;
            state.user.isMobileVerified = 1;
        },
        MOBILE_VERIFY(state, payload) {
            //Security check (tamae etelaat user ersal mishe dar khate payin)
            state.user.email = '';
            state.user.isMobileVerified = payload.status ? 2 : 1;
            state.user.isVerified = 1;

        }


    },
    actions: {
        logout({commit}) {
            axios.post('/logout').then(() => {
                commit('LOGOUT');
            })
        },
        login({commit}, LoginInfo) {
            return axios.post('/login', LoginInfo)
                .then((response) => {
                    commit('LOGIN', response.data.data)

                })

        },
        register({commit}, RegisterInfo) {
            return axios.post('/register', RegisterInfo)
                .then((response) => {
                    commit('REGISTER', response.data.data);
                    return ([response.data.authType, response.data.data]);
                })
        },
        mobileVerify({commit}, mobileVerifyCode) {
            return axios.post('/mobile/verify/' + mobileVerifyCode).then((response) => {
                commit('MOBILE_VERIFY', response.data);
                return (response);
            })
        }
    }
}
