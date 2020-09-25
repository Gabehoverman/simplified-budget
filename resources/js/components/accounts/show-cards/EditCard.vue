<template>
    <div class="col-12">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Edit Account</div>

                    <div class="card-body">

                        <!-- <bank-card
                            :account="account"
                            :errors="$v.account"
                            :institutions="institutions"
                        /> -->

                        <!-- <credentials-card
                            :account="account"
                            :errors="$v.account"
                        /> -->

                        <settings-card
                            :account="account"
                            :errors="$v.account"
                        />

                        <div class="col-md-6 offset-md-6 row mt-5 text-right">
                            <a @click="saveAccount( account )" href="#" class="text-right btn btn-primary" style="float: right;">
                                Update
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { required, minLength, between } from 'vuelidate/lib/validators'

    import BankCard from '../step-cards/BankCard'
    import CredentialsCard from '../step-cards/CredentialsCard'
    import SettingsCard from '../step-cards/SettingsCard'

    export default {
        props: ['account', 'institutions'],
        components: {
            BankCard,
            CredentialsCard,
            SettingsCard
        },
        methods: {
            saveAccount( account ) {
                var self = this;
                this.$v.account.$touch()

                if (!this.$v.account.$invalid) {
                    this.$emit('saveAccount', account)
                }
            }
        },
        validations: {
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
                }
            },
            BankGroup: ['account.institution_id'],
            CredentialsGroup: ['account.username', 'account.password'],
            SettingsGroup: ['account.name', 'account.tracking_type', 'account.tracking_options', 'account.type']
        }
    }
</script>

<style>
    .card-lead {
        display: none;
    }
</style>
