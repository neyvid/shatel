<template>
    <v-main>

        <carousel ></carousel>
        <online-services></online-services>
        <our-services></our-services>
        <our-news></our-news>



    </v-main>
</template>

<script>

import Carousel from "../../components/front/Carousel";
import OnlineServices from "../../components/front/OnlineServices";
import OurServices from "../../components/front/OurServices";
import OurNews from "../../components/front/OurNews";


export default {
    name: "home",

    components: {

        Carousel,OnlineServices,OurServices, OurNews,
    },

}
</script>

<style scoped>

</style>
