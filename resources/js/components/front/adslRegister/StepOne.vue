<template>
<div>
    <v-stepper-items>

        <v-stepper-content step="1">
            <p class="mt-8">سرویس های پیشنهادی</p>
            <v-divider></v-divider>
            <v-row>
                <v-col cols="12">
                    <p>شما می‌توانید سرویس مورد نظر خود را از میان فهرست پیشنهادی زیر انتخاب
                        فرمایید. برای مشاهده سرویس‌های دیگر شاتل بر روی کلید انتخاب‌های بیش‌تر
                        کلیک کنید. </p>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="4" >
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
                </v-col>
                <v-col cols="12" md="4">
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
                </v-col>
                <v-col cols="12" md="4">
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
                </v-col>
            </v-row>
            <p class="mt-8">تجهیزات پیشنهادی</p>
            <v-divider></v-divider>
            <v-row class="mt-6">
                <v-col cols="12" md="3">
                    <div class="suggestion-equipment-wrap text-center">
                        <div class="sugesstion-equipment-image d-flex">
                            <v-img  src="images/front/adslRegister/VMG5301.jpg" width="150" height="150" contain></v-img>
                        </div>
                        <div class="sugesstion-equipment-content">
                            <p class="equipment-title mt-3">
                                Combo P-660RU Zyxel
                            </p>
                            <a href="" class="equipment-propeties-link mb-3 d-inline-block">مهمترین امکانات و ویژگی ها</a>

                            <p class="equipment-price">
                                2,400,000
                                <span>ریال</span>
                            </p>
                            <v-btn class="success rounded-0 " block>انتخاب</v-btn>


                        </div>
                    </div>
                </v-col>
                <v-col cols="12" md="3">
                    <div class="suggestion-equipment-wrap text-center">
                        <div class="sugesstion-equipment-image d-flex">
                            <v-img  src="images/front/adslRegister/VMG5301.jpg" width="150" height="150" contain></v-img>
                        </div>
                        <div class="sugesstion-equipment-content">
                            <p class="equipment-title mt-3">
                                Combo P-660RU Zyxel
                            </p>
                            <a href="" class="equipment-propeties-link mb-3 d-inline-block">مهمترین امکانات و ویژگی ها</a>

                            <p class="equipment-price">
                                2,400,000
                                <span>ریال</span>
                            </p>
                            <v-btn class="success rounded-0 " block>انتخاب</v-btn>


                        </div>
                    </div>
                </v-col>
            </v-row>


            <v-btn
                color="primary"
                @click="$emit('nextStep')"
                class="mt-8"
            >
                Continue
            </v-btn>

            <v-btn text   class="mt-8">
                Cancel
            </v-btn>
        </v-stepper-content>



    </v-stepper-items>
</div>


</template>

<script>
export default {
    name: "StepOne",

}
</script>

<style scoped>
.suggestion-service-wrap{
    border:1px solid #d5d5d5;
    border-radius: 10px;
}
.suggestion-image-service{
    background-image: url("../../../../../public/images/front/adslRegister/eco-8192.png");
    width: 164px;
    background-position: top left;
    background-repeat: no-repeat;
    background-size: cover;

}
</style>
