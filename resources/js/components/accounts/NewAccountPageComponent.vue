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
                                        Follow the 3 simple steps to complete your integration.
                                    </h6>

                                </div>

                                <div class="col-6">

                                    <div class="row text-right" v-if="account.institution_id">
                                        <!-- Project name -->
                                        <!-- <img width="300px" :src=" '/img/logos/' + institutions.filter( institution => institution.id == account.institution_id )+ ' Logo.png'" style="position: absolute; right: 0px; top: -30px"> -->
                                        <img width="300px" :src=" institutions.filter( institution => institution.id == account.institution_id )[0].asset " style="position: absolute; right: 0px; top: -30px">
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
                        <!-- <li :class="'progress-step ' + (step == 2 ? 'is-active' : step > 2 ? 'is-complete' : '')">
                            <div class="progress-text">
                            <h4 class="progress-title">Supply Credentials</h4>
                            &nbsp
                            </div>
                            <div class="progress-marker"></div>

                        </li> -->

                        <li :class="'progress-step ' + (step == 2 ? 'is-active' : step > 2 ? 'is-complete' : '')" aria-current="step">
                            <div class="progress-text">
                            <h4 class="progress-title">Account Settings</h4>
                            &nbsp
                            </div>
                            <div class="progress-marker"></div>

                        </li>

                        <li :class="'progress-step ' + (step == 3 ? 'is-active' : step > 3 ? 'is-complete' : '')">
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
                                :institutions="institutions"
                                :errors="$v.account"
                                :user="user"
                                @manualAccount="manualAccount( $event )"
                                @updateAccount="updateAccount( $event )"
                            />
                        </transition>

                    </form>

                    <div class="col-md-6 offset-md-6 row mt-5 text-right" style="height: 40px;">
                        <!-- Buttons -->
                        <a v-if="step > 2" @click="previousStep()" href="#" class="btn btn-secondary" style="float: left">
                            Prev
                        </a>
                        <a v-if="step < 3" @click="nextStep()" href="#" class="btn btn-primary" style="right: 0px; position: absolute;">
                            Next
                        </a>
                        <a v-if="step == 3" @click="saveAccount( account )" href="#" class="text-right btn btn-primary" style="right: 0px; position: absolute;">
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
        // {path: '/accounts/new/credentials', name:'Credentials', component: CredentialsCard},
        {path: '/accounts/new/settings/:id', name:'Settings', component: SettingsCard},
        {path: '/accounts/new/confirm/:id', name:'Confirm', component: ConfirmCard},
    ]

    const router = new VueRouter ({
        mode: 'history',
        routes,
        props: true
    });

   export default {
        name: 'new-accounts-component',
        router,
        props: [
            'selectedAccount',
            'institutions',
            'user'
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
                this.$router.push({name: this.$router.options.routes[index-1].name, params: {id: this.account.id} });
                this.step = index - 1;
            },
            nextStep() {
                console.log( this.$router.currentRoute.name )
                eval('this.$v.'+ this.$router.currentRoute.name + 'Group.$touch()')
                let invalid = eval('this.$v.'+ this.$router.currentRoute.name + 'Group.$invalid')

                if (!invalid) {
                    if (this.step == 1 && this.account.manual_account == true && this.account.id == null) {
                        this.createManualAccount()
                    } else {
                        let index = this.$router.options.routes.map(function(x) {return x.name; }).indexOf(this.$router.currentRoute.name);
                        this.$router.push({name: this.$router.options.routes[index+1].name, params: {id: this.account.id} });
                        this.step = index + 1;
                    }
                }
            },
            updateAccount( account ) {
                console.log('UPDATE PARENT')
                this.account = account;
                // this.account.institution_id = account.institution_id
                // this.account.name = account.name
                this.account = account
                console.log(this.account)
                this.nextStep();
                // this.$router.push({name: this.$router.options.routes[2].name, params: { id: this.account.id } });
            },
            createManualAccount() {
                var self = this
                this.asyncSendData(this.account, '/accounts/manual', 'POST').then( function( response ) {
                    self.account = response;
                    self.nextStep();
                })
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
                console.log(this.$v.account.$invalid)
                console.log(this.$v.account)

                if (!this.$v.account.$invalid) {
                    console.log('sync')
                    this.asyncSendData(account, '/accounts/'+account.id+'/sync', 'POST').then( function( response ) {
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
                institution_id: {
                    required
                },
                // username: {
                //     required
                // },
                // password: {
                //     required
                // }
            },
            BankGroup: ['account.institution_id'],
            // CredentialsGroup: ['account.username', 'account.password'],
            SettingsGroup: ['account.name', 'account.tracking_type', 'account.tracking_options', 'account.type']
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
