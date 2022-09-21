<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="createDialog=true">ایجاد سرویس جدید</v-btn>

                </v-col>
                <!--             Start   Modal For create Item-->

                <v-dialog
                    v-model="createDialog"
                    fullscreen
                    hide-overlay
                    transition="dialog-bottom-transition"

                >

                    <v-card>
                        <v-toolbar
                            dark
                            class="orange darken-1"
                        >

                            <v-toolbar-title>
                                <span class="text-h5">ایجاد سرویس جدید </span>
                            </v-toolbar-title>
                            <v-spacer></v-spacer>

                        </v-toolbar>
                        <v-card-text>
                            <v-form ref="createForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام سرویس"
                                                :rules="[required('نام سرویس'),persianCharachter()]"
                                                v-model="createItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>

                                            <v-text-field
                                                label="شناسه سرویس"
                                                :rules="[required('شناسه سرویس')]"
                                                v-model="createItem.service_id"
                                                :error-messages="errors.service_id"

                                            ></v-text-field>
                                            <v-autocomplete
                                                :items="opratorData"
                                                label="اپراتور سرویس دهنده"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.oprator_id"
                                                :rules="[required('اپراتور')]"
                                            ></v-autocomplete>
                                            <v-autocomplete
                                                :items="typeData"
                                                label="نوع سرویس"
                                                item-text="type_name"
                                                item-value="type"
                                                v-model="createItem.type"
                                                :rules="[required( 'نوع سرویس')]"
                                            ></v-autocomplete>
                                            <v-autocomplete
                                                :items="planData"
                                                label="طرح سرویس"
                                                item-text="plan_name"
                                                item-value="plan"
                                                v-model="createItem.plan"
                                                :rules="[required('طرح سرویس')]"
                                            ></v-autocomplete>

                                            <v-text-field
                                                label="قیمت پایه (تومان)"
                                                :rules="[required('قیمت پایه')]"
                                                v-model="createItem.base_price"
                                                :error-messages="errors.base_price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="قیمت فروش (تومان)"
                                                :rules="[required('قیمت فروش')]"
                                                v-model="createItem.sell_price"
                                                :error-messages="errors.sell_price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="مبنای محاسبه پورسانت (تومان)"
                                                :rules="[required('مبنای محاسبه پورسانت')]"
                                                v-model="createItem.commission_price"
                                                :error-messages="errors.commission_price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="قیمت کل (تومان)"
                                                :rules="[required('قیمت سرویس')]"
                                                v-model="createItem.total_price"
                                                :error-messages="errors.price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="میزان تخفیف(درصد)"
                                                :rules="[required('میزان تخفیف')]"
                                                v-model="createItem.discount"
                                                :error-messages="errors.discount"

                                            ></v-text-field>
                                            <v-text-field
                                                label="مدت زمان سرویس"
                                                :rules="[required('مدت زمان سرویس')]"
                                                v-model="createItem.period"
                                                :error-messages="errors.period"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان ترافیک شبانه "
                                                :rules="[required('میزان ترافیک شبانه ')]"
                                                v-model="createItem.night_trafic"
                                                :error-messages="errors.night_trafic"

                                            ></v-text-field>
                                            <v-text-field
                                                label="سرعت (Kb/s)"
                                                :rules="[required('سرعت')]"
                                                v-model="createItem.speed"
                                                :error-messages="errors.speed"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان محدودیت "
                                                :rules="[required('میزان محدودیت ')]"
                                                v-model="createItem.limit_amount"
                                                :error-messages="errors.limit_amount"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" شناسه قیمت "
                                                :rules="[required('شناسه فروش')]"
                                                v-model="createItem.price_id"
                                                :error-messages="errors.price_id"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" شناسه دسترسی "
                                                :rules="[required('شناسه دسترسی')]"
                                                v-model="createItem.available_id"
                                                :error-messages="errors.available_id"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان ترافیک بین المللی(MB) "
                                                :rules="[required('میزان ترافیک بین المللی ')]"
                                                v-model="createItem.international_trafic"
                                                :error-messages="errors.international_trafic"

                                            ></v-text-field>
                                            <!--sell zone is telecomcenter_id-->
                                            <v-autocomplete
                                                :items="telecomcenterData"
                                                label="منطقه فروش"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.telecomcenter_id"
                                                :rules="[required('منطقه فروش')]"
                                            ></v-autocomplete>
                                            <v-autocomplete
                                                :items="categoryData"
                                                label="دسته بندی سرویس"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.category_id"
                                                :rules="[required('دسته بندی سرویس')]"
                                            ></v-autocomplete>
                                            <date-picker v-model="createItem.expire_date"
                                                         label="اعتبار سرویس تا :"
                                            ></date-picker>
                                            <v-textarea
                                                class="mt-4"
                                                label="توضیحات"
                                                :rules="[required('توضیحات')]"
                                                v-model="createItem.description"
                                                :error-messages="errors.description"
                                            ></v-textarea>


                                        </v-col>


                                    </v-row>
                                </v-container>
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="createDialog=false"
                            >
                                انصراف
                            </v-btn>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="createService"
                            >
                                ذخیره
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <!--                End Modal For create Item-->
            </v-row>

            <v-row>
                <v-col cols="12" :class="{'text-center':$vuetify.breakpoint.smAndDown}">
                    <v-form class="d-flex align-center" ref="exelFormInput"
                            enctype="multipart/form-data">
                        <v-file-input
                            ref="inputExelFile"
                            accept=".xlsx"
                            label="برای ورود داده ها توسط فایل اکسل، فایل را انتخاب نمایید(پسوند xlsx.)"
                            :rules="[required('فایل مورد نظر'),]"
                            :error-messages="errors.name"
                            v-on:change="onFileChange"
                        ></v-file-input>

                    </v-form>
                    <v-btn @click="importService" class="mr-4 exelBtn" color="success">
                        <template v-if="loading">
                            <v-progress-circular
                                indeterminate
                                color="white"
                            ></v-progress-circular>
                            درحال انتفال
                        </template>
                        <template v-else>
                            انتقال از اکسل به پایگاه داده
                        </template>
                    </v-btn>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="جسنجو کنید..."
                        single-line
                        hide-details
                        class="mb-8"
                    ></v-text-field>
                    <v-data-table
                        :headers="headers"
                        :items="servicesData"
                        :items-per-page="20"
                        class="elevation-1"
                        :search="search"

                        :expanded.sync="expanded"
                        show-expand
                    >
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length">
                                <tr>توضیحات: {{ item.description }}</tr>
                                <tr>شناسه قیمت: {{ item.price_id }}</tr>
                                <tr>قیمت پایه:{{ item.base_price }}</tr>
                                <tr>قیمت فروش:{{ item.sell_price }}</tr>
                            </td>

                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                class="mr-2"
                                @click="showEditItem(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                small
                                @click="deleteItem(item.id)"
                            >
                                mdi-delete
                            </v-icon>
                        </template>


                    </v-data-table>
                </v-col>

                <!--             Start   Modal For Edit Item-->
                <v-dialog
                    v-model="editDialog"
                    persistent
                    max-width="600px"

                >

                    <v-card>
                        <v-card-title>
                            <span class="text-h5">ویرایش سرویس</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="editForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام سرویس"
                                                :rules="[required('نام سرویس'),persianCharachter()]"
                                                v-model="editItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>
                                            <v-text-field
                                                label="شناسه سرویس"
                                                :rules="[required('شناسه سرویس')]"
                                                v-model="editItem.service_id"
                                                :error-messages="errors.service_id"

                                            ></v-text-field>
                                            <v-autocomplete
                                                :items="opratorData"
                                                label="اپراتور سرویس دهنده"
                                                item-text="name"
                                                item-value="id"
                                                v-model="editItem.oprator_id"
                                                :rules="[required('اپراتور')]"
                                            ></v-autocomplete>
                                            <v-autocomplete
                                                :items="typeData"
                                                label="نوع سرویس"
                                                item-text="type_name"
                                                item-value="type"
                                                v-model="editItem.type"
                                                :rules="[required( 'نوع سرویس')]"
                                            ></v-autocomplete>
                                            <v-autocomplete
                                                :items="planData"
                                                label="طرح سرویس"
                                                item-text="plan_name"
                                                item-value="plan"
                                                v-model="editItem.plan"
                                                :rules="[required('طرح سرویس')]"
                                            ></v-autocomplete>
                                            <v-text-field
                                                label="قیمت پایه (تومان)"
                                                :rules="[required('قیمت پایه')]"
                                                v-model="editItem.base_price"
                                                :error-messages="errors.base_price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="قیمت فروش (تومان)"
                                                :rules="[required('قیمت فروش')]"
                                                v-model="editItem.sell_price"
                                                :error-messages="errors.sell_price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="مبنای محاسبه پورسانت (تومان)"
                                                :rules="[required('مبنای محاسبه پورسانت')]"
                                                v-model="editItem.commission_price"
                                                :error-messages="errors.commission_price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="قیمت کل (تومان)"
                                                :rules="[required('قیمت سرویس')]"
                                                v-model="editItem.total_price"
                                                :error-messages="errors.price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="میزان تخفیف(درصد)"
                                                :rules="[required('میزان تخفیف')]"
                                                v-model="editItem.discount"
                                                :error-messages="errors.discount"

                                            ></v-text-field>
                                            <v-text-field
                                                label="مدت زمان سرویس"
                                                :rules="[required('مدت زمان سرویس')]"
                                                v-model="editItem.period"
                                                :error-messages="errors.period"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان ترافیک شبانه "
                                                :rules="[required('میزان ترافیک شبانه ')]"
                                                v-model="editItem.night_trafic"
                                                :error-messages="errors.night_trafic"

                                            ></v-text-field>
                                            <v-text-field
                                                label="سرعت (Kb/s)"
                                                :rules="[required('سرعت')]"
                                                v-model="editItem.speed"
                                                :error-messages="errors.speed"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان محدودیت "
                                                :rules="[required('میزان محدودیت ')]"
                                                v-model="editItem.limit_amount"
                                                :error-messages="errors.limit_amount"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" شناسه قیمت "
                                                :rules="[required('شناسه فروش')]"
                                                v-model="editItem.price_id"
                                                :error-messages="errors.price_id"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" شناسه دسترسی "
                                                :rules="[required('شناسه دسترسی')]"
                                                v-model="editItem.available_id"
                                                :error-messages="errors.available_id"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان ترافیک بین المللی(MB) "
                                                :rules="[required('میزان ترافیک بین المللی ')]"
                                                v-model="editItem.international_trafic"
                                                :error-messages="errors.international_trafic"

                                            ></v-text-field>
                                            <v-autocomplete
                                                :items="telecomcenterData"
                                                label="منطقه فروش"
                                                item-text="name"
                                                item-value="id"
                                                v-model="editItem.telecomcenter_id"
                                                :rules="[required('منطقه فروش')]"
                                            ></v-autocomplete>
                                            <v-autocomplete
                                                :items="categoryData"
                                                label="دسته بندی سرویس"
                                                item-text="name"
                                                item-value="id"
                                                v-model="editItem.category_id"
                                                :rules="[required('دسته بندی سرویس')]"
                                            ></v-autocomplete>
                                            <date-picker v-model="editItem.expire_date"
                                                         label="اعتبار سرویس تا :"
                                            ></date-picker>

                                            <v-textarea
                                                class="mt-4"
                                                label="توضیحات"
                                                :rules="[required('توضیحات')]"
                                                v-model="editItem.description"
                                                :error-messages="errors.description"
                                            ></v-textarea>

                                        </v-col>


                                    </v-row>
                                </v-container>
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="editDialog=false"
                            >
                                انصراف
                            </v-btn>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="updateItem"
                            >
                                ذخیره
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <!--                End Modal For Edit Item-->
            </v-row>

        </v-container>
    </v-main>
</template>

<script>
import {required, code, persianCharachter} from '../../../rules/frontRules'
import Swal from "sweetalert2";
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

export default {
    name: "index",
    data() {
        return {
            required, code, persianCharachter,
            expanded: [],
            servicesData: [],
            createDialog: false,
            search: '',
            editDialog: false,
            typeData: {},
            planData: {},
            opratorData: {},
            loading: false,
            telecomcenterData: {},
            categoryData: {},
            createItem: {},
            editItem: {},
            headers: [
                {
                    text: 'نام سرویس',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },

                {text: 'شناسه سرویس', value: 'service_id', sortable: false,},
                // {text: 'اپراتور', value: 'oprator.name', sortable: false,},
                {text: 'نوع', value: 'type', sortable: false,},
                {text: 'طرح', value: 'plan', sortable: false,},
                // {text: 'شناسه قیمت', value: 'price_id', sortable: false,},
                // {text: ' قیمت پایه', value: 'base_price', sortable: false,},
                // {text: ' قیمت فروش', value: 'sell_price', sortable: false,},
                // {text: 'دسته سرویس', value: 'categories[0].name', sortable: false,},
                {text: ' مبنای پورسانت', value: 'commission_price', sortable: false,},
                {text: ' قیمت کل', value: 'total_price', sortable: false,},
                {text: 'تخفیف (%)', value: 'discount', sortable: false,},
                // {text: ' منطقه فروش', value: 'telecomcenter.name', sortable: false,},
                {text: 'تاریخ اعتبار', value: 'expire_date', sortable: false,},
                {text: 'زمان', value: 'period', sortable: false,},
                {text: 'شناسه قیمت', value: 'price_id', sortable: false,},
                {text: 'شناسه دسترسی', value: 'available_id', sortable: false,},
                {text: 'ترافیک شبانه', value: 'night_trafic', sortable: false,},
                {text: 'سرعت', value: 'speed', sortable: false,},
                {text: 'میزان محدودیت', value: 'limit_amount', sortable: false,},
                {text: 'ترافیک بین المللی', value: 'international_trafic', sortable: false,},
                // {text: 'توضیحات', value: 'description', sortable: false,},
                {text: 'عملیات', value: 'actions', sortable: false,},

            ],
            errors: {
                name: null,
                province: null
            },

            menu2: false,
        }

    },
    components: {
        datePicker: VuePersianDatetimePicker
    },
    methods: {
        createService() {
            axios.post('/admin/service/create', this.createItem).then(({data}) => {
                console.log(data);
                this.servicesData.push(data);
                this.createDialog = false;
            })
        },
        deleteItem(id) {

            Swal.fire({
                title: 'از حذف این گزینه مطمئن هستید؟',
                text: "درصورت حذف، قابل برگشت نمی باشد",
                icon: 'اخطار',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'انصراف',
                confirmButtonText: '!بله مطمئن هستم'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('/admin/service/delete/' + id).then(() => {
                        const index = this.servicesData.map(function (obj) {
                            return obj.id;
                        }).indexOf(id);
                        this.servicesData.splice(index, 1);

                    }).catch((error) => {
                        alert('خطایی در حذف رخ داده است لطفا مجددا تلاش کنید.')

                    })
                    Swal.fire(
                        {
                            title: '!حذف شد',
                            text: '.گزینه مورد نظر با موفقیت حذف شد',
                            type: 'success',
                            confirmButtonText: 'باشه!'
                        }
                    )
                }
            })
        },
        showEditItem({id}) {
            axios.get('/admin/service/edit/' + id).then(({data}) => {
                // console.log(data.oprator.name);

                this.editItem = data;
                this.editDialog = true;
            })
        },
        updateItem() {
            axios.post('/admin/service/edit/' + this.editItem.id, this.editItem).then(({data}) => {
                console.log(data);
                const index = this.servicesData.map(function (obj) {
                    return obj.id;
                }).indexOf(this.editItem.id);
                // this.servicesData[index].oprator = data.oprator;
                this.servicesData[index].name = data.name;
                this.servicesData[index].type = data.type_name;
                this.servicesData[index].plan = data.plan_name;
                this.servicesData[index].discount = data.discount;
                this.servicesData[index].period = data.period;
                this.servicesData[index].expire_date = data.expire_date;
                this.servicesData[index].night_trafic = data.night_trafic;
                this.servicesData[index].limit_amount = data.limit_amount;
                this.servicesData[index].speed = data.speed;
                this.servicesData[index].international_trafic = data.international_trafic;
                this.servicesData[index].description = data.description;
                this.servicesData[index].commission_price = data.commission_price;
                this.servicesData[index].total_price = data.total_price;
                this.servicesData[index].sell_price = data.sell_price;
                this.servicesData[index].base_price = data.base_price;
                this.servicesData[index].available_id = data.available_id;
                this.servicesData[index].price_id = data.price_id;
                this.servicesData[index].service_id = data.service_id;
                this.servicesData[index].telecomcenter = data.telecomcenter;
                // this.servicesData[index].category_id = data.category_id;
                // this.servicesData[index].categories = data.categories;


                this.editDialog = false;

            })
        },
        onFileChange(event) {

            this.exelFile = event;
        },
        importService() {
            if (this.$refs.exelFormInput.validate()) {

                let currentObj = this;
                this.loading = true;
                const config = {
                    headers: {'content-type': 'multipart/form-data'}
                }
                let formData = new FormData();
                formData.append('file', this.exelFile);

                axios.post('/admin/service/import', formData, config).then(({data}) => {
                    if (!data.status) {
                        Swal.fire(
                            {
                                title: 'خطایی رخ داده!',
                                text: data.message,
                                type: 'warning',
                                confirmButtonText: 'متوجه شدم!'
                            }
                        )
                    } else {
                        this.servicesData = data.allData.services;
                        this.typeData = data.allData.type;
                        this.planData = data.allData.plan;
                        // this.opratorData = data.allData.oprators;
                        // this.telecomcenterData = data.allData.telecomcentes;
                        // this.categoryData = data.allData.categories;
                    }
                }).finally(() => {
                    this.loading = false;
                    this.$refs.inputExelFile.reset();
                    Swal.fire(
                        {
                            title: 'عملیات تکمیل شد !',
                            text: 'داده های اکسل به درستی وارد شد',
                            type: 'success',
                            confirmButtonText: 'باشه!'
                        }
                    )
                })
            }


        },
    },
    created() {
        axios.get('/admin/services/').then(({data}) => {

            this.servicesData = data.services;
            this.typeData = data.type;
            this.planData = data.plan;
            // this.opratorData = data.oprators;
            // this.telecomcenterData = data.telecomcentes;
            // this.categoryData = data.categories;

        })
    }
}
</script>

<style scoped>

</style>
