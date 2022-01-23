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
                            ref="registerFormData"
                        >
                            <v-text-field
                                required
                                label="ایمیل یا شماره همراه"
                                :rules="[required('ایمیل یا شماره همراه')]"
                                v-model="registerFormInfo.username"
                                :error-messages="errors.username"

                            ></v-text-field>

                            <v-text-field
                                label="رمز عبور"
                                required
                                type="password"
                                :rules="[required('رمزعبور'),moreThan('رمزعبور',8)]"
                                v-model="registerFormInfo.password"
                                :error-messages="errors.password"
                            ></v-text-field>


                            <v-btn block
                                   color="success"
                                   @click="register"
                                   class="mt-8"
                            >

                                <template v-if="loading">
                                    <v-progress-circular
                                        indeterminate
                                        color="red"
                                    ></v-progress-circular>
                                </template>
                                <template v-else>
                                    ورود
                                </template>


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
                                            {{ slide }} slide
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


import {registerModule} from "../../../Module/Common/registerModule";
import {required, moreThan} from "../../../rules/frontRules";

export default {
    name: "Register",
    setup() {

        return {
            required, moreThan, ...registerModule()
        }
    },

}
</script>

<style scoped>

</style>
