<template>
    <div>
        <div>
            <v-stepper-items>

                <v-stepper-content step="5">
                    <p class="mt-8">مطالعه و تایید قرارداد</p>
                    <v-divider></v-divider>
                    <h4 class="mt-5">لطفا متن قرارداد زیر را با دقت مطالعه نمایید و در صورت تایید ، قسمت قرار داد را
                        مطالعه و تایید
                        می نمایم را تایید فرمایید. </h4>
                    <div class="contract-content-wrap mt-5 pa-7">
                        <p>
                            اين قرارداد بين شركت صبانت به
                            <span class="font-weight-italic ">
                            شماره ثبت 9359
                                     </span>
                            ،
                            <span class="font-weight-italic ">
                            شناسه ملی 10780077580
                                </span>
                            و
                            <span class="font-weight-italic ">كداقتصادي:411313957195</span>
                            دارنده پروانه ارایه خدمات ارتباطي اینترنت ثابت (ADSL) به شماره 100-95-65 از
                            سازمان تنظيم مقررات و ارتباطات راديويي با اعتبار از مورخ 7/8/1396 به مدت 5 سال شمسی ،
                            <span class="font-weight-italic ">ایمیل info@sabanetco.com</span>

                            ،
                            <span class="font-weight-italic ">


                            نمابر 031-26689532
                                  </span>
                            و
                            <span class="font-weight-italic ">


                            مدیرعاملی صبا نت
                                      </span>
                            با
                            <span class="font-weight-italic ">


                            شماره ملی
                            1291998225 </span>
                            <span class="font-weight-italic ">


                            به آدرس : اصفهان خیابان طیب کدپستی 3813674679
                                    </span>
                            به
                            <span class="font-weight-italic-italic ">


                            شماره تماس
                            03136285464
                                 </span>
                            و
                            <span class="font-weight-italic-italic ">
                            آقای /خانم / شرکت :
                            {{userInfo.name}}/ {{userInfo.company_name}}
                                </span>
                            از یک‌ طرف و مشترك با مشخصات به شرح ذيل
                            منعقد گرديده است.

                            مشخصات مشترک: (شخص حقیقی یا حقوقی)

                            آقای /خانم / شرکت {{userInfo.name}}
                            <br>
                            به کد ملی /شماره ثبت {{userInfo.national_code}}/{{userInfo.registration_number}}
                            <br>
                            نام نماینده /مدیرعامل {{userInfo.name}}
                            <br>
                            شماره تلفن همراه:
                            {{userInfo.mobile}}
                            <br>

                            نشانی مکان دریافت خدمت {{userInfo.address}}
                            <br>
                            شماره تلفن ثابت: {{userInfo.user_phone_number}}
                            <br>
                            رایانامه (ایمیل ) : {{userInfo.email}}
                            <br>
                            و تاریخ تولد : {{userInfo.birthday_date}}

                        </p>
                    </div>
                    <v-switch
                        @change="changeSwitch"
                        v-model="confirmContract"
                        inset
                        label="متن قرارداد را مطالعه و تایید می نماید."
                        color="red"
                    ></v-switch>
                    <v-btn
                        color="primary"
                        @click="$emit('nextStep')"
                        class="mt-8"
                        :disabled="!confirmContract"
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
                    <v-btn text class="mt-8" @click="$emit('exit')">
                        خروج
                    </v-btn>
                </v-stepper-content>


            </v-stepper-items>
        </div>
    </div>
</template>

<script>
export default {
    name: "StepFive",
    props: ['userInfo'],
    data() {
        return {
            confirmContract: null,
        }
    },
    methods: {
        changeSwitch(status) {

            this.$emit('confirmContract', status)
        }
    }
}
</script>

<style scoped>
.contract-content-wrap {
    background-color: #e3e3e3;
    border: 1px solid #bfbfbf;
    height: 250px;
    border-radius: 5px;
    text-align: justify;
    overflow: auto;
}

.font-weight-italic {

    font-weight: bold;
}
</style>
