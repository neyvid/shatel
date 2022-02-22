<template>
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col>
                    <v-btn rounded class="primary" @click="createDialog=true">ایجاد سرویس جدید</v-btn>

                </v-col>
                <!--             Start   Modal For create Item-->
                <v-dialog
                    v-model="createDialog"
                    persistent
                    max-width="600px"
                >

                    <v-card>
                        <v-card-title>
                            <span class="text-h5">ایجاد سرویس جدید</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="createForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام سرویس"
                                                :rules="[required('نام سرویس'),persianCharachter()]"
                                                v-model="createItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>
                                            <v-autocomplete
                                                :items="opratorData"
                                                label="اپراتور سرویس دهنده"
                                                item-text="name"
                                                item-value="id"
                                                v-model="createItem.oprator_id"
                                                :rules="[required('اپراتور')]"
                                            ></v-autocomplete>
                                            <v-autocomplete
                                                :items="typeData"
                                                label="نوع سرویس"
                                                item-text="type_name"
                                                item-value="type"
                                                v-model="createItem.type"
                                                :rules="[required( 'نوع سرویس')]"
                                            ></v-autocomplete>
                                            <v-autocomplete
                                                :items="planData"
                                                label="طرح سرویس"
                                                item-text="plan_name"
                                                item-value="plan"
                                                v-model="createItem.plan"
                                                :rules="[required('طرح سرویس')]"
                                            ></v-autocomplete>

                                            <v-text-field
                                                label="قیمت سرویس (تومان)"
                                                :rules="[required('قیمت سرویس')]"
                                                v-model="createItem.price"
                                                :error-messages="errors.price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="میزان تخفیف(درصد)"
                                                :rules="[required('میزان تخفیف')]"
                                                v-model="createItem.discount"
                                                :error-messages="errors.discount"

                                            ></v-text-field>
                                            <v-text-field
                                                label="مدت زمان سرویس"
                                                :rules="[required('مدت زمان سرویس')]"
                                                v-model="createItem.period"
                                                :error-messages="errors.period"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان ترافیک شبانه "
                                                :rules="[required('میزان ترافیک شبانه ')]"
                                                v-model="createItem.night_trafic"
                                                :error-messages="errors.night_trafic"

                                            ></v-text-field>
                                            <v-text-field
                                                label="سرعت (Kb/s)"
                                                :rules="[required('سرعت')]"
                                                v-model="createItem.speed"
                                                :error-messages="errors.speed"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان محدودیت "
                                                :rules="[required('میزان محدودیت ')]"
                                                v-model="createItem.limit_amount"
                                                :error-messages="errors.limit_amount"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان ترافیک بین المللی(MB) "
                                                :rules="[required('میزان ترافیک بین المللی ')]"
                                                v-model="createItem.international_trafic"
                                                :error-messages="errors.international_trafic"

                                            ></v-text-field>
                                            <v-text-field
                                                label="توضیحات"
                                                :rules="[required('توضیحات')]"
                                                v-model="createItem.description"
                                                :error-messages="errors.description"

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
                                @click="createService"
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
                        :items="servicesData"
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
                            <span class="text-h5">ویرایش استان</span>
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="editForm">
                                <v-container>
                                    <v-row>
                                        <v-col
                                            cols="12">
                                            <v-text-field
                                                label="نام سرویس"
                                                :rules="[required('نام سرویس'),persianCharachter()]"
                                                v-model="editItem.name"
                                                :error-messages="errors.name"

                                            ></v-text-field>
                                            <v-autocomplete
                                                :items="opratorData"
                                                label="اپراتور سرویس دهنده"
                                                item-text="name"
                                                item-value="id"
                                                v-model="editItem.oprator_id"
                                                :rules="[required('اپراتور')]"
                                            ></v-autocomplete>
                                            <v-autocomplete
                                                :items="typeData"
                                                label="نوع سرویس"
                                                item-text="type_name"
                                                item-value="type"
                                                v-model="editItem.type"
                                                :rules="[required( 'نوع سرویس')]"
                                            ></v-autocomplete>
                                            <v-autocomplete
                                                :items="planData"
                                                label="طرح سرویس"
                                                item-text="plan_name"
                                                item-value="plan"
                                                v-model="editItem.plan"
                                                :rules="[required('طرح سرویس')]"
                                            ></v-autocomplete>

                                            <v-text-field
                                                label="قیمت سرویس (تومان)"
                                                :rules="[required('قیمت سرویس')]"
                                                v-model="editItem.price"
                                                :error-messages="errors.price"

                                            ></v-text-field>
                                            <v-text-field
                                                label="میزان تخفیف(درصد)"
                                                :rules="[required('میزان تخفیف')]"
                                                v-model="editItem.discount"
                                                :error-messages="errors.discount"

                                            ></v-text-field>
                                            <v-text-field
                                                label="مدت زمان سرویس"
                                                :rules="[required('مدت زمان سرویس')]"
                                                v-model="editItem.period"
                                                :error-messages="errors.period"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان ترافیک شبانه "
                                                :rules="[required('میزان ترافیک شبانه ')]"
                                                v-model="editItem.night_trafic"
                                                :error-messages="errors.night_trafic"

                                            ></v-text-field>
                                            <v-text-field
                                                label="سرعت (Kb/s)"
                                                :rules="[required('سرعت')]"
                                                v-model="editItem.speed"
                                                :error-messages="errors.speed"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان محدودیت "
                                                :rules="[required('میزان محدودیت ')]"
                                                v-model="editItem.limit_amount"
                                                :error-messages="errors.limit_amount"

                                            ></v-text-field>
                                            <v-text-field
                                                label=" میزان ترافیک بین المللی(MB) "
                                                :rules="[required('میزان ترافیک بین المللی ')]"
                                                v-model="editItem.international_trafic"
                                                :error-messages="errors.international_trafic"

                                            ></v-text-field>
                                            <v-text-field
                                                label="توضیحات"
                                                :rules="[required('توضیحات')]"
                                                v-model="editItem.description"
                                                :error-messages="errors.description"

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
            servicesData: [],
            createDialog: false,
            editDialog: false,
            typeData: {},
            planData: {},
            opratorData: {},
            createItem: {},
            editItem: {},
            headers: [
                {
                    text: 'نام سرویس',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },

                {text: 'اپراتور', value: 'oprator.name', sortable: false,},
                {text: 'نوع', value: 'type', sortable: false,},
                {text: 'طرح', value: 'plan', sortable: false,},
                {text: 'قیمت', value: 'price', sortable: false,},
                {text: 'تخفیف (%)', value: 'discount', sortable: false,},
                {text: 'زمان', value: 'period', sortable: false,},
                {text: 'ترافیک شبانه', value: 'night_trafic', sortable: false,},
                {text: 'سرعت', value: 'speed', sortable: false,},
                {text: 'میزان محدودیت', value: 'limit_amount', sortable: false,},
                {text: 'ترافیک بین المللی', value: 'international_trafic', sortable: false,},
                {text: 'توضیحات', value: 'description', sortable: false,},
                {text: 'عملیات', value: 'actions', sortable: false,},

            ],
            errors: {
                name: null,
                province: null
            },
        }

    },
    methods: {
        createService() {
            axios.post('/admin/service/create', this.createItem).then(({data}) => {
                this.servicesData.push(data);
                this.createDialog = false;
            })
        },
        deleteItem(id){
            console.log(id);
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
                    axios.get('/admin/service/delete/' + id).then(() => {
                        const index = this.servicesData.map(function (obj) {
                            return obj.id;
                        }).indexOf(id);
                        this.servicesData.splice(index, 1);

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
            axios.get('/admin/service/edit/' + id).then(({data}) => {
                // console.log(data.oprator.name);

                this.editItem=data;
                this.editDialog = true;
            })
        },
        updateItem() {
            axios.post('/admin/service/edit/'+this.editItem.id,this.editItem).then(({data})=>{
                const index = this.servicesData.map(function (obj) {
                    return obj.id;
                }).indexOf(this.editItem.id);
                this.servicesData[index].oprator = data.oprator;
                this.servicesData[index].name = data.name;
                this.servicesData[index].type = data.type_name;
                this.servicesData[index].plan = data.plan_name;
                this.servicesData[index].price = data.price;
                this.servicesData[index].discount= data.discount;
                this.servicesData[index].period = data.period;
                this.servicesData[index].night_trafic = data.night_trafic;
                this.servicesData[index].limit_amount = data.limit_amount;
                this.servicesData[index].speed = data.speed;
                this.servicesData[index].international_trafic = data.international_trafic;
                this.servicesData[index].description = data.description;
                this.editDialog = false;

            })
        }

    },
    created() {
        axios.get('/admin/services/').then(({data}) => {

            this.servicesData = data.services;
            this.typeData = data.type;
            this.planData = data.plan;
            this.opratorData = data.oprators;
        })
    }
}
</script>

<style scoped>

</style>
