<template>
    <div class="tab-pane fade show active mb-5" id="wizardStepTwo" role="tabpanel" aria-labelledby="wizardTabTwo">

        <!-- Header -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                <!-- Pretitle -->
                <h6 class="mb-4 text-uppercase text-muted">
                    Step 2 of 4
                </h6>

                <!-- Title -->
                <h1 class="mb-3">
                    Next, let’s add your first account.
                </h1>

                <!-- Subtitle -->
                <p class="mb-5 text-muted">
                    We'll need at least one account to track transactions. You can add more later.
                </p>

            </div>
        </div> <!-- / .row -->

        <transition-group name="fade" mode="out-in" >
            <bank-card
                v-if="!dataAccount.mx_institution_code"
                :key="1"
                :account="dataAccount"
                :institutions="institutions"
                :errors="errors"
                @updateAccount="updateAccount($event)"
            />
            <!-- <credentials-card
                v-if="account.institution_id"
                :key="2"
                :account="account"
                :errors="errors"
            /> -->
            <settings-card
                v-if="dataAccount.mx_institution_code"
                :key="2"
                :account="dataAccount"
                :errors="errors"
            />
        </transition-group>

    </div>
</template>

<script>
    import BankCard from '../../accounts/step-cards/BankCard'
    import CredentialsCard from '../../accounts/step-cards/CredentialsCard'
    import SettingsCard from '../../accounts/step-cards/SettingsCard'

    export default {
        props: ['account', 'institutions', 'errors'],
        data() {
            return {
                dataAccount: this.account
            }
        },
        components: {
            BankCard,
            CredentialsCard,
            SettingsCard
        },
        methods: {
            updateAccount( data ) {
                this.dataAccount = data;
                console.log(this.account)
                this.$emit('updateAccount', data)
            }
        }
    }
</script>


<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        transition: opacity .5s
    }
</style>

