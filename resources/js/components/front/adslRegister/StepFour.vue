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
                                        <span>شخصی</span>
                                    </li>
                                    <li>نام و نام خانوادگی:
                                        <span>نوید سخی طبع</span>
                                    </li>
                                    <li>شماره تلفن:
                                        <span>34342773</span>
                                    </li>
                                    <li>شماره موبایل:
                                        <span>09131011538</span>
                                    </li>
                                    <li>ایمیل:
                                        <span>n.sakhitabe@gmail.com</span>
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
                                            <span>سرعت : </span>
                                            16384 کیلوبیت بر ثانیه
                                        </p>
                                        <p class="ma-0 py-1 pr-1  fs-13">
                                            <span>دوره: </span>
                                            12 ماهه
                                        </p>
                                        <p class="ma-0 py-1 pr-2  fs-13">
                                            <span>حد آستانه مصرف: </span>
                                            ماهانه 120 گیگ ترافیک ایران
                                        </p>
                                        <p class="ma-0 py-1 pr-3 fs-13">
                                            معادل 60 گیگ ترافیک بین الملل
                                        </p>
                                        <p class="ma-0 fs-14 pr-5 font-weight-bold subtitle-1">8,750,000
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

                                label=" آخرین قبض خط 36283165 پرداخت شده است"
                                color="blue"
                                value=""
                                hide-details

                            ></v-checkbox>
                            <v-checkbox
                                v-model="checked"
                                label="مایلم پیامک‌های خودکار اطلاع‌رسانی شاتل را دریافت کنم."
                                color="blue"
                                value=""
                                hide-details
                                checked
                            ></v-checkbox>
                            <p>درخواست سرویس شما برای شماره تلفن 36283165 است. </p>
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
    data() {
        return {
            checked: true,
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
