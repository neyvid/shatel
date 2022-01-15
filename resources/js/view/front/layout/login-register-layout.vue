<template>
    <div>
        <v-container>
            <v-row>
                <v-col col="12" md="4" class="d-flex justify-sm-center justify-lg-start justify-md-start">
                    <v-img src="images/front/shatel-logo.svg" contain max-width="110" max-height="110"></v-img>
                </v-col>
                <v-col cols="12" md="8" class="d-flex align-center justify-end justify-sm-center">

                    <p class="ma-0 pa-3 fs-14 d-inline "><span>ENGLISH Version</span></p>
                    <p class="ma-0 pa-3 fs-14 d-inline "><span>شماره سراسری : 09131011538</span></p>
                    <p class="ma-0 pa-3 fs-14 d-inline "><span>ارتباط با ما</span></p>
                    <v-btn class="success">سایت صبانت</v-btn>

                </v-col>
            </v-row>

        </v-container>
        <router-view></router-view>
        <footer-section></footer-section>
    </div>

</template>

<script>
import FooterSection from "../../../components/front/FooterSection";

export default {
    name: "login-register-layout",
    components: {FooterSection}
}
</script>

<style scoped>

</style>
