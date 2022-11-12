<template>
    <div>
        <v-stepper-items :class="{'lowOpacity':this.opacity}">

            <v-stepper-content step="3">
                <p class="mt-8">تکمیل اطلاعات </p>
                <v-divider></v-divider>


                <v-row class="mt-15" v-if="this.userInfo.length===0">
                    <v-col cols="12">

                        <v-row justify="center">
                            <v-dialog
                                v-model="dialog"
                                fullscreen
                                hide-overlay
                                transition="dialog-bottom-transition"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <div class="d-flex justify-center align-center">
                                        <p class="fs-16">درصوتیکه قبلا در سایت عضویت دارید ، وارد سایت شوید</p>
                                    </div>
                                    <v-btn
                                        color="warning"
                                        dark
                                        v-bind="attrs"
                                        v-on="on"
                                        class="mr-4"
                                    >
                                        ورود
                                    </v-btn>
                                </template>
                                <v-card>
                                    <v-toolbar
                                        dark
                                        color="primary"
                                    >
                                        <v-btn
                                            icon
                                            dark
                                            @click="dialog = false"
                                        >
                                            <v-icon>mdi-close</v-icon>
                                        </v-btn>

                                    </v-toolbar>
                                    <!--Start content of login form-->
                                    <v-container fluid class="login-content-container">
                                        <v-container>
                                            <v-row class="login-content-wrap">
                                                <v-col cols="12" class="login-form center  ">
                                                    <v-avatar width="110" height="110">
                                                        <v-img src="images/front/login/login-form-logo.svg"
                                                               contain></v-img>

                                                    </v-avatar>
                                                    <p class="font-weight-bold py-5 ">ورود به صفحه کاربری </p>

                                                    <v-form
                                                        ref="loginForm">

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
                                                        <router-link style="font-size: 14px"
                                                                     :to="{name:'reset-password-form'}">رمزعبوررا
                                                            فراموش
                                                            کرده اید؟
                                                        </router-link>


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

                                            </v-row>
                                        </v-container>
                                    </v-container>
                                    <!--End content of login form-->

                                </v-card>
                            </v-dialog>
                        </v-row>

                    </v-col>

                </v-row>
                <v-row class="mt-15">
                    <v-col cols="12" md="8" class="topBoxWrap">
                        <div class="select-customer-type-wrap d-flex justify-center">
                            <v-radio-group
                                row
                                v-model="user_kind"

                            >
                                <v-radio
                                    v-if="userType===0  || userType===null"
                                    label="شخصی"
                                    value="personal"
                                    @click="showPersonalForm"
                                ></v-radio>
                                <v-radio
                                    v-if="userType===1 || userType===null"
                                    label="سازمان ها و شرکت ها"
                                    value="company"
                                    @click="showCompanyForm"
                                ></v-radio>
                            </v-radio-group>
                        </div>

                    </v-col>

                </v-row>

                <v-row v-if="personalForm" class="mt-15">
                    <v-col cols="12" md="8" class="formBoxWrap">
                        <v-row>
                            <v-col cols="12">
                                <div class="person-info-customer-form">

                                    <v-form
                                        :disabled="isDisabled"
                                        :class="{'pa-5': $vuetify.breakpoint.smAndDown, 'pa-12': $vuetify.breakpoint.mdAndUp}"
                                        ref="personalForm"
                                        lazy-validation
                                        block
                                        dense
                                    >
                                        <v-text-field
                                            label="نام"
                                            @input="changePersonalFrm"
                                            v-model="personalFormData.name"
                                            :rules="[required('نام الزامیست'),persianCharachter('نام')]"
                                            :error-messages="errors.name"
                                            outlined
                                            dense

                                        ></v-text-field>

                                        <v-text-field
                                            v-model="personalFormData.lastname"
                                            @input="changePersonalFrm"
                                            label="نام خانوادگی"
                                            :rules="[required('نام خانوادگی ') ,persianCharachter('نام خانوادگی')]"
                                            :error-messages="errors.lastname"
                                            required
                                            outlined
                                            dense
                                        ></v-text-field>
                                        <v-select
                                            label="جنسیت "
                                            required
                                            outlined
                                            dense
                                            @input="changePersonalFrm"
                                            :items="gender"
                                            item-value="value"
                                            item-text="name"
                                            :rules="[required('جنسیت')]"
                                            v-model="personalFormData.gender"
                                        ></v-select>
                                        <v-text-field
                                            v-model="personalFormData.father_name"
                                            @input="changePersonalFrm"
                                            label="نام پدر"
                                            :rules="[required('نام پدر ') ,persianCharachter('نام پدر')]"
                                            :error-messages="errors.father_name"
                                            required
                                            outlined
                                            dense
                                        ></v-text-field>
                                        <date-picker
                                            v-model="personalFormData.birthday_date"
                                            label="تاریخ تولد:"
                                            color="dimgray" simple
                                            @input="changePersonalFrm,birthday=$event"
                                            :disabled="isDisabled"
                                            class="birthday"
                                            min="1320/01/01"
                                            max="1383/12/01"
                                        >
                                        </date-picker>
                                        <v-text-field
                                            v-model="personalFormData.national_code"
                                            @input="changePersonalFrm"
                                            label="کد ملی"
                                            :rules="[codeCheck]"
                                            :error-messages="errors.national_code"
                                            required
                                            outlined
                                            dense
                                            class="mt-5"
                                            maxlength="10"
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="personalFormData.postal_code"
                                            @input="changePersonalFrm"
                                            label="کد پستی"
                                            :rules="[required('کد پستی '),postalCode() ]"
                                            :error-messages="errors.postal_code"
                                            required
                                            outlined
                                            dense
                                            maxlength="10"

                                        ></v-text-field>


                                        <v-text-field
                                            v-model="personalFormData.mobile"
                                            @input="changePersonalFrm"
                                            label="شماره موبایل"
                                            :rules="[required('شماره موبایل ')]"
                                            :error-messages="errors.mobile"
                                            required
                                            outlined
                                            dense
                                            maxlength="11"
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="personalFormData.email"
                                            @input="changePersonalFrm"
                                            label="ایمیل"

                                            :rules="[required('ایمیل الزامیست'),email()]"
                                            :error-messages="errors.email"
                                            required
                                            outlined dense
                                        ></v-text-field>
                                        <v-file-input
                                            v-model="personalFormData.nationalCodePic"
                                            label="تصویر کارت ملی"
                                            outlined
                                            dense
                                            @input="changePersonalFrm"
                                            :rules="[required('تصویر کارت ملی ')]"
                                            :error-messages="errors.nationalCodePic"
                                            @change="uploadPic"

                                        ></v-file-input>
                                        <v-textarea
                                            v-model="personalFormData.address"
                                            @input="changePersonalFrm"
                                            label="آدرس پستی"
                                            :rules="[required('آدرس پستی ') ,persianCharachter()]"
                                            :error-messages="errors.address"
                                            required
                                            outlined
                                            dense
                                        ></v-textarea>


                                    </v-form>
                                </div>
                            </v-col>
                        </v-row>
                    </v-col>
                    <!--                    <v-col cols="12" md="4" class="online-chat-base"-->
                    <!--                           :class="{'d-none':$vuetify.breakpoint.smAndDown}">-->

                    <!--                        <div class="online-chat-wraper text-center">-->
                    <!--                            <v-img class="online-chat-img" src="images/front/adslRegister/online-chat-pic.png"-->
                    <!--                                   width="80"-->
                    <!--                                   height="80" contain></v-img>-->
                    <!--                            <h4 class="mt-15 mx-5">-->
                    <!--                                لطفا به موارد زیر توجه فرمایید:-->
                    <!--                            </h4>-->
                    <!--                            <p class="mx-5 mt-5">یک آدرس ایمیل معتبر وارد کنید.</p>-->
                    <!--                            <p class="mx-5 mt-5">-->
                    <!--                                به راهنمایی نیاز دارید؟-->

                    <!--                            </p>-->

                    <!--                            <p class="online-chat-btn">-->
                    <!--                                <a href="#" class="d-inline-block">-->
                    <!--                                    <v-icon color="blue">mdi-chat</v-icon>-->
                    <!--                                    <span>-->
                    <!--                                       گفتگوی آنلاین با کارشناسان فروش-->
                    <!--                                </span>-->
                    <!--                                </a>-->
                    <!--                            </p>-->
                    <!--                        </div>-->
                    <!--                    </v-col>-->
                </v-row>
                <v-row v-if="companyForm" class="mt-15">
                    <v-col cols="12" md="8" class="formBoxWrap">
                        <v-row>


                            <v-col cols="12">
                                <div class="person-info-customer-form">

                                    <v-form
                                        :disabled="isDisabled"
                                        :class="{'pa-5': $vuetify.breakpoint.smAndDown, 'pa-12': $vuetify.breakpoint.mdAndUp}"
                                        ref="companyForm"
                                        lazy-validation
                                        block
                                        dense
                                    >
                                        <v-text-field
                                            label="نام شرکت"
                                            v-model="companyFormData.company_name"
                                            @input="changeCompanyFrm"
                                            :rules="[required('نام شرکت '),persianCharachter('نام شرکت')]"
                                            :error-messages="companyFormErrors.name"
                                            outlined
                                            dense
                                        ></v-text-field>
                                        <v-text-field
                                            label="شماره ثبت"
                                            v-model="companyFormData.registration_number"
                                            @input="changeCompanyFrm"
                                            :rules="[required('شماره ثبت ')]"
                                            :error-messages="companyFormErrors.registration_number"
                                            outlined
                                            dense
                                        ></v-text-field>
                                        <date-picker v-model="companyFormData.registration_number_date"
                                                     label="تاریخ ثبت:"
                                                     color="dimgray" simple
                                                     @input="changeCompanyFrm"
                                                     :disabled="isDisabled"
                                        ></date-picker>
                                        <v-text-field
                                            class="mt-5"
                                            label="شماره اقتصادی"
                                            v-model="companyFormData.economic_number"
                                            @input="changeCompanyFrm"
                                            :rules="[required('شماره اقتصادی ')]"
                                            :error-messages="companyFormErrors.economic_number"
                                            outlined
                                            dense
                                        ></v-text-field>

                                        <v-text-field
                                            v-model="companyFormData.name"
                                            @input="changeCompanyFrm"
                                            :rules="[required('نام نماینده '),persianCharachter()]"
                                            :error-messages="companyFormErrors.name"
                                            label="نام نماینده"
                                            required
                                            outlined
                                            dense
                                        ></v-text-field>

                                        <v-text-field
                                            v-model="companyFormData.lastname"
                                            @input="changeCompanyFrm"
                                            :rules="[required('نام خانوادگی نماینده '),persianCharachter()]"
                                            :error-messages="companyFormErrors.lastname"
                                            label="نام خانوادگی نماینده"
                                            required
                                            outlined
                                            dense

                                        ></v-text-field>

                                        <v-text-field
                                            label="نام پدر نماینده"
                                            @input="changeCompanyFrm"
                                            v-model="companyFormData.father_name"
                                            :rules="[required('نام  پدر ')]"
                                            :error-messages="errors.father_name"
                                            outlined
                                            dense
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="companyFormData.national_code"
                                            @input="changeCompanyFrm"
                                            label="کد ملی نماینده"
                                            :rules="[codeCheck]"
                                            :error-messages="errors.national_code"
                                            required
                                            outlined
                                            dense
                                            maxlength="10"

                                        ></v-text-field>
                                        <v-file-input
                                            label="تصویر کارت ملی"
                                            v-model="companyFormData.nationalCodePic"
                                            :error-messages="errors.nationalCodePic"
                                            :rules="[required('تصویر کارت ملی ')]"
                                            @input="changeCompanyFrm"
                                            outlined
                                            dense
                                            @change="uploadPic"

                                        ></v-file-input>

                                        <date-picker v-model="companyFormData.birthday_date"
                                                     min="1320/01/01"
                                                     max="1383/12/01"
                                                     placeholder="تاریخ تولد نماینده"
                                                     color="dimgray" simple
                                                     class="agent-birthday_date"
                                                     @input="changeCompanyFrm,agentBirthday=$event"
                                                     :disabled="isDisabled"
                                        ></date-picker>
                                        <v-text-field
                                            v-model="companyFormData.mobile"
                                            @input="changeCompanyFrm"
                                            :rules="[required('موبایل ')]"
                                            :error-messages="companyFormErrors.mobile"
                                            label=" شماره موبایل نماینده"
                                            required
                                            class="py-5 pb-0"
                                            maxlength="11"
                                            outlined dense
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="companyFormData.email"
                                            @input="changeCompanyFrm"
                                            :rules="[required('ایمیل نماینده '),email()]"
                                            :error-messages="companyFormErrors.email"
                                            label="ایمیل  نماینده"
                                            required
                                            outlined dense
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="companyFormData.user_phone_number"
                                            @input="changeCompanyFrm"
                                            :rules="[required('شماره ثابت ')]"
                                            :error-messages="companyFormErrors.user_phone_number"
                                            label=" شماره ثابت نماینده"
                                            required
                                            outlined dense
                                            maxlength="8"
                                        ></v-text-field>
                                        <v-select
                                            v-model="companyFormData.agent_nationality"
                                            label="ملیت نماینده"
                                            required
                                            outlined
                                            dense
                                            :rules="[required('ملیت')]"

                                            @input="changeCompanyFrm"
                                            :items="agent_nationality"
                                            item-value="value"
                                            item-text="name"
                                        ></v-select>
                                        <v-select
                                            label="نوع شرکت"
                                            required
                                            outlined
                                            dense
                                            @input="changeCompanyFrm"
                                            :items="companyType"
                                            item-value="value"
                                            :rules="[required('نوع شرکت')]"

                                            item-text="name"
                                            v-model="companyFormData.company_type"
                                        ></v-select>
                                        <v-select
                                            label="جنسیت نماینده"
                                            required
                                            outlined
                                            dense
                                            @input="changeCompanyFrm"
                                            :items="gender"
                                            :rules="[required('جنسیت نماینده')]"

                                            item-value="value"
                                            item-text="name"
                                            v-model="companyFormData.gender"
                                        ></v-select>
                                        <v-text-field
                                            v-model="companyFormData.postal_code"
                                            @input="changeCompanyFrm"
                                            :rules="[required('کدپستی '),postalCode()]"
                                            :error-messages="companyFormErrors.postal_code"
                                            label="کد پستی"
                                            required
                                            outlined dense
                                            maxlength="10"
                                        ></v-text-field>
                                        <v-textarea
                                            v-model="companyFormData.address"
                                            @input="changeCompanyFrm"
                                            label="آدرس پستی"
                                            :rules="[required('آدرس پستی ') ,persianCharachter()]"
                                            :error-messages="errors.address"
                                            required
                                            outlined
                                            dense
                                        ></v-textarea>

                                    </v-form>
                                </div>
                            </v-col>
                        </v-row>
                    </v-col>
                    <!--                    <v-col cols="12" md="4" class="online-chat-base"-->
                    <!--                           :class="{'d-none':$vuetify.breakpoint.smAndDown}">-->
                    <!--                        <div class="online-chat-wraper text-center">-->
                    <!--                            <v-img class="online-chat-img" src="images/front/adslRegister/online-chat-pic.png"-->
                    <!--                                   width="80"-->
                    <!--                                   height="80" contain></v-img>-->
                    <!--                            <h4 class="mt-15 mx-5">-->
                    <!--                                لطفا به موارد زیر توجه فرمایید:-->
                    <!--                            </h4>-->
                    <!--                            <p class="mx-5 mt-5">یک آدرس ایمیل معتبر وارد کنید.</p>-->
                    <!--                            <p class="mx-5 mt-5">-->
                    <!--                                به راهنمایی نیاز دارید؟-->

                    <!--                            </p>-->

                    <!--                            <p class="online-chat-btn">-->
                    <!--                                <a href="#" class="d-inline-block">-->
                    <!--                                    <v-icon color="blue">mdi-chat</v-icon>-->
                    <!--                                    <span>-->
                    <!--                                       گفتگوی آنلاین با کارشناسان فروش-->
                    <!--                                </span>-->
                    <!--                                </a>-->
                    <!--                            </p>-->

                    <!--                        </div>-->
                    <!--                    </v-col>-->
                </v-row>

                <v-btn
                    color="primary"
                    @click="nextToStep4"
                    class="mt-8 "
                    :disabled="this.isDisable"
                >
                    <template v-if="this.loadingBtnStep">
                        <v-progress-circular
                            indeterminate
                            color="white"
                        ></v-progress-circular>
                    </template>
                    <template v-else>
                        ادامه
                        <v-icon>mdi-chevron-left</v-icon>
                    </template>
                </v-btn>
                <!--                <v-btn-->
                <!--                    color="primary"-->
                <!--                    @click="nextToStep4"-->
                <!--                    class="mt-8 "-->

                <!--                >-->
                <!--                    ادامه-->
                <!--                    <v-icon>mdi-chevron-left</v-icon>-->

                <!--                </v-btn>-->
                <v-btn
                    color="warning"
                    @click="$emit('backStep')"
                    class="mt-8"
                >
                    برگشت
                </v-btn>

                <v-btn text class="mt-8" @click="$emit('exit')">
                    خروج
                </v-btn>

            </v-stepper-content>


        </v-stepper-items>


    </div>


</template>

<script>
import {required, persianCharachter, codeCheck, postalCode, email} from '../../../../rules/frontRules';

import Swal from "sweetalert2";
import {loginModule} from "../../../../Module/Common/loginModule";
import {ref} from "@vue/composition-api";
import router from "../../../../router/router";

export default {
    name: "StepThree",
    props: ['isUserLogin', 'userInfo', 'userKind', 'userType', 'isDisabled', 'opacity','loadingBtnStep','isDisable'],
    data() {
        return {

            required, persianCharachter, codeCheck, postalCode, email,
            user_kind: 'personal',
            companyType: [
                {name: 'خصوصی', value: 1},
                {name: 'سهامی عام', value: 2}
            ],
            agent_nationality: [
                {name: 'ایرانی', value: 1},
                {name: 'غیر ایرانی', value: 2},
            ],
            LoginInfo:
                {
                    username: null,
                    password: null,
                    remember: false,
                },


            gender: [
                {name: 'زن', value: 2},
                {name: 'مرد', value: 1}
            ],
            loading: false,

            personalForm: true,
            companyForm: false,
            companyFormData: {},
            personalFormData: {},
            errors: {},
            companyFormErrors: {},
            nationalCodePic: {},
            dialog: false,
            notifications: false,
            sound: true,
            widgets: false,
            userDetail: {},
            companyDetail: {}


        }
    },

    methods: {
        nextToStep4() {
            if (this.userInfo.length != 0) {
                this.$emit('nextStep', this.userInfo)

            }
            const refForm = this.$refs;
            //this code have problem(code payiini)
            if (refForm.hasOwnProperty('personalForm') && refForm.personalForm !== undefined && this.userInfo.length == 0) {
                (refForm.personalForm.validate() && typeof (this.birthday) !== 'undefined') ? this.$emit('nextStep') : Swal.fire({
                    title: 'اخطار',
                    text: 'تاریخ تولد را وارد نمایید',
                    type: 'warning',
                    confirmButtonText: 'باشه!'
                })
            }
            if (refForm.hasOwnProperty('companyForm') && refForm.companyForm !== undefined && this.userInfo.length == 0) {
                (refForm.companyForm.validate() && typeof (this.agentBirthday) !== 'undefined') ? this.$emit('nextStep') : Swal.fire({
                    title: 'اخطار',
                    text: 'تاریخ تولد را وارد نمایید',
                    type: 'warning',
                    confirmButtonText: 'باشه!'
                })
            }


        }
        ,
        changePersonalFrm() {

            this.$emit('personalFormChange', this.personalFormData);
        }
        ,
        changeCompanyFrm() {
            console.log(this.$refs.nationalCodPic);
            this.$emit('companyFormChange', this.companyFormData);
        }
        ,

        showPersonalForm() {
            if (!this.personalForm) {
                this.$refs.companyForm.resetValidation();
                this.personalForm = true;
                this.companyForm = false;
                this.companyFormData = {};
                this.$emit('deleteCompanyFormData');
                this.$emit('changeUserKind', 0);
            }
        }
        ,
        showCompanyForm() {
            if (!this.companyForm) {
                this.$refs.personalForm.resetValidation();
                this.companyForm = true;
                this.personalForm = false;
                this.personalFormData = {};


                this.$emit('deletePersonalFormData');
                this.$emit('changeUserKind', 1);
            }
        }
        ,
        uploadPic(event) {
            const file = event;
            const reader = new FileReader();
            reader.onload = (image) => {
                //Name of Image
                if (this.personalForm) {
                    this.personalFormData.national_code_pic_name = event.name;
                    // BASE64 Imgae result (self)
                    this.personalFormData.national_code_pic_src = image.target.result;
                    this.changePersonalFrm();
                } else {
                    this.companyFormData.national_code_pic_name = event.name;
                    // BASE64 Imgae result (self)
                    this.companyFormData.national_code_pic_src = image.target.result;
                    this.changeCompanyFrm();
                }

            };
            reader.readAsDataURL(file);
        }
        ,
        login() {
            if (this.$refs.loginForm.validate()) {
                this.loading = true;
                this.$store.dispatch('login', this.LoginInfo)

                    .then(({data}) => {

                        this.dialog = false;
                        if (data.data.user_type == 0) {
                            this.user_kind = 'personal';
                            this.showPersonalForm();
                        }
                        if (data.data.user_type == 1) {
                            this.user_kind = 'company';
                            this.showCompanyForm();
                        }
                        this.$emit('changeUserTypeAfterLogin', data.data.user_type);
                        this.$emit('setUserInfo', data.data);
                    }).catch((error) => {
                    this.errors.username = error.response.data.errors.username != undefined ? error.response.data.errors.username[0] : '';
                    this.errors.password = error.response.data.errors.password != undefined ? error.response.data.errors.password[0] : '';
                }).finally(() => {
                    this.loading = false;
                })
            }


        }

    },
    watch: {

        userInfo: function (value) {

            if (value.user_type == 0) {
                this.personalFormData = value;
            }
            if (value.user_type == 1) {
                this.companyFormData = value;
            }

        },

    },
    created() {
        if (this.$store.state.user.user) {
            axios.get('/api/user').then(({data}) => {

                if (data.user_type === 1) {
                    this.companyForm = true;
                    this.personalForm = false;
                    this.user_kind = 'company'
                } else {
                    this.companyForm = false;
                    this.personalForm = true;
                    this.user_kind = 'personal'
                }

            })
        }

    }


}
</script>

<style scoped>
.select-customer-type-wrap {
    border: 1px solid #dadada;
    background-color: #f9f9f9;
    border-radius: 10px;
}


.select-customer-type-wrap {
    border: 1px solid #dadada;
    background-color: #f9f9f9;
    border-radius: 10px;
}

.person-info-customer-form {
    border: 1px solid #dadada;
    border-radius: 10px;
    background-color: #f9f9f9;
}

.online-chat-wraper {

    border: 1px solid #dadada;
    background-color: #f9f9f9;

    border-radius: 10px;
}

.online-chat-base {
    position: relative;
}

.online-chat-img {
    position: absolute;
    top: -30px;

}

.online-chat-btn {
    text-align: center;
    border: 1px solid blue;
    margin: 10px;
    padding: 6px;
    border-radius: 5px;
}

.online-chat-btn > a {
    text-decoration: none;
}


/*Personal Form*/
.select-customer-type-wrap {
    border: 1px solid #dadada;
    background-color: #f9f9f9;
    border-radius: 10px;
}

.person-info-customer-form {
    border: 1px solid #dadada;
    border-radius: 10px;
    background-color: #f9f9f9;
}

.online-chat-wraper {

    border: 1px solid #dadada;
    background-color: #f9f9f9;

    border-radius: 10px;
}

.online-chat-base {
    position: relative;
}

.my-custom-date-picker {
    border-color: #9f9c9c !important;
    border-bottom-left-radius: 5px !important;
    border-top-left-radius: 5px !important;
    width: 183px !important;
}

.agent-birthday_date input {
    width: 133px !important;

}

.formBoxWrap, .topBoxWrap {
    margin: 0 auto !important;
}

.lowOpacity {
    opacity: .2 !important;
}


</style>
