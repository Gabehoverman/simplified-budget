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
                  Transactions / All
                </h6>

                <!-- Title -->
                <h1 class="header-title mt-md-5">
                  Transactions
                </h1>

              </div>
              <div class="col-auto">

                <!-- Button -->
                <a href="/accounts" class="btn btn-primary">
                  Add Account
                </a>

              </div>
            </div> <!-- / .row -->
            <div class="row align-items-center" :key="selectedAccount ? selectedAccount.id : null">
              <div class="col">

                <!-- Nav -->
                <ul class="nav nav-tabs nav-overflow header-tabs">
                  <li class="nav-item">
                    <a @click="unselectAccount()" href="#!" :class="!selectedAccount ? 'nav-link active' : 'nav-link'">
                      All Accounts
                      <!-- <span class="badge badge-pill badge-soft-secondary">823</span> -->
                    </a>
                  </li>
                  <li v-for="( account ) in accounts" :key="account.id" class="nav-item">
                    <a @click="selectAccount(account)" href="#!" :class="selectedAccount && selectedAccount.id == account.id ? 'nav-link active' : 'nav-link'">
                      {{ account.name }}
                      <!-- <span class="badge badge-pill badge-soft-secondary">24</span> -->
                    </a>
                  </li>
                </ul>

              </div>
            </div>
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
                    <!-- Button trigger modal -->
                    <button
                        @click="newTransaction()"
                        type="button"
                        class="btn btn-sm btn-primary"
                        data-toggle="modal"
                        data-target="#newTransactionModal"
                        :disabled="accounts.length < 1 ? true : false"
                        >Add Transaction
                    </button>

                  <new-transaction-modal
                    :transaction="selectedTransaction"
                    :accounts="accounts"
                    @saveTransaction="saveTransaction($event)"
                  />
                </div>

              </div>
            </div> <!-- / .row -->
          </div>
          <div class="table-responsive">
            <table id="transactions-table" class="table table-hover table-sm table-nowrap card-table">
              <thead>
                <tr>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-order">
                        #
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-category">
                      Category
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-amount">
                      Amount
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-vendor">
                      Vendor
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-account">
                      Account
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted sort" data-sort="orders-date">
                      Date
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
                <tr v-for="(transaction, index ) in filteredTransactions" :key="index">
                  <td class="orders-order">
                    #{{ index + 1 }}
                  </td>
                  <td class="orders-category">
                    {{ formatString(transaction.category) }}
                  </td>
                  <td class="orders-amount">
                    <div :class="'badge '+getBadgeType( transaction )">
                        ${{ transaction.amount }}
                    </div>
                  </td>
                  <td class="orders-vendor">
                      {{ transaction.vendor }}
                  </td>
                  <td class="orders-account">
                    {{ transaction.account.name }}
                  </td>
                  <td class="orders-date">
                    <time :datetime="transaction.date">{{ getFormattedDate( transaction.date ) }}</time>
                  </td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="window">
                        <i class="fe fe-more-vertical"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a @click="editTransaction( transaction )" href="#!" class="dropdown-item" data-toggle="modal" data-target="#newTransactionModal">
                          Edit
                        </a>
                        <a @click="deleteTransaction( transaction )" href="#!" class="dropdown-item">
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
    import NewTransactionModal from './components/NewTransactionModal'

    export default {
        name: 'transactions-page-component',
        props: [
            'accounts',
            'transactions'
        ],
        components: {
            NewTransactionModal
        },
        data() {
            return {
                selectedAccount: null,
                selectedTransaction: {},
                dataTransactions: this.transactions
            }
        },
        methods: {
            unselectAccount() {
                this.selectedAccount = null
            },
            selectAccount( account ) {
                this.selectedAccount = account;
            },
            editTransaction ( transaction ) {
                this.selectedTransaction = transaction
            },
            newTransaction() {
                this.selectedTransaction = {};
            },
            saveTransaction( transaction ) {
                var self = this;
                let url = '/transactions' + ( transaction.id ? '/'+transaction.id : '')
                let method = transaction.id ? 'PUT' : 'POST'
                this.asyncSendData(transaction, url, method).then( function( response ) {
                    if (!transaction.id) {
                        self.$set(self.transactions, self.transactions.length, response)
                        self.showNotification('success', 'Transaction Posted Successfully!')
                    } else {
                        self.showNotification('success', 'Transaction Updated Successfully!')
                    }
                })
            },
            deleteTransaction( transaction ) {
                var self = this;
                this.asyncSendData(transaction, '/transactions/'+transaction.id, 'DELETE').then( function( response ) {
                    let index = self.transactions.map(function (x) { return x.id; }).indexOf(transaction.id);
                    self.$delete(self.transactions, index)
                    self.showNotification('success', 'Transaction Successfully Removed!')
                })
            }
        },
        computed: {
            filteredTransactions() {
                if (this.selectedAccount) {
                    return this.dataTransactions.filter(x => x.account_id == this.selectedAccount.id)
                }
                return this.dataTransactions
            }
        }
    }
</script>

<style scoped>
    .dropdown .dropdown-menu:not(.show) {
        display: none;
    }
</style>
