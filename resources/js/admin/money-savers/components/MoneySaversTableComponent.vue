<template>
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

              </div>
            </div> <!-- / .row -->
          </div>
          <div class="table-responsive">
            <table id="moneySavers-table" class="table table-hover table-sm table-nowrap card-table">
              <thead>
                <tr>
                  <th>
                    <a href="#" class="text-muted list-sort" data-sort="orders-order">
                        #
                    </a>
                  </th>
                    <th>
                    <a href="#" class="text-muted list-sort" data-sort="orders-vendor">
                      Name
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted list-sort" data-sort="orders-category">
                      Category
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted list-sort" data-sort="orders-account">
                      Vendor
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted list-sort" data-sort="orders-date">
                      Rating
                    </a>
                  </th>
                  <th>
                    <a href="#" class="text-muted list-sort" data-sort="orders-method">
                      Actions
                    </a>
                  </th>
                </tr>
              </thead>
              <tbody class="list">
                <tr v-for="(moneySaver, index ) in moneySavers" :key="moneySaver.id" :class="moneySaver.exclude ? 'excluded' : ''">
                  <td class="orders-order">
                    #{{ index + 1 }}
                  </td>
                  <!-- <td class="orders-category" v-html="moneySaver.category">
                </td> -->
                <td class="orders-account" @click="editMoneySaver( moneySaver, 'min' )">
                    <a  href="#!" data-toggle="modal" data-target="#moneySaverModal" v-html="moneySaver.name">
                    </a>
                </td>
                 <td class="orders-category" @click="editMoneySaver( moneySaver, 'min' )">
                     {{ moneySaver.category }}
                </td>
                  <td class="orders-amount">
                        {{ moneySaver.vendor }}
                  </td>
                  <td class="orders-vendor">
                      {{ moneySaver.rating }}
                  </td>
                  <td class="hidden orders-filter-date">{{ moneySaver.date }}</td>
                  <td class="orders-type hidden">{{ getMoneySaverType(moneySaver.type) }}</td>
                  <td class="text-right">
                    <div class="dropdown">
                      <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="window">
                        <i class="fe fe-more-vertical"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a @click="editMoneySaver( moneySaver, 'min' )" href="#!" class="dropdown-item" data-toggle="modal" data-target="#moneySaverModal">
                          Edit
                        </a>
                        <a @click="deleteMoneySaver( moneySaver )" href="#!" class="dropdown-item">
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
</template>

<script>
    export default {
        props: ['account', 'moneySavers', 'moneySaverTypes', 'errors'],
        data() {
            return {
            }
        },
        methods: {
            addMoneySaver() {
                event.preventDefault()
                let moneySaver = {
                    'category': '',
                    'amount': 0,
                    'account_id': '',
                }
                this.$emit('saveMoneySaver', moneySaver)
            },
            saveMoneySaver( moneySaver ) {
                this.$emit('saveMoneySaver', moneySaver)
            },
            deleteMoneySaver( moneySaver ) {
                event.preventDefault()
                if ( confirm('Are you sure you\'d like to delete this moneySaver?') ) {
                    this.$emit('deleteMoneySaver', moneySaver)
                }
            },
            selectMoneySaver( moneySaver ) {
                event.preventDefault()
                this.$emit('selectMoneySaver', moneySaver);
            },
            editMoneySaver( moneySaver ) {
                event.preventDefault()
                this.$emit('editMoneySaver', moneySaver);
            },
            getMoneySaverType( moneySaver ) {

            },
            getMonthlyMoneySaverAmount( moneySaver ) {
                if (moneySaver.timeframe == 1) {
                    return parseFloat( ( moneySaver.amount / 12 ) ).toFixed(2)
                } else {
                    return moneySaver.amount
                }
            },
            getRemainder( moneySaver ) {
                if (moneySaver.timeframe == 1) {
                    return parseFloat( ( moneySaver.amount / 12 ) - moneySaver.total )
                } else {
                    return moneySaver.amount - moneySaver.total
                }
            },
            getAnnualSum( moneySaver ) {
                var sum = 0;
                for ( var month in moneySaver.monthly_moneySavers ) {
                    sum += parseFloat(moneySaver.monthly_moneySavers[month])
                }
                return sum;
            },
        },
        computed: {
            moneySaverCategories() {
                var categories = Object.values(this.$transactionCategories)
                this.moneySavers.forEach( function( moneySaver ) {
                    let index = categories.map( function(category) { return category }).indexOf( moneySaver.category )
                    if (index !== -1) {
                        categories.splice( index, 1 )
                    }
                })
                return categories
            }
        },
        mounted() {
            if (!this.moneySavers) {
                this.addMoneySaver()
            }
        }
    }
</script>
