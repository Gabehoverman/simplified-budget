<template>
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">

            <!-- Form -->
            <form class="tab-content mt-5 card wizard" id="wizardSteps">
                <transition name="fade">
                    <step-one-card
                        v-if="currentStep == 0"
                        :user="user"
                        :errors="$v.user"
                    />

                    <step-two-card
                        v-if="currentStep == 1"
                        :account="account"
                        :institutions="institutions"
                        :errors="$v.account"
                    />

                    <step-three-card
                        v-if="currentStep == 2"
                        :user="user"
                        :transactions="transactions"
                    />

                    <step-four-card
                        v-if="currentStep == 3"
                        :user="user"
                    />
                </transition>

                <!-- Footer -->
                <div class="row align-items-center">
                    <div class="col-auto">

                    <!-- Button -->
                    <a v-if="currentStep > 0" class="btn btn-lg btn-white" @click="previousStep">Back</a>

                    </div>
                    <div class="col text-center">

                    <!-- Step -->
                    <h6 class="text-uppercase text-muted mb-0">Step {{ currentStep + 1 }} of 4</h6>

                    </div>
                    <div class="col-auto">

                        <!-- Button -->
                        <a class="btn btn-lg btn-primary text-white" @click="nextStep" v-if="currentStep < 3">Next</a>
                        <a class="btn btn-lg btn-primary text-white" @click="saveData" v-if="currentStep == 3">Go To Dashboard</a>

                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</template>

<script>
import StepOneCard from './cards/StepOneCard'
import StepTwoCard from './cards/StepTwoCard'
import StepThreeCard from './cards/StepThreeCard'
import StepFourCard from './cards/StepFourCard'

import { required, minLength, between } from 'vuelidate/lib/validators'

export default {
    props: ['user', 'institutions'],
    data() {
        return {
            currentStep: 0,
            // user: {},
            account: {},
            transactions: [],
        }
    },
    components: {
        StepOneCard,
        StepTwoCard,
        StepThreeCard,
        StepFourCard
    },
    methods: {
        nextStep() {
            eval('this.$v.'+ this.getValidations( this.currentStep ) + 'Group.$touch()')
            let invalid = eval('this.$v.'+ this.getValidations( this.currentStep ) + 'Group.$invalid')
            if (!invalid && this.currentStep < 4) {
                this.currentStep++;
            }
        },
        previousStep() {
            if (this.currentStep > 0) {
                this.currentStep--;
            }
        },
        getValidations( step ) {
            switch (step) {
                case 0:
                    return 'StepOne';
                case 1:
                    return 'StepTwo';
                case 2:
                    return 'StepThree'
            }
        },
        saveData() {
            let data = {
                'user': this.user,
                'account': this.account,
                'transactions': this.transactions,
            }
            this.asyncSendData(data, '/onboarding', 'POST').then( function( response ) {
                window.location.href = "/dashboard"
            })
        }
    },
    validations: {
        user: {
            first_name: {
                required
            },
            last_name: {
                required
            },
            email: {
                required
            },
            phone: {
                required
            },
            income: {
                required
            },
            pay: {
                required
            },
            goals: {
                required
            }
        },
        account: {
            name: {
                required
            },
            type: {
                required
            },
            tracking_type: {
                required
            },
            tracking_options: {
                required
            },
            institution_id: {
                required
            },
            username: {
                required
            },
            password: {
                required
            },
        },
        transactions: {
            required,
            minLength: minLength(1)
        },
        StepOneGroup: ['user.first_name', 'user.last_name', 'user.email', 'user.phone', 'user.income', 'user.pay', 'user.goals'],
        StepTwoGroup: ['account.institution_id', 'account.username', 'account.password', 'account.name', 'account.tracking_type', 'account.tracking_options', 'account.type'],
        StepThreeGroup: ['transactions'],
        BankGroup: ['account.institution'],
        CredentialsGroup: ['account.username', 'account.password'],
        SettingsGroup: ['account.name', 'account.tracking_type', 'account.tracking_options', 'account.type']
    }
}
</script>

<style scoped>
    .wizard {
        padding: 25px;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-enter-to, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        transition: opacity .5s
    }
</style>
