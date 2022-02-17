import router from "../../router/router";
import {ref} from "@vue/composition-api";
import store from '../../store'

export function loginModule() {
    const loginForm = ref(null);
    const loading = ref(false);
    const colors = ref([
        'indigo',
        'warning',
        'pink darken-2',
        'red lighten-1',
        'deep-purple accent-4',
    ]);
    const slides = ref([
        'First',
        'Second',
        'Third',
        'Fourth',
        'Fifth',
    ]);
    const LoginInfo = ref({
        username: null,
        password: null,
        remember: false
    });

    const errors = ref({
        username: null,
        password: null,
    });


    function login() {

        if (loginForm.value.validate()) {
            loading.value = true;
            store.dispatch('login', LoginInfo.value)
                .then(() => {
                    router.push({name:'home'})
                }).catch((error) => {

                errors.value.username = error.response.data.errors.username != undefined ? error.response.data.errors.username[0] : '';
                errors.value.password = error.response.data.errors.password != undefined ? error.response.data.errors.password[0] : '';


            }).finally(() => {
                loading.value = false;
            })
        }


    }

    return {
        loginForm, loading, colors, slides, LoginInfo, errors, login
    }
}
