<template>
    <div>
        <v-stepper-items>

            <v-stepper-content step="1">
                <p class="mt-8">سرویس های پیشنهادی</p>
                <v-divider></v-divider>
                <v-row>
                    <v-col cols="12">
                        <p>شما می‌توانید سرویس مورد نظر خود را از میان فهرست پیشنهادی زیر انتخاب
                            فرمایید. برای مشاهده سرویس‌های دیگر شاتل بر روی کلید انتخاب‌های بیش‌تر
                            کلیک کنید. </p>
                    </v-col>
                </v-row>
                <v-row>

                    <v-col
                        v-for="(serviceDetail,index) in serviceDetails" :key="index"
                        cols="12" md="4">

                        <div :class="{ 'is-selected': isSelected==index }"
                             @click="selectService(serviceDetail,index,$event)"
                             class="serviceWrap pointerCursor d-flex flex-row suggestion-service-wrap">
                            <template v-if="isSelected==index">
                                <v-icon class="selectIcon" color="green" size="40">mdi-checkbox-marked-circle</v-icon>
                            </template>
                            <div class="suggestion-image-service"></div>
                            <div class="suggestion-service-content pa-2">
                                <p class="ma-0 py-1   fs-13">


                                    <span>نام سرویس : </span>
                                    {{ serviceDetail.name }}
                                </p>
                                <p class="ma-0 py-1   fs-13">
                                    <span>سرعت : </span>
                                    {{ serviceDetail.speed }}
                                </p>
                                <p class="ma-0 py-1 pr-1  fs-13">
                                    <span>دوره: </span>
                                    {{ serviceDetail.period }}
                                </p>
                                <p class="ma-0 py-1 pr-2  fs-13">
                                    <span>حد آستانه مصرف: </span>
                                    {{ serviceDetail.limit_amount }}
                                </p>
                                <p class="ma-0 py-1 pr-3 fs-13">
                                    {{ serviceDetail.description }}
                                </p>
                                <p class="ma-0 fs-14 pr-5 font-weight-bold subtitle-1">
                                    {{ serviceDetail.total_price }}
                                    <span>ریال</span>
                                </p>
                            </div>
                        </div>
                    </v-col>

                </v-row>
                <p class="mt-8">تجهیزات پیشنهادی</p>
                <v-divider></v-divider>
                <v-row class="mt-6">

                    <v-col cols="12" md="3" v-for="(produtDetail,index) in produtDetails" :key="index">
                        <div :class="{ 'is-selected': isSelectedProduct==index }"
                             class="suggestion-equipment-wrap text-center">

                            <div class="sugesstion-equipment-image d-flex">
                                <v-img
                                    :src="produtDetail.image_name!=='product_image_default.jpg'? '/productImage/' + produtDetail.id+'/'+produtDetail.image_name :  '/productImage/product_image_default.jpg'"
                                    width="150" height="150" contain></v-img>
                            </div>
                            <div class="sugesstion-equipment-content">
                                <p class="equipment-title mt-3">
                                    {{ produtDetail.name }}
                                </p>
                                <a href="" class="equipment-propeties-link mb-3 d-inline-block">مهمترین امکانات و ویژگی
                                    ها</a>

                                <p class="equipment-price">
                                    {{ produtDetail.price }}
                                    <span>ریال</span>
                                </p>

                                <v-btn @click="selectProduct(produtDetail,index,$event)" class="rounded-0" :class="isSelectedProduct==index ? 'success ' : 'primary' "
                                       block>
                                    <template v-if="isSelectedProduct==index">
                                        <v-icon>mdi-checkbox-marked-circle-plus-outline</v-icon>
                                    </template>
                                    <template v-else>
                                        انتخاب
                                    </template>

                                </v-btn>


                            </div>
                        </div>
                    </v-col>

                </v-row>


                <v-btn
                    color="primary"
                    @click="$emit('nextStep')"
                    class="mt-8"
                >
                    مرحله بعد
                    <v-icon>mdi-chevron-left</v-icon>

                </v-btn>

                <v-btn text class="mt-8">
                    خروج
                </v-btn>


            </v-stepper-content>


        </v-stepper-items>
    </div>


</template>

<script>
export default {
    name: "StepOne",
    props: ['orderDetails', 'serviceDetails', 'produtDetails'],
    data() {
        return {
            serviceDetail: '',
            isSelected: null,
            isSelectedProduct: null,
        }
    },
    methods: {
        selectService(serviceDetail, index) {
            this.isSelected = index;
            this.$emit('selectServ', serviceDetail);

        },
        selectProduct(productDetail, index) {
            if(this.isSelectedProduct === index){
                this.isSelectedProduct = null;
                this.$emit('selectProd', null);
            }else{
                this.isSelectedProduct = index;
                this.$emit('selectProd', productDetail);
            }


        }
    },
    created() {

    }

}
</script>

<style scoped>
.suggestion-service-wrap {
    border: 1px solid #d5d5d5;
    border-radius: 10px;
}

.pointerCursor {
    cursor: pointer;
}

.serviceWrap {
    position: relative !important;
}

.selectIcon {
    position: absolute !important;
    top: 30px !important;
    left: 30px !important;
}

.suggestion-image-service {
    background-image: url("../../../../../public/images/front/adslRegister/eco-8192.png");
    width: 164px;
    background-position: top left;
    background-repeat: no-repeat;
    background-size: cover;

}

</style>
