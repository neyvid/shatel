<template>
    <v-container fluid class="onlineServiceWrap">
    <v-container>
        <v-row>
            <v-col cols="12" md="4" class="d-flex justify-center">
                <v-card
                    class="mx-auto my-12 onlineServiceWrap"
                    max-width="374"
                >
                    <v-img
                        height="110"
                        contain
                       class="my-6"
                        src="images/front/f1.png"
                    ></v-img>

                    <v-card-title class=" fs-16 d-flex justify-center">بررسی پوشش خدمات +ADSL2</v-card-title>
                    <v-card-text>


                        <div class="text-center">
                            با استفاده از سرویس خرید آنلاین ، شما میتوانید بصورت آنلاین سرویس اینترنت خود را راه اندازی
                            نمایید.
                        </div>

                        <v-btn depressed large block color="buyOnlineBtn darken-3 mt-2"
                               :to="{name:'adsl-availability-check'}">خرید آنلاین
                        </v-btn>

                    </v-card-text>


                </v-card>
            </v-col>
            <v-col cols="12" md="4" class="d-flex justify-center">
                <v-card
                    class="mx-auto my-12 onlineServiceWrap"
                    max-width="374"

                >
                    <v-img
                        height="110"
                        contain
                       class="my-6"
                        src="images/front/work2.png"
                    ></v-img>

                    <v-card-title class="fs-16 d-flex justify-center">تعرفه خدمات +ADSL2</v-card-title>

                    <v-card-text>


                        <div class="text-center">تعرفه خدمات اینترنت پرسرعت شاتل را برای مقایسه خدمات و انتخاب سرویس
                            مورد نیاز خود مشاهده فرمایید.
                        </div>
                    </v-card-text>


                </v-card>
            </v-col>
            <v-col cols="12" md="4" class="d-flex justify-center">
                <v-card
                    class="mx-auto my-12 onlineServiceWrap"
                    max-width="374"
                >
                    <v-img
                        height="110"
                        contain
                       class="my-6"
                        src="images/front/work3.png"
                    ></v-img>

                    <v-card-title class="fs-16 d-flex justify-center">سفارش آنلاین خدمات +ADSL2</v-card-title>

                    <v-card-text>


                        <div class="text-center">همین حالا سرویس مورد نیازتان را به سادگی و به صورت آنلاین خریداری
                            کنید.
                        </div>
                    </v-card-text>


                </v-card>
            </v-col>


        </v-row>
    </v-container>
    </v-container>
</template>

<script>

export default {
    name: "OnlineServices",

}
</script>

<style scoped>
.buyOnlineBtn{
    background-color: #f95114 !important;
    color: #FFFFFF !important;
}
</style>
