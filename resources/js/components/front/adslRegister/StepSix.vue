<template>
    <div>
        <div>
            <v-stepper-items>

                <v-stepper-content step="6">

                    <v-row
                        class="fill-height"
                        align-content="center"
                        justify="center"
                    >
                        <v-col
                            class="text-subtitle-1 text-center"
                            cols="12"

                        >
                            <h2 class="mt-5 green--text"> درحال اتصال به درگاه بانکی (لطفا تا انتقال به درگاه بانک شکیبا
                                باشید)
                            </h2>

                        </v-col>
                        <v-col cols="6">
                            <v-progress-linear
                                color="deep-purple accent-4"
                                indeterminate
                                rounded
                                reverse
                                height="10"
                            ></v-progress-linear>
                        </v-col>
                    </v-row>

                    <!--                    <v-row class="text-center">-->
                    <!--                        <v-col>-->
                    <!--                            <h2 class="mt-5 green&#45;&#45;text">درحال اتصال به درگاه بانکی</h2>-->
                    <!--                            <v-progress-circular-->
                    <!--                                v-if="loadingForOpenGatway"-->
                    <!--                                :size="70"-->
                    <!--                                :width="7"-->
                    <!--                                color="green"-->
                    <!--                                indeterminate-->
                    <!--                            ></v-progress-circular>-->
                    <!--                            <p class="mt-5">لطفا کمی تامل نمایید ! </p>-->

                    <!--                        </v-col>-->
                    <!--                    </v-row>-->


                </v-stepper-content>


            </v-stepper-items>
        </div>
    </div>
</template>

<script>
export default {
    name: "StepSix",
    props: ['loadingForOpenGatway'],
    data() {

    },
    methods: {}

}
</script>

<style scoped>

</style>
