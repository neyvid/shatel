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
                            ref="loginForm"

                        >

                            <v-text-field
                                label="ایمیل یا شماره همراه"
                                required
                                :rules="[required('ایمیل یا شماره همراه')]"
                                v-model="LoginInfo.username"
                                :error-messages="errors.username"
                            ></v-text-field>

                            <v-text-field
                                label="رمز عبور"
                                required
                                :rules="[required('رمزعبور')]"
                                v-model="LoginInfo.password"
                                type="password"
                                :error-messages="errors.password"
                            ></v-text-field>


                            <v-checkbox
                                label="مرابه یاد داشته باش!"
                                required
                                v-model="LoginInfo.remember"
                            ></v-checkbox>
                            <router-link style="font-size: 14px" :to="{name:'reset-password-form'}">رمزعبوررا فراموش کرده اید؟</router-link>


                            <v-btn
                                block
                                color="success"
                                @click="login"
                                class="mt-3"
                            >
                                <template v-if="loading">
                                    <v-progress-circular
                                        indeterminate
                                        color="white"
                                    ></v-progress-circular>
                                </template>
                                <template v-else> ورود</template>
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

import {required,moreThan} from "../../../rules/frontRules";
import {loginModule} from "../../../Module/Common/loginModule";
import store from '../../../store';

export default {
    name: "Login",
    setup() {
        return {

             required,moreThan, ...loginModule()
        }
    },
    // data() {
    //
    //     return {
    //         loading: false,
    //         colors: [
    //             'indigo',
    //             'warning',
    //             'pink darken-2',
    //             'red lighten-1',
    //             'deep-purple accent-4',
    //         ],
    //         slides: [
    //             'First',
    //             'Second',
    //             'Third',
    //             'Fourth',
    //             'Fifth',
    //         ],
    //         LoginInfo: {
    //             email: null,
    //             password: null,
    //             remember: false
    //         },
    //         errors: {
    //             email: null,
    //             password: null,
    //         },
    //         emailRules: [
    //             v => !!v || 'وارد نمودن ایمیل الزامی می باشد.'
    //         ],
    //         passwordRules: [
    //             v => !!v || 'وارد نمودن رمزعبور الزامی می باشد.'
    //         ],
    //     }
    // },
    // methods: {
    //     login() {
    //         if (this.$refs.loginForm.validate()) {
    //             this.loading = true;
    //             axios.post('/login', this.LoginInfo).then(() => {
    //                 router.push('/')
    //             }).catch((error) => {
    //                 this.errors.email = error.response.data.errors.email[0];
    //                 this.errors.password = error.response.data.errors.password[0];
    //
    //             }).finally(() => {
    //                 this.loading = false;
    //             })
    //         }
    //
    //
    //     }
    // }
}
</script>

<style scoped>

</style>
