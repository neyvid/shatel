<template>
    <v-container>
        <v-row class="mt-8 ">
            <v-col col="12" class="pa-0 ma-0 justify-center d-flex">
                <v-img src="/images/front/sabanet-logo.png" contain width="50px" height="50px"></v-img>
            </v-col>
        </v-row>
        <v-row class="mt-12">

            <v-col cols="12">
                <v-form
                    ref="form"
                    lazy-validation
                >
                    <v-text-field
                        v-model="formInfo.email"
                        :rules="[required('ایمیل')]"
                        label="ایمیل خود را وارد نمایید"
                        required
                        :error-messages="errors.email"
                    ></v-text-field>
                    <v-text-field
                        v-model="formInfo.password"
                        :rules="[required('رمز عبور')]"
                        label="رمز عبور خود را وارد نمایید"
                        required
                        :error-messages="errors.password"
                    ></v-text-field>
                    <v-text-field
                        v-model="formInfo.password_confirmation"
                        :rules="[required('تایید رمز عبور')]"
                        label="تایید رمز عبور خود را وارد نمایید"
                        required
                        :error.messages="errors.password_confirmation"
                    ></v-text-field>


                    <v-btn
                        block
                        color="success"
                        class="mt-6"
                        @click="resetPassword"
                    >
                        تغییر رمز
                    </v-btn>


                </v-form>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import {required} from "../../../rules/frontRules";
import {ref} from "@vue/composition-api";

export default {
    name: "ResetPassword",
    setup(props, {refs, root}) {
        const form = ref(null);
        const formInfo = ref({
            email: null,
            password: null,
            password_confirmation: null,
            token: root.$route.params.token
        });
        const errors = ref({
            password: null,
            email: null,
            password_confirmation: null,
        })

        function resetPassword() {
            if (form.value.validate()) {
                axios.post('/password/reset', formInfo.value).then((response) => {
                    alert(response.data.message)
                })

                    .catch((error) => {
                        errors.value.password = error.response.data.errors.password != undefined ? error.response.data.errors.password[0] : '';
                        errors.value.password_confirmation = error.response.data.errors.password_confirmation != undefined ? error.response.data.errors.password_confirmation[0] : '';
                        errors.value.email = error.response.data.errors.email != undefined ? error.response.data.errors.email[0] : '';
                    })
            }
        }

        return {
            resetPassword, required, formInfo, form, errors

        }
    }
}
</script>

<style scoped>

</style>
