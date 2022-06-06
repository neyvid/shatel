<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="createDialog=true">ایجاد دسته بندی جدید</v-btn>

                </v-col>
                <!--             Start   Modal For create Item-->
                <v-dialog
                    v-model="createDialog"
                    persistent
                    max-width="600px"

                >

                    <v-card>
                        <v-card-title>
                            <span class="text-h5">ایجاد دسته بندی جدید</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="createForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام دسته بندی"
                                                :rules="[required('نام دسته بندی')]"
                                                v-model="createItem.name"
                                                :error-messages="errors.name"
                                            ></v-text-field>
                                            <v-checkbox
                                                v-model="hasParent"
                                                label="والد دارد"
                                                @click="changeParentId"
                                            ></v-checkbox>
                                            <v-autocomplete
                                                v-show="hasParent"
                                                :items="categoryDataForCreate"
                                                label="والد دسته بندی"
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
                                @click="createCategory"
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
                    <v-data-table
                        :headers="headers"
                        :items="categoryData"
                        :items-per-page="20"
                        class="elevation-1"
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
                            <span class="text-h5">ویرایش دسته بندی</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="editForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام دسته"
                                                :rules="[required('نام دسته')]"
                                                v-model="editItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>
                                            <v-checkbox
                                                v-model="hasParent"
                                                label="والد دارد"
                                                @click="editItem.parent_id=0"

                                            ></v-checkbox>
                                            <v-autocomplete
                                                v-show="hasParent"
                                                :items="categoryDataForUpdate"
                                                label="والد دسته بندی"
                                                item-text="name"
                                                item-value="id"
                                                v-model="editItem.parent_id">
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
            required, code, persianCharachter,
            categoryData: [],
            hasParent: false,
            categoryDataForCreate: [],
            categoryDataForUpdate: [],
            createDialog: false,
            editDialog: false,
            provinceData: [],
            editItem: {},
            headers: [
                {
                    text: 'نام دسته بندی',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                {text: 'والد دسته', value: 'parent.name', sortable: false,},
                {text: 'عملیات', value: 'actions', sortable: false,},
            ],
            errors: {
                name: null,
                province: null
            },
            createItem: {},
        }
    },

    methods: {
        changeParentId() {
            this.createItem.parent_id = 0;
        },
        createCategory() {
            axios.post('/admin/category/create', this.createItem).then(({data}) => {
                this.categoryData.push(data);
                if (data.parent === null) {
                    data.parent = {name: 'بدون والد'}
                }


                this.createDialog = false
            })
        },
        showEditItem({id}) {
            axios.get('/admin/category/edit/' + id).then(({data}) => {
                console.log(data);
                this.categoryDataForUpdate = data.categories;

                this.editItem.name = data.category.name;
                this.editItem.id = data.category.id;
                this.editItem.parent_id = data.category.parent_id;
                if (data.category.parent === null) {
                    this.hasParent = false;
                    this.editItem.parent = {name: 'بدون والد'};
                } else {
                    this.hasParent = true;
                    this.editItem.parent = data.parent;
                }

                this.editDialog = true;
            })
        },
        updateItem() {
            axios.post('/admin/category/edit/' + this.editItem.id, this.editItem).then(({data}) => {
                const index = this.categoryData.map(function (obj) {
                    return obj.id;
                }).indexOf(this.editItem.id);
                this.categoryData[index].name = data.name;
                this.categoryData[index].parent_id = data.parent_id;
                if (data.parent === null) {
                    this.categoryData[index].parent = {name: 'بدون والد'};
                } else {
                    this.categoryData[index].parent = data.parent
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
                    axios.get('/admin/category/delete/' + id).then(({data}) => {
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
                            const index = this.categoryData.map(function (obj) {
                                return obj.id;
                            }).indexOf(id);
                            this.categoryData.splice(index, 1);

                        }


                    }).catch((error) => {
                        alert('خطایی در حذف رخ داده است لطفا مجددا تلاش کنید.')

                    })

                }
            })
        }

    },
    created() {
        axios.get('/admin/categories').then(({data}) => {

            this.categoryData = data;
            this.categoryData.forEach(function (item, index, arr) {
                if (item.parent == null) {
                    arr[index].parent = {name: 'بدون والد'}
                }

            })
            //

            this.categoryDataForCreate = data;

        })


    }
}
</script>

<style scoped>

</style>
