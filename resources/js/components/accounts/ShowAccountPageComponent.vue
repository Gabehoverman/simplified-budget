<template>
 <div class="container-fluid ">
    <notifications group="notification"/>
    <div class="row justify-content">
          <div class="col-12 col-lg-12 col-xl-12">

                <!-- Header -->
                <div class="header">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Pretitle -->
                                <h6 class="header-pretitle">
                                Accounts / Details
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title mt-md-5">
                                {{ account.name }}
                                </h1>

                            </div>
                        </div> <!-- / .row -->
                        <div class="row">
                            <div class="col">

                                <!-- Nav -->
                                <ul class="nav nav-tabs nav-overflow header-tabs">
                                    <li class="nav-item">
                                        <a @click="selectTab('details')" href="#!" :class="selectedTab == 'details' ? 'nav-link active' : 'nav-link'">
                                            Account Details
                                        <!-- <span class="badge badge-pill badge-soft-secondary">823</span> -->
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="selectTab('transactions')" href="#!" :class="selectedTab == 'transactions' ? 'nav-link active' : 'nav-link'">
                                            Recorded Transactions
                                        <!-- <span class="badge badge-pill badge-soft-secondary">823</span> -->
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="selectTab('edit')" href="#!" :class="selectedTab == 'edit' ? 'nav-link active' : 'nav-link'">
                                            Edit Account
                                        <!-- <span class="badge badge-pill badge-soft-secondary">823</span> -->
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
          </div>

          <details-card
                v-if="selectedTab == 'details'"
                :account="account"
            />

            <transactions-card
                v-if="selectedTab == 'transactions'"
                :account="account"
                :transactions="transactions"
            />

            <edit-card
                v-if="selectedTab == 'edit'"
                :account="account"
                :institutions="institutions"
                @saveAccount="saveAccount"
            />

    </div> <!-- / .row -->
</div>
</template>

<script>
    import DetailsCard from './show-cards/DetailsCard'
    import EditCard from './show-cards/EditCard'
    import TransactionsCard from './show-cards/TransactionsCard'

   export default {
        name: 'show-account-page-component',
        props: [
            'selectedAccount',
            'transactions',
            'institutions'
        ],
        components: {
            DetailsCard,
            DetailsCard,
            TransactionsCard,
        },
        data() {
            return {
                account: this.selectedAccount ? this.selectedAccount : {},
                selectedTab: 'details',
            }
        },
        methods: {
            selectTab( tab ) {
                this.selectedTab = tab
            },
            saveAccount( account ) {
                var self = this;
                this.asyncSendData(account, '/accounts/'+this.account.id, 'PUT').then( function( response ) {
                    self.showNotification('success', 'Account Successfuly Updated!')
                })
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
