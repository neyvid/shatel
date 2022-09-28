<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="createDialog=true">ایجاد سفارش جدید</v-btn>

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
                                <span class="text-h5">ایجاد سفارش جدید </span>
                            </v-toolbar-title>
                            <v-spacer></v-spacer>

                        </v-toolbar>
                        <v-card-text>
                            <v-form ref="createForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">

                                            <v-autocomplete

                                                :items="uersInfo"
                                                label="کاربر سفارش دهنده"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.user_id">
                                            </v-autocomplete>
                                            <v-autocomplete
                                                :items="productData"
                                                label="محصول انتخابی"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.products"
                                                multiple
                                            >
                                            </v-autocomplete>
                                            <v-autocomplete
                                                :items="serviceData"
                                                label="سرویس انتخابی"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.services"
                                                multiple
                                            >
                                            </v-autocomplete>
                                            <v-text-field
                                                label="درصد تخفیف"
                                                :rules="[required('درصد تخفیف'),]"
                                                v-model="createItem.discount_amount"
                                                :error-messages="errors.discount_amount"

                                            ></v-text-field>
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
                                @click="createOrder"
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
                            accept=".xlsx"
                            label="برای ورود داده ها توسط فایل اکسل، فایل را انتخاب نمایید(پسوند xlsx.)"
                            :rules="[required('فایل مورد نظر'),]"
                            :error-messages="errors.name"
                            v-on:change="onFileChange"
                        ></v-file-input>

                    </v-form>
                    <v-btn @click="importCity" class="mr-4 exelBtn" color="success">
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
                        :items="orderData"
                        :items-per-page="20"
                        class="elevation-1"
                        :search="search"
                    >
                        <template v-slot:item.status="{ item }">
                            <v-chip
                                :color="getStatusColor(item.status)"
                                dark
                            >
                                {{ item.status }}
                            </v-chip>

                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                class="mr-2"
                                color="success"
                                @click="showEditItem(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                color="error"
                                small
                                @click="deleteItem(item)"
                            >
                                mdi-delete
                            </v-icon>

                            <v-tooltip bottom>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-icon
                                        color="primary"
                                        small
                                        @click="showDetail(item)"
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        mdi-eye
                                    </v-icon>
                                </template>
                                <span>مشاهده جزییات سفارش</span>
                            </v-tooltip>
                        </template>


                    </v-data-table>
                    <template>

                        <div class="text-center">
                            <v-dialog
                                v-model="dialog"
                                width="auto"
                            >


                                <v-card>
                                    <v-card-title class="text-h5 grey lighten-2">
                                        جزییات سفارش
                                    </v-card-title>

                                    <v-card-text>

                                        <v-simple-table dense class="order_detail_dialog">
                                            <thead>
                                            <tr>
                                                <th class="text-center">نوع سفارش</th>
                                                <th class="text-center">نام سفارش</th>
                                                <th class="text-center">قیمت سفارش</th>
                                                <th class="text-center">توضیحات سفارش</th>

                                            </tr>


                                            </thead>
                                            <tbody class="text-center">
                                            <tr v-for="orderItem in orderItems">
                                                <td>
                                                    {{ orderItem.order_type === 'service' ? 'سرویس' : 'محصول' }}
                                                </td>
                                                <td>
                                                    {{ orderItem.name }}
                                                </td>
                                                <td>
                                                    {{
                                                        orderItem.order_type === 'service' ? orderItem.total_price :
                                                            orderItem.price
                                                    }}
                                                </td>
                                                <td>
                                                    {{ orderItem.description }}
                                                </td>


                                            </tr>
                                            </tbody>
                                        </v-simple-table>
                                    </v-card-text>

                                    <v-divider></v-divider>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="primary"
                                            text
                                            @click="dialog = false"
                                        >
                                            بستن
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </div>

                    </template>
                </v-col>

                <!--             Start   Modal For Edit Item-->
                <v-dialog
                    v-model="editDialog"
                    persistent
                    max-width="600px"

                >

                    <v-card>
                        <v-card-title>
                            <span class="text-h5">ویرایش سفارش</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="editForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام سفارش دهنده"
                                                :rules="[required('نام سفارش دهنده'),persianCharachter()]"
                                                v-model="orderUserDetail.name"
                                                :error-messages="errors.name"
                                            ></v-text-field>
                                            <v-text-field
                                                label="نام سفارش دهنده"
                                                :rules="[required('نام سفارش دهنده'),persianCharachter()]"
                                                v-model="orderUserDetail.lastname"
                                                :error-messages="errors.name"
                                            ></v-text-field>

                                            <v-autocomplete
                                                :items="serviceData"
                                                label="سرویس انتخابی"
                                                item-text="name"
                                                item-value="id"
                                                v-model="serviceEdit"
                                                multiple
                                            >
                                            </v-autocomplete>
                                            <v-autocomplete
                                                :items="productData"
                                                label="محصول انتخابی"
                                                item-text="name"
                                                item-value="id"
                                                v-model="productEdit"
                                                multiple
                                            >
                                            </v-autocomplete>
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
                                @click="editDialog=false,editItem=[]"
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
import {code, persianCharachter, required} from "../../../rules/frontRules";
import Swal from "sweetalert2";

export default {
    name: "index",
    data() {
        return {
            required, code, persianCharachter,
            orderData: [],
            loading: false,
search:'',
            uersInfo: [],
            exelFormInput: null,

            orderItems: null,
            userData: [],
            dialog: false,
            serviceData: [],
            productData: {},
            createDialog: false,
            editDialog: false,
            createItem: {
                products: null,
                services: null,

            },
            editItem: {

                services: null,
            },
            productEdit: [],
            serviceEdit: [],
            exelFile: {},
            headers: [

                {
                    text: 'نام سفارش دهنده',
                    align: 'start',
                    sortable: false,
                    value: 'user.name',
                },


                {
                    text: 'نام خانوادگی سفارش دهنده',
                    align: 'start',
                    sortable: false,
                    value: 'user.lastname',
                },
                {
                    text: 'وضعیت سفارش',
                    align: 'start',
                    sortable: false,
                    value: 'status',
                },
                {text: 'عملیات', value: 'actions', sortable: false,},


            ],
            errors: {
                name: null,
                province: null
            },
        }
    },
    methods: {
        getStatusColor (status) {
            if (status ==0) return 'red'
            else return 'green'
        },
        showDetail(item) {
            axios.get('/admin/order/detail/' + item.id).then(({data}) => {
                console.log(data);
                this.orderItems = data;
                this.dialog = true;
            })

        },
        createOrder() {
            axios.post('/admin/order/create', this.createItem).then(({data}) => {

                this.orderData.push(data.order);

                this.createDialog = false;
            })
        },
        deleteItem({id}) {
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

                    axios.get('/admin/oprator/delete/' + id).then((response) => {

                        const index = this.orderData.map(function (obj) {
                            return obj.id;
                        }).indexOf(id);
                        this.orderData.splice(index, 1);

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
            axios.get('/admin/order/edit/' + id).then(({data}) => {
                this.productEdit = [];
                this.serviceEdit = [];
                this.editDialog = true;
                this.editItem = data;
                this.editItem.order_items.forEach(function (item, index, arr) {
                    if (arr[index].item_type === 'product') {
                        this.productEdit.push(arr[index].item_id);
                    }
                    if (arr[index].item_type === 'service') {
                        this.serviceEdit.push(arr[index].item_id);
                    }

                }, this)
            })
        },
        onFileChange(event) {
            this.exelFile = event;
        },
        importCity() {
            if (this.$refs.exelFormInput.validate()) {

                let currentObj = this;
                this.loading = true;
                const config = {
                    headers: {'content-type': 'multipart/form-data'}
                }
                let formData = new FormData();
                formData.append('file', this.exelFile);

                axios.post('/admin/order/import', formData, config).then(({data}) => {
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
                        this.orderData = data.orders;
                        this.productData = data.products;
                        this.serviceData = data.services;
                    }

                }).finally(() => {

                    this.loading = false;
                })
            }


        },
        // formSubmit(e) {
        //     e.preventDefault();
        //     let currentObj = this;
        //     const config = {
        //         headers: {'content-type': 'multipart/form-data'}
        //     }
        //     let formData = new FormData();
        //     formData.append('file', this.exelFile);
        //
        //     axios.post('/admin/order/import', formData, config).then(({data}) => {
        //         console.log(data);
        //         this.orderData = data.orders;
        //         this.productData = data.products;
        //         this.serviceData = data.services;
        //
        //     })
        //
        // }
    },
    created() {
        axios.get('/admin/orders/').then(({data}) => {
            console.log(data);
            this.orderData = data.orders;
            this.productData = data.products;
            this.serviceData = data.services;
            this.uersInfo = data.users;

            // const indexx = this.productData.map(function (obj) {
            //     return obj.id;
            // });
            // const result = {};
            // for (let index = 0; index < this.productData.length; ++index) {
            //     result[this.productData[index]] = indexx[index];
            // }
            // console.log(result);
            // console.log(indexx);
        })
    },
    computed: {
        orderUserDetail() {
            return this.editItem.user ? this.editItem.user : '';
        },
        // orderItemDetail() {
        //     this.editItem.order_items.forEach(function (item, index, arr) {
        //         return item.name;
        //     })
        //
        // }
    },
}

</script>

<style scoped>

</style>
