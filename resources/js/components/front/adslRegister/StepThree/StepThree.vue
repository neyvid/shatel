<template>
    <div>
        <v-stepper-items>

            <v-stepper-content step="3">
                <p class="mt-8">تکمیل اطلاعات </p>
                <v-divider></v-divider>
                <v-row class="mt-15">
                    <v-col cols="8">
                        <div class="select-customer-type-wrap d-flex justify-center">
                            <v-radio-group

                                row
                                mandatory
                            >
                                <v-radio
                                    label="شخصی"
                                    value="radio-1"
                                    @click="showPersonalForm"
                                ></v-radio>
                                <v-radio
                                    label="سازمان ها و شرکت ها"
                                    value="radio-2"
                                    @click="showCompanyForm"
                                ></v-radio>
                            </v-radio-group>
                        </div>

                    </v-col>

                </v-row>
                <v-row v-if="personalForm" class="mt-15">
                    <v-col cols="12" md="8">
                        <v-row>
                            <v-col cols="12">
                                <div class="person-info-customer-form">

                                    <v-form
                                        class="pa-15"
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


                                        <date-picker v-model="personalFormData.birthday_date"
                                                     label="تاریخ تولد:"

                                                     color="dimgray" simple
                                                     @input="changePersonalFrm"

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
                                            label="تصویر کارت ملی"
                                            outlined
                                            dense
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
                    <v-col cols="12" md="4" class="online-chat-base">

                        <div class="online-chat-wraper text-center">
                            <v-img class="online-chat-img" src="images/front/adslRegister/online-chat-pic.png"
                                   width="80"
                                   height="80" contain></v-img>
                            <h4 class="mt-15 mx-5">
                                لطفا به موارد زیر توجه فرمایید:
                            </h4>
                            <p class="mx-5 mt-5">یک آدرس ایمیل معتبر وارد کنید.</p>
                            <p class="mx-5 mt-5">
                                به راهنمایی نیاز دارید؟

                            </p>

                            <p class="online-chat-btn">
                                <a href="#" class="d-inline-block">
                                    <v-icon color="blue">mdi-chat</v-icon>
                                    <span>
                                       گفتگوی آنلاین با کارشناسان فروش
                                </span>
                                </a>
                            </p>
                        </div>
                    </v-col>
                </v-row>
                <v-row v-if="companyForm" class="mt-15">
                    <v-col cols="12" md="8">
                        <v-row>


                            <v-col cols="12">
                                <div class="person-info-customer-form">

                                    <v-form
                                        class="pa-15"
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
                                            :rules="[required('تصویر کارت ملی ')]"

                                            outlined
                                            dense
                                            @change="uploadPic"

                                        ></v-file-input>
                                        <date-picker v-model="companyFormData.birthday_date"
                                                     label="تاریخ تولد نمایده:"
                                                     color="dimgray" simple
                                                     @input="changeCompanyFrm"
                                        ></date-picker>
                                        <v-text-field
                                            v-model="companyFormData.mobile"
                                            @input="changeCompanyFrm"
                                            :rules="[required('موبایل ')]"
                                            :error-messages="companyFormErrors.mobile"
                                            label=" شماره موبایل نماینده"
                                            required
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
                    <v-col cols="12" md="4" class="online-chat-base">

                        <div class="online-chat-wraper text-center">
                            <v-img class="online-chat-img" src="images/front/adslRegister/online-chat-pic.png"
                                   width="80"
                                   height="80" contain></v-img>
                            <h4 class="mt-15 mx-5">
                                لطفا به موارد زیر توجه فرمایید:
                            </h4>
                            <p class="mx-5 mt-5">یک آدرس ایمیل معتبر وارد کنید.</p>
                            <p class="mx-5 mt-5">
                                به راهنمایی نیاز دارید؟

                            </p>

                            <p class="online-chat-btn">
                                <a href="#" class="d-inline-block">
                                    <v-icon color="blue">mdi-chat</v-icon>
                                    <span>
                                       گفتگوی آنلاین با کارشناسان فروش
                                </span>
                                </a>
                            </p>
                        </div>
                    </v-col>
                </v-row>

                <v-btn
                    color="primary"
                    @click="nextToStep4"
                    class="mt-8"
                >
                    ادامه
                    <v-icon>mdi-chevron-left</v-icon>

                </v-btn>
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
import {required, persianCharachter, codeCheck, postalCode,email} from '../../../../rules/frontRules'
import store from '../../../../store'

export default {
    name: "StepThree",
    props: ['userInfo'],
    data() {
        return {
            required, persianCharachter, codeCheck, postalCode,email,
            companyType: [
                {name: 'خصوصی', value: 1},
                {name: 'سهامی عام', value: 2}
            ],
            agent_nationality: [
                {name: 'ایرانی', value: 1},
                {name: 'غیر ایرانی', value: 2},
            ],
            gender: [
                {name: 'زن', value: 2},
                {name: 'مرد', value: 1}
            ],
            personalForm: true,
            companyForm: false,
            companyFormData: {},
            personalFormData: {},
            errors: {},
            companyFormErrors: {},
            nationalCodePic: {},


        }
    },

    methods: {
        nextToStep4() {
            const refForm = this.$refs;
            if (refForm.hasOwnProperty('personalForm') && refForm.personalForm !== undefined) {

                refForm.personalForm.validate() ? this.$emit('nextStep') : '';
            }

            if (refForm.hasOwnProperty('companyForm') && refForm.companyForm !== undefined) {
                refForm.companyForm.validate() ? this.$emit('nextStep') : '';
            }


        },
        changePersonalFrm() {
            this.$emit('personalFormChange', this.personalFormData);
        },
        changeCompanyFrm() {
            this.$emit('companyFormChange', this.companyFormData);
        },
        showPersonalForm() {
            if (!this.personalForm) {

                this.$refs.companyForm.resetValidation();
                this.personalForm = true;
                this.companyForm = false;
                this.companyFormData = {};
                this.$emit('deleteCompanyFormData');
            }
        },
        showCompanyForm() {
            if (!this.companyForm) {
                this.$refs.personalForm.resetValidation();

                this.companyForm = true;
                this.personalForm = false;
                this.personalFormData = {};


                this.$emit('deletePersonalFormData');
            }
        },
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


    },


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
}
</style>
