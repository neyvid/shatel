<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="createDialog=true">ایجاد محصول جدید</v-btn>
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
                                <span class="text-h5">ایجاد محصول جدید </span>
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
                                                label="نام محصول"
                                                :rules="[required('نام محصول')]"
                                                v-model="createItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>
                                            <v-text-field
                                                label="(تومان)قیمت محصول"
                                                :rules="[required('قیمت محصول')]"
                                                v-model="createItem.price"
                                                :error-messages="errors.price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="درصد تخفیف"
                                                :rules="[required('درصد تخفیف')]"
                                                v-model="createItem.discount"
                                                :error-messages="errors.discount"

                                            ></v-text-field>
                                            <v-autocomplete
                                                :items="categoryData"
                                                label="دسته بندی"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.category_id"
                                            ></v-autocomplete>
                                            <v-file-input
                                                show-size
                                                label="تصویر محصول"
                                                @change="uploadProductImage"
                                                @click:clear="clientClearImage"
                                            ></v-file-input>
                                            <v-textarea
                                                label="توضیحات"
                                                :rules="[required('توضیحات')]"
                                                v-model="createItem.description"
                                                :error-messages="errors.description">
                                            </v-textarea>


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
                                @click="createProduct"
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
                        :items="productData"
                        :items-per-page="20"
                        class="elevation-1"
                        :search="search"
                    >
                        <template v-slot:item.image_name="{ item }">
                            <v-img
                                :src="item.image_name!=='product_image_default.jpg'? '/productImage/' + item.id+'/'+item.image_name :  '/productImage/product_image_default.jpg'"
                                width="80px" height="80px"></v-img>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                color="red"
                                class="mr-2"
                                @click="showEditItem(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                small
                                color="green"
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
                            <span class="text-h5">ویرایش محصول/تجهیزات</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="editForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام محصول"
                                                :rules="[required('نام محصول')]"
                                                v-model="editItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>
                                            <v-text-field
                                                label="(تومان)قیمت محصول"
                                                :rules="[required('قیمت محصول')]"
                                                v-model="editItem.price"
                                                :error-messages="errors.price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="درصد تخفیف"
                                                :rules="[required('درصد تخفیف')]"
                                                v-model="editItem.discount"
                                                :error-messages="errors.discount"

                                            ></v-text-field>
                                            <v-autocomplete
                                                :items="categoryData"
                                                label="دسته بندی"
                                                item-text="name"
                                                item-value="id"
                                                v-model="editItem.category_id"
                                            ></v-autocomplete>
                                            <v-img
                                                :src="editItem.image_name!=='product_image_default.jpg' ? '/productImage/'+editItem.id+'/'+editItem.image_name : '/productImage/product_image_default.jpg'"
                                                width="80px" height="80px"></v-img>
                                            <v-file-input
                                                show-size
                                                label="تصویر محصول"
                                                @change="uploadProductImage"
                                                @click:clear="clientClearImage"
                                            ></v-file-input>
                                            <v-textarea
                                                label="توضیحات"
                                                :rules="[required('توضیحات')]"
                                                v-model="editItem.description"
                                                :error-messages="errors.description">
                                            </v-textarea>


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
import {required, persianCharachter} from '../../../rules/frontRules'
import Swal from "sweetalert2";

export default {
    name: "index",
    data() {
        return {
            required, persianCharachter,
            createDialog: false,
            editDialog: false,
            productData: [],
            createItem: {},
            search:'',
            editItem: {},
            categoryData: [],
            errors: [],
            headers: [
                {
                    text: 'نام محصول/تجهیزات',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                    width: '30%'
                },
                {text: 'قیمت', value: 'price'},
                {text: 'درصد تخفیف', value: 'discount',width:'5%'},
                {text: 'دسته محصول', value: 'categories[0].name'},
                {text: 'توضیحات', value: 'description'},
                {text: 'تصویر', value: 'image_name'},
                {text: 'عملیات', value: 'actions', sortable: false,},

            ],
        }
    },

    methods: {
        clientClearImage(){
            if (this.createDialog) {
                this.createItem.image_name =null;
                // BASE64 Imgae result (slef
                this.createItem.image_src = null;
            }
            if (this.editDialog) {
                this.editItem.image_name_update =null;
                // BASE64 Imgae result (slef
                this.editItem.image_src = null;
            }
        },
        uploadProductImage(event) {
            const file = event;
            const reader = new FileReader();
            reader.onload = (image) => {
                //Name of Image
                if (this.createDialog) {
                    this.createItem.image_name = event.name;
                    // BASE64 Imgae result (slef
                    this.createItem.image_src = image.target.result;
                }
                if (this.editDialog) {
                    this.editItem.image_name_update = event.name;
                    // BASE64 Imgae result (slef
                    this.editItem.image_src = image.target.result;
                }

            };
            reader.readAsDataURL(file);
        },
        createProduct() {
            axios.post('/admin/product/create', this.createItem).then(({data}) => {
                this.productData.push(data);
                this.createDialog = false;
            })

        },
        updateItem() {
            axios.post('/admin/product/edit/' + this.editItem.id, this.editItem).then(({data}) => {
                const index = this.productData.map(function (obj) {
                    return obj.id;
                }).indexOf(this.editItem.id);

                this.productData[index].name = data.name;
                this.productData[index].price = data.price;
                this.productData[index].discount = data.discount;
                this.productData[index].categories = data.categories;
                this.productData[index].image_name = data.image_name;
                this.productData[index].description = data.description;
                this.editDialog = false;

            })

        },
        showEditItem({id}) {
            axios.get('/admin/product/edit/' + id).then(({data}) => {
                this.editItem.id = data.id;
                this.editItem.name = data.name;
                this.editItem.price = data.price;
                this.editItem.discount = data.discount;
                this.editItem.category_id = data.categories[0].id;
                this.editItem.image_name = data.image_name;
                this.editItem.description = data.description;
                this.editDialog = true;
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
                    axios.get('/admin/product/delete/' + id).then(({data}) => {
                        console.log(data);
                        const index = this.productData.map(function (obj) {
                            return obj.id;
                        }).indexOf(id);
                        this.productData.splice(index, 1);

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


        }
    },
    created() {
        axios.get('/admin/products').then(({data}) => {

            this.productData = data.products;
            this.categoryData = data.categories;
        })
    }
}
</script>

<style scoped>

</style>
