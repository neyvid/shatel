<template>
    <v-container class="mb-4">

        <v-row class="hidden-lg-and-up mb-4">
            <v-col cols="8" class="text-right  ">
                <p class="ma-0 pa-2 d-inline">

                    <v-icon color="blue">mdi-phone</v-icon>
                    شماره سراسری 09131011538

                </p>
            </v-col>
            <v-col cols="4" class="text-left">
                <v-icon @click="showTop=!showTop">
                    <template v-if="!showTop">mdi-plus</template>
                    <template v-else>mdi-minus</template>
                </v-icon>
            </v-col>
            <v-col v-if="showTop" class="text-center">
                <p class="ma-0 pa-2  "><span>راهکار های سازمانی</span></p>
                <p class="ma-0 pa-2 "><span>همکاری با شاتل</span></p>
                <p class="ma-0 pa-2  "><span>ارتباط با ما</span></p>
                <p class="ma-0 pa-2"><span>شارژ مجدد اینترنت</span></p>
                <p class="ma-0 pa-2 "><span>تست سرعت</span></p>
                <p class="ma-0 pa-2 "><span>English</span></p>

            </v-col>
        </v-row>
        <v-row>
            <v-col cols="2" class="d-flex justify-center">
                <v-img src="images/front/shatel-logo.svg" max-width="110" max-height="110"
                       contain></v-img>
            </v-col>
            <v-col cols="10" class="top-nav">
                <v-row class="hidden-md-and-down">
                    <v-col class="text-left ">
                        <p class="ma-0 pa-2 d-inline "><span>راهکار های سازمانی</span></p>
                        <p class="ma-0 pa-2 d-inline "><span>همکاری با شاتل</span></p>
                        <p class="ma-0 pa-2 d-inline "><span>ارتباط با ما</span></p>
                        <p class="ma-0 pa-2 d-inline "><span>شارژ مجدد اینترنت</span></p>
                        <p class="ma-0 pa-2 d-inline "><span>تست سرعت</span></p>
                        <p class="ma-0 pa-2 d-inline "><span>English</span></p>
                        <p class="ma-0 pa-2 d-inline ">
                                <span>
                                          <v-icon color="blue">mdi-phone</v-icon>
                                      شماره سراسری 09131011538
                                </span>

                        </p>
                    </v-col>

                </v-row>
                <v-row>
                    <v-col cols="12" class="d-flex justify-end">
                        <v-btn class="primary ">
                            <v-icon>mdi-lock</v-icon>
                            شاتل کلاب
                        </v-btn>
                        <template v-if="!auth">
                            <v-btn class="success mr-2 ml-2" to="login">
                                <v-icon>mdi-lock</v-icon>
                                مای شاتل
                            </v-btn>
                        </template>
                        <template v-else>
                            <v-menu offset-y>
                                <template v-slot:activator="{ on }">
                                    <v-btn class=" mr-2 ml-2"
                                           color="success"
                                           dark
                                           v-on="on">
                                        {{ (user.email) ? user.email : user.mobile }}
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item>
                                        <v-list-item-title style="cursor: pointer">پروفایل</v-list-item-title>
                                    </v-list-item>
                                    <v-list-item style="cursor: pointer">
                                        <v-list-item-title @click.prevent="logout">خروج</v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </template>
                        <v-app-bar-nav-icon class="hidden-lg-and-up"
                                            @click="$emit('show-navigation-drawer')"></v-app-bar-nav-icon>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import {mapState,mapActions} from 'vuex'
import VerifyEmailAlert from "./VerifyEmailAlert";


export default {
    name: "TopNav",
    components: {VerifyEmailAlert},
    data() {
        return {

            showTop: false,
            // auth: this.$store.state.isLoggedIn,
            // user: this.$store.state.user,

        }
    },
    computed: {
        ...mapState({
            auth: state => state.user.isLoggedIn,
            user: state => state.user.user
        })
    },
    methods: {

        ...mapActions(['logout'])
    }


}
</script>

<style scoped>

</style>
