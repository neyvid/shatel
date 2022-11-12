<template>
    <v-container fluid class="verify-email-banner-wrap">
        <v-row>
            <v-col class="d-flex justify-center align-center">
                <p class="ma-0 verify-text">شما هنوز ایمیل خود را تایید نکرده اید.</p>
                <span class="verify-text-answer" v-if="sended">ایمیل با موفقیت ارسال شد</span>
                <template v-else>
                    <v-btn :disabled="isClicked" class="success mr-4 " small rounded
                           @click="resendVerify">
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

export default {
    name: "VerifyEmailAlert",
    setup() {
        const sended = ref(false);
        const isClicked = ref(false)

        function resendVerify() {
            isClicked.value = true;
            axios.post('/email/resend').then(() => {
                sended.value = true;
            }).finally(() => {
                isClicked.value = false;
            })
        }

        return {
            sended, resendVerify, isClicked
        }

    },


}
</script>

<style scoped>
.verify-email-banner-wrap {
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
