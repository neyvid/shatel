<template>
    <div>
        <v-stepper-items>

            <v-stepper-content step="2">
                <p class="mt-8">انتخاب خدمات تکمیلی </p>
                <v-divider></v-divider>
                <v-row>
                    <v-col cols="12">
                        <p>برای تامین امنیت شبکه اینترنت خود بر روی سیستم عامل‌های ویندوز یا اندروید می‌توانید از خدمات
                            تکمیلی شاتل بهره‌مند شوید.
                            همچنین از این بخش می‌توانید نسبت به خرید اشتراک نماوا اقدام نمایید. </p>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="4">
                        <div class="d-flex flex-column  supplementary-service-wrap">
                            <div class="supplementary-service-image mb-5">
                                <v-img src="images/front/adslRegister/OnlineRegistration_NamavaSubscription_1.png"
                                       contain></v-img>
                            </div>
                            <div class="supplementary-service-content text-center">
                                <p>اشتراک فیلم و سریال نماوا </p>
                                <p class="captiion">Namava Subscription</p>
                                <a href="" class="d-inline-block ">
                                    <v-icon color="blue">mdi-chevron-left</v-icon>
                                    توضیحات بیشتر

                                </a>

                                <v-row class="mt-4 d-flex align-center">
                                    <v-col cols="3"><p>دوره : </p></v-col>
                                    <v-col cols="8">
                                        <v-select
                                            :items="items"
                                            label="Solo field"
                                            dense
                                            solo
                                        ></v-select>

                                    </v-col>

                                </v-row>


                            </div>
                            <div>
                                <v-btn class="primary rounded-t-0" block>انتخاب</v-btn>
                            </div>
                        </div>
                    </v-col>

                </v-row>


                <v-btn
                    color="primary"
                    @click="nextToStep3"
                    class="mt-8"
                >
                    Continue
                </v-btn>
                <v-btn
                    color="warning"
                    @click="$emit('backStep')"
                    class="mt-8"
                >
                    back
                </v-btn>

                <v-btn text class="mt-8">
                    Cancel
                </v-btn>
            </v-stepper-content>


        </v-stepper-items>

    </div>
</template>

<script>
import store from '../../../store'
import router from "../../../router/router";

export default {
    name: "StepTwo",

    data: () => ({
        items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
    }),

    methods: {
        nextToStep3() {

            this.$emit('nextStep');


        }
    }
}
</script>

<style scoped>
.supplementary-service-wrap {
    border: 1px solid #d5d5d5;
    border-radius: 10px;
}

</style>
