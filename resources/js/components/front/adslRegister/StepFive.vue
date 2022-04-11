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
                        <p>این قرار داد به نام آقای
                            این قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام
                            آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به
                            نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد
                            به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار
                            داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین
                            قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام
                            آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به
                            نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد
                            به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار
                            داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین
                            قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام
                            آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به نام آقایاین قرار داد به
                            نام آقایاین قرار داد به نام آقای
                            <span>نوید سخی طبع </span>
                            به شماره ملی
                            <span>1291998225</span>
                            به جهت اشتراک یک ساله بسته می گردد.
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
    name: "StepFive",
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
</style>
