<template>
    <v-main>
        <v-container fluid>


            <v-row>

                <v-col>


                    <v-data-table
                        :headers="_headers"
                        :items="ordersData"
                        :items-per-page="20"
                        class="elevation-1"
                    >


                        <template  v-slot:item.status="{ item }">
                            <template v-if="!item.status">
                                <v-chip
                                    :color="getStatusColor(item.status)"
                                    dark>
                                    {{ showStatus(item.status) }}
                                </v-chip>
                                <v-btn  @click="payNow(item)" class="error">پرداخت کنید</v-btn>
                            </template>

                            <v-chip
                                v-else
                                :color="getStatusColor(item.status)"
                                dark>
                                {{ showStatus(item.status) }}
                            </v-chip>
                        </template>

                        <template v-slot:item.actions="{ item }">
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-icon
                                        color="primary"
                                        small
                                        @click="showDetail(item)"
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        mdi-eye
                                    </v-icon>
                                </template>
                                <span>مشاهده جزییات سفارش</span>
                            </v-tooltip>
                        </template>

                    </v-data-table>
                    <template>

                        <div class="text-center">
                            <v-dialog
                                v-model="dialog"
                                width="auto"
                            >


                                <v-card>
                                    <v-card-title class="text-h5 grey lighten-2">
                                        جزییات سفارش
                                    </v-card-title>
                                    <v-card-text>
                                        <v-simple-table dense class="order_detail_dialog">
                                            <thead>
                                            <tr>
                                                <th class="text-center">نوع سفارش</th>
                                                <th class="text-center">نام سفارش</th>
                                                <th class="text-center">قیمت سفارش</th>
                                                <th class="text-center">توضیحات سفارش</th>


                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <tr v-for="orderItem in orderItems">
                                                <td>
                                                    {{ orderItem.order_type === 'service' ? 'سرویس' : 'محصول' }}
                                                </td>
                                                <td>
                                                    {{ orderItem.name }}
                                                </td>
                                                <td>
                                                    {{
                                                    orderItem.order_type === 'service' ? orderItem.total_price :
                                                    orderItem.price
                                                    }}
                                                </td>
                                                <td>
                                                    {{ orderItem.description }}
                                                </td>




                                            </tr>
                                            </tbody>
                                        </v-simple-table>
                                    </v-card-text>

                                    <v-divider></v-divider>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="primary"
                                            text
                                            @click="dialog = false"
                                        >
                                            بستن
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </div>

                    </template>
                </v-col>

            </v-row>

        </v-container>
    </v-main>
</template>

<script>
export default {
    name: "index",
    data() {
        return {

            ordersData: [],
            orderItems: [],
            status:null,
            dialog: false,


        }

    },
    computed: {

        _headers() {
            let headers = [
                {
                    text: 'قیمت سفارش',
                    align: 'start',
                    sortable: false,
                    value: 'price',
                    show: true
                },
                {
                    text: 'مبلغ قابل پرداخت',
                    align: 'start',
                    sortable: false,
                    value: 'payable_amount',
                    show: true
                },
                {
                    text: 'وضعیت سفارش',
                    align: 'start',
                    sortable: false,
                    value: 'status',
                    show: true

                },
                {
                    text: 'کد پیگیری سفارش',
                    align: 'start',
                    sortable: false,
                    value: 'refId',
                    show: true
                },




                {text: 'عملیات', value: 'actions', sortable: false, show: true},
            ]
            // if (this.ordersData.status) {
            //     headers.push({
            //         text: 'پرداخت کنید',
            //         align: 'start',
            //         sortable: false,
            //         value: 'pay',
            //         show: true,
            //     },)
            //
            // }

            return headers
        }
    },
    methods: {
        payNow(item) {
            axios.post('/panel/order/pay', item).then(({data}) => {
                console.log(data)
                if (data.status) {
                    window.location.href = 'https://sandbox.zarinpal.com/pg/StartPay/' + data.Authority;
                }

            })
        },
        getStatusColor(status) {
            if (status == 0) return 'red'
            else return 'green'
        },
        showStatus(status) {
            if (status == 0) return 'پرداخت نشده'
            else return 'پرداخت شده'
        },
        showDetail(item) {
            axios.get('/panel/order/detail/' + item.id).then(({data}) => {
                this.orderItems = data;
                this.dialog = true;
            })
        },
    },
    created() {
        axios.get('/panel/orders/').then(({data}) => {
            this.ordersData = data;

        })
    },

}
</script>

<style scoped>

</style>
