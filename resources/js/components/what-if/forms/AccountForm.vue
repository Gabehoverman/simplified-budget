<template>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="mt-3">Details</h3>
            </div>
            <div class="card-body">
                <div class="col-md-12 row">
                    <div class="form-group col-md-12">
                        <!-- todo: Pull in debt accounts here -->
                        <label>Account</label>
                        <select class="form-control" v-model="projectionData.account_id" @change="fillAccount">
                            <!-- todo: pull in all debt accounts -->
                            <option value="undefined">Select a Debt Account:</option>
                            <option v-for="account in accounts" :key="account.id" :value="account.id">{{ account.name }}</option>
                            <option value="custom">Custom Debt</option>
                        </select>
                    </div>

                    <!-- todo: prefil these based on selected account -->

                    <div class="form-group col-md-12">
                        <label>Amount</label>
                        <input
                            type="text"
                            :class="'form-control '+($v.projectionData.account_amount.$error ? 'is-invalid ' : '')"
                            v-model="projectionData.account_amount"
                        />
                    </div>

                    <div class="form-group col-md-12">
                        <label>APR</label>
                        <input
                            type="text"
                            :class="'form-control '+($v.projectionData.account_apr.$error ? 'is-invalid ' : '')"
                            v-model="projectionData.account_apr"
                        />
                    </div>

                    <div class="row col-md-12">

                        <div class="form-group col" v-if="projectionData.account_current_monthly != 1">
                            <label>Current Monthly Payment</label>
                            <input
                                type="text"
                                :class="'form-control '+($v.projectionData.account_current_payment.$error ? 'is-invalid ' : '')"
                                v-model="projectionData.account_current_payment"
                            />
                        </div>

                        <div class="form-group col" v-if="projectionData.account_current_monthly == 1">
                            <label>Current Payoff Rate (months)</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="projectionData.account_original_payoff"
                            />
                        </div>
    <!--
                        <div class="forn-group col-auto">
                            <toggle-button v-model="projectionData.account_current_monthly"
                                :color="{checked: '#0095f7', unchecked: '#0095f7', disabled: '#0095f7'}"
                                width="75"
                                :labels="{checked: 'Months', unchecked: 'Payment'}"
                            />
                        </div> -->

                    </div>

                    <div class="row col-md-12">

                        <div class="form-group col">
                            <label v-if="projectionData.account_one_time == 1">One Time Payment Amount</label>
                            <label v-else>New Monthly Payment</label>
                            <input
                                type="text"
                                :class="'form-control '+($v.projectionData.account_new_payment.$error ? 'is-invalid ' : '')"
                                v-model="projectionData.account_new_payment"
                                @keyup="limitPayment()"
                            />
                        </div>

                        <div class="forn-group col-auto">
                            <toggle-button v-model="projectionData.account_one_time"
                                :color="{checked: '#0095f7', unchecked: '#0095f7', disabled: '#0095f7'}"
                                :width="80"
                                :labels="{checked: 'One Time', unchecked: 'Monthly'}"
                            />
                        </div>

                    </div>

                    <div class="form-group col-md-12 text-right">
                        <button class="btn btn-primary" @click="calculate">Calculate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { required, minLength, sameAs } from "vuelidate/lib/validators";

export default {
    props: ["projectionData", "projectionResults", 'accounts'],
    methods: {
        calculate() {
            this.$v.projectionData.$touch()

            if (!this.$v.projectionData.$invalid) {
                this.$emit('calculate');
            }
        },
        limitPayment() {
            if ( parseInt(this.projectionData.account_new_payment) > parseInt( this.projectionData.account_amount ) ) {
                this.projectionData.account_new_payment = this.projectionData.account_amount;
            }
        },
        fillAccount() {
            if ( this.projectionData.account_id != 'undefined' && this.projectionData.account_id != 'custom' ) {
                let index = this.accounts.map( function(account) { return account.id }).indexOf( this.projectionData.account_id )
                this.projectionData.account_amount = this.accounts[index].balance
                this.projectionData.account_apr = this.accounts[index].apr
                this.projectionData.account_current_payment = this.accounts[index].minimum_payment
            }
        }
    },
    validations: {
            projectionData: {
                account_amount: {
                    required
                },
                account_apr: {
                    required
                },
                account_current_payment: {
                    required
                },
                account_new_payment: {
                    required
                }
            },
        }
};
</script>
