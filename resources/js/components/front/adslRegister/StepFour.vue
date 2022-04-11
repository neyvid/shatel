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
                                        <span>{{personalFormInfo.name? personalFormInfo.name : companyFormInfo.name}}</span>
                                    </li>
                                    <li>نام و نام خانوادگی:
                                        <span>{{personalFormInfo.lastName? personalFormInfo.lastName : companyFormInfo.agentName}}</span>

                                    </li>
                                    <li>شماره تلفن:
                                        <span>{{orderDetails.phoneNumber}}</span>
                                    </li>
                                    <li>شماره موبایل:
                                        <span>{{personalFormInfo.mobile? personalFormInfo.mobile : companyFormInfo.mobile}}</span>

                                    </li>
                                    <li>ایمیل:
                                        <span>{{personalFormInfo.email? personalFormInfo.email :''}}</span>
                                    </li>
                                    <li>مودم انتخابی:
                                        <span>TP-LINK Wd2500</span>
                                    </li>
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
                    <v-row>
                        <v-col col="6" offset="6">
                            <div class="discount-code-input pa-6">
                                <p>کد تخفیف (پیمانی)</p>
                                <v-text-field
                                    label="Outlined"
                                    placeholder="Placeholder"
                                    outlined
                                    dense
                                ></v-text-field>
                            </div>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col class="review-register-description-wrap">

                            <v-checkbox

                                :label=" ' آخرین قبض خط ' +orderDetails.phoneNumber+' پرداخت شده است. '"
                                color="blue"
                                value=""
                                hide-details
                                v-model="lastPayStatus"
                                @change="ChangeLastPayStatus"
                            ></v-checkbox>
                            <v-checkbox
                                v-model="smsStatus"
                                label="مایلم پیامک‌های خودکار اطلاع‌رسانی شاتل را دریافت کنم."
                                color="blue"
                                value=""
                                hide-details
                                @change="ChangeSmsStatus"

                            ></v-checkbox>
                            <p>درخواست سرویس شما برای شماره تلفن
                                <span class="red--text">
                                    {{orderDetails.phoneNumber}}
                                </span>
                                است. </p>
                            <p>سپاس گزار خواهیم بود اگر صحت اطلاعات بالا را برای ثبت نهایی تایید فرمایید.</p>
                            <p> دوست گرامی، در سفارش شما تجهیزات مورد نیاز برای استفاده از خدمات اینترنت پرسرعت ثبت نشده
                                است. در صورت تمایل می‌توانید تجهیزات مورد نیاز خود را از فهرست پیشنهادی شاتل انتخاب
                                فرمایید. </p>
                            <p>به اطلاع می‌رسانیم که سرویس اینترنت پرسرعت شما طی 3 تا 7 روز کاری پس از زمان پرداخت اولین
                                صورت‌حساب، راه‌اندازی خواهد شد. </p>
                            <p> اگر گزینه‌ی «پیامک خودکار» روی صورت‌حساب شما فعال باشد، پیامک‌های اطلاع‌رسانی شاتل برای
                                شما ارسال و به ازای هر ماه اشتراک، مبلغ ۱۰۰۰ تومان به صورت‌حساب شما افزوده می‌شود. </p>
                        </v-col>
                    </v-row>
                    <v-btn
                        color="primary"
                        @click="$emit('nextStep')"
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
    </div>
</template>

<script>
export default {
    name: "StepFour",
    props: ['serviceSelectedDetail', 'personalFormInfo', 'companyFormInfo','orderDetails'],

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
</style>
