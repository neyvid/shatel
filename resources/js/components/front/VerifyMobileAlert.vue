<template>
    <v-container fluid class="verify-mobile-banner-wrap">
        <v-row>
            <v-col class="d-flex justify-center align-center">

                <p class="ma-0 verify-text">شما هنوز شماره همراه خود را تایید نکرده اید.</p>

                <template v-if="sended">
                    <span class="pr-5 verify-text-answer">کد فعال سازی برای شماره همراه شما به درستی ارسال گردید.</span>
                </template>
                <template v-else>
                    <v-btn :disabled="isClicked" class="success mr-4 " small rounded
                           @click="resendMobileVerify">
                        <template  v-if="!isClicked">ارسال مجدد لینک تایید</template>
                        <template  v-if="isClicked">درحال ارسال...</template>
                        <v-progress-circular
                            v-if="isClicked"
                            :size="18"
                            :width="3"
                            indeterminate
                            color="blue"
                        ></v-progress-circular>
                    </v-btn>
                </template>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import {ref} from "@vue/composition-api";
import router from "../../router/router";

export default {
    name: "VerifyMobileAlert",
    setup() {

        const sended = ref(false);
        const isClicked = ref(false)

        function resendMobileVerify() {
            isClicked.value = true;
            axios.post('/mobileVerify/resend').then(() => {
                sended.value = true;
            }).finally(() => {
                isClicked.value = false;
                router.push({name: 'verify-mobile'})
            })
        }

        return {
            sended, resendMobileVerify, isClicked
        }

    },
}
</script>

<style scoped>
.verify-mobile-banner-wrap {
    background-color: #da1f26;
}
.verify-text {
    color: #ffffff;
    font-size: 14px;
}
.verify-text-answer {
    color: #ffc85f;
    font-size: 14px;
}
</style>
