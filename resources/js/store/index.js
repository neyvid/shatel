import Vue from 'vue';
import Vuex from 'vuex';
import {commit} from "lodash/seq";
import router from "../router/router";
import user from "./modules/user";
Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        user
    }
});
