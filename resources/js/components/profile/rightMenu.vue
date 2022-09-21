<template>
    <v-navigation-drawer
        absolute
        right
        v-model="drawer"
        app

    >
        <template v-slot:prepend>
            <v-list-item two-line>
                <v-list-item-content>
                    <v-list-item-title class="text-center ">

                        {{$store.state.user.user.name}} {{$store.state.user.user.lastname}}</v-list-item-title>
<!--                    <v-list-item-subtitle>{{$store.state.user.user.email}}</v-list-item-subtitle>-->
                    <v-list-item-subtitle  class="text-center mt-4">
                        <v-icon>mdi-home-city</v-icon>
                        <router-link :to="{name:'home'}">سایت صبانت</router-link>
                    </v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </template>

        <v-divider></v-divider>
        <v-treeview
            :items="treeitems"
            activatable
            transition
            open-on-click
            v-if="$store.state.user.user.role==='1'"
        >
            <template slot="label" slot-scope="props">
                <router-link :to="props.item.to" v-if="props.item.to">{{ props.item.name }}</router-link>
                <span v-else>{{ props.item.name }}</span>
            </template>
        </v-treeview>
        <v-treeview
            :items="treeitemsForNormoalUser"
            activatable
            transition
            open-on-click
            v-else
        >
            <template slot="label" slot-scope="props">
                <router-link :to="props.item.to" v-if="props.item.to">{{ props.item.name }}</router-link>
                <span v-else>{{ props.item.name }}</span>
            </template>
        </v-treeview>
<!--        <v-list dense>-->
<!--            <v-list-item-->
<!--                v-for="item in items"-->
<!--                :key="item.title"-->
<!--            >-->
<!--                <v-list-item-icon >-->
<!--                    <v-icon>{{ item.icon }}</v-icon>-->
<!--                </v-list-item-icon>-->

<!--                <v-list-item-content>-->
<!--                    <v-list-item-title>{{ item.title }}</v-list-item-title>-->
<!--                </v-list-item-content>-->
<!--            </v-list-item>-->
<!--        </v-list>-->
    </v-navigation-drawer>
</template>

<script>

export default {
    name: "rightMenu",
    data() {
        return {
            // items: [
            //     {title: 'صفحه اصلی', icon: 'mdi-home-city'},
            //     {title: 'استان ها', icon: 'mdi-country'},
            //     {title: 'شهرها', icon: 'mdi-city'},
            //     {title: 'مراکز مخابراتی', icon: 'mdi-city'},
            //
            // ],
            treeitems: [
                // {
                //     id: 1,
                //     name: 'شهر ها',
                //     children: [
                //         {id: 2, name: 'مشاهده شهر ها', to: {name: 'cities'}},
                //     ],
                // },
                // {
                //     id: 3,
                //     name: 'استان ها',
                //     children: [
                //         {id: 4, name: 'مشاهده استان ها', to: {name: 'provinces'}},
                //     ],
                // },
                // {
                //     id: 5,
                //     name: 'ادیتور',
                //     children: [
                //         {id: 6, name: 'ادیتور', to: {name: 'editor'}},
                //     ],
                // },
                // {
                //     id: 6,
                //     name: 'مراکز مخابراتی',
                //     children: [
                //         {id: 7, name: 'مشاهده مراکز مخابراتی', to: {name: 'telecomeCenters'}},
                //     ],
                // },
                // {
                //     id: 7,
                //     name: 'پیش شماره ها',
                //     children: [
                //         {id: 8, name: 'مشاهده پیش شماره ها', to: {name: 'areacode'}},
                //     ],
                // },
                // {
                //     id: 9,
                //     name: 'اپراتور ها',
                //     children: [
                //         {id: 10, name: 'مشاهده اپراتورها', to: {name: 'oprator'}},
                //     ],
                // },
                {
                    id: 11,
                    name: 'سرویس ها',
                    children: [
                        {id: 12, name: 'مشاهده سرویس ها', to: {name: 'service'}},
                    ],
                },
                {
                    id: 13,
                    name: 'دسته بندی ها',
                    children: [
                        {id: 14, name: 'مشاهده دسته بندی ها', to: {name: 'category'}},
                    ],
                },
                {
                    id: 14,
                    name: 'محصولات و تجهیزات',
                    children: [
                        {id: 15, name: 'مشاهده تجهیزات و محصولات', to: {name: 'product'}},
                    ],
                },
                {
                    id: 16,
                    name: 'سفارشات',
                    children: [
                        {id: 17, name: 'مشاهده سفارش ها', to: {name: 'order'}},
                    ],
                },
                {
                    id: 18,
                    name: 'منو ها',
                    children: [
                        {id: 19, name: 'مشاهده منو ها', to: {name: 'menu'}},
                    ],
                },
                {
                    id: 20,
                    name: 'اسلایدر ها',
                    children: [
                        {id: 21, name: 'مشاهده اسلایدر ها', to: {name: 'slider'}},
                    ],
                },
                {
                    id: 22,
                    name: 'خبر ها',
                    children: [
                        {id: 23, name: 'مشاهده خبر ها', to: {name: 'news'}},
                    ],
                },
                {
                    id: 23,
                    name: 'کدها',
                    children: [
                        {id: 24, name: 'مشاهده پیش شماره ها', to: {name: 'code'}},
                    ],
                },
            ],
            treeitemsForNormoalUser:[
                {

                    id: 25,
                    name: 'سفارش های من',
                    children: [
                        {id: 26, name: 'مشاهده سفارش ها', to: {name: 'my-order'}},
                    ],
                }
            ],
        }
    },
    props: ['drawer']
}
</script>

<style scoped>
.router-link-active{
    text-decoration: none !important;
}
</style>
