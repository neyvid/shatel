<template>
    <div>
        <v-container>
            <v-row>
                <v-col col="12" md="4" class="d-flex justify-center">
                    <v-img src="images/front/shatel-logo.svg" contain max-width="110" max-height="110"></v-img>
                </v-col>
                <v-col cols="12" md="8" class="d-flex align-center justify-center justify-sm-center">

<!--                    <p class="ma-0 pa-3 fs-14 d-inline "><span>ENGLISH Version</span></p>-->
                    <p class="ma-0 pa-2 fs-14 d-inline "><span>شماره سراسری : 1707 007 0930</span></p>
                    <p class="ma-0 pa-2 fs-14 d-inline "><span>ارتباط با ما</span></p>
                    <v-btn class="success" :class="{'d-none':$vuetify.breakpoint.smAndDown}" :to="{name:'home'}">سایت صبانت</v-btn>

                </v-col>
                <v-col  cols="12" class="d-flex justify-center">
                    <v-btn class="success py-2 px-5" :class="{'d-block':$vuetify.breakpoint.smAndDown,'d-none':$vuetify.breakpoint.mdAndUp}" :to="{name:'home'}">سایت صبانت</v-btn>

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
