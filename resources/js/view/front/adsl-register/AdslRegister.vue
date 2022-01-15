<template>
    <v-main>
        <v-container fluid class="adslRegisterHeader">
            <v-container>
                <v-row>
                    <v-col cols='12'>
                        <h2>خرید آنلاین محصولات و خدمات صبا نت</h2>
                    </v-col>
                    <v-divider></v-divider>
                    <v-col cols='12' class="d-flex align-center flex-column">
                        <v-img src="images/front/shatel-logo.svg" contain width="100px" height="100px"></v-img>
                        <p>100-94-15 :از سوی سازمان تنظیم مقررات و ارتباطات رادیویی FCP شماره پروانه سراسری
                        </p>
                    </v-col>

                </v-row>
            </v-container>
        </v-container>
        <v-container>
            <v-row>

                <v-col cols="12">

                    <v-stepper v-model="e1" flat tile>
                        <v-stepper-header>
                            <v-stepper-step
                                :complete="e1 > 1"
                                step="1"
                            >
                                انتخاب سرویس و مودم
                            </v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step
                                :complete="e1 > 2"
                                step="2"
                            >
                                انتخاب خدمات تکمیلی
                            </v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step
                                :complete="e1 > 3"
                                step="3">
                                تکمیل اطلاعات
                            </v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step
                                :complete="e1 > 4"
                                step="4">
                                بازبینی سفارش
                            </v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step
                                :complete="e1 >5"
                                step="5">
                                قرارداد
                            </v-stepper-step>
                            <v-divider></v-divider>
                            <v-stepper-step
                                :complete="e1 > 6"
                                step="6">
                                پرداخت
                            </v-stepper-step>
                        </v-stepper-header>

                        <step-one @nextStep="e1=2"></step-one>
                        <step-two @nextStep="e1=3"></step-two>
                        <step-three @nextStep="e1=4"></step-three>
                        <step-four @nextStep="e1=5"></step-four>
                        <step-five @nextStep="e1=6"></step-five>

                    </v-stepper>


                </v-col>
            </v-row>
        </v-container>
    </v-main>
</template>

<script>
import StepOne from "../../../components/front/adslRegister/StepOne";
import StepTwo from "../../../components/front/adslRegister/StepTwo";
import StepThree from "../../../components/front/adslRegister/StepThree/StepThree";
import StepFour from "../../../components/front/adslRegister/StepFour";
import StepFive from "../../../components/front/adslRegister/StepFive";

export default {
    name: "AdslRegister",
    components: {StepFive, StepThree, StepOne, StepTwo,StepFour},

    data() {
        return {
            e1: 5,
        }
    },
}
</script>

<style scoped>
.adslRegisterHeader {
    background-image: url("../../../../../public/images/front/adslRegister/MyShatel-headerBg.jpg");
    background-position: top center;
    background-size: cover;
    position: relative;
}

</style>
