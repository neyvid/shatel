<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="createDialog=true">ایجاد کد جدید</v-btn>

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
                                <span class="text-h5">ایجاد کد جدید </span>
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
                                                label="شناسه کد"
                                                :rules="[required('شناسه کد')]"
                                                v-model="createItem.code_id"
                                                :error-messages="errors.code_id"

                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="پیش کد"
                                                :rules="[required('پیش کد')]"
                                                v-model="createItem.areacode"
                                                :error-messages="errors.areacode"

                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="استان"
                                                :rules="[required('استان')]"
                                                v-model="createItem.province"
                                                :error-messages="errors.province"

                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="شهر"
                                                :rules="[required('شهر')]"
                                                v-model="createItem.city"
                                                :error-messages="errors.city"

                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="مرکز مخابراتی"
                                                :rules="[required('مرکز مخابراتی')]"
                                                v-model="createItem.telecomcenter"
                                                :error-messages="errors.telecomcenter"

                                            ></v-text-field>
                                        </v-col>

<!--                                        <v-col cols="12">-->
<!--                                            <v-autocomplete-->
<!--                                                :items="provinceData"-->
<!--                                                label="شهر"-->
<!--                                                item-text="name"-->
<!--                                                item-value="id"-->
<!--                                                v-model="createItem.province_id"-->
<!--                                            ></v-autocomplete>-->

<!--                                        </v-col>-->
<!--                                        <v-col cols="12">-->
<!--                                            <v-autocomplete-->
<!--                                                :items="codeData"-->
<!--                                                label="شهر"-->
<!--                                                item-text="name"-->
<!--                                                item-value="id"-->
<!--                                                v-model="createItem.city_id"-->
<!--                                            ></v-autocomplete>-->

<!--                                        </v-col>-->
<!--                                        <v-col cols="12">-->
<!--                                            <v-autocomplete-->
<!--                                                :items="telecomcenterData"-->
<!--                                                label="مرکز مخابرات"-->
<!--                                                item-text="name"-->
<!--                                                item-value="id"-->
<!--                                                v-model="createItem.telecomcenter_id"-->
<!--                                            ></v-autocomplete>-->

<!--                                        </v-col>-->

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
                                @click="createCode"
                            >
                                ذخیره
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <!--                End Modal For create Item-->
            </v-row>
            <v-row>
                <v-col cols="12"  :class="{'text-center':$vuetify.breakpoint.smAndDown}">
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
                    <v-btn @click="importCode" class="mr-4 exelBtn" color="success">
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
                        :items="codeData"
                        :items-per-page="20"
                        class="elevation-1"
                        :search="search"
                    >
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
                                @click="deleteItem(item)"
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
                            <span class="text-h5">ویرایش پیش شماره</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="editForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="پیش شماره"
                                                :rules="[required('پیش شماره')]"
                                                v-model="editItem.areacode"
                                                :error-messages="errors.areacode"

                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="کد شهر"
                                                :rules="[required('کد شهر'),code()]"
                                                v-model="editItem.code"
                                                :error-messages="errors.code"

                                            ></v-text-field>
                                        </v-col>

                                        <v-col
                                            cols="12"

                                        >
                                            <v-autocomplete
                                                :items="provinceData"
                                                label="استان"
                                                item-text="name"
                                                item-value="id"
                                                v-model="editItem.province_id"
                                            ></v-autocomplete>

                                        </v-col>
                                        <v-col
                                            cols="12"

                                        >
                                            <v-autocomplete
                                                :items="codeData"
                                                label="شهر"
                                                item-text="name"
                                                item-value="id"
                                                v-model="editItem.city_id"
                                            ></v-autocomplete>

                                        </v-col>
                                        <v-col
                                            cols="12"

                                        >

                                            <v-autocomplete
                                                :items="telecomcenterData"
                                                label="مرکز مخابرات"
                                                item-text="name"
                                                item-value="id"
                                                v-model="editItem.telecomcenter_id"
                                            ></v-autocomplete>

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

export default {
    name: "index",
    data() {
        return {
            required, code, persianCharachter,
            search: '',
            codeData: [],
            createDialog: false,
            editDialog: false,
            createItem: {},
            editItem: {},
            loading:false,
            provinceData: [],
            telecomcenterData: [],
            errors: [{
                areacode: '',
            }],
            headers: [
                {text: 'شناسه', value: 'code_id'},

                {
                    text: 'پیش شماره',
                    align: 'start',
                    sortable: false,
                    value: 'areacode',
                },
                {text: 'استان', value: 'province'},
                {text: 'شهر', value: 'city'},
                {text: 'مرکزمخابراتی', value: 'telecomcenter'},
                {text: 'عملیات', value: 'actions', sortable: false,},

            ],
        }
    },
    methods: {
        createCode() {
            axios.post('/admin/code/create', this.createItem).then(({data}) => {
                this.codeData.push(data);
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

                    axios.get('/admin/areacode/delete/' + id).then((response) => {

                        const index = this.codeData.map(function (obj) {
                            return obj.id;
                        }).indexOf(id);
                        this.codeData.splice(index, 1);

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
            axios.get('/admin/areacode/edit/' + id).then(({data}) => {
                this.editItem = data;
                this.editDialog = true;
            })

        },
        updateItem() {
            axios.post('/admin/areacode/edit/' + this.editItem.id, this.editItem).then(({data}) => {
                const index = this.codeData.map(function (obj) {
                    return obj.id;
                }).indexOf(this.editItem.id);
                this.codeData[index].areacode = data.areacode;
                this.codeData[index].code = data.code;
                this.codeData[index].province_id = data.province_id;
                this.codeData[index].city_id = data.city_id;
                this.codeData[index].telecomcenter_id = data.telecomcenter_id;
                this.codeData[index].province = data.province;
                this.codeData[index].city = data.province;
                this.codeData[index].telecomcenter = data.telecomcenter;
                this.editDialog = false;

            })
        },
        onFileChange(event) {
            this.exelFile = event;

        },
        importCode() {
            if (this.$refs.exelFormInput.validate()) {

                let currentObj = this;
                this.loading = true;
                const config = {
                    headers: {'content-type': 'multipart/form-data'}
                }
                let formData = new FormData();
                formData.append('file', this.exelFile);

                axios.post('/admin/code/import', formData, config).then(({data}) => {
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
                        this.codeData = data.allData;
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


        }
    },
    created() {
        axios.get('/admin/codes').then(({data}) => {
            this.codeData = data;
        })
    }
}
</script>

<style scoped>

</style>
