<template>
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                    {{ this.dataAccount }}
                    {{ this.user }}

                <!-- Form -->
                <form class="tab-content mt-5 card wizard" id="wizardSteps">
                    <transition name="fade">
                        <step-one-card
                            v-if="currentStep == 0"
                            :user="user"
                            :errors="$v.user"
                        />

                        <plan-card
                            v-if="currentStep == 1"
                            :account="dataAccount"
                            :institutions="institutions"
                            :errors="$v.account"
                            :user="dataUser"
                            @updateAccount="updateAccount( $event )"
                            @selectPlan="selectPlan( $event )"
                        />

                        <step-two-card
                            v-if="currentStep == 2"
                            :account="dataAccount"
                            :user="user"
                            :institutions="institutions"
                            :errors="$v.dataAccount"
                            @updateAccount="updateAccount( $event )"
                        />

                        <step-three-card
                            v-if="currentStep == 3"
                            :user="user"
                            :account="dataAccount"
                            :transactions="transactions"
                            @addTransaction="addTransaction()"
                        />

                        <!-- <step-four-card
                            v-if="currentStep == 4"
                            :user="user"
                            :account="dataAccount"
                            :budgets="budgets"
                            :transactions="transactions"
                        /> -->

                        <step-five-card
                            v-if="currentStep == 4"
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
                        <h6 class="text-uppercase text-muted mb-0">Step {{ currentStep + 1 }} of 5</h6>

                        </div>
                        <div class="col-auto">
                            <!-- Button -->
                            <a class="btn btn-lg btn-primary text-white" @click="nextStep" v-if="currentStep == 0">Next</a>
                            <a class="btn btn-lg btn-primary text-white disabled" @click="nextStep" v-if="currentStep == 1 && !selectedPlan">Next</a>
                            <a class="btn btn-lg btn-primary text-white" @click="nextStep" v-if="currentStep == 1 && selectedPlan">Next</a>
                            <a class="btn btn-lg btn-primary text-white" @click="nextStep" v-if="currentStep > 1 && currentStep < 4">Next</a>
                            <a class="btn btn-lg btn-primary text-white" @click="saveData" v-if="currentStep == 4">Go To Dashboard</a>

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
import StepFiveCard from './cards/StepFiveCard'

import { required, minLength, between, optional } from 'vuelidate/lib/validators'

export default {
    props: ['user', 'account', 'institutions', 'transactions'],
    data() {
        return {
            currentStep: 0,
            selectedPlan: this.user.plan,
            dataAccount: !Array.isArray(this.account ) ? this.account : {},
            // user: {},
            // account: {},
            dataUser: this.user,
            dataTransactions: this.transactions,
            dataTest: {},
            budgets: [],
        }
    },
    components: {
        StepOneCard,
        StepTwoCard,
        StepThreeCard,
        StepFourCard,
        StepFiveCard
    },
    methods: {
        nextStep() {
            eval('this.$v.'+ this.getValidations( this.currentStep ) + 'Group.$touch()')
            let invalid = eval('this.$v.'+ this.getValidations( this.currentStep ) + 'Group.$invalid')
            console.log(invalid)
            console.log(this.account)
            if (!invalid && this.currentStep < 6) {
                this.currentStep++;
                if ( this.currentStep == 2 && this.user.billing == 'Free' ) {
                    this.dataAccount.tracking_type = 0;
                }
                if ( this.currentStep == 3 ) {
                    this.fetchTransactions()
                }
                if ( this.currentStep > 2) {
                    this.updateData()
                }
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
                    return 'Plan';
                case 2:
                    return 'StepTwo';
                case 3:
                    return 'StepThree'
                case 4:
                    return 'StepFour'
            }
        },
        updateAccount( account ) {
            this.dataAccount = account
        },
        updateData() {
            let data = {};
            var self = this;
            if (this.user) {
                data.user = this.user
            }
            data.account = this.dataAccount
            this.asyncSendData(data, '/onboarding', 'PUT').then( function( response ) {
                self.dataAccount = response.account;
            })
        },
        saveData() {
            let data = {
                'user': this.user,
                'account': this.dataAccount,
                'budgets': this.budgets,
                'transactions': this.transactions,
                'plan': this.user.billing,
            }
            this.asyncSendData(data, '/onboarding', 'PUT').then( function( response ) {
                window.location.href = "/dashboard"
            })
        },
        fetchTransactions() {
            var self = this;
            if ( this.account && this.account.tracking_type == 0) {
                return;
            }
            this.asyncFetchData('/onboarding/transactions/'+this.account.id+'', 'GET').then( function( response ) {
                console.log('Transactions!')
                console.log(response)
                Vue.set(self.transactions, response)
            })
        },
        addTransaction() {
            this.transactions.push( {
                'account_id': null,
                'user_id': this.user.id,
            })
        },
        selectPlan( plan ) {
            this.selectedPlan = plan
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
            },
            billing: {
                required
            }
        },
        dataAccount: {
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
        },
        transactions: {
            required,
            minLength: minLength(1)
        },
        budgets: {
            optional
        },
        StepOneGroup: ['user.first_name', 'user.last_name', 'user.email', 'user.phone', 'user.income', 'user.pay', 'user.goals'],
        PlanGroup: ['user.billing'],
        StepTwoGroup: ['dataAccount.institution_id', 'dataAccount.name', 'dataAccount.tracking_type', 'dataAccount.tracking_options', 'dataAccount.type'],
        StepThreeGroup: ['transactions'],
        BankGroup: ['account.institution'],
        StepFourGroup: [],
        // CredentialsGroup: ['account.username', 'account.password'],
        SettingsGroup: ['dataAccount.name', 'dataAccount.tracking_type', 'dataAccount.tracking_options', 'dataAccount.type']
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
