<template>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="mt-3">Details</h3>
            </div>
            <div class="card-body">

                <div class="form-group col-md-12">
                    <label>Amount</label>
                    <input
                        type="text"
                        :class="'form-control '+($v.projectionData.debt_amount.$error ? 'is-invalid ' : '')"
                        v-model="projectionData.debt_amount"
                    />
                </div>

                <div class="form-group col-md-12">
                    <label>APR</label>
                    <input
                        type="text"
                        :class="'form-control '+($v.projectionData.debt_apr.$error ? 'is-invalid ' : '')"
                        v-model="projectionData.debt_apr"
                    />
                </div>

                <div class="row col-md-12">

                    <div class="form-group col">
                        <label v-if="projectionData.debt_timeframe == 1">Months to Payoff</label>
                        <label v-else>Monthly Payment</label>
                        <input
                            type="text"
                            :class="'form-control '+($v.projectionData.debt_payment.$error ? 'is-invalid ' : '')"
                            v-model="projectionData.debt_payment"
                            @keyup="limitPayment()"
                        />
                    </div>

                    <div class="forn-group col-auto">
                        <toggle-button v-model="projectionData.debt_timeframe"
                            :color="{checked: '#0095f7', unchecked: '#0095f7', disabled: '#0095f7'}"
                            :width="80"
                            :labels="{checked: 'Term', unchecked: 'Payment'}"
                        />
                    </div>

                </div>


                <div class="form-group col-md-12 text-right">
                    <a href="#" class="btn btn-primary" @click="calculate">Calculate</a>
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
            }
        }
    },
    validations: {
        projectionData: {
            debt_amount: {
                required
            },
            debt_apr: {
                required
            },
            debt_payment: {
                required
            }
        },
    }
};
</script>
