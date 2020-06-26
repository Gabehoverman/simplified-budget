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

                    <!-- Title -->
                    <!-- <h1 class="header-title">
                      Create a new project
                    </h1> -->

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
                                <div class="col">

                                    <!-- Title -->
                                    <h2 class="header-title mb-5">
                                        Add New Account
                                    </h2>

                                    <!-- Pretitle -->
                                    <h6 class="header-pretitle">
                                        Follow the simple 4 Steps to complete your integration.
                                    </h6>

                                    <!-- Title -->
                                    <!-- <h1 class="header-title">
                                    Create a new project
                                    </h1> -->

                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="col-md-4 col-lg-4 col-sm-4">
                    Steps to Complete
                </div>
                <div class="col-md-8 col-lg-8 col-sm-8">
                    <form class="mb-4">

                        <h3 class="mb-5">Account Settings</h3>

                        <div class="row">
                            <!-- Project name -->
                            <div class="form-group col-md-6">
                                <label>
                                    Account Name
                                </label>
                                <input v-model="account.name" name="name" type="text" :class="'form-control '+($v.account.name.$error ? 'is-invalid ' : '')">
                            </div>

                            <!-- Project tags -->
                            <div class="form-group col-md-6">
                                <label>
                                    Account Type
                                </label>
                                <select v-model="account.type" :class="'form-control '+($v.account.type.$error ? 'is-invalid ' : '')" data-toggle="select">
                                    <option value="undefined" disabled>Select an Option</option>
                                    <option value="0">Checking</option>
                                    <option value="1">Savings</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">

                            <!-- Project tags -->
                            <div class="form-group col-md-6">
                                <label>
                                    Transaction Recording
                                </label>
                                <select v-model="account.tracking_type"  :class="'form-control '+($v.account.tracking_type.$error ? 'is-invalid ' : '')" data-toggle="select">
                                    <option value="undefined" disabled>Select an Option</option>
                                    <option value="1">Automatic</option>
                                    <option value="0">Manual</option>
                                </select>
                            </div>

                            <!-- Project tags -->
                            <div class="form-group col-md-6">
                                <label>
                                    Tracking Options
                                </label>
                                <select v-model="account.tracking_options" :class="'form-control '+($v.account.tracking_options.$error ? 'is-invalid ' : '')" data-toggle="select">
                                    <option value="undefined" disabled>Select an Option</option>
                                    <option value="0">Income & Expenses</option>
                                    <option value="1">Income Only</option>
                                    <option value="2">Expenses Only</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-1 offset-md-10 row mt-5 text-right">
                            <!-- Buttons -->
                            <!-- <a href="#" class="text-muted" style="float: left">
                                Previous |
                            </a> -->
                            <a @click="saveAccount( account )" href="#" class="text-right btn btn-primary" style="float: right">
                                Create
                            </a>
                        </div>

                    </form>
                    </div>
                </div>
            </div>
        </div> <!-- / .row -->
    </div>
</template>

<script>
    import { required, minLength, between } from 'vuelidate/lib/validators'

   export default {
        name: 'accounts-page-component',
        props: [
            'accounts',
        ],
        components: {

        },
        data() {
            return {
                selectedAccount: null,
                account: {}
            }
        },
        methods: {
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
                }
            }
        }
    }
</script>
