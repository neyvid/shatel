<template>
    <v-row class="mt-15">
        <v-col cols="12" md="8">
            <v-row>


                <v-col cols="12">
                    <div class="person-info-customer-form">

                        <v-form
                            class="pa-15"
                            ref="form"

                            lazy-validation
                            block
                            dense
                        >
                            <v-text-field
                                label="نام شرکت"

                                outlined
                                dense
                            ></v-text-field>

                            <v-text-field

                                label="نام رابط"
                                required
                                outlined
                                dense
                            ></v-text-field>

                            <v-text-field

                                label="نام خانوادگی رابط"
                                required
                                outlined
                                dense
                            ></v-text-field>
                            <v-text-field

                                label="شماره موبایل"
                                required
                                outlined dense
                            ></v-text-field>

                            <v-select

                                label="نحوه آشنایی با صبانت"
                                required
                                outlined
                                dense
                            ></v-select>


                        </v-form>
                    </div>
                </v-col>
            </v-row>
        </v-col>
        <v-col cols="12" md="4" class="online-chat-base">

            <div class="online-chat-wraper text-center">
                <v-img id="online-chat-img" src="images/front/adslRegister/online-chat-pic.png" width="80"
                       height="80" contain></v-img>
                <h4 class="mt-15 mx-5">
                    لطفا به موارد زیر توجه فرمایید:
                </h4>
                <p class="mx-5 mt-5">یک آدرس ایمیل معتبر وارد کنید.</p>
                <p class="mx-5 mt-5">
                    به راهنمایی نیاز دارید؟

                </p>

                <p id="online-chat-btn">
                    <a href="#" class="d-inline-block"><v-icon  color="blue">mdi-chat</v-icon>
                        <span>
                                       گفتگوی آنلاین با کارشناسان فروش
                                </span>
                    </a>
                </p>
            </div>
        </v-col>
    </v-row>
</template>

<script>
export default {
    name: "CompanyForm"
}
</script>

<style scoped>
.select-customer-type-wrap {
    border: 1px solid #dadada;
    background-color: #f9f9f9;
    border-radius: 10px;
}

.person-info-customer-form {
    border: 1px solid #dadada;
    border-radius: 10px;
    background-color: #f9f9f9;
}

.online-chat-wraper {

    border: 1px solid #dadada;
    background-color: #f9f9f9;

    border-radius: 10px;
}

.online-chat-base {
    position: relative;
}

#online-chat-img {
    position: absolute;
    top: -30px;

}
#online-chat-btn{
    text-align: center;
    border: 1px solid blue;
    margin: 10px;
    padding: 6px;
    border-radius: 5px;
}
#online-chat-btn>a{
    text-decoration: none;
}
</style>
