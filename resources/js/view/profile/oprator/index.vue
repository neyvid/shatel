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
                    persistent
                    max-width="600px"
                >

                    <v-card>
                        <v-card-title>
                            <span class="text-h5">ایجاد شهر جدید</span>
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
                <v-col>
                    <v-data-table
                        :headers="headers"
                        :items="opratorData"
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
import {required, code, persianCharachter} from '../../../rules/frontRules'
import Swal from "sweetalert2";

export default {
    name: "index",
    data() {
        return {
            required, code, persianCharachter,
            opratorData: [],
            createDialog: false,
            editDialog: false,
            createItem: {},
            editItem: {},
            headers: [
                {
                    text: 'نام اپراتور',
                    align: 'start',
                    sortable: false,
                    value: 'name',
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
        createCity() {
            axios.post('/admin/oprator/create', this.createItem).then(({data}) => {
                this.opratorData.push(data);
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

                        const index = this.opratorData.map(function (obj) {
                            return obj.id;
                        }).indexOf(id);
                        this.opratorData.splice(index, 1);

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
        updateItem() {
            axios.post('/admin/oprator/edit/' + this.editItem.id, this.editItem).then(({data}) => {
                const index = this.opratorData.map(function (obj) {
                    return obj.id;
                }).indexOf(this.editItem.id);

                this.opratorData[index].name = data.name;
                this.editDialog = false;
            })
        }
    },
    created() {
        axios.get('/admin/oprators/').then(({data}) => {
            console.log(data);
            this.opratorData = data;
        })
    }
}
</script>

<style scoped>

</style>
