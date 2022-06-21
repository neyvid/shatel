import {ref} from "@vue/composition-api";
import {required} from "../../rules/frontRules";
import store from "../../store";
import router from "../../router/router";


export default function userProfile() {
    const isClickInVerifyMobile = ref(false);
    const isClickInVerifyEmail = ref(false);
    const isLoading = ref(false);
    const isEmailVerifyLoading = ref(false);
    const userInfoForm = ref(null);
    const user = ref(null);
    const disabled = ref(true);
    const isEmailExist = ref(false);
    const isMobileExist = ref(false);
    const form_data = ref({
        name: null,
        lastname: null,
        email: null,
        mobile: null,
        password: null
    });
    const old_form_data = ref({
        name: null,
        lastname: null,
        email: null,
        mobile: null,
        password: null
    });
    const errors = ref({
        email: null,
        mobile: null,
    });
    const verifyMobileCode = ref(null);
    const isClick = ref(false);

    function getUser() {
        axios.get('/api/user').then(({data}) => {

            user.value = data;
            isEmailExist.value = !!user.value.email;
            isMobileExist.value = !!user.value.mobile;

        })
    }

    function startEdit(user) {
        disabled.value = false;
        for (const index in user) {
            old_form_data.value[index] = user[index];
        }
    }

    function cancelEdit() {
        for (const index in this.user) {
            user.value[index] = old_form_data.value[index];
        }
        disabled.value = true;


    }

    function userUpdate() {
        if (userInfoForm.value.validate()) {

            axios.patch('/api/user/update', user.value).then((response) => {
                disabled.value = true;
                user.value = response.data;
                isMobileExist.value=true;
                response.data.mobile_verified_at === null ? store.state.user.user.isMobileVerified = 1 : '';
                response.data.email_verified_at === null ? store.state.user.user.isVerified = 1 : '';
            }).catch((error) => {
                errors.value.email = error.response.data.errors.email != undefined ? error.response.data.errors.email[0] : '';
                errors.value.mobile = error.response.data.errors.mobile != undefined ? error.response.data.errors.mobile[0] : '';

            });
        }

    }

    function mobileConfirmation() {
        isLoading.value = true;
        axios.post('/mobileVerify/resend').then((responsse) => {
            isClickInVerifyMobile.value = true;
            isLoading.value = false;
        }).catch(() => {

        })
    }
    function emailConfirmation() {
        isEmailVerifyLoading.value = true;
        axios.post('/email/resend').then((responsse) => {
            isClickInVerifyEmail.value = true;
            isEmailVerifyLoading.value = false;
        }).catch(() => {

        })
    }

    function verifyMobile() {
        isClick.value = true;
        axios.post('/mobile/verify/' + verifyMobileCode.value).then((response) => {
            isClickInVerifyMobile.value = false;
            if (response.data.status) {
                store.state.user.user.isMobileVerified = 2;
                alert('شماره شما با موفقیت تایید گردید.');
            } else {
                alert('مشکلی پیش آمده است لطفا مجددا تلاش نمایید.')
            }
        })
    }

    function uploadAvatar(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = (image) => {
            //Name of Image
            user.value.image_name = event.target.files[0].name;
            // BASE64 Imgae result (slef
            user.value.image_src = image.target.result;
        };
        reader.readAsDataURL(file);
    }

    getUser();
    return {
        required,
        user,
        isClick,
        disabled,
        isEmailExist,
        isMobileExist,
        form_data,
        old_form_data,
        isLoading,
        isEmailVerifyLoading,
        verifyMobileCode,
        verifyMobile,
        errors,
        userInfoForm,
        startEdit,
        cancelEdit,
        uploadAvatar,
        userUpdate,
        getUser,
        mobileConfirmation,
        emailConfirmation,
        isClickInVerifyMobile,
        isClickInVerifyEmail,
    }
}
