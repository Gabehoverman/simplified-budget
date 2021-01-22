<template>
    <div>

        <h5 class="mb-5 mt-4">Additional Details</h5>

        <div class="row">

            <div class="form-group col-md-6" v-if="isDebtAccount( account )">
                <label>
                    Account APR
                </label>
                <!-- <vue-mask type="number" :class="'form-control '+(errors.apr.$error ? 'is-invalid ' : '')" name="phone" mask="00.00" v-model="account.apr" :options="{raw: true}"/> -->
                <input maxlength="5" :class="'form-control '+(errors.apr.$error ? 'is-invalid ' : '')" v-model="account.apr" name="apr" type="text" @keyup="forceDecimal()">
            </div>

             <div class="form-group col-md-6" v-if="isDebtAccount( account )">
                <label>
                    {{ account.type == 2 ? 'Minimum Payment' : 'Monthly Payment' }}
                </label>
                <input v-model="account.minimum_payment" name="minimum_payment" type="text" :class="'form-control '+(errors.minimum_payment.$error ? 'is-invalid ' : '')">
            </div>

            <!-- <div class="form-group col-md-6" v-if="[2,3,4].includes( account.type )">
                <label>
                    Account APR
                </label>
                <input maxlength="5" v-model="account.apr" name="apr" type="text" :class="'form-control '+(errors.apr.$error ? 'is-invalid ' : '')">
            </div> -->

        </div>
    </div>
</template>

<script>
    export default {
        props: ['account', 'institutions', 'errors'],
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            forceDecimal() {
                if ( this.account.apr.length > 2 && !this.account.apr.includes('.') ) {
                    this.account.apr = this.account.apr.substring(0,2) + '.' + this.account.apr.substring(2,3);
                }
            }
        }
    }
</script>
