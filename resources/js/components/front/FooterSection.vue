<template>
    <v-container fluid class="footer-bg">
        <v-container>

            <v-row class="mb-8 pb-8">
                <v-col cols="12" md="6">

                    <v-row>
                        <v-col cols="12" md="6"
                               :class="$vuetify.breakpoint.mdAndDown? 'pb-0 d-flex justify-center text-center' : ''">
                            <ul class="fs-12">
                                <li class="py-2">درباره صبانت</li>
                                <li class="py-2">سوالات متداول</li>
                                <li class="py-2">صدای مشتری</li>
                                <li class="py-2">گفتگوی آنلاین</li>
                                <li class="py-2">آشنایی با ریگالاتوری</li>
                            </ul>
                        </v-col>
                        <v-col cols="12" md="6"
                               :class="$vuetify.breakpoint.mdAndDown? 'pt-0  d-flex justify-center text-center' : ''">
                            <ul class="fs-12">
                                <li class="py-2">اخباروتازه ها</li>
                                <li class="py-2">سامانه رضایت سنجی</li>
                                <li class="py-2">تست سرعت</li>
                                <li class="py-2">مناقصه و مزایده ها</li>

                            </ul>
                        </v-col>
                    </v-row>

                </v-col>
                <v-col cols="12" md="6">
                    <v-row>
                        <v-col cols="12" class="text-center">

                            <v-img class="d-inline-block ml-2" width="35px" height="35px" contain
                                   src="images/front/socialMedia/telegram.png"></v-img>
                            <v-img class="d-inline-block ml-2" width="35px" height="35px" contain
                                   src="images/front/socialMedia/instagram.png"></v-img>
                            <v-img class="d-inline-block ml-2" width="35px" height="35px" contain
                                   src="images/front/socialMedia/whatsapp.png"></v-img>
                            <v-img class="d-inline-block ml-2" width="35px" height="35px" contain
                                   src="images/front/socialMedia/linkedin.png"></v-img>
                        </v-col>
                        <v-col cols="12">
                            <v-row>
                                <v-col cols="9" class="pl-0 ml-0">
                                    <v-text-field
                                        placeholder="عضویت در خبرنامه"
                                        outlined
                                        class="rounded-l-0 subscribeInput"
                                        background-color="white"
                                        flat
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="3" class="pr-0 mr-0">
                                    <v-btn class="subscribeBtn rounded-r-0 py-7">عضویت</v-btn>
                                </v-col>
                            </v-row>


                        </v-col>
                    </v-row>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12"  md="6" class="pa-0 ma-0" :class="{'text-center':$vuetify.breakpoint.smAndDown}">
                    <p class="fs-13">
                        کپی‌رایت © ۱۴۰۰. گروه فناوری ارتباطات و اطلاعات شاتل
                    </p></v-col>
                <v-col cols="6" class="text-left pa-0 ma-0 hidden-sm-and-down">
                    <ul class="pa-0">
                        <li class="d-inline-block pl-3 fs-13">بررسی شکایات</li>
                        <li class="d-inline-block pl-3 fs-13">بررسی شکایات</li>
                    </ul>
                </v-col>
            </v-row>
        </v-container>
    </v-container>
</template>

<script>
export default {
    name: "FooterSection",
    data() {
        return {
            items: [
                {
                    icon: 'mdi-wifi',
                    text: 'Wifi',
                },
                {
                    icon: 'mdi-bluetooth',
                    text: 'Bluetooth',
                },
                {
                    icon: 'mdi-chart-donut',
                    text: 'Data Usage',
                },
            ],
        }
    }
}
</script>

<style scoped>


</style>
