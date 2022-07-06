<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="createDialog=true">ایجاد اسلایدر جدید</v-btn>

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
                                <span class="text-h5">ایجاد اسلایدر جدید </span>
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
                                                label="نام اسلایدر"
                                                :rules="[required('نام سرویس'),persianCharachter()]"
                                                v-model="createItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>

                                            <v-file-input
                                                label="تصویراسلایدر"
                                                class="mt-6"
                                                dense
                                                :rules="[required('تصویر اسلایدر')]"
                                                :error-messages="errors.nationalCodePic"
                                                @change="uploadPic($event,'create')"
                                            ></v-file-input>

                                            <v-text-field
                                                label="لینک اسلایدر"
                                                :rules="[required('لینک اسلایدر')]"
                                                v-model="createItem.link"
                                                :error-messages="errors.name"

                                            ></v-text-field>

                                            <date-picker
                                                label="تاریخ شروع اسلایدر:"
                                                color="dimgray" simple
                                                @input=""
                                                class="mt-6"
                                                v-model="createItem.start_date"
                                            ></date-picker>
                                            <date-picker
                                                label="تاریخ انقضا اسلایدر:"
                                                color="dimgray" simple
                                                @input=""
                                                class="mt-6"
                                                v-model="createItem.expire_date"

                                            ></date-picker>
                                            <v-row>
                                                <v-col><p>وضعیت اسلایدر:</p></v-col>

                                            </v-row>
                                            <v-row class="d-flex">

                                                <v-col cols="5" class="pa-0 d-flex align-center justify-end">
                                                    <span>غیر فعال</span>
                                                </v-col>
                                                <v-col cols="1" class="pa-0 d-flex justify-center">
                                                    <v-switch
                                                        v-model="createItem.status"
                                                        inset

                                                    ></v-switch>
                                                </v-col>
                                                <v-col cols="5" class="px-3 d-flex align-center">
                                                    <span>فعال</span>
                                                </v-col>
                                            </v-row>


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
                                @click="createSlider"
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
                        :items="sliderData"
                        :items-per-page="20"
                        class="elevation-1"
                        :search="search"

                    >

                        <template v-slot:item.status="{ item }">
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-icon v-bind="attrs"   v-if="item.status==='فعال'"  v-on="on" color='green' class="fa fa-globe">mdi-eye</v-icon>
                                    <v-icon v-bind="attrs" v-else v-on="on"  color='red' class="fa fa-globe" >mdi-eye-off</v-icon>
                                </template>
                                <span v-if="item.status==='فعال'">قابل مشاهده(فعال)</span>
                                <span v-else>غیر قابل مشاهده(غیرفعال)</span>

                            </v-tooltip>

                        </template>
                        <template v-slot:item.picture="{ item }">
                            <v-img height="65px" width="150px"
                                   :src="'/slidersImage/'+item.id+'/'+item.picture">
                            </v-img>
                        </template>

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
                                @click="deleteItem(item.id)"
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
                            <span class="text-h5">ویرایش سرویس</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="editForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام اسلایدر"
                                                :rules="[required('نام سرویس'),persianCharachter()]"
                                                v-model="editItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>

                                            <v-file-input
                                                label="تصویراسلایدر"
                                                class="mt-6"
                                                dense

                                                :rules="[required('تصویر اسلایدر')]"
                                                :error-messages="errors.nationalCodePic"
                                                @change="uploadPic($event,'edit')"
                                            ></v-file-input>

                                            <v-dialog
                                                v-model="showPictue"
                                                width="500"
                                            >
                                                <v-card>

                                                    <v-card-text>
                                                        <v-img target="_blank"
                                                               :src="'/slidersImage/'+editItem.id+'/'+editItem.picture">
                                                        </v-img>
                                                    </v-card-text>

                                                    <v-divider></v-divider>

                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn
                                                            color="success"
                                                            text
                                                            @click="showPictue = false"
                                                        >
                                                            بستن
                                                        </v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>
                                            <a target="_blank" @click="showPictue=true">
                                                <v-img
                                                    :src="editItem.picture ? '/slidersImage/'+editItem.id+'/'+editItem.picture : ''"
                                                    width="80px" height="80px">
                                                </v-img>
                                            </a>
                                            <v-text-field
                                                label="لینک اسلایدر"
                                                :rules="[required('لینک اسلایدر')]"
                                                v-model="editItem.link"
                                                :error-messages="errors.name"

                                            ></v-text-field>

                                            <date-picker
                                                label="تاریخ شروع اسلایدر:"
                                                color="dimgray" simple
                                                @input=""
                                                class="mt-6"
                                                v-model="editItem.start_date"
                                            ></date-picker>
                                            <date-picker
                                                label="تاریخ انقضا اسلایدر:"
                                                color="dimgray" simple
                                                @input=""
                                                class="mt-6"
                                                v-model="editItem.expire_date"

                                            ></date-picker>
                                            <v-row>
                                                <v-col><p>وضعیت اسلایدر:</p></v-col>

                                            </v-row>
                                            <v-row class="d-flex">

                                                <v-col cols="5" class="pa-0 d-flex align-center justify-end">
                                                    <span>غیر فعال</span>
                                                </v-col>
                                                <v-col cols="1" class="pa-0 d-flex justify-center">
                                                    <v-switch
                                                        v-model="editItem.status"
                                                        inset

                                                    ></v-switch>
                                                </v-col>
                                                <v-col cols="5" class="px-3 d-flex align-center">
                                                    <span>فعال</span>
                                                </v-col>
                                            </v-row>


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
import swal from "sweetalert2";


export default {
    name: "index",
    data() {
        return {
            required, code, persianCharachter,
            showPictue: false,
            sliderData: [],
            search:'',
            createDialog: false,
            editDialog: false,
            createItem: {},
            editItem: {},
            headers: [
                {
                    text: 'نام اسلایدر',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },

                {text: 'لینک اسلایدر', value: 'link', sortable: false,},
                {text: 'تاریخ شروع', value: 'start_date', sortable: true,},
                {text: 'تاریخ انقضا', value: 'expire_date', sortable: true,},
                {text: 'تصویر', value: 'picture', sortable: true,},
                {text: 'وضعیت', value: "status", sortable: true,},
                {text: 'عملیات', value: 'actions', sortable: false,},

            ],
            errors: {
                name: null,
                province: null
            },

            menu2: false,
        }
    },
    methods: {
        createSlider() {
            axios.post('/admin/slider/create', this.createItem).then(({data}) => {
                if (data.status) {
                    this.sliderData.push(data.slider);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا !',
                        text: data.message,
                        confirmButtonText: 'متوجه شدم'
                    })
                }

                this.createDialog = false;
            })
        },
        deleteItem(id) {
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
                    axios.get('/admin/slider/delete/' + id).then(() => {
                        const index = this.sliderData.map(function (obj) {
                            return obj.id;
                        }).indexOf(id);
                        this.sliderData.splice(index, 1);

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
            axios.get('/admin/slider/edit/' + id).then(({data}) => {

                this.editItem = data;
                this.editItem.status=data.status==='فعال'? true :false;
                this.editDialog = true;
            })
        },
        updateItem() {
            axios.post('/admin/slider/edit/' + this.editItem.id, this.editItem).then(({data}) => {

                if (data.status) {
                    const index = this.sliderData.map(function (obj) {
                        return obj.id;
                    }).indexOf(this.editItem.id);
                    this.sliderData[index].name = data.slider.name;
                    this.sliderData[index].link = data.slider.link;
                    this.sliderData[index].picture = data.slider.picture;
                    this.sliderData[index].start_date = data.slider.start_date;
                    this.sliderData[index].expire_date = data.slider.expire_date;
                    this.sliderData[index].status = data.slider.status==='فعال' ?  'فعال'  : 'غیرفعال';

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا !',
                        text: data.message,
                        confirmButtonText: 'متوجه شدم'
                    })
                }
                this.editDialog = false;


            })
        },
        uploadPic(event,type) {

            const file = event;
            const reader = new FileReader();
            reader.onload = (image) => {
                if(type==='create'){
                    //Name of Image
                    this.createItem.slider_pic_name = event.name;
                    // BASE64 Imgae result (self)
                    this.createItem.slider_pic_src = image.target.result;
                }else{
                    //Name of Image
                    this.editItem.slider_pic_name = event.name;
                    // BASE64 Imgae result (self)
                    this.editItem.slider_pic_src = image.target.result;
                }

            };
            reader.readAsDataURL(file);
        }


    },
    created() {
        axios.get('/admin/sliders/').then(({data}) => {
            this.sliderData = data;

        })
    }
}
</script>

<style scoped>
.vpd-main {
    margin: 20px !important;
}
</style>
