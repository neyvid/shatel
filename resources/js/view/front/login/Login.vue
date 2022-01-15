<template>

    <v-main>


        <v-container fluid class="login-content-container">
            <v-container>
                <v-row class="login-content-wrap">
                    <v-col cols="12" md="4" class="login-form  ">
                        <v-avatar width="110" height="110">
                            <v-img src="images/front/login/login-form-logo.svg" contain></v-img>

                        </v-avatar>
                        <p class="font-weight-bold py-5 ">ورود به صفحه کاربری </p>

                        <v-form
                            ref="form"
                            v-model="valid"
                            lazy-validation
                        >

                            <v-text-field
                                label="ایمیل"
                                required
                            ></v-text-field>

                            <v-text-field
                                label="رمز عبور"
                                required
                            ></v-text-field>


                            <v-checkbox
                                label="مرابه یاد داشته باش!"
                                required
                            ></v-checkbox>


                            <v-btn block
                                   color="success"
                            >
                                ورود
                            </v-btn>
                        </v-form>
                    </v-col>
                    <v-col cols="12" md="8" class="pt-0">

                        <v-carousel
                            cycle
                            height="400"
                            hide-delimiter-background
                            show-arrows-on-hover
                        >
                            <v-carousel-item
                                v-for="(slide, i) in slides"
                                :key="i"
                            >
                                <v-sheet
                                    :color="colors[i]"
                                    height="100%"
                                >
                                    <v-row
                                        class="fill-height"
                                        align="center"
                                        justify="center"
                                    >
                                        <div class="text-h2">
                                            {{ slide }} Slide
                                        </div>
                                    </v-row>
                                </v-sheet>
                            </v-carousel-item>
                        </v-carousel>
                    </v-col>
                </v-row>
            </v-container>
        </v-container>

    </v-main>

</template>

<script>
export default {
    name: "Login",

    data() {
        return {
            colors: [
                'indigo',
                'warning',
                'pink darken-2',
                'red lighten-1',
                'deep-purple accent-4',
            ],
            slides: [
                'First',
                'Second',
                'Third',
                'Fourth',
                'Fifth',
            ],
        }
    }
}
</script>

<style scoped>

</style>
