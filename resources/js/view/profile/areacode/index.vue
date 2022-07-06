<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="createDialog=true">ایجاد پیش شماره جدید</v-btn>

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
                                <span class="text-h5">ایجاد پیش شماره جدید </span>
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
                                                label="پیش شماره"
                                                :rules="[required('پیش شماره')]"
                                                v-model="createItem.areacode"
                                                :error-messages="errors.areacode"

                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="کد شهر"
                                                :rules="[required('کد شهر'),code()]"
                                                v-model="createItem.code"
                                                :error-messages="errors.code"

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
                                        <v-col cols="12">
                                            <v-autocomplete
                                                :items="cityData"
                                                label="شهر"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.city_id"
                                            ></v-autocomplete>

                                        </v-col>
                                        <v-col cols="12">
                                            <v-autocomplete
                                                :items="telecomcenterData"
                                                label="مرکز مخابرات"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.telecomcenter_id"
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
                                @click="createAreacode"
                            >
                                ذخیره
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <!--                End Modal For create Item-->
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
                        :items="areaCodeData"
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
                                                :items="cityData"
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
            areaCodeData: [],
            createDialog: false,
            editDialog: false,
            createItem: {},
            editItem: {},
            cityData: [],
            provinceData: [],
            telecomcenterData: [],
            errors: [{
                areacode: '',
            }],
            headers: [
                {
                    text: 'پیش شماره',
                    align: 'start',
                    sortable: false,
                    value: 'areacode',
                },
                {text: 'استان', value: 'province.name'},
                {text: 'شهر', value: 'city.name'},
                {text: 'مرکزمخابراتی', value: 'telecomcenter.name'},
                {text: 'کد', value: 'code'},
                {text: 'عملیات', value: 'actions', sortable: false,},

            ],
        }
    },
    methods: {

        createAreacode() {
            axios.post('/admin/areacode/create', this.createItem).then(({data}) => {
                this.areaCodeData.push(data);
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

                        const index = this.areaCodeData.map(function (obj) {
                            return obj.id;
                        }).indexOf(id);
                        this.areaCodeData.splice(index, 1);

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
                const index = this.areaCodeData.map(function (obj) {
                    return obj.id;
                }).indexOf(this.editItem.id);
                this.areaCodeData[index].areacode = data.areacode;
                this.areaCodeData[index].code = data.code;
                this.areaCodeData[index].province_id = data.province_id;
                this.areaCodeData[index].city_id = data.city_id;
                this.areaCodeData[index].telecomcenter_id = data.telecomcenter_id;
                this.areaCodeData[index].province = data.province;
                this.areaCodeData[index].city = data.province;
                this.areaCodeData[index].telecomcenter = data.telecomcenter;
                this.editDialog = false;


            })
        }
    },
    created() {

        axios.get('/admin/areacodes').then(({data}) => {
            // console.log(data)
            this.areaCodeData = data.areacodes;
            this.provinceData = data.provinces;
            this.cityData = data.cities;
            this.telecomcenterData = data.telecomcenters;
        })
    }
}
</script>

<style scoped>

</style>
