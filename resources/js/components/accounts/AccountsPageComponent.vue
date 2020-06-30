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

        <!-- Card -->
        <div class="card" data-toggle="lists" data-lists-values='["orders-order", "orders-product", "orders-date", "orders-total", "orders-status", "orders-method"]'>
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col">

                <!-- Search -->
                <form class="row align-items-center">
                  <div class="col-auto pr-0">
                    <span class="fe fe-search text-muted"></span>
                  </div>
                  <div class="col">
                      <input type="search" class="form-control form-control-flush search" placeholder="Search">
                  </div>
                </form>

              </div>
              <div class="col-auto">

                <!-- Button -->

                <div class="dropdown">
                </div>

              </div>
            </div> <!-- / .row -->
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-sm table-nowrap card-table">
              <thead>
                <tr>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-order">
                      Account #
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-category">
                      Name
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-amount">
                      Transactions
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-vendor">
                      Account Type
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-account">
                      institution
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-date">
                      Tracking
                    </a>
                  </th>
                  <th colspan="2">
                    <a href="#" class="text-muted sort" data-sort="orders-method">
                      Actions
                    </a>
                  </th>
                </tr>
              </thead>
              <tbody class="list">
                <tr v-for="(account, index ) in dataAccounts" :key="index">
                  <td class="orders-order">
                    {{ index + 1 }}
                  </td>
                  <td class="orders-category">
                      <div class="avatar avatar-account avatar-rounded">
                          <p>{{ getInitials(account.name) }}</p>
                      </div>
                    {{ account.name }}
                  </td>
                  <td class="orders-amount">
                    {{ account.transactions.length }}
                  </td>
                  <td class="orders-vendor">
                    <!-- <div class="badge badge-soft-success"> -->
                      {{ getAccountLabel( account.type ) }}
                    <!-- </div> -->
                  </td>
                  <td class="orders-account">
                    {{ account.institution }}
                  </td>
                  <td class="orders-tracking">
                    {{ getTrackingLabel( account.tracking_options ) }}
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="window">
                        <i class="fe fe-more-vertical"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="#!" class="dropdown-item">
                          Edit
                        </a>
                        <a @click="deleteAccount( account )" href="#!" class="dropdown-item">
                          Delete
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div> <!-- / .row -->
  </div>
</template>

<script>
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
