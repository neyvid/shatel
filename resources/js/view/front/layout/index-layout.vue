<template>
    <div>
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

export default {
    name: "index-layout",
    components: {
        TopNav, FrontNavbar, FrontNavigationDrawer, FooterSection
    },
    data() {
        return {
            drawer: false,
        }
    },

}
</script>

<style scoped>

</style>
