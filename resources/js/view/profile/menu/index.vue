<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="createDialog=true">ایجاد منو جدید</v-btn>

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
                                <span class="text-h5">ایجاد منو جدید </span>
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
                                                label="نام منو"
                                                :rules="[required('نام منو')]"
                                                v-model="createItem.name"
                                                :error-messages="errors.name"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12">
                                            <span class="caption">
                                                <u>
                                                (صرفا فقط آدرس صفحه مورد نظر را وارد نمایید و با '/' جداسازی نمایید.)
                                                </u>
                                            </span>

                                            <v-text-field
                                                label="لینک را بصورت مثال روبروی وارد نمایید  /page1/page2 "
                                                :rules="[required('لینک منو')]"
                                                v-model="createItem.link"
                                                :error-messages="errors.link"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col
                                            cols="12">
                                            <v-checkbox
                                                v-model="hasParent"
                                                label="منو اصلی دارد"
                                                @click="changeParentId"
                                            ></v-checkbox>
                                            <v-autocomplete
                                                v-show="hasParent"
                                                :items="menuDataForCreate"
                                                label="منوی اصلی را انتخاب کنید"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.parent_id">
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
                                @click="createDialog=false"
                            >
                                انصراف
                            </v-btn>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="createMenu"
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
                        :items="menuData"
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

                        <template v-slot:item.link="{ item }">
                            <a target="_blank" :href="item.link">
                                {{ item.link }}
                            </a>
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
                            <span class="text-h5">ویرایش منو</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="editForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام منو"
                                                :rules="[required('نام منو')]"
                                                v-model="editItem.name"
                                                :error-messages="errors.name"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col>
                                            <v-checkbox
                                                v-model="hasParent"
                                                label="والد دارد"
                                                @click="editItem.parent_id=0"
                                            ></v-checkbox>
                                            <v-autocomplete
                                                v-show="hasParent"
                                                :items="menuDataForUpdate"
                                                label="منوی اصلی را انتخاب کنید"
                                                item-text="name"
                                                item-value="id"
                                                v-model="editItem.parent_id">
                                            </v-autocomplete>
                                        </v-col>

                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="لینک منو"
                                                :rules="[required('لینک منو')]"
                                                v-model="editItem.link"
                                                :error-messages="errors.link"
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
import {required, code, persianCharachter} from '../../../rules/frontRules'
import Swal from "sweetalert2";

export default {
    name: "index",
    data() {
        return {
            required, code, persianCharachter,
            hasParent: false,
            menuData: [],
            search:'',
            createDialog: false,
            menuDataForCreate: [],
            menuDataForUpdate: [],
            editDialog: false,
            createItem: {},
            editItem: {},
            headers: [
                {
                    text: 'نام منو',
                    align: 'start',
                    sortable: false,
                    value: 'name',

                },
                {
                    text: 'نوع منو',
                    align: 'start',
                    sortable: false,
                    value: 'parent.name',
                },
                {
                    text: 'لینک منو',
                    align: 'start',
                    sortable: false,
                    value: 'link',
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
        changeParentId() {
            this.createItem.parent_id = 0;
        },
        createMenu() {
            axios.post('/admin/menu/create', this.createItem).then(({data}) => {

                this.menuData.push(data);
                this.createDialog = false;
                console.log(data);
            })
        },



        showEditItem({id}) {
            axios.get('/admin/menu/edit/' + id).then(({data}) => {
                this.editDialog = true;
                this.menuDataForUpdate = data.menus
                this.editItem.name = data.menu.name
                this.editItem.link = data.menu.link
                this.editItem.parent_id = data.menu.parent_id;
                this.editItem.id = data.menu.id
                if (data.menu.parent === null) {
                    this.hasParent = false;
                    this.editItem.parent = {name: 'بدون والد'};
                } else {
                    this.hasParent = true;
                    this.editItem.parent = data.parent;
                }
                console.log(data);
            })
        },
        updateItem() {
            axios.post('/admin/menu/edit/' + this.editItem.id, this.editItem).then(({data}) => {

                const index = this.menuData.map(function (obj) {
                    return obj.id;
                }).indexOf(this.editItem.id);

                this.menuData[index].name = data.name;
                this.menuData[index].link = data.link;
                if (data.parent === null) {
                    this.menuData[index].parent = {name: 'بدون والد'};
                } else {
                    this.menuData[index].parent = data.parent
                }
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
                    axios.get('/admin/menu/delete/' + id).then(({data}) => {
                        console.log(data);
                        if (data.hasParent) {
                            Swal.fire({
                                icon: 'error',
                                title: 'خطای سیستم',
                                text: 'دسته بندی انتخاب شده برای حذف دارای فرزند(فرزندان) هست و با حذف آن سیستم دچار اشکال می گردد، لذا ابتدا فرزندان را حذف نمایید و سپس برای حذف این مورد اقدام فرمایید!',
                            })
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: '.دسته بندی مورد نظر با موفقیت حذف گردید',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            const index = this.menuData.map(function (obj) {
                                return obj.id;
                            }).indexOf(id);
                            this.menuData.splice(index, 1);

                        }


                    }).catch((error) => {
                        alert('خطایی در حذف رخ داده است لطفا مجددا تلاش کنید.')

                    })

                }
            })
        }
    },
    created() {
        axios.get('/admin/menus/').then(({data}) => {
            console.log(data);
            this.menuData = data;
            this.menuDataForCreate = data;
        })
    }
}
</script>

<style scoped>
.caption {
    font-family: shabnam !important;
    color: #ff0000;
    opacity: .8 !important;
    font-size: 14px !important;
}
</style>
