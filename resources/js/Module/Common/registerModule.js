import {ref} from "@vue/composition-api";
import router from "../../router/router";
import store from '../../store'

export function registerModule() {
    const registerFormData = ref(null);
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
    const registerFormInfo = ref({
        'username': null,
        'password': null
    });
    const errors = ref({
        'username': null,
        'password': null
    });


    function register() {
        if (registerFormData.value.validate()) {
            loading.value = true;
            store.dispatch('register', registerFormInfo.value)
                .then((response) => {
                    (response[0] == 'mobile') ? router.push('/verify-mobile') : router.push('/verify-email');
                }).catch((error) => {
                errors.value.username = error.response.data.errors.username != undefined ? error.response.data.errors.username[0] : '';
                errors.value.password = error.response.data.errors.password != undefined ? error.response.data.errors.password[0] : '';
            }).finally(() => {
                loading.value = false
            })

        }
    }

    return {
        registerFormInfo, registerFormData, loading, colors, slides, errors, register
    }
}
