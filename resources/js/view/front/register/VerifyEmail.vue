<template>
<v-main>
    <v-container fluid>
        <v-row>
            <v-col class="d-flex justify-center">
                <v-img src="images/front/shatel-logo.svg" contain width="150" height="150"></v-img>
            </v-col>
        </v-row>
    </v-container>
    <v-container>
        <v-row class="mt-8">
            <v-col>
                <div class="text-center">
                    <h4 class="mb-4">
                        <v-icon color="green">mdi-checkbox-marked-circle</v-icon>
                        لینک تایید ایمیل برای شما ارسال گردید

                    </h4>
                    <p>لطفا برای استفاده از امکانات سایت وارد ایمیل خود شوید ، و ایمیل خود راتایید نمایید.</p>
                    <v-btn to="/" class="primary mt-5">صفحه اصلی</v-btn>
                </div>
            </v-col>
        </v-row>
    </v-container>
</v-main>
</template>

<script>
export default {
    name: "VerifyEmail"
}
</script>

<style scoped>

</style>
