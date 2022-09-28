<template>
    <div>
        <div>
            <v-stepper-items>

                <v-stepper-content step="4">
                    <p class="mt-8">بازبینی سفارش</p>
                    <v-divider></v-divider>
                    <v-row class="mt-8 mb=8">
                        <v-col cols="12" md="6">
                            <p>مشخصات اشتراک</p>
                            <div class="review-customer-info-wrap">
                                <ul>
                                    <li>نام اشتراک:
                                        <v-chip
                                            class="ma-2"

                                            color="orange"
                                            outlined
                                            label
                                        >
                                        {{personalFormInfo.name? personalFormInfo.name : companyFormInfo.name}}
                                        </v-chip>
                                    </li>
                                    <li>نام و نام خانوادگی:

                                        <v-chip
                                            class="ma-2"

                                            color="orange"
                                            outlined
                                            label
                                        >
                                            {{personalFormInfo.lastname? personalFormInfo.lastname : companyFormInfo.lastname}}
                                        </v-chip>
                                    </li>
                                    <li>شماره تلفن:

                                        <v-chip
                                            class="ma-2"
                                            color="orange"
                                            outlined
                                            label

                                        >
                                            {{orderDetails.phoneNumber}}
                                        </v-chip>
                                    </li>
                                    <li>شماره موبایل:

                                        <v-chip
                                            class="ma-2"
                                            label
                                            color="orange"
                                            outlined
                                        >
                                            {{personalFormInfo.mobile? personalFormInfo.mobile : companyFormInfo.mobile}}
                                        </v-chip>
                                    </li>
                                    <li>ایمیل:
                                        <v-chip
                                            class="ma-2"
                                            label
                                            color="orange"
                                            outlined
                                        >
                                            {{personalFormInfo.email? personalFormInfo.email :''}}
                                        </v-chip>
                                    </li>
                                    <template v-if="!!productSelectedDetail.name">
                                        <li >تجهیزات انتخابی شما:
                                            <v-chip
                                                class="ma-2"

                                                color="orange"
                                                label
                                                outlined
                                            >
                                                {{productSelectedDetail.name}}
                                            </v-chip>
                                        </li>
                                    </template>

                                    <li>جشنواره انتخابی
                                        <span>بهاره</span>
                                    </li>
                                    <li>درخواست اشتراک نماوا
                                        <span>دارد</span>
                                    </li>

                                </ul>
                            </div>
                        </v-col>
                        <v-col col="12" md="6">
                            <p>مشخصات سرویس انتخابی</p>
                            <div class="review-service-info-wrap">


                                <div class="d-flex flex-row suggestion-service-wrap">
                                    <div class="suggestion-image-service"></div>
                                    <div class="suggestion-service-content pa-2">
                                        <p class="ma-0 py-1   fs-13">
                                            <span>نام سرویس : </span>
                                            {{ serviceSelectedDetail.name }}
                                        </p>
                                        <p class="ma-0 py-1   fs-13">
                                            <span>سرعت : </span>
                                            {{ serviceSelectedDetail.speed }} کیلوبیت بر ثانیه
                                        </p>
                                        <p class="ma-0 py-1 pr-1  fs-13">
                                            <span>دوره: </span>
                                            {{ serviceSelectedDetail.period }} ماهه
                                        </p>
                                        <p class="ma-0 py-1 pr-2  fs-13">
                                            <span>حد آستانه مصرف: </span>
                                            ماهانه {{ serviceSelectedDetail.limit_amount }} گیگ ترافیک ایران
                                        </p>
                                        <p class="ma-0 py-1 pr-3 fs-13">
                                            معادل {{ serviceSelectedDetail.international_trafic }} گیگ ترافیک بین الملل
                                        </p>
                                        <p class="ma-0 fs-14 pr-5 font-weight-bold font-shabnam subtitle-1">
                                            {{ formatPrice(serviceSelectedDetail.total_price)}}
                                            <span>ریال</span>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </v-col>
                    </v-row>
<!--                    <v-row>-->
<!--                        <v-col cols="12"  >-->
<!--                            <div class="discount-code-input pa-6">-->
<!--                                <p>کد تخفیف (پیمانی)</p>-->
<!--                                <v-text-field-->
<!--                                    label="Outlined"-->
<!--                                    placeholder="Placeholder"-->
<!--                                    outlined-->
<!--                                    dense-->
<!--                                ></v-text-field>-->
<!--                            </div>-->
<!--                        </v-col>-->
<!--                    </v-row>-->
                    <v-row>
                        <v-col class="review-register-description-wrap ">
                            <p class="fs-15 text-red" >برای ادامه خرید می بایست  پرداخت آخرین قبض تلفن را تایید نمایید.</p>

                            <v-checkbox
                                :label=" ' آخرین قبض خط ' +orderDetails.phoneNumber+' پرداخت شده است. '"
                                color="red"
                                hide-details
                                v-model="lastPayStatus"
                                @change="ChangeLastPayStatus"
                                class="checkbox_step4"
                            ></v-checkbox>
                            <v-checkbox
                                v-model="smsStatus"
                                label="مایلم پیامک‌های خودکار اطلاع‌رسانی شاتل را دریافت کنم."
                                color="red"
                                hide-details
                                @change="ChangeSmsStatus"
                                class="checkbox_step4"
                            ></v-checkbox>
<!--                            <p>درخواست سرویس شما برای شماره تلفن-->
<!--                                <span class="red&#45;&#45;text">-->
<!--                                    {{orderDetails.phoneNumber}}-->
<!--                                </span>-->
<!--                                است. </p>-->

                            <p class="fs-15 text-green">قابل ذکر می باشد که سرویس اینترنت پرسرعت شما طی 3 تا 7 روز کاری پس از زمان پرداخت
                                صورت‌حساب ، راه‌اندازی خواهد شد. </p>
                            <p class="fs-15 text-red" > درصورت انتخاب «پیامک خودکار»، پیامک‌های اطلاع‌رسانی صبا نت برای
                                شما ارسال و به ازای هر ماه اشتراک ، مبلغ 10,000 تومان به صورت‌حساب شما افزوده می‌شود. </p>
                        </v-col>
                    </v-row>
                    <v-btn
                        color="primary"
                        @click="$emit('nextStep')"
                        class="mt-8"
                        :disabled="!lastPayStatus"
                    >
                        ادامه
                    </v-btn>
                    <v-btn
                        color="warning"
                        @click="$emit('backStep')"
                        class="mt-8"
                    >
                        برگشت
                    </v-btn>
                    <v-btn text class="mt-8"  @click="$emit('exit')">
                        خروج
                    </v-btn>
                </v-stepper-content>


            </v-stepper-items>
        </div>
    </div>
</template>

<script>
export default {
    name: "StepFour",
    props: ['serviceSelectedDetail', 'personalFormInfo', 'companyFormInfo','orderDetails' ,'productSelectedDetail'],

    data() {
        return {
            lastPayStatus:false,
            smsStatus:false,
        }
    },
    methods:{
        formatPrice(value) {
           return  new Intl.NumberFormat('fa-IR').format(value)
        },
        ChangeLastPayStatus(event){

            this.$emit('ChangeLastPayStatus',event)
        },

        ChangeSmsStatus(event){

            this.$emit('ChangeSmsStatus',event)
        }

    }
}
</script>

<style scoped>
.review-customer-info-wrap {
    background-color: #f9f9f9;
    border: 1px solid #dbdbdb;
    border-radius: 5px;
    padding: 25px;

}
.font-shabnam{
    font-family: Shabnam !important;
}

.review-customer-info-wrap > ul > li {
    padding: 5px 0;
}

.review-service-info-wrap {
    background-color: #f9f9f9;
    border: 1px solid #dbdbdb;
    border-radius: 5px;
    padding: 25px;

}

.discount-code-input {
    background-color: #f9f9f9;
    border: 1px solid #dbdbdb;
    border-radius: 5px;
}

.suggestion-service-wrap {
    border: 1px solid #d5d5d5;
    border-radius: 10px;

}

.suggestion-image-service {
    background-image: url("../../../../../public/images/front/adslRegister/eco-8192.png");
    width: 164px;
    background-position: top left;
    background-repeat: no-repeat;
    background-size: cover;

}

.review-register-description-wrap {

}
.checkbox_step4{
    text-align:right !important;
}
</style>
