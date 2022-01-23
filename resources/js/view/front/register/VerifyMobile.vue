<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col class="d-flex justify-center">
                    <v-img src="images/front/shatel-logo.svg" contain width="150" height="150"></v-img>
                </v-col>
            </v-row>
        </v-container>
        <v-container>
            <v-row class="mt-8">
                <v-col cols="12">
                    <div class="text-center">
                        <h4 class="mb-4">
                            <v-icon color="green">mdi-checkbox-marked-circle</v-icon>
                            پیامکی حاوی کد فعال سازی به شماره همراه شما با موفقیت ارسال گردید

                        </h4>
                        <p>لطفا برای استفاده از امکانات سایت کد فعال سازی پیامک شده به شماره همراه خود را در کادر زیر
                            وارد و تایید نمایید.</p>

                    </div>
                </v-col>

            </v-row>
            <v-row class="justify-center otp-row">

                <v-col cols="4">
                    <v-otp-input
                        length="6"
                        v-model="mobileVerifyCode"

                    ></v-otp-input>

                    <v-btn class="success rounded mt-5" block
                           @click="verifyMobile"
                    >تایید شماره
                    </v-btn>
                </v-col>


            </v-row>
        </v-container>
    </v-main>
</template>

<script>
import {ref} from "@vue/composition-api";
import router from "../../../router/router";
import store from "../../../store"
export default {
    name: "VerifyMobile",
    setup() {
        const mobileVerifyCode = ref(null);


        function verifyMobile() {
            store.dispatch('mobileVerify',mobileVerifyCode.value).then((response) => {
                if (response.data.status) {
                    router.push('/');
                } else {
                    alert(response.data.message)
                }

            })
        }

        return {
            mobileVerifyCode, verifyMobile
        }
    }
}
</script>

<style scoped>
.otp-row {
    direction: ltr !important;
}
</style>
