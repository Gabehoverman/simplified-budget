<template>
<div class="container-fluid">
    <notifications group="notification"/>

    <div class="row justify-content-center">
      <div class="col-12">

        <!-- Header -->
        <div class="header">
          <div class="header-body">
            <div class="row align-items-center">
              <div class="col">

                <!-- Pretitle -->
                <h6 class="header-pretitle">
                  Accounts / All
                </h6>

                <!-- Title -->
                <h1 class="header-title mt-md-5">
                  Accounts
                </h1>

              </div>
              <div class="col-auto">

                <!-- Button -->
                <a href="/accounts/new" class="btn btn-primary">
                  Add Account
                </a>

              </div>
            </div> <!-- / .row -->
          </div>
        </div>

        <tile-component
            :accounts="accounts"
            @deleteAccount="deleteAccount( $event )"
        />

      </div>
    </div> <!-- / .row -->
  </div>
</template>

<script>
    import TableComponent from './components/TableComponent'
    import TileComponent from './components/TileComponent'


   export default {
        name: 'accounts-page-component',
        props: [
            'accounts',
        ],
        components: {
            TableComponent,
            TileComponent
        },
        data() {
            return {
                selectedAccount: null,
                dataAccounts: this.accounts
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
                this.asyncSendData(account, '/accounts', 'POST').then( function( response ) {
                    self.$set(self.accounts, self.accounts.length, response)
                })
            },
            deleteAccount( account ) {
                var self = this;
                this.asyncSendData(account, '/accounts/'+account.id, 'DELETE').then( function( response ) {
                    let index = self.accounts.map(function (x) { return x.id; }).indexOf(account.id);
                    self.$delete(self.accounts, index)
                    self.showNotification('success', 'Account Successfuly Removed!')
                })
            }
        },
    }
</script>

<style scoped>
    .dropdown .dropdown-menu:not(.show) {
        display: none;
    }
</style>
