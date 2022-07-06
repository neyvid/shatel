require('./bootstrap');

window.Vue = require('vue').default;
import vuetify from './plugin/vuetify';
import router from './router/router';
import VueCompositionAPI from '@vue/composition-api';
import store from './store';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
import CKEditor from '@ckeditor/ckeditor5-vue2';

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.use(VueCompositionAPI);


Vue.use(VuePersianDatetimePicker, {
    name: 'date-picker',
    props: {
        format: 'jYYYY-jMM-jDD',
        displayFormat: 'jYYYY-jMM-jDD', // if you need jalali dates
        color: '#00acc1',

        inputClass: 'my-custom-date-picker',
        autoSubmit: true,
        clearable: true,
    }
});
Vue.use( CKEditor );
const app = new Vue({
    el: '#app',
    vuetify,
    router,
    store,


    created() {

    }
});
