<template>
    <v-container fluid class="verify-email-banner-wrap">
        <v-row>
            <v-col class="d-flex justify-center align-center">
                <p class="ma-0">شما هنوز ایمیل خود را تایید نکرده اید.</p>
                <span v-if="sended">ایمیل به درستی ارسال شد</span>
                <template v-else>
                    <v-btn :disabled="isClicked" class="success mr-4 " small rounded
                           @click="resendVerify">ارسال مجدد لینک تایید
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
    background-color: #ff8888;
}
</style>
