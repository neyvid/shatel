<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="showCreateItem">ایجاد استان جدید</v-btn>
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
                                <span class="text-h5">ایجاد استان جدید </span>
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
                                                label="نام استان"
                                                :rules="[required('نام استان'),persianCharachter()]"
                                                v-model="createItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"

                                        >
                                            <v-text-field
                                                label="کد استان"
                                                v-model="createItem.code"
                                                :rules="[required('کداستان'),code()]"
                                                :error-messages="errors.code"
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
                                @click="createProvince"
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
                        :items="provinceData"
                        :items-per-page="10"
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
                                                :rules="[required('نام استان'),persianCharachter()]"
                                                v-model="editItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12"

                                        >
                                            <v-text-field
                                                label="کد استان"
                                                v-model="editItem.code"
                                                :rules="[required('کداستان'),code()]"
                                                :error-messages="errors.code"
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
import {required, code, persianCharachter} from "../../../rules/frontRules";
import Swal from 'sweetalert2';

export default {
    name: "index",


    data() {
        return {
            editedIndex: -1,
            required, code, persianCharachter,
            editForm: null,
            createForm: null,
            editDialog: false,
            createDialog: false,
            search:'',
            errors: {
                name: null,
                code: null
            },
            editItem: {
                id: null,
                name: null,
                code: null,
            },
            createItem: {
                id: null,
                name: null,
                code: null,
            },
            provinceData: [],
            headers: [
                {
                    text: 'نام استان',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                {text: 'کد استان', value: 'code'},
                {text: 'عملیات', value: 'actions', sortable: false,},

            ],

        }
    },
    methods: {
        showEditItem({id}) {
            axios.get('/admin/provinces/edit/' + id).then(({data}) => {
                this.editDialog = true;
                this.editItem.name = data.name;
                this.editItem.code = data.code;
                this.editItem.id = data.id;
            })
        },
        updateItem() {
            if (this.$refs.editForm.validate()) {
                axios.post('/admin/provinces/edit/' + this.editItem.id, this.editItem).then(({data}) => {
                    const index = this.provinceData.map(function (obj) {
                        return obj.id;
                    }).indexOf(this.editItem.id);
                    this.provinceData[index].name = data.name;
                    this.provinceData[index].code = data.code;
                    this.editDialog = false;
                }).catch((error) => {
                    console.log(error);
                    this.errors.name = error.response.data.errors.name != undefined ? error.response.data.errors.name[0] : '';
                    this.errors.code = error.response.data.errors.code != undefined ? error.response.data.errors.code[0] : '';

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
                    axios.get('/admin/provinces/delete/' + id).then((response) => {
                        const index = this.provinceData.map(function (obj) {
                            return obj.id;
                        }).indexOf(id);
                        this.provinceData.splice(index, 1);

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
        showCreateItem() {

            this.createDialog = true;

        },
        createProvince() {

            if (this.$refs.createForm.validate()) {
                axios.post('/admin/provinces/create', this.createItem).then(({data}) => {
                    this.provinceData.push(data);
                    this.createDialog = false;
                    this.$refs.createForm.reset();
                }).catch((error) => {
                    console.log(error);
                    this.errors.name = error.response.data.errors.name != undefined ? error.response.data.errors.name[0] : '';
                    this.errors.code = error.response.data.errors.code != undefined ? error.response.data.errors.code[0] : '';

                })

            }
        },

    },
    created() {

        axios.get('/admin/provinces').then(({data}) => {
     ;
            this.provinceData = data;

        })

    }


}
</script>

<style scoped>
.text-h5 {
    font-family: shabnam !important;
}
</style>
