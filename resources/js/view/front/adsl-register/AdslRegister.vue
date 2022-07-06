<template>
    <v-main>
        <v-container fluid class="adslRegisterHeader">
            <v-container>
                <v-row>
                    <v-col cols='12' class="text-center">
                        <h2>خرید آنلاین محصولات و خدمات صبا نت</h2>
                    </v-col>
                    <v-divider></v-divider>
                    <v-col cols='12' class="d-flex align-center flex-column text-center">
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

                        <step-one :orderDetails="orderDetails" :serviceDetails="serviceDetails"
                                  :produtDetails="productData"
                                  @selectServ="selectServ" @selectProd="selectProd" @nextStep="e1=2"
                                  @exit="exit"></step-one>
                        <step-two @nextStep="nextStepToThree" @backStep="e1=1" @exit="exit"></step-two>
                        <step-three
                            @deletePersonalFormData="deletePersonalData"
                            @deleteCompanyFormData="deleteCompanyData"
                            @personalFormChange="changePersonalForm"
                            @companyFormChange="changeCompanyForm"
                            @nextStep="nextStepTo4"
                            @backStep="e1=2"
                            @exit="exit">

                        </step-three>
                        <step-four :orderDetails="orderDetails" :serviceSelectedDetail="selectService"
                                   :personalFormInfo="personalData? personalData : ''"
                                   @ChangeLastPayStatus="changePayStatus"
                                   @ChangeSmsStatus="smsStatus"
                                   :companyFormInfo="companyData? companyData : ''"
                                   @nextStep="nextStepTo5"
                                   @backStep="e1=3"
                                   @exit="exit"></step-four>
                        <step-five @nextStep="nextStepTo6" @confirmContract="changeContractStatus"
                                   @backStep="e1=4"
                                   @exit="exit"></step-five>
                        <step-six :loadingForOpenGatway="loadingOpenGateWay"></step-six>
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
import router from "../../../router/router";
import Swal from "sweetalert2";
import store from "../../../store"
import StepSix from "../../../components/front/adslRegister/StepSix";

export default {
    name: "AdslRegister",
    components: {StepSix, StepFive, StepThree, StepOne, StepTwo, StepFour},

    data() {
        return {
            e1: 1,
            loadingOpenGateWay: false,
            orderDetails: [],
            productData: [],
            serviceDetails: [],
            selectService: {},
            selectProduct: null,
            companyData: null,
            personalData: {},
            confirmContract: null,
            payStatus: null,
            sendsms: null,
        }
    },
    methods: {
        nextStepTo6() {
            if (this.confirmContract) {
                this.e1 = 6;
                this.loadingOpenGateWay = true;
                axios.post('/adslRegister/save/order',
                    {
                        orderDetails: this.orderDetails,
                        personalData: this.personalData,
                        selectProduct: this.selectProduct,
                        selectService: this.selectService,
                        sendsms: this.sendsms,
                        companyData: this.companyData,
                        confirmContract: this.confirmContract
                    }).then(({data}) => {
                    if (!data.status) {
                        console.log(data.message);
                    } else {
                        window.location.href = 'https://sandbox.zarinpal.com/pg/StartPay/' + data.Authority;
                    }


                })

            } else {
                Swal.fire(
                    {
                        title: 'اخطار',
                        text: 'لطفا تیک پرداخت آخرین قبض خط را تایید کنید.',
                        type: 'warning',
                        confirmButtonText: 'باشه!'
                    }
                )
            }

        },
        nextStepToThree() {
            this.e1 = 3;
        },
        nextStepTo4() {
            if (this.personalData != null && (!this.personalData.birthday_date || this.personalData.birthday_date === '')) {
                Swal.fire(
                    {
                        title: 'اخطار',
                        text: 'تاریخ تولد را وارد نمایید',
                        type: 'warning',
                        confirmButtonText: 'باشه!'
                    }
                )
            } else {
                axios.post('/adslRegister/save/check', {
                    personalData: this.personalData,
                    companyData: this.companyData
                }).then(({data}) => {
                    if (data) {
                        Swal.fire(
                            {
                                title: 'خطا',
                                text: 'ایمیل و یا شماره موبایل وارد شده در سیستم موجود می باشد؛لطفا با ایمیل ویا شماره موبایل دیگری اقدام نمایید.',
                                type: 'warning',
                                confirmButtonText: 'باشه!'
                            }
                        )

                    } else {
                        this.e1 = 4;
                    }
                })

            }


        },
        nextStepTo5() {
            if (this.payStatus) {
                this.e1 = 5;
            } else {
                Swal.fire(
                    {
                        title: 'اخطار',
                        text: 'لطفا تیک پرداخت آخرین قبض خط را تایید کنید.',
                        type: 'warning',
                        confirmButtonText: 'باشه!'
                    }
                )
            }
        },
        selectServ(item) {
            this.selectService = item;

        },
        exit() {
            axios.get('/adsl/buy/online/cancel').then(({data}) => {
                if (data) {
                    Swal.fire({
                        title: "اخطار",
                        text: "آیا از خروج روند خرید مطمئن هستید؟",
                        icon: "warning",
                        confirmButtonText: 'بله'
                    }).then(() => {
                        router.push('/services/adsl/availability-check')
                        location.reload();
                    });
                }
            })

        },
        selectProd(item) {
            this.selectProduct = item;

        },
        changePersonalForm(personalFormData) {

            this.personalData = personalFormData;
            this.companyData = null;

        },
        changeCompanyForm(companyFormData) {
            this.companyData = companyFormData;
            this.personalData = null;
        },
        deleteCompanyData() {
            this.companyData = {};
        },
        deletePersonalData() {
            this.personalData = {};
        },

        changeContractStatus(status) {
            this.confirmContract = status;
        },
        changePayStatus(status) {
            this.payStatus = status;

        },
        smsStatus(status) {
            this.sendsms = status;

        }


    },
    watch: {
        e1: function (step) {
            if (Object.keys(this.selectService).length > 0) {
                this.e1 = step;
            } else {
                Swal.fire({
                    title: 'لطفا یکی از سرویس ها را انتخاب نمایید',
                    confirmButtonText: ' ! باشه',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                })
                this.e1 = 1;
            }
        }
    },
    created() {

        axios.get('/adsl/buy/online/get/session/').then(({data}) => {
            if (data.status) {
                this.orderDetails = data.orderDetails;
                this.productData = data.products;
                this.serviceDetails = data.servicesDetails;
            } else {
                Swal.fire({
                    title: " ! خطا",
                    text: ".خطایی رخ داده است، لطفا مجددا تلاش کنید",
                    type: "success",
                    confirmButtonText: 'باشه'
                }).then(() => {
                    router.push({name: 'adsl-availability-check'})
                    location.reload();
                });

            }


        })
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
