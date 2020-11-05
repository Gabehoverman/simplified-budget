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
            <div class="row align-items-center" >
              <div class="col">

                <!-- Nav -->
                <ul class="nav nav-tabs nav-overflow header-tabs">
                  <li class="nav-item">
                    <a @click="unselectAccount()" href="#!" :class="!selectedAccount ? 'nav-link active list-filter' : 'nav-link list-filter'">All Accounts</a>
                  </li>
                  <li v-for="( account ) in accounts" :key="account.id" class="nav-item">
                    <a href="#!" @click="selectAccount( account )" :class="selectedAccount && selectedAccount.id == account.id ? 'nav-link active list-filter' : 'nav-link list-filter'">{{ account.name }}</a>
                  </li>
                </ul>

              </div>
            </div>
          </div>
        </div>

        <!-- Card -->
        <div id="list" class="card list" data-toggle="lists" data-list='{"valueNames": ["orders-order", "orders-category", "orders-amount", "orders-vendor", "orders-account", "orders-method", "orders-date","orders-type", "orders-filter-date"], "page": 10, "pagination": {"paginationClass": "list-pagination"}}'>
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col">

                <!-- Search -->
                <form class="row align-items-center">
                  <div class="col-auto pr-0">
                    <span class="fe fe-search text-muted"></span>
                  </div>
                  <div class="col">
                      <input type="search" class="form-control form-control-flush list-search" placeholder="Search">
                  </div>
                </form>

              </div>
              <div class="col-auto">
                <div class="col-auto" data-select2-id="18">

                    <!-- Dropdown -->
                    <div class="dropdown" data-select2-id="17">

                        <!-- Toggle -->
                        <button class="btn btn-sm btn-white" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fe fe-sliders mr-1"></i> Filter <span class="badge badge-primary ml-1 d-none">0</span>
                        </button>

                        <!-- Menu -->
                        <form class="dropdown-menu dropdown-menu-right dropdown-menu-card" style="" data-select2-id="16">
                        <div class="card-header">

                            <!-- Title -->
                            <h4 class="card-header-title">
                            Filters
                            </h4>

                            <!-- Link -->
                            <a href="#" class="btn btn-sm btn-link text-reset clear-filters-btn" type="reset">
                                <small>Clear filters</small>
                            </a>

                        </div>
                        <div class="card-body" data-select2-id="15">

                            <!-- List group -->
                            <div class="list-group list-group-flush mt-n4" data-select2-id="14">
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col">

                                            <!-- Text -->
                                            <small>Category</small>

                                        </div>
                                        <div class="col-8">

                                            <!-- Select -->
                                            <select class="custom-select custom-select-sm addl-filter" data-filter-key="orders-category" name="item-title" data-toggle="select" data-options="{'minimumResultsForSearch': -1}" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                                <option value="any" selected="" data-select2-id="6">Any</option>
                                                <option v-for="(key, category) in $transactionCategories" :key="key" :value="key">{{ category }}</option>
                                            </select>
                                        </div>
                                    </div> <!-- / .row -->
                                </div>
                                <div class="list-group-item" data-select2-id="13">
                                    <div class="row" data-select2-id="12">
                                        <div class="col">

                                            <!-- Text -->
                                            <small>Type</small>

                                        </div>
                                        <div class="col-8" data-select2-id="11">

                                            <!-- Select -->
                                            <select class="custom-select custom-select-sm addl-filter" data-filter-key="orders-type" name="item-score" data-toggle="select" data-options="{'minimumResultsForSearch': -1}" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                                <option value="any" selected="" data-select2-id="9">Any</option>
                                                <option value="Expense" data-select2-id="24">Expense</option>
                                                <option value="Income" data-select2-id="24">Income</option>
                                                <option value="Transfer" data-select2-id="24">Transfer</option>
                                                <option value="Fee" data-select2-id="24">Fee</option>
                                            </select>
                                        </div>
                                    </div> <!-- / .row -->
                                </div>
                                <div class="list-group-item" data-select2-id="13">
                                    <div class="row" data-select2-id="12">
                                        <div class="col">

                                            <!-- Text -->
                                            <small>Start Date</small>

                                        </div>
                                        <div class="col-8" data-select2-id="11">

                                            <!-- Select -->
                                            <input type="date" class="form-control addl-filter" data-filter-key="start-date" name="start_date" data-date="true" data-date-type="start">

                                        </div>
                                    </div> <!-- / .row -->
                                </div>

                                <div class="list-group-item" data-select2-id="13">
                                    <div class="row" data-select2-id="12">
                                        <div class="col">

                                            <!-- Text -->
                                            <small>End Date</small>

                                        </div>
                                        <div class="col-8" data-select2-id="11">

                                            <!-- Select -->
                                            <input type="date" class="form-control addl-filter" data-filter-key="end-date" name="end-date" data-date="true" data-date-type="start">

                                        </div>
                                    </div> <!-- / .row -->
                                </div>
                            </div>

                            <!-- Button -->
                            <!-- <a href="#" class="btn btn-block btn-primary addl-filter-btn" type="submit">
                                Apply filter
                            </a> -->

                        </div>
                        </form>

                    </div>

                    </div>
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
                        data-target="#transactionModal"
                        :disabled="accounts.length < 1 ? true : false"
                        >Add Transaction
                    </button>

                    <transaction-modal
                        :key="modalKey"
                        :transaction="selectedTransaction"
                        :accounts="accounts"
                        :modalType="modal"
                        :rules="rules"
                        @changeModal="changeModal($event)"
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
                    <a href="#" class="text-muted list-sort" data-sort="orders-order">
                        #
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted list-sort" data-sort="orders-category">
                      Category
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted list-sort" data-sort="orders-amount">
                      Amount
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted list-sort" data-sort="orders-vendor">
                      Vendor
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted list-sort" data-sort="orders-account">
                      Account
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted list-sort" data-sort="orders-date">
                      Date
                    </a>
                  </th>
                  <th colspan="2">
                    <a href="#" class="text-muted list-sort" data-sort="orders-method">
                      Actions
                    </a>
                  </th>
                </tr>
              </thead>
              <tbody class="list">
                <tr v-for="(transaction, index ) in dataTransactions" :key="transaction.id" :class="transaction.exclude ? 'excluded' : ''">
                  <td class="orders-order">
                    #{{ index + 1 }}
                  </td>
                  <!-- <td class="orders-category" v-html="transaction.category">
                </td> -->
                 <td class="orders-category" @click="editTransaction( transaction, 'min' )">
                    <a  href="#!" class="dropdown-item" data-toggle="modal" data-target="#transactionModal" v-html="transaction.category">
                    </a>
                    </td>
                  <td class="orders-amount">
                    <div :class="'badge '+getBadgeType( transaction )">
                        ${{ transaction.amount }}
                    </div>
                  </td>
                  <td class="orders-vendor">
                      {{ transaction.vendor }}
                  </td>
                  <td class="orders-account">{{ transaction.account.name }}</td>
                  <td class="orders-date">
                    <time :datetime="transaction.date">{{ getFormattedDate( transaction.date ) }}</time>
                  </td>
                  <td class="hidden orders-filter-date">{{ transaction.date }}</td>
                  <td class="orders-type hidden">{{ getTransactionType(transaction.type) }}</td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="window">
                        <i class="fe fe-more-vertical"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a @click="editTransaction( transaction, 'min' )" href="#!" class="dropdown-item" data-toggle="modal" data-target="#transactionModal">
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
           <div class="card-footer d-flex justify-content-between">

                <!-- Pagination (prev) -->
                <ul class="list-pagination-prev pagination pagination-tabs card-pagination">
                    <li class="page-item">
                        <a class="page-link pl-0 pr-4 border-right" href="#">
                          <i class="fe fe-arrow-left mr-1"></i> Prev
                        </a>
                    </li>
                </ul>

                <!-- Pagination -->
                <ul class="list-pagination pagination pagination-tabs card-pagination"></ul>

                <!-- Pagination (next) -->
                <ul class="list-pagination-next pagination pagination-tabs card-pagination">
                    <li class="page-item">
                        <a class="page-link pl-4 pr-0 border-left" href="#">
                          Next <i class="fe fe-arrow-right ml-1"></i>
                        </a>
                    </li>
                </ul>
           </div>
        </div>
      </div>
    </div> <!-- / .row -->
  </div>
</template>

<script>
    import TransactionModal from './components/TransactionModal'

    export default {
        name: 'transactions-page-component',
        props: [
            'accounts',
            'transactions',
            'rules'
        ],
        components: {
            TransactionModal
        },
        data() {
            return {
                selectedAccount: null,
                selectedTransaction: {},
                dataTransactions: this.transactions,
                modalKey: 0,
                modal: 'full'
            }
        },
        methods: {
            unselectAccount() {
                this.selectedAccount = null
            },
            selectAccount( account ) {
                this.selectedAccount = account;
            },
            editTransaction ( transaction, modal ) {
                this.selectedTransaction = transaction
                this.modal = modal
            },
            newTransaction() {
                this.modal = 'full'
                this.selectedTransaction = {};
            },
            changeModal( type ) {
                console.log(type)
                this.modal = type;
            },
            saveTransaction( transaction ) {
                var self = this;
                let url = '/transactions' + ( transaction.id ? '/'+transaction.id : '')
                let method = transaction.id ? 'PUT' : 'POST'
                this.asyncSendData(transaction, url, method).then( function( response ) {
                    if (!transaction.id) {
                        self.$set(self.dataTransactions, self.dataTransactions.length, response)
                        self.showNotification('success', 'Transaction Posted Successfully!')
                    } else {
                        let index = self.dataTransactions.map(function (x) { return x.id; }).indexOf(response.id);
                        //todo: figure out why table won't update via Vue.$set
                        self.dataTransactions.splice(index, 1);
                        setTimeout( function() {
                            self.dataTransactions.splice(index, 0, response)
                        }, 100)
                        self.showNotification('success', 'Transaction Updated Successfully!')
                    }
                    self.modalKey += 1;
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
                // if (this.selectedAccount) {
                //     return this.dataTransactions.filter(x => x.account_id == this.selectedAccount.id)
                // }
                return this.dataTransactions
            }
        },
        mounted() {
            $(document).ready( function() {
                // var options = {
                //     valueNames: ["orders-order", "orders-category", "orders-amount", "orders-vendor", "orders-account"],
                //     page: 15,
                //     pagination: true,
                //     pagination: {"paginationClass": "list-pagination"}
                // };

                // var userList = new List('list', $('#list').data('list'));
            })
        }
    }
</script>

<style scoped>
    .dropdown .dropdown-menu:not(.show) {
        display: none;
    }
</style>
