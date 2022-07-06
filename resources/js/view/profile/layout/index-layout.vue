<template>
    <div>
        <v-main>
            <v-container fluid>
                <v-row class="mb-2 mt-3">
                    <v-col cols="2" class="d-flex align-center">
                        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                    </v-col>

                    <v-col cols="8" class="d-flex justify-center">
                        <h1 v-if="$store.state.user.user.role==='1'">پنل مدیریت</h1>
                        <h1 v-else>پنل کاربری</h1>
                    </v-col>

                    <v-col cols="2" class="d-flex justify-end align-center">
                        <v-btn class="warning" @click.prevent="logout" rounded>خروج</v-btn>
                    </v-col>
                </v-row>
                <v-divider>
                </v-divider>
            </v-container>
        </v-main>
        <right-menu :drawer="drawer"></right-menu>


        <router-view></router-view>

    </div>

</template>

<script>


import {ref} from "@vue/composition-api";
import {mapActions} from "vuex";
import store from '../../../store';
import router from "../../../router/router";
import RightMenu from "../../../components/profile/rightMenu";


export default {
    name: "index-layout",
    components: {RightMenu},
    setup() {
        const drawer = ref(true);

        function logout() {
            store.dispatch('logout').then(()=>{
                router.push({name: 'home'})
            })

        }

        return {
            drawer, logout

        }
    }

}
</script>

<style scoped>

</style>
