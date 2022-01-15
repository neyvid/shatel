<template>
    <div>
        <v-stepper-items>

            <v-stepper-content step="3">
                <p class="mt-8">تکمیل اطلاعات </p>
                <v-divider></v-divider>
                <v-row class="mt-15">
                    <v-col cols="8">
                        <div class="select-customer-type-wrap d-flex justify-center">
                            <v-radio-group
                                v-model="row"
                                row
                                mandatory
                            >
                                <v-radio
                                    label="شخصی"
                                    value="radio-1"
                                    @click="showPersonalForm"
                                ></v-radio>
                                <v-radio
                                    label="سازمان ها و شرکت ها"
                                    value="radio-2"
                                    @click="showCompanyForm"
                                ></v-radio>
                            </v-radio-group>
                        </div>

                    </v-col>

                </v-row>
                <personal-form v-if="personalForm"></personal-form>
                <company-form v-if="companyForm"></company-form>
                <v-btn
                    color="primary"
                    @click="$emit('nextStep')"
                    class="mt-8"
                >
                    Continue
                </v-btn>

                <v-btn text class="mt-8">
                    Cancel
                </v-btn>
            </v-stepper-content>


        </v-stepper-items>
    </div>

</template>

<script>
import PersonalForm from "./PersonalForm";
import CompanyForm from "./CompanyForm";

export default {
    name: "StepThree",
    components: {CompanyForm, PersonalForm},
    data() {
        return {
            personalForm: true,
            companyForm: false,
        }
    },
    methods:{
        showPersonalForm(){
           if(!this.personalForm){
               this.personalForm=true;
               this.companyForm=false;
           }
        },
        showCompanyForm(){
           if(!this.companyForm){
               this.companyForm=true;
               this.personalForm=false;
           }
        }
    }
}
</script>

<style scoped>
.select-customer-type-wrap {
    border: 1px solid #dadada;
    background-color: #f9f9f9;
    border-radius: 10px;
}


</style>
