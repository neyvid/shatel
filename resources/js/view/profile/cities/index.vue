<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="createDialog=true">ایجاد شهر جدید</v-btn>

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
                                <span class="text-h5">ایجاد شهر جدید </span>
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
                                                label="نام شهر"
                                                :rules="[required('نام شهر'),persianCharachter('نام شهر')]"
                                                v-model="createItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-autocomplete
                                                :items="provinceData"
                                                label="استان"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.province_id"
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
                <v-col cols="12"  :class="{'text-center':$vuetify.breakpoint.smAndDown}">
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
                        :items="cityData"
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
                            <span class="text-h5">ویرایش استان</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="editForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام استان"
                                                :rules="[required('نام استان'),persianCharachter('نام استان')]"
                                                v-model="editItem.name"
                                                :error-messages="errors.name"

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

import {required, code, persianCharachter} from "../../../rules/frontRules";
import Swal from 'sweetalert2'

export default {
    name: "index",
    data() {
        return {
            exelFormInput: null,
            required, code, persianCharachter,
            cityData: [],
            search:'',
            createDialog: false,
            editDialog: false,
            provinceData: [],
            loading: false,
            editItem: {},
            headers: [
                {
                    text: 'نام شهر',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                {text: 'استان', value: 'province.name'},
                {text: 'عملیات', value: 'actions', sortable: false,},

            ],
            errors: {
                name: null,
                province: null
            },
            createItem: {
                name: null,
                province_id: null
            },
        }
    },
    methods: {
        createCity() {
            axios.post('/admin/cities/create', this.createItem).then(({data}) => {
                this.cityData.push(data);
                this.createDialog = false;
            })
        },
        showEditItem({id}) {
            axios.get('/admin/city/edit/' + id).then(({data}) => {
                this.editItem.name = data.name;
                this.editItem.id = data.id;
                this.editItem.province_id = data.province.id;

                this.editDialog = true;
            })
        },
        updateItem() {
            axios.post('/admin/city/edit/' + this.editItem.id, this.editItem).then(({data}) => {
                const index = this.cityData.map(function (obj) {
                    return obj.id;
                }).indexOf(this.editItem.id);

                this.cityData[index].name = data.name;
                this.cityData[index].province_id = data.province_id;
                this.cityData[index].province = data.province;
                this.editDialog = false;


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
                    axios.get('/admin/city/delete/' + id).then((response) => {
                        const index = this.cityData.map(function (obj) {
                            return obj.id;
                        }).indexOf(id);
                        this.cityData.splice(index, 1);

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

                axios.post('/admin/city/import', formData, config).then(({data}) => {
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
                        this.cityData = data.allData.cities;
                        this.provinceData = data.allData.provinces;
                    }

                }).finally(() => {

                    this.loading = false;
                })
            }


        }
    },
    created() {
        axios.get('/admin/cities').then(({data}) => {
            this.cityData = data.cities;
            this.provinceData = data.provinces;
        })
    }

}
</script>

<style scoped>
.text-h5 {
    font-family: Shabnam !important;
}
</style>

