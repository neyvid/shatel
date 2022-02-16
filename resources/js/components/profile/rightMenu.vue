<template>
    <v-navigation-drawer
        absolute
        right
        v-model="drawer"
        app
    >
        <template v-slot:prepend>
            <v-list-item two-line>
                <v-list-item-avatar>
                    <img src="https://randomuser.me/api/portraits/women/81.jpg">
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>Jane Smith</v-list-item-title>
                    <v-list-item-subtitle>Logged In</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </template>

        <v-divider></v-divider>
        <v-treeview :items="treeitems"
                    activatable
                    transition
                    open-on-click

        >
            <template slot="label" slot-scope="props">
                <router-link :to="props.item.to"  v-if="props.item.to">{{ props.item.name }}</router-link>
                <span v-else>{{ props.item.name }}</span>
            </template>


        </v-treeview>
        <v-list dense>
            <v-list-item
                v-for="item in items"
                :key="item.title"
            >
                <v-list-item-icon>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>

export default {
    name: "rightMenu",
    data() {
        return {
            items: [
                {title: 'صفحه اصلی', icon: 'mdi-home-city'},
                {title: 'استان ها', icon: 'mdi-country'},
                {title: 'شهرها', icon: 'mdi-city'},
                {title: 'مراکز مخابراتی', icon: 'mdi-city'},

            ],
            treeitems: [
                {
                    id: 1,
                    name: 'شهر ها',
                    children: [
                        {id: 2, name: 'مشاهده شهر ها',to: {name:'cities'}},
                    ],
                },
                {
                    id: 3,
                    name: 'استان ها',
                    children: [
                        {id: 4, name: 'مشاهده استان ها',to: {name:'provinces'}},
                    ],
                },
                {
                    id: 5,
                    name: 'ادیتور',
                    children: [
                        {id: 6, name: 'ادیتور',to: {name:'editor'}},
                    ],
                },
                {
                    id: 6,
                    name: 'مراکز مخابراتی',
                    children: [
                        {id: 7, name: 'مشاهده مراکز مخابراتی',to: {name:'telecomeCenters'}},
                    ],
                },

            ],
        }
    },
    props: ['drawer']
}
</script>

<style scoped>

</style>
