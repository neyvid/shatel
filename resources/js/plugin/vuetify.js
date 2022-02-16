import Vue from "vue";
import Vuetify from "vuetify";
import fa from "vuetify/lib/locale/fa"
Vue.use(Vuetify);

export default new Vuetify({
    rtl: true,
    lang: {
        locales: { fa },
        current: 'fa',
    },

});
