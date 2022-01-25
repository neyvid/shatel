<template>
    <div>
        <verify-email-alert v-if="user.user && user.user.isVerified===1 && !!user.user.email  "></verify-email-alert>
        <verify-mobile-alert v-if="user.user && user.user.isMobileVerified===1 && !!user.user.mobile"   ></verify-mobile-alert>
        <top-nav @show-navigation-drawer="drawer=!drawer"></top-nav>
        <front-navigation-drawer :drawer="drawer"></front-navigation-drawer>
        <front-navbar></front-navbar>
        <router-view></router-view>

        <footer-section></footer-section>
    </div>
</template>

<script>
import TopNav from "../../../components/front/TopNav";
import FrontNavbar from "../../../components/front/FrontNavbar";
import FrontNavigationDrawer from "../../../components/front/FrontNavigationDrawer";
import FooterSection from "../../../components/front/FooterSection";
import VerifyEmailAlert from "../../../components/front/VerifyEmailAlert";
import {mapState} from "vuex";
import VerifyMobileAlert from "../../../components/front/VerifyMobileAlert";


export default {
    name: "index-layout",
    components: {
        VerifyMobileAlert,
        VerifyEmailAlert,
        TopNav, FrontNavbar, FrontNavigationDrawer, FooterSection
    },
    data() {
        return {
            drawer: false,

        }

    },
    computed: {
        ...mapState(['user'])
    }


}
</script>

<style scoped>

</style>
