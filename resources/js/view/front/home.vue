<template>
    <v-main>
        <top-nav @show-navigation-drawer="drawer=!drawer"></top-nav>
        <front-navbar></front-navbar>
        <front-navigation-drawer :drawer="drawer"></front-navigation-drawer>
    </v-main>
</template>

<script>
import TopNav from "../../components/front/TopNav";
import FrontNavbar from "../../components/front/FrontNavbar";
import FrontNavigationDrawer from "../../components/front/FrontNavigationDrawer";

export default {
    name: "home",
    data() {
        return {
            drawer: false,
        }
    },
    components: {FrontNavigationDrawer, FrontNavbar, TopNav}
}
</script>

<style scoped>

</style>
