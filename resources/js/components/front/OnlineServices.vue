<template>
    <v-container>
        <v-row >
            <v-col cols="12" md="4" class="d-flex justify-center">
                <v-card
                    class="my-12"
                >
                    <v-img
                        height="110"
                        contain
                        src="images/front/checkAdsl.svg"
                    ></v-img>

                    <v-card-title class=" fs-16 d-flex justify-center">بررسی پوشش خدمات +ADSL2</v-card-title>

                    <v-card-text>

                        <v-form
                            ref="form"
                            v-model="valid"
                            lazy-validation
                        >
                            <v-container>


                            <v-row>
                                <v-col cols="7"       class="px-0 pl-1">
                                    <v-text-field
                                        label="شماره تلفن ثابت"
                                        placeholder="شماره تلفن ثابت"
                                        outlined
                                        dense

                                    ></v-text-field>
                                </v-col>
                                <v-col cols="5"   class="px-0">

                                    <v-text-field
                                        label="پیش شماره شهر"
                                        placeholder="پیش شماره شهر"
                                        outlined
                                        dense
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            </v-container>




                            <v-btn
                                block
                                color="success"


                            >
                                ثبت
                            </v-btn>


                        </v-form>
                    </v-card-text>




                </v-card>
            </v-col>
            <v-col cols="12" md="4" class="d-flex justify-center">       <v-card
                class="mx-auto my-12"
                max-width="374"
            >
                <v-img
                    height="110"
                    contain
                    src="images/front/priceOfAdsl.svg"
                ></v-img>

                <v-card-title class="fs-16 d-flex justify-center">تعرفه خدمات +ADSL2</v-card-title>

                <v-card-text>


                    <div class="text-center">تعرفه خدمات اینترنت پرسرعت شاتل را برای مقایسه خدمات و انتخاب سرویس مورد نیاز خود مشاهده فرمایید.</div>
                </v-card-text>




            </v-card></v-col>
            <v-col cols="12" md="4" class="d-flex justify-center">     <v-card
                class="mx-auto my-12"
                max-width="374"
            >
                <v-img
                    height="110"
                    contain
                    src="images/front/onlineOrder.svg"
                ></v-img>

                <v-card-title class="fs-16 d-flex justify-center">سفارش آنلاین خدمات +ADSL2</v-card-title>

                <v-card-text>


                    <div class="text-center">همین حالا سرویس مورد نیازتان را به سادگی و به صورت آنلاین خریداری کنید.</div>
                </v-card-text>



            </v-card></v-col>


        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "OnlineServices"
}
</script>

<style scoped>

</style>
