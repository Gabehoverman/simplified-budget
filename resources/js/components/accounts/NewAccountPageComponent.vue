<template>
 <div class="container-fluid ">
    <div class="row justify-content-center">
          <div class="col-12 col-lg-12 col-xl-12">

            <!-- Header -->
            <div class="header mt-md-5">
              <div class="header-body">
                <div class="row align-items-center">
                  <div class="col">

                    <!-- Pretitle -->
                    <h6 class="header-pretitle">
                      Accounts / New
                    </h6>

                  </div>
                </div> <!-- / .row -->
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-12 col-xl-12">
            <div class="card row" style="padding: 25px; flex-direction: row">
                <div class="col-md-12">

                    <div class="header">
                        <div class="header-body">
                            <div class="row align-items-center">
                                <div class="col-6">

                                    <!-- Title -->
                                    <h2 class="header-title mb-5">
                                        Add New Account
                                    </h2>

                                    <!-- Pretitle -->
                                    <h6 class="header-pretitle">
                                        Follow the simple 4 Steps to complete your integration.
                                    </h6>

                                </div>

                                <div class="col-6">

                                    <div class="row text-right" v-if="account.institution">
                                        <!-- Project name -->
                                        <img width="300px" :src=" '/img/logos/' + account.institution + ' Logo.png'" style="position: absolute; right: 0px; top: -30px">
                                    </div>

                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="col-md-4 col-lg-4 col-sm-4">

                    <ul class="progress-tracker progress-tracker--vertical">
                        <li :class="'progress-step ' + (step == 1 ? 'is-active' : step > 1 ? 'is-complete' : '')">
                            <div class="progress-text">
                            <h4 class="progress-title">Select a Bank</h4>
                            &nbsp
                            </div>
                            <div class="progress-marker"></div>
                        </li>

                        <li :class="'progress-step ' + (step == 2 ? 'is-active' : step > 2 ? 'is-complete' : '')">
                            <div class="progress-text">
                            <h4 class="progress-title">Supply Credentials</h4>
                            &nbsp
                            </div>
                            <div class="progress-marker"></div>

                        </li>

                        <li :class="'progress-step ' + (step == 3 ? 'is-active' : step > 3 ? 'is-complete' : '')" aria-current="step">
                            <div class="progress-text">
                            <h4 class="progress-title">Account Settings</h4>
                            &nbsp
                            </div>
                            <div class="progress-marker"></div>

                        </li>

                        <li :class="'progress-step ' + (step == 4 ? 'is-active' : step > 4 ? 'is-complete' : '')">
                            <div class="progress-text">
                            <h4 class="progress-title">Confirm</h4>
                            &nbsp
                            </div>
                            <div class="progress-marker"></div>

                        </li>
                    </ul>
                </div>
                <div class="col-md-8 col-lg-8 col-sm-8">
                    <form class="mb-4 new-account-form">

                        <transition name="fade" mode="out-in">
                            <router-view
                                :account="account"
                                :errors="$v.account"
                            />
                        </transition>

                    </form>

                    <div class="col-md-6 offset-md-6 row mt-5 text-right">
                        <!-- Buttons -->
                        <a v-if="step != 1" @click="previousStep()" href="#" class="btn btn-secondary" style="float: left">
                            Prev
                        </a>
                        <a v-if="step < 4" @click="nextStep()" href="#" class="btn btn-primary" style="right: 0px; position: absolute;">
                            Next
                        </a>
                        <a v-if="step == 4" @click="saveAccount( account )" href="#" class="text-right btn btn-primary" style="right: 0px; position: absolute;">
                            Create
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div> <!-- / .row -->
</div>
</template>

<script>
    import { required, minLength, between } from 'vuelidate/lib/validators'

    import BankCard from './step-cards/BankCard'
    import CredentialsCard from './step-cards/CredentialsCard'
    import SettingsCard from './step-cards/SettingsCard'
    import ConfirmCard from './step-cards/ConfirmCard'

    import Vue from 'vue';
    import VueRouter from 'vue-router';

    Vue.use(VueRouter);

    const routes = [
        {path: '/accounts/new', redirect: '/accounts/new/bank'},
        {path: '/accounts/new/bank', name:'Bank', component: BankCard},
        {path: '/accounts/new/credentials', name:'Credentials', component: CredentialsCard},
        {path: '/accounts/new/settings', name:'Settings', component: SettingsCard},
        {path: '/accounts/new/confirm', name:'Confirm', component: ConfirmCard},
    ]

    const router = new VueRouter ({
        mode: 'history',
        routes,
        props: true
    });

   export default {
        name: 'accounts-page-component',
        router,
        props: [
            'selectedAccount',
        ],
        components: {
            SettingsCard
        },
        data() {
            return {
                account: this.selectedAccount ? this.selectedAccount : {},
                step: this.$router.options.routes.map(function(x) {return x.name; }).indexOf(this.$router.currentRoute.name),
            }
        },
        methods: {
            previousStep() {
                let index = this.$router.options.routes.map(function(x) {return x.name; }).indexOf(this.$router.currentRoute.name);
                this.$router.push({name: this.$router.options.routes[index-1].name});
                this.step = index - 1;
            },
            nextStep() {
                eval('this.$v.'+ this.$router.currentRoute.name + 'Group.$touch()')
                let invalid = eval('this.$v.'+ this.$router.currentRoute.name + 'Group.$invalid')
                if (!invalid) {
                    let index = this.$router.options.routes.map(function(x) {return x.name; }).indexOf(this.$router.currentRoute.name);
                    this.$router.push({name: this.$router.options.routes[index+1].name });
                    this.step = index + 1;
                }
            },
            unselectAccount() {
                this.selectedAccount = null
            },
            selectAccount( account ) {
                this.selectedAccount = account;
            },
            saveAccount( account ) {
                var self = this;
                this.$v.account.$touch()

                if (!this.$v.$invalid) {
                    this.asyncSendData(account, '/accounts', 'POST').then( function( response ) {
                        window.location.href = "/accounts"
                    })
                }
            },
            deleteAccount( account ) {
                var self = this;
                this.asyncSendData(account, '/accounts/'+account.id, 'DELETE').then( function( response ) {
                    let index = self.accounts.map(function (x) { return x.id; }).indexOf(account.id);
                    self.$delete(self.accounts, index)
                })
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
                },
                institution: {
                    required
                },
                username: {
                    required
                },
                password: {
                    required
                }
            },
            BankGroup: ['account.institution'],
            CredentialsGroup: ['account.username', 'account.password'],
            SettingsGroup: ['account.name', 'account.tracking_type', 'account.tracking_options', 'account.type']
        }
    }
</script>
