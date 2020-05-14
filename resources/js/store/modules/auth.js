import axios from 'axios'
import Cookies from "js-cookie";
import * as types from "../mutations_types";

const state = {
    user: null,
    token: Cookies.get("token"),
    loading:false,
    auth_err: null,
    isLogged:false

};
const getters = {
    user: state => state.user,
    token: state => state.token,
    check: state => state.user != null,
    loading:state=>state.loading,
    auth_err: state => state.auth_err,
    isLogged:state=>state.isLogged

};
const mutations = {
    [types.LOGIN](state)
    {
        state.loading=true;
    },
    [types.LOGIN_SUCCESS](state, { token, rembmer }) {
        state.loading = false;
        state.auth_err = null;
        state.token = token;
        state.isLogged = true;
        Cookies.set("token", token, { expires: rembmer ? 365 : null });
    },
    [types.LOGIN_FAILED](state, { error }) {
        state.loading = false;
        state.auth_err = error;
        state.isLogged = false;
    },
    [types.FETCH_USER_SUCCESS](state, { user }) {
        state.user = user;
        state.isLogged = true;
    },
    [types.FETCH_USER_FAILURE](state) {
        state.token = null;
        Cookies.remove("token");
        state.isLogged = false;
    },
    [types.LOGOUT](state) {
        state.user = null;
        state.token = null;
        Cookies.remove("token");
        state.isLogged = false;
    }
};
const actions = {
    login({commit}) {
        commit(types.LOGIN);
    },
    async fetchUser({commit}) {

        try {
            const { data } = await axios.get('/api/v1/auth/user');
            commit(types.FETCH_USER_SUCCESS, {user: data.data})
        } catch (error) {
            console.log(error)
            commit(types.FETCH_USER_FAILURE)
        }
    },
};
export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
