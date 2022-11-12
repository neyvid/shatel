<template>
    <v-main>

        <v-container>
            <v-row class="mt-5 mb-5 ">
                <v-col cols="12" md="12">
                    <h2 class="text-center" :class="{'text-center':$vuetify.breakpoint.smAndDown}">بررسی وضعیت دسترسی به
                        ADSL2+</h2>
                    <v-row>
                        <v-col cols="12" class="covered-area-wrap">
                            <v-img
                                :class="{'width100':$vuetify.breakpoint.smAndDown,'cover-area-image':$vuetify.breakpoint.smAndUp}"
                                src="/images/front/covered-are.jpg">

                            </v-img>
                        </v-col>
                        <v-col cols="12" class="text-center">
                            <h1 >مناطق تحت پوشش <a href="http://sabanet.ir/adsl" title="اینترنت پرسرعت ADSL صبانت">اینترنت پرسرعت +ADSL2 صبانت</a></h1>
                           <p>
                               اینترنت پرسرعت ADSL در مناطقی که با رنگ سبز نمایش داده شده به طور کامل به مشترکین ارائه و در مناطقی که با رنگ خاکستری مشخص شده در آینده نزدیک تحت پوشش قرار می گیرند.
                           </p>
                        </v-col>
                    </v-row>

                </v-col>

            </v-row>
        </v-container>

    </v-main>
</template>

<script>
export default {
    name: "areasCovered"
}
</script>

<style scoped>
.width100 {
    width: 100% !important;
}

.cover-area-image {
    width: 45% !important;
    margin: 0 auto !important;
}
</style>
