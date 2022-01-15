<template>
    <v-main>
        <v-container fluid class="border-bottom">
            <v-container>
                <v-row>
                    <v-col class="pa-0">
                        <v-breadcrumbs
                            class="pa-0"
                            :items="items">
                            <template v-slot:divider>
                                <v-icon>mdi-chevron-left</v-icon>
                            </template>
                        </v-breadcrumbs>
                    </v-col>
                </v-row>
            </v-container>


        </v-container>
        <v-container>
            <v-row class="mt-5 mb-5 ">
                <v-col cols="12" md="8">
                    <h2>بررسی وضعیت دسترسی به ADSL2+</h2>
                    <v-row>
                        <v-col cols="6">
                            <v-form
                                class="mt-8"
                                ref="form"
                                v-model="valid"
                                lazy-validation
                            >
                                <v-text-field
                                    label="پیش شماره شهر"
                                    required
                                    outlined
                                ></v-text-field>

                                <v-text-field
                                    outlined
                                    label="شماره تلفن"
                                    required
                                ></v-text-field>

                                <v-btn
                                    color="primary"

                                >
                                    بررسی وضعیت
                                </v-btn>


                            </v-form>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="10">
                            <v-simple-table class="simple-table-bordered">
                                <template v-slot:default>
                                    <thead>
                                    <tr class="blue-bg th-border-simple-table">
                                        <th class="text-right">
                                            شهر
                                        </th>
                                        <th class="text-right">
                                            نام مرکز
                                        </th>
                                        <th class="text-right">
                                            پیش شماره شما
                                        </th>
                                        <th class="text-right">
                                            وضعیت
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class=" td-border-simple-table">
                                        <td class="text-right">اصفهان</td>
                                        <td class="text-right">قندی</td>
                                        <td class="text-right">3628</td>
                                        <td class="text-right"> تحت پوشش خدمات شاتل</td>

                                    </tr>
                                    </tbody>
                                </template>
                            </v-simple-table>
                            <v-btn class="mt-4 success"> خرید آنلاین</v-btn>
                        </v-col>
                    </v-row>

                </v-col>
                <v-col cols="12" md="4">
                    <div class="widget mb-3  d-flex flew-row">
                        <div class="widget-icon pa-2">
                            <v-img src="/images/front/adslAvailabilityCheck/shatel-online-order.png" width="70" height="70"></v-img>
                        </div>
                        <div class="widget-content pa-2">
                            <p class="Overline">خرید آنلاین</p>
                            <span class='caption'>خرید خود را اینترنتی انجام دهید</span>
                        </div>
                    </div>
                    <div class="widget mb-3  d-flex flew-row">
                        <div class="widget-icon pa-2">
                            <v-img src="/images/front/adslAvailabilityCheck/shatel-online-order.png" width="70" height="70"></v-img>
                        </div>
                        <div class="widget-content pa-2">
                            <p class="Overline">خرید آنلاین</p>
                            <span class='caption'>خرید خود را اینترنتی انجام دهید</span>
                        </div>
                    </div>
                    <div class="services-widget widget">
                        <div class="services-widget-title pa-3">
                            <p class="ma-0">خدمات صبا نت</p>
                        </div>
                        <div class="services-widget-content ">
                            <v-treeview hoverable :items="treeItem" transition >
                            </v-treeview>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-container>

    </v-main>
</template>

<script>
export default {
    name: "AdslServiceAvailabilityCheck",
    data() {
        return {
            items: [
                {
                    text: 'خانه',
                    disabled: false,
                    href: '/home',
                },
                {
                    text: 'خدمات صبانت',
                    disabled: false,
                    href: 'asd',
                },
                {
                    text: 'بررسی وضعیت دسترسی به ADSL2+',
                    disabled: true,
                    href: 'dassa',
                },
            ],
            treeItem: [
                {
                    id: 1,
                    name: 'اینترنت پرسرعت ADSL2+',

                    children: [
                        { id: 2, name: 'قیمت سروسی ها و تجهیزات اینترنت پرسرعت ثابت (ADSL2+)' },
                        { id: 3, name: 'شیوه استفاده از خدمات ADSL2+' },
                        { id: 4, name: 'خدمات اینترنت پرسرعت شاتل بر بستر بی‌سیم با استفاده از فناوری PTMP' },
                    ],
                },
                {
                    id: 2,
                    name: 'اینترنت پرسرعت ADSL2+',

                    children: [
                        { id: 2, name: 'قیمت سروسی ها و تجهیزات اینترنت پرسرعت ثابت (ADSL2+)' },
                        { id: 3, name: 'شیوه استفاده از خدمات ADSL2+' },
                        { id: 4, name: 'خدمات اینترنت پرسرعت شاتل بر بستر بی‌سیم با استفاده از فناوری PTMP' },
                    ],
                },

            ],
        }
    }
}
</script>

<style scoped>
.Overline,.caption{
    font-family: shabnam !important;
}

</style>
