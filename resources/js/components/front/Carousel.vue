<template>



            <v-carousel
                cycle
                height="auto"
                hide-delimiter-background
                show-arrows-on-hover
            >
                <v-carousel-item
                    v-for="(item,i) in sliderData"
                    :key="i"
                    :src="sliderData.sliderImagePath+item.id+'/'+item.picture"
                    reverse-transition="fade-transition"
                    transition="fade-transition"
                    :href="item.link"
                    contain
                >
                </v-carousel-item>

            </v-carousel>


</template>

<script>
export default {
    name: "Carousel",
    data() {
        return {
            sliderData: [],
            sliderImagePath:null,

        }
    },
    created() {
        axios.get('/sliders/').then(({data}) => {

            this.sliderData = data;
            console.log(data.sliderImagePath)
        })
    }
}
</script>

<style scoped>

</style>
