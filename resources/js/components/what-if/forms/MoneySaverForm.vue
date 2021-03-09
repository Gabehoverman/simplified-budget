<template>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="mt-3">Details</h3>
            </div>
            <div class="card-body">
                <div class="col-md-12 row">

                    <div class="form-group col-md-12">
                        <label>Money Saver</label>
                        <select class="form-control" v-model="projectionData.money_saver_id" @change="selectMoneySaver">
                            <option value="undefined">Select a Money Saver</option>
                            <option v-for="moneySaver in moneySavers" :key="moneySaver.id" :value="moneySaver.id">{{ moneySaver.name }}</option>
                        </select>
                    </div>


                    <div class="form-group col-md-12" v-if="projectionData.money_saver_id">
                        <label>Compare To</label>
                        <select class="form-control" v-model="projectionData.account_id" @change="fillAccount">
                            <option value="undefined">Select a Debt Account:</option>
                            <option v-for="account in computedAccounts" :key="account.id" :value="account.id">{{ account.name }}</option>
                            <!-- todo: consider adding a custom option -->
                            <!-- <option value="custom">Custom Debt</option> -->
                        </select>
                    </div>

                    <!-- todo: Match MoneySaver details to the account details -->
                    <!-- <div class="form-group col-md-12 row" v-if="projectionData.money_saver_id && projectionData.account_id">
                        <div class="col-md-6">
                            <p>{{ this.selectedAccount.name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>{{ this.selectedMoneySaver.name }}</p>
                        </div>
                    </div>
                    <div v-if="projectionData.money_saver_id && projectionData.account_id" class="col-md-12 row">
                        <div class="form-group col-md-12 row" v-for="( feature, index ) in selectedMoneySaver.features" :key="index">

                            <div class="col-md-6">
                                   <label>{{ feature.label }}</label>
                                <p>{{ getCompareTo( feature ) }}</p>
                            </div>

                            <div class="col-md-6">
                                <label>{{ feature.label }}</label>
                                <p>{{ feature.value }}</p>
                            </div>
                        </div>
                    </div> -->

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
    props: ["projectionData", "projectionResults", 'accounts', 'moneySavers'],
    data() {
        return {
            selectedMoneySaver: this.projectionData.money_saver_id ? this.moneySavers[this.moneySavers.map( function(saver) { return saver.id }).indexOf( this.projectionData.money_saver_id )] : null,
            selectedAccount: null
        }
    },
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
        selectMoneySaver() {
            let index = this.moneySavers.map( function(saver) { return saver.id }).indexOf( this.projectionData.money_saver_id )
            this.selectedMoneySaver = this.moneySavers[index];
        },
        fillAccount() {
            if ( this.projectionData.account_id != 'undefined' && this.projectionData.account_id != 'custom' ) {
                let index = this.accounts.map( function(account) { return account.id }).indexOf( this.projectionData.account_id )
                this.selectedAccount = this.accounts[index];
                this.projectionData.account_amount = this.accounts[index].balance
                this.projectionData.account_apr = this.accounts[index].apr
                this.projectionData.account_current_payment = this.accounts[index].minimum_payment
            }
        },
        getCompareTo( feature ) {
            var self = this;
            if (feature.compare_to) {
                return this.selectedAccount[ feature.compare_to ]
            }
            var parentType = this.selectedMoneySaver.type.features.filter( function(type) { return type.label == feature.label });
            if (parentType[0]) {
                return this.selectedAccount[parentType[0].compare_to];
            }
        }
    },
    computed: {
        computedAccounts() {
            var self = this;
            return this.accounts.filter( function(account) { return account.type == self.selectedMoneySaver.type.account_type });
        }
    },
    validations: {
            projectionData: {
                money_saver_id: {
                    required
                },
                account_id: {
                    required
                },
            },
        }
};
</script>
