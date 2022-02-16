require('./bootstrap');

window.Vue = require('vue').default;
import vuetify from './plugin/vuetify';
import router from './router/router';
import VueCompositionAPI from '@vue/composition-api';
import store from './store';


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.use(VueCompositionAPI)

const app = new Vue({
    el: '#app',
    vuetify,
    router,
    store,



    created() {

    }
});
