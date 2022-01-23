<template>
    <v-container fluid class="verify-mobile-banner-wrap">
        <v-row>
            <v-col class="d-flex justify-center align-center">
                <p class="ma-0">شما هنوز شماره همراه خود را تایید نکرده اید.</p>
                <span v-if="sended">کد فعال سازی برای شماره همراه شما به درستی ارسال گردید.</span>
                <template v-else>
                    <v-btn :disabled="isClicked" class="success mr-4 " small rounded
                           @click="resendMobileVerify">ارسال مجدد کد تایید
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
    name: "VerifyMobileAlert",
    setup() {
        const sended = ref(false);
        const isClicked = ref(false)

        function resendMobileVerify() {
            isClicked.value = true;
            //baraye monbile dorost beshe
            axios.post('/email/resend').then(() => {
                sended.value = true;
            }).finally(() => {
                isClicked.value = false;
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
    background-color: #ff8888;
}
</style>
