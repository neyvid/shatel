require('./bootstrap');

window.Vue = require('vue').default;
import Vue from "vue";
import Vuetify from "vuetify";
import VueRouter from "vue-router";

Vue.use(Vuetify);
Vue.use(VueRouter);
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const vuetify = new Vuetify({});
const router = new VueRouter({
    mode:"history",
    routes: [
        {path: '/login', component: require('./components/login.vue').default}

    ]
});


const app = new Vue({
    el: '#app',
    vuetify,
    router

});
