<template>
    <v-main>

        <v-container>
            <v-row>
                <v-col>
                    <div class="d-flex flex-row align-center">
                        <h3 class="ml-4">اطلاعات کاربری شما:</h3>
                        <v-btn outlined v-show="disabled" rounded class="primary ml-2" color="white"
                               @click="startEdit(user)">
                            ویرایش
                        </v-btn>
                        <v-btn outlined v-show="!disabled" rounded class="error ml-2" color="white" @click="cancelEdit">
                            انصراف
                        </v-btn>

                    </div>

                    <div class="d-flex justify-center mt-8">
                        <v-avatar size="100">
                            <v-img :src="user.image_src || '/images/profile/avatar/avatar.jpg'"
                                   @click="$refs.avatar.click()"></v-img>
                        </v-avatar>
                        <input type="file"
                               style="display: none;"
                               ref="avatar"
                               @change="uploadAvatar"
                        >
                    </div>

                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="8">
                    <v-form ref="userInfoForm">

                        <div>
                            <span>نام:</span>
                            <v-text-field
                                v-model="user.name"
                                :disabled="disabled"
                                :rules="[required('نام')]"
                            >

                            </v-text-field>
                        </div>

                        <div>
                            <span>نام ونام خانوادگی:</span>
                            <v-text-field
                                v-model="user.lastname"
                                :disabled="disabled"
                                :rules="[required('نام ونام خانوادگی')]"
                            >

                            </v-text-field>
                        </div>

                        <div>
                            <span>ایمیل:</span>
                            <v-btn v-if="isEmailExist && $store.state.user.user.isVerified!==2" rounded small outlined
                                   class="success">تایید
                                ایمیل
                            </v-btn>
                            <v-text-field
                                v-model="user.email"
                                :disabled="disabled"
                                :rules="[required('ایمیل')]"
                                :error-messages="errors.email"
                            >
                            </v-text-field>
                        </div>

                        <div>

                            <span>شماره همراه:</span>
                            <template v-if="!isClickInVerifyMobile">
                                <v-progress-circular
                                    indeterminate
                                    color="red"
                                    v-show="isLoading"
                                ></v-progress-circular>
                                <v-btn v-show="!isLoading"
                                       v-if="isMobileExist && $store.state.user.user.isMobileVerified!==2"
                                       @click="mobileConfirmation(user.mobile)" rounded small
                                       outlined class="success">تایید شماره همراه
                                </v-btn>

                            </template>
                            <template v-else>
                                <v-col cols="6">
                                    <v-otp-input
                                        length="6"
                                        v-model="verifyMobileCode"
                                    ></v-otp-input>

                                    <v-btn :disabled="isClick" @click="verifyMobile" rounded outlined small class="success">

                                        <v-progress-circular
                                            indeterminate
                                            color="amber"
                                            small
                                            size="20"
                                            v-if="isClick"

                                        ></v-progress-circular>
                                        <template v-else>تایید</template>
                                    </v-btn>

                                </v-col>

                            </template>

                            <v-text-field
                                v-model="user.mobile"
                                :disabled="disabled"
                                :rules="[required('شماره همراه')]"
                                :error-messages="errors.mobile"
                            >

                            </v-text-field>

                        </div>

                        <div>
                            <span>رمزعبور:</span>
                            <v-text-field
                                v-model="user.password"
                                :disabled="disabled"

                            >

                            </v-text-field>
                        </div>

                    </v-form>

                    <v-btn v-if="!disabled" @click="userUpdate" outlined class="success ml-2 mt-8" block>ثبت نهایی
                    </v-btn>

                </v-col>
                <v-col cols="4">dasdasa</v-col>
            </v-row>
        </v-container>
    </v-main>


</template>

<script>

import userProfile from "../../Module/Admin/userProfile";


export default {
    name: "home",
    setup() {
        return {

            ...userProfile(),
        }

    },


}
</script>

<style scoped>
.v-otp-input {
    direction: ltr !important;
}
</style>
