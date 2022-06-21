<template>
    <v-main>
        <v-container fluid class="border-bottom">
            <v-container>
                <v-row>
                    <v-col class="pa-0">
                        <v-breadcrumbs
                            class="pa-0"
                            :items="items">
                            <template v-slot:divider>
                                <v-icon>mdi-chevron-left</v-icon>
                            </template>
                        </v-breadcrumbs>
                    </v-col>
                </v-row>
            </v-container>


        </v-container>
        <v-container>
            <v-row class="mt-5 mb-5 ">
                <v-col cols="12" md="8">
                    <h2>بررسی وضعیت دسترسی به ADSL2+</h2>
                    <v-row>
                        <v-col cols="6">
                            <v-form
                                class="mt-8"
                                ref="adslCheckForm"

                                lazy-validation
                            >

<!--                                <v-autocomplete-->
<!--                                    outlined-->
<!--                                    :items="provinceData"-->
<!--                                    label="استان"-->
<!--                                    item-text="name"-->
<!--                                    item-value="id"-->
<!--                                    v-model="checkAdslInfo.province_id"-->
<!--                                    :rules="[required('استان')]"-->
<!--                                    @change="changeProvince(checkAdslInfo.province_id)"-->
<!--                                ></v-autocomplete>-->
<!--                                <v-autocomplete-->
<!--                                    outlined-->
<!--                                    :items="cityData"-->
<!--                                    label="شهر"-->
<!--                                    item-text="name"-->
<!--                                    item-value="id"-->
<!--                                    :rules="[required('شهر')]"-->
<!--                                    v-model="checkAdslInfo.city_id"-->
<!--                                ></v-autocomplete>-->
                                <v-text-field
                                    outlined
                                    label="کد شهر"
                                    :rules="[required('کد'),code()]"
                                    v-model="checkAdslInfo.city_code"
                                    maxlength="3"
                                ></v-text-field>
                                <v-text-field
                                    label="شماره تلفن"
                                    required
                                    outlined
                                    :rules="[required('شماره تلفن'),phoneNumber()]"
                                    v-model="checkAdslInfo.phone_number"
                                    maxlength="8"
                                ></v-text-field>


                                <v-btn
                                    color="primary"
                                    @click="checkAdslSupport"
                                    :loading="loading"
                                >
                                    بررسی وضعیت
                                </v-btn>


                            </v-form>
                        </v-col>
                    </v-row>
                    <!--                    online Order Table start-->
                    <v-expand-transition>
                        <v-row v-if="orderTableShow">
                            <v-col cols="10">
                                <v-simple-table class="simple-table-bordered">
                                    <template v-slot:default>
                                        <thead>
                                        <tr class="blue-bg th-border-simple-table">
                                            <th class="text-right">
                                                شهر
                                            </th>
                                            <th class="text-right">
                                                نام مرکز
                                            </th>
                                            <th class="text-right">
                                                پیش شماره شما
                                            </th>
                                            <th class="text-right">
                                                وضعیت
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class=" td-border-simple-table">
                                            <td class="text-right">{{ areacodeData.city.name }}</td>
                                            <td class="text-right">{{ areacodeData.telecomcenter.name }}</td>
                                            <td class="text-right">{{ areacodeData.areacode }}</td>
                                            <td class="text-right">فعال</td>

                                        </tr>
                                        </tbody>
                                    </template>
                                </v-simple-table>
                                <v-btn class="mt-4 success" @click="buyAdslBtn"> خرید آنلاین</v-btn>
                            </v-col>
                        </v-row>

                    </v-expand-transition>
                    <!--                    online Order Table end-->
                    <!--                    online Order Table start-->
                    <v-expand-transition>
                        <v-row v-if="adslCheckFail">
                            <v-col cols="10">
                                <p>متاسفانه در استان و شهر شما ، این شماره برای دریافت خدمات اینترنت پر سرعت تعریف نشده
                                    است.</p>
                            </v-col>
                        </v-row>

                    </v-expand-transition>
                    <!--                    online Order Table end-->

                </v-col>
                <v-col cols="12" md="4">
                    <div class="widget mb-3  d-flex flew-row">
                        <div class="widget-icon pa-2">
                            <v-img src="/images/front/adslAvailabilityCheck/shatel-online-order.png" width="70"
                                   height="70"></v-img>
                        </div>
                        <div class="widget-content pa-2">
                            <p class="Overline">خرید آنلاین</p>
                            <span class='caption'>خرید خود را اینترنتی انجام دهید</span>
                        </div>
                    </div>
                    <div class="widget mb-3  d-flex flew-row">
                        <div class="widget-icon pa-2">
                            <v-img src="/images/front/adslAvailabilityCheck/shatel-online-order.png" width="70"
                                   height="70"></v-img>
                        </div>
                        <div class="widget-content pa-2">
                            <p class="Overline">خرید آنلاین</p>
                            <span class='caption'>خرید خود را اینترنتی انجام دهید</span>
                        </div>
                    </div>
                    <div class="services-widget widget">
                        <div class="services-widget-title pa-3">
                            <p class="ma-0">خدمات صبا نت</p>
                        </div>
                        <div class="services-widget-content ">
                            <v-treeview hoverable :items="treeItem" transition>
                            </v-treeview>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-container>

    </v-main>
</template>

<script>
import {required, code,moreThan,phoneNumber} from "../../../rules/frontRules";
import router from "../../../router/router";
import Swal from "sweetalert2";
export default {
    name: "AdslServiceAvailabilityCheck",
    data() {

        return {
            orderTableShow: false,
            adslCheckFail: false,
            required,
            code,
             moreThan,
            phoneNumber,
            provinceValue: null,
            loading: false,
            checkAdslInfo: {},
            provinceData: [],
            cityData: [],
            items: [
                {
                    text: 'خانه',
                    disabled: false,
                    href: '/home',
                },
                {
                    text: 'خدمات صبانت',
                    disabled: false,
                    href: 'asd',
                },
                {
                    text: 'بررسی وضعیت دسترسی به ADSL2+',
                    disabled: true,
                    href: 'dassa',
                },
            ],
            treeItem: [
                {
                    id: 1,
                    name: 'اینترنت پرسرعت ADSL2+',

                    children: [
                        {id: 2, name: 'قیمت سروسی ها و تجهیزات اینترنت پرسرعت ثابت (ADSL2+)'},
                        {id: 3, name: 'شیوه استفاده از خدمات ADSL2+'},
                        {id: 4, name: 'خدمات اینترنت پرسرعت شاتل بر بستر بی‌سیم با استفاده از فناوری PTMP'},
                    ],
                },
                {
                    id: 2,
                    name: 'اینترنت پرسرعت ADSL2+',

                    children: [
                        {id: 2, name: 'قیمت سروسی ها و تجهیزات اینترنت پرسرعت ثابت (ADSL2+)'},
                        {id: 3, name: 'شیوه استفاده از خدمات ADSL2+'},
                        {id: 4, name: 'خدمات اینترنت پرسرعت شاتل بر بستر بی‌سیم با استفاده از فناوری PTMP'},
                    ],
                },

            ],
            areacodeData: [],
        }
    },
    methods:
        {
        checkAdslSupport() {
            if (this.$refs.adslCheckForm.validate()) {
                this.loading = true;
                axios.post('/adsl/support/check', this.checkAdslInfo).then(({data}) => {
                    if (data !== '') {
                        this.orderTableShow = true;
                        this.adslCheckFail = false;
                        this.areacodeData = data;
                    }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            text: 'برای این شماره تلفن قبلا درخواست ارسال شده است',
                            showConfirmButton: false,
                            timer: 2500
                        })

                    }
                }).catch(() => {
                    this.adslCheckFail = true;
                    this.orderTableShow = false;
                }).finally(() => {
                    this.loading = false;
                })
            }
        },
        changeProvince(provinceId) {
            axios.get('/adsl/support/getCititesOfProvince/' + provinceId).then(({data}) => {
                this.cityData = data

            })
        },
        buyAdslBtn() {
            axios.post('/adsl/buy/online', this.areacodeData).then(({data}) => {
                if (data !== '') {
                    router.push({name: 'adsl-register'})
                }
            }).catch(() => {
                Swal.fire('خطایی رخ داده است لطفا مجددا تلاش کنید!')
            })
        }
    },
    created() {
        axios.get('/adsl/support/getProvinces').then(({data}) => {
            this.provinceData = data;

        })
        axios.get('/resetSession');
    }
}
</script>

<style scoped>
.Overline, .caption {
    font-family: shabnam !important;
}

</style>
