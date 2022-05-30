<template>
    <v-main>
        <v-container fluid>



            <v-row>

                <v-col>


                    <v-data-table
                        :headers="headers"
                        :items="ordersData"
                        :items-per-page="20"
                        class="elevation-1"
                    >

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
            dialog: false,


            headers: [

                {
                    text: 'قیمت سفارش',
                    align: 'start',
                    sortable: false,
                    value: 'price',
                },

                {
                    text: 'مبلغ قابل پرداخت',
                    align: 'start',
                    sortable: false,
                    value: 'payable_amount',
                },
                {
                    text: 'وضعیت سفارش',
                    align: 'start',
                    sortable: false,
                    value: 'status',
                },
                {
                    text: 'کد پیگیری سفارش',
                    align: 'start',
                    sortable: false,
                    value: 'refId',
                },

                {text: 'عملیات', value: 'actions', sortable: false,},


            ],
        }
    },
    methods: {
        showDetail(item) {
            console.log(item.id)
            axios.get('/panel/order/detail/' + item.id).then(({data}) => {
                console.log(data);
                this.orderItems = data;
                this.dialog = true;
            })

        },

    },
    created() {
        axios.get('/panel/orders/').then(({data}) => {
            this.ordersData = data;
            console.log(data);

        })
    }
}
</script>

<style scoped>

</style>
