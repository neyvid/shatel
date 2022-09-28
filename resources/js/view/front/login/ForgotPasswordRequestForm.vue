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


                    <v-btn
                        block
                        color="success"
                        class="mt-6"
                        @click="resetPassword"
                        :disabled="sended"
                    >

                        <template v-if="sended"><v-progress-circular
                            :size="20"
                            color="red"
                            indeterminate
                        ></v-progress-circular>
                        </template>
                        <template v-else>تغییر رمز</template>

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
    name: "ForgotPassword",
    setup() {
        const form = ref(null);
        const formInfo = ref({
            email: null,
        });
        const errors = ref({
            email: null,
        });
        const sended = ref(false);

        function resetPassword() {
            if (form.value.validate()) {
                sended.value = true;
                axios.post('/password/email', formInfo.value).then((response) => {
                    alert(response.data.message);
                }).catch((error) => {
                    errors.value.email = error.response.data.email[0];
                }).finally(() => {
                    sended.value = false;
                })
            }
        }

        return {
            resetPassword, required, formInfo, form, errors,sended

        }
    }
}
</script>

<style scoped>

</style>
