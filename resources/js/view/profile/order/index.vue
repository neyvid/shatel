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
                    persistent
                    max-width="600px"
                >

                    <v-card>
                        <v-card-title>
                            <span class="text-h5">ایجاد سفارش جدید</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="createForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام اپراتور"
                                                :rules="[required('نام شهر'),persianCharachter()]"
                                                v-model="createItem.name"
                                                :error-messages="errors.name"

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
                                @click="createCity"
                            >
                                ذخیره
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <!--                End Modal For create Item-->
            </v-row>
            <v-row>
                <v-row>
                    <v-col cols="10" >
                        <form class="d-flex align-center" @submit="formSubmit" enctype="multipart/form-data">
                            <v-file-input label="برای ورود داده ها توسط فایل اکسل، فایل را انتخاب نمایید"  v-on:change="onFileChange"></v-file-input>
                            <v-btn type="submit" class="mr-4" color="success">انتقال از اکسل به پایگاه داده</v-btn>
                        </form>
                    </v-col>
                </v-row>
            </v-row>
            <v-row>
                <v-col>

                    <v-data-table
                        :headers="headers"
                        :items="orderData"
                        :items-per-page="20"
                        class="elevation-1"
                    >

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

                                        <v-simple-table dense  class="order_detail_dialog">
                                            <thead>
                                            <tr>
                                                <th class="text-center">نوع سفارش</th>
                                                <th  class="text-center">نام سفارش</th>
                                                <th  class="text-center">قیمت سفارش</th>
                                                <th  class="text-center">توضیحات سفارش</th>

                                            </tr>


                                            </thead>
                                            <tbody class="text-center">
                                            <tr v-for="orderItem in orderItems">
                                                <td >
                                                    {{orderItem.order_type==='service' ? 'سرویس':'محصول'}}
                                                </td>
                                                <td >
                                                    {{orderItem.name}}
                                                </td>
                                                <td >
                                                    {{orderItem.order_type==='service' ? orderItem.total_price : orderItem.price}}
                                                </td>
                                                <td >
                                                    {{orderItem.description}}
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
                            <span class="text-h5">ویرایش استان</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="editForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام اپراتور"
                                                :rules="[required('نام اپراتور'),persianCharachter()]"
                                                v-model="editItem.name"
                                                :error-messages="errors.name"

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
import {code, persianCharachter, required} from "../../../rules/frontRules";
import Swal from "sweetalert2";

export default {
    name: "index",
    data() {
        return {
            required, code, persianCharachter,
            orderData: [],
            orderItems: null,
            userData: [],
            dialog: false,
            serviceData: [],
            productData: {},
            createDialog: false,
            editDialog: false,
            createItem: {},
            editItem: {},
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
        showDetail(item) {
            axios.get('/admin/order/detail/' + item.id).then(({data}) => {
                console.log(data);
                this.orderItems = data;
                this.dialog = true;
            })

        },
        createCity() {
            axios.post('/admin/oprator/create', this.createItem).then(({data}) => {
                this.orderData.push(data);
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
            axios.get('/admin/oprator/edit/' + id).then(({data}) => {
                this.editDialog = true;
                this.editItem.name = data.name
                this.editItem.id = data.id
            })
        },

        onFileChange(event) {
            this.exelFile = event;
        },
        formSubmit(e) {
            e.preventDefault();
            let currentObj = this;
            const config = {
                headers: {'content-type': 'multipart/form-data'}
            }
            let formData = new FormData();
            formData.append('file', this.exelFile);

            axios.post('/admin/order/import', formData, config).then(({data}) => {
                console.log(data);
                this.orderData = data.orders;
                this.productData = data.products;
                this.serviceData = data.services;

            })

        }
    },
    created() {
        axios.get('/admin/orders/').then(({data}) => {
            console.log(data);
            this.orderData = data.orders;
            this.productData = data.products;
            this.serviceData = data.services;

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
    }
}
</script>

<style scoped>

</style>
