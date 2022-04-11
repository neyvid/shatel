<template>
    <div>
        <div>
            <v-stepper-items>

                <v-stepper-content step="6">
                    <v-row class="text-center">
                        <v-col>
                            <h2 class="mt-5 green--text">درحال اتصال به درگاه بانکی</h2>
                            <v-progress-circular
                                v-if="loadingForOpenGatway"
                                :size="70"
                                :width="7"
                                color="purple"
                                indeterminate
                            ></v-progress-circular>
                            <p class="mt-5">لطفا کمی تامل نمایید ! </p>

                        </v-col>
                    </v-row>


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
