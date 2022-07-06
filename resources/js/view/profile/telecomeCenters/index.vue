<template>
    <v-main>
        <v-container fluid>

            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="createDialog=true">ایجاد مرکزمخابراتی جدید</v-btn>
                    <v-btn rounded class="error" v-if="itemSelected.length!=0" @click="itemsGroupDelete">حذف همه
                        انتخاب
                        ها
                    </v-btn>
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
                                <span class="text-h5">ایجاد مرکز مخابراتی جدید </span>
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
                                                label="نام مرکزمخابرات"
                                                :rules="[required('نام مرکزمخابرات'),persianCharachter()]"
                                                v-model="createItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-autocomplete
                                                :items="cityData"
                                                label="شهر"
                                                item-text="name"
                                                item-value="id"
                                                :error-messages="errors.city"
                                                :rules="[required('شهر')]"
                                                v-model="createItem.city_id"
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
                                @click="createTelecomeCenter"
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
                        :items="telecomcenterData"
                        :items-per-page="30"
                        class="elevation-1"
                        show-select
                        v-model="itemSelected"
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
                            <span class="text-h5">ویرایش مرکزمخابراتی</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="editForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام مرکزمخابرات"
                                                :rules="[required('نام مرکزمخابرات'),persianCharachter()]"
                                                v-model="editItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"

                                        >

                                            <v-autocomplete
                                                :items="cityData"
                                                label="شهر"
                                                item-text="name"
                                                item-value="id"
                                                :error-messages="errors.city"
                                                :rules="[required('شهر')]"
                                                v-model="editItem.city_id"
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
import Swal from "sweetalert2";

export default {
    name: "index",
    data() {
        return {
            required, persianCharachter, code,
            errors: {},
            search:'',
            itemSelected: [],
            headers: [
                {
                    text: 'نام مرکز مخابرات',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                {text: 'شهر', value: 'city.name'},
                {text: 'عملیات', value: 'actions', sortable: false,},

            ],
            editItem: {},
            createItem: {},
            createDialog: false,
            telecomcenterData: [],
            cityData: [],
            editDialog: false

        }
    },
    methods: {
        createTelecomeCenter() {
            if (this.$refs.createForm.validate()) {
                axios.post('/admin/telecomcenter/create', this.createItem).then(({data}) => {
                    this.telecomcenterData.push(data);
                    this.createDialog = false;
                })
            }

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
                    axios.get('/admin/telecomcenter/delete/' + id).then((response) => {
                        const index = this.telecomcenterData.map(function (obj) {
                            return obj.id;
                        }).indexOf(id);
                        this.telecomcenterData.splice(index, 1);
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
        itemsGroupDelete() {

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
                    const itemsSelected = this.itemSelected;
                    const itemsSelectedId = itemsSelected.map(function (value) {
                        return value.id;
                    });
                    axios.post('/admin/telecomcenter/delete/all', itemsSelectedId).then((response) => {
                        //todo how to work this line
                        // const newTelecomcenterData = this.telecomcenterData.filter(x => !this.itemSelected.filter(y => y.id === x.id).length);
                        // this.telecomcenterData = newTelecomcenterData;
                        const idsToDelete = this.itemSelected.map(function (value) {
                            return value.id;
                        });
                        const newTelecomcenterData = this.telecomcenterData.filter(function (value) {
                            return idsToDelete.indexOf(value.id) === -1;
                        });
                        this.telecomcenterData = newTelecomcenterData;
                        this.itemSelected = [];


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

            axios.get('/admin/telecomcenter/edit/' + id).then(({data}) => {
                this.editDialog = true
                this.editItem.name = data.name;
                this.editItem.id = data.id;
                // this.editItem.city = data.city.name;
                this.editItem.city_id = data.city_id;
            })


        },
        updateItem() {
            if (this.$refs.editForm.validate()) {
                axios.post('/admin/telecomcenter/edit/' + this.editItem.id, this.editItem).then(({data}) => {
                    const index = this.telecomcenterData.map(function (obj) {
                        return obj.id;
                    }).indexOf(this.editItem.id);

                    this.telecomcenterData[index].name = data.name;
                    this.telecomcenterData[index].city_id = data.city_id;
                    this.telecomcenterData[index].city = data.city;
                    this.editDialog = false;
                })
            }
        }
    },
    created() {
        axios.get('/admin/telecomcenters').then(({data}) => {
            this.telecomcenterData = data.telecomCenters;
            this.cityData = data.cities
        })

    }
}
</script>

<style scoped>

</style>
