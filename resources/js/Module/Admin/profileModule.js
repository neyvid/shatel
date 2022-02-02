import uploadBase64 from "../../Module/Common/uploadBase64";
import {ref} from "@vue/composition-api";
import router from "../../router/router";
import store from '../../store'


export default function profileModule() {
    const form = ref(null);
    const drawer = ref(true);
    const items = ref([
        {
            text: 'Dashboard',
            disabled: false,
            href: 'breadcrumbs_dashboard',
        },
        {
            text: 'Link 1',
            disabled: false,
            href: 'breadcrumbs_link_1',
        },
        {
            text: 'Link 2',
            disabled: true,
            href: 'breadcrumbs_link_2',
        },
    ]);
    const user = ref({});
    const avatar = ref(null);
    const editing = ref({
        name: false,
        lastname: false,
        mobile: false,
        email: false,
        password: false,
    });
    const old = ref({
        name: null,
        lastname: null,
        mobile: null,
        email: null,
        password: null,
    });

    //methods
    const getUser = () => {
        axios.get('/api/user').then(({data}) => {
            user.value = data;
        })
    };

    function uploadImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = (image) => {
            avatar.value = image.target.result;
            user.value.image_name =event.target.files[0].name;

        }

        reader.readAsDataURL(file);
    }

    function logout() {
        store.dispatch('logout').then(() => {
            router.push({name: 'home'});
        })
    }

    function cancel(data) {
        user.value[data] = old.value[data];
        editing.value[data] = false;
    }

    function changeEdit(data) {
        old.value[data] = user.value[data];
        editing.value[data] = !editing.value[data];
    }

    function update() {
        if (form.value.validate()) {
            for (const index in user.value) {
                editing.value[index] = true;
            }
            axios.patch('/api/admin/profile', user.value).then(() => {

            }
            )
        }

    }


    getUser();

    return {
        user, drawer, items, avatar, editing, old, logout, cancel, changeEdit, uploadImage, getUser, form, update
    }
}
