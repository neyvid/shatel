<template>
    <v-app>
        <v-main>
            <div class="d-flex justify-space-between ma-3  pa-2 align-center">
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                <v-btn class="warning ml-4" small @click.prevent="logout">خروج</v-btn>
            </div>

            <v-divider></v-divider>

            <v-container fluid class="ma-4">
                <v-row class="align-center">
                    <v-col cols="12" md="6" class="text-sm-center text-md-right text-xs-center">
                        <h4>داشبرد پروفایل</h4>
                    </v-col>
                    <v-col cols="12" md="6" class="d-flex justify-md-end  justify-xs-center justify-sm-center">
                        <v-breadcrumbs
                            :items="items"
                            divider="-"
                        ></v-breadcrumbs>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="6">
                        <v-form
                            ref="form"
                        >
                            <div class="d-flex flex-row align-center mb-8">

                                <v-avatar size="80px">
                                    <v-img :src="avatar ||  '/images/profile/avatar/avatar.jpg'"
                                           @click="$refs.profile.click()"
                                    ></v-img>
                                    <input type="file"
                                           style="display: none;"
                                           ref="profile"
                                           @change="uploadImage"
                                    >
                                </v-avatar>
                                <p class="headline">مشخصات شما</p>
                            </div>


                            <div class="mb-4">
                                <span class="title">نام:</span>
                                <div class="d-flex align-center flex-row mb-5">
                                    <span v-if="!editing.name" class="d-block w-100">{{ user.name }}</span>
                                    <v-text-field
                                        v-else
                                        v-model="user.name"
                                        :rules="[required('نام')]"
                                        required
                                        class="ma-0 pa-0 ml-4"
                                        autofocus
                                    ></v-text-field>
                                    <v-btn :class="{ 'success': editing.name, 'ml-2': editing.name}"
                                           @click="changeEdit('name')" class="rounded-pill" outlined small
                                           text>{{ !editing.name ? 'ویرایش' : 'ثبت' }}
                                    </v-btn>
                                    <v-btn v-show="editing.name" @click="cancel('name')" class="rounded-pill" outlined
                                           small
                                           text>
                                        انصراف
                                    </v-btn>
                                </div>
                            </div>
                            <v-divider class="mb-4"></v-divider>
                            <div class="mb-4">
                                <span class="title">رمزعبور:</span>
                                <div class="d-flex align-center flex-row mb-5">
                                    <span v-if="!editing.password" class="d-block w-100">{{ user.password }}</span>
                                    <v-text-field
                                        v-else
                                        v-model="user.password"

                                        class="ma-0 pa-0 ml-4"
                                        autofocus
                                    ></v-text-field>
                                    <v-btn :class="{ 'success': editing.password, 'ml-2': editing.password}"
                                           @click="changeEdit('password')" class="rounded-pill" outlined small
                                           text>{{ !editing.password ? 'ویرایش' : 'ثبت' }}
                                    </v-btn>
                                    <v-btn v-show="editing.password" @click="cancel('password')" class="rounded-pill"
                                           outlined
                                           small
                                           text>
                                        انصراف
                                    </v-btn>
                                </div>
                            </div>
                            <v-divider class="mb-4"></v-divider>


                            <div class="mb-4">
                                <span class="title">نام خانوادگی:</span>
                                <div class="d-flex align-center flex-row mb-5">

                                    <span v-if="!editing.lastname" class="d-block w-100">{{ user.lastname }}</span>
                                    <v-text-field
                                        v-else
                                        v-model="user.lastname"
                                        :rules="[required('نام خانوادگی')]"

                                        required
                                        class="ma-0 pa-0 ml-4"
                                        autofocus
                                    ></v-text-field>

                                    <v-btn :class="{ 'success': editing.lastname, 'ml-2': editing.lastname}"
                                           @click="changeEdit('lastname')" class="rounded-pill" outlined small
                                           text>{{ !editing.lastname ? 'ویرایش' : 'ثبت' }}
                                    </v-btn>


                                    <v-btn v-show="editing.lastname" @click="cancel('lastname')" class="rounded-pill"
                                           outlined small
                                           text>
                                        انصراف
                                    </v-btn>


                                </div>

                            </div>
                            <v-divider class="mb-4"></v-divider>
                            <div class="mb-4">
                                <span class="title">شماره همراه:</span>
                                <div class="d-flex align-center flex-row mb-5">

                                    <span v-if="!editing.mobile" class="d-block w-100">{{ user.mobile }}</span>
                                    <v-text-field
                                        v-else
                                        v-model="user.mobile"
                                        :rules="[required('شماره همراه')]"

                                        required
                                        class="ma-0 pa-0 ml-4"
                                        autofocus
                                    ></v-text-field>

                                    <v-btn :class="{ 'success': editing.mobile, 'ml-2': editing.mobile}"
                                           @click="changeEdit('mobile')" class="rounded-pill" outlined small
                                           text>{{ !editing.mobile ? 'ویرایش' : 'ثبت' }}
                                    </v-btn>


                                    <v-btn v-show="editing.mobile" @click="cancel('mobile')" class="rounded-pill"
                                           outlined small
                                           text>
                                        انصراف
                                    </v-btn>


                                </div>

                            </div>
                            <v-divider class="mb-4"></v-divider>
                            <div class="mb-4">
                                <span class="title">ایمیل:</span>
                                <div class="d-flex align-center flex-row mb-5" email>

                                    <span v-if="!editing.email" class="d-block w-100">{{ user.email }}</span>
                                    <v-text-field
                                        v-else
                                        v-model="user.email"
                                        :rules="[required('ایمیل')]"
                                        required
                                        class="ma-0 pa-0 ml-4"
                                        autofocus
                                    ></v-text-field>

                                    <v-btn :class="{ 'success': editing.email, 'ml-2': editing.email}"
                                           @click="changeEdit('email')" class="rounded-pill" outlined small
                                           text>{{ !editing.email ? 'ویرایش' : 'ثبت' }}
                                    </v-btn>


                                    <v-btn v-show="editing.email" @click="cancel('email')" class="rounded-pill" outlined
                                           small
                                           text>
                                        انصراف
                                    </v-btn>


                                </div>

                            </div>
                            <v-divider class="mb-4"></v-divider>
                        </v-form>
                    </v-col>
                    <v-divider vertical></v-divider>
                    <v-col cols="12" md="6">
                        <p class="headline">تنظیمات پروفایل شما</p>
                        <div class="d-flex flex-row align-end justify-space-between mt-7">
                            <p class="ma-0">سشییشسس</p>
                            <v-switch
                                class="ma-0 ml-8"

                                color="red"
                                value="red"
                                hide-details
                                inset
                            ></v-switch>
                        </div>
                        <div class="d-flex flex-row align-end justify-space-between mt-7">
                            <p class="ma-0">سشییشسس</p>
                            <v-switch
                                class="ma-0 ml-8"

                                color="red"
                                value="red"
                                hide-details
                                inset
                            ></v-switch>
                        </div>
                        <div class="d-flex flex-row align-end justify-space-between mt-7">
                            <p class="ma-0">سشییشسس</p>
                            <v-switch
                                class="ma-0 ml-8"
                                color="red"
                                value="red"
                                hide-details
                                inset
                            ></v-switch>
                        </div>


                    </v-col>


                </v-row>
            </v-container>
            <v-container fluid>


                <v-row>
                    <v-col>
                        <v-btn class="success" @click="update" block>ذخیره اطلاعات</v-btn>

                    </v-col>
                </v-row>
            </v-container>


        </v-main>


        <v-navigation-drawer
            v-model="drawer"
            absolute
            bottom
            right
            app

        >
            <v-list>
                <v-list-item class="px-2 justify-center">
                    <v-list-item-avatar>
                        <v-img src="https://randomuser.me/api/portraits/women/85.jpg"></v-img>
                    </v-list-item-avatar>
                </v-list-item>

                <v-list-item link class="text-center">
                    <v-list-item-content>
                        <v-list-item-title class="text-h6">
                            Sandra Adams
                        </v-list-item-title>
                        <v-list-item-subtitle>sandra_a88@gmail.com</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-divider></v-divider>
            <v-list
                nav
                dense
            >
                <v-list-item link>
                    <v-list-item-icon>
                        <v-icon>mdi-folder</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>My Files</v-list-item-title>
                </v-list-item>
                <v-list-item link>
                    <v-list-item-icon>
                        <v-icon>mdi-account-multiple</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Shared with me</v-list-item-title>
                </v-list-item>
                <v-list-item link>
                    <v-list-item-icon>
                        <v-icon>mdi-star</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Starred</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

    </v-app>


</template>

<script>

import profileModule from "../../Module/Admin/profileModule";
import {required} from "../../rules/frontRules";

export default {
    name: "home",
    setup() {
        return {
            ...profileModule(), required
        }
    },
    // created() {
    //     axios.get('/api/user').then(({data}) => {
    //         this.user = data;
    //     })
    // }
}
</script>

<style scoped>
.headline, .title {

    font-family: Shabnam !important;
}

#avatar {
    cursor: pointer;
}

.w-100 {
    width: 100% !important;
}
</style>
