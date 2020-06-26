<template>
        <!-- MAIN CONTENT
    ================================================== -->
    <div>
      <!-- HEADER -->
      <div class="header bg-dark pb-5">
        <div class="container-fluid">

          <!-- Body -->
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">

                <!-- Pretitle -->
                <h6 class="header-pretitle text-secondary">
                  Overview
                </h6>

                <!-- Title -->
                <h1 class="header-title text-white">
                  Spending
                </h1>

              </div>
              <div class="col-auto">

                <!-- Nav -->
                <ul class="nav nav-tabs header-tabs">
                  <li class="nav-item" data-toggle="chart" data-target="#headerChart" data-update='{"data":{"datasets":[{"data":[0,10,5,15,10,20,15,25,20,30,25,40]}]' data-prefix="$" data-suffix="k">
                    <a href="#" class="nav-link text-center active" data-toggle="tab">
                      <h6 class="header-pretitle text-secondary">
                        <!-- Breakdown -->
                        &nbsp
                      </h6>
                      <h3 class="text-white mb-0">
                        Daily
                      </h3>
                    </a>
                  </li>
                  <li class="nav-item" data-toggle="chart" data-target="#headerChart" data-update='{"data":{"datasets":[{"data":[50,75, 35,25,55,87,67,53,25,80,87,45]}]' data-prefix="" data-suffix="k">
                    <a href="#" class="nav-link text-center" data-toggle="tab">
                      <h6 class="header-pretitle text-secondary">
                        <!-- Sessions -->
                        &nbsp
                      </h6>
                      <h3 class="text-white mb-0">
                        Weekly
                      </h3>
                    </a>
                  </li>
                  <li class="nav-item" data-toggle="chart" data-target="#headerChart" data-update='{"data":{"datasets":[{"data":[40,57,25,50,57,32,46,28,59,34,52,48]}]' data-prefix="" data-suffix="%">
                    <a href="#" class="nav-link text-center" data-toggle="tab">
                      <h6 class="header-pretitle text-secondary">
                        Breakdown
                        <!-- &nbsp -->
                      </h6>
                      <h3 class="text-white mb-0">
                        Monthly
                      </h3>
                    </a>
                  </li>
                </ul>

              </div>
            </div> <!-- / .row -->
          </div> <!-- / .header-body -->

          <!-- Footer -->
          <div class="header-footer">

            <!-- Chart -->
            <div class="chart">
              <canvas id="headerChart" class="chart-canvas"></canvas>
            </div>

          </div>

        </div>
      </div> <!-- / .header -->

      <!-- CARDS -->
      <div class="container-fluid mt--6">
        <!-- <div class="row">
          <div class="col-12 col-xl-8">

            <accounts-graph-card

            />

          </div>
          <div class="col-12 col-xl-4">

              <transactions-graph-card

              />

          </div>
        </div> / .row -->
        <div class="row">
          <div class="col-12 col-lg-6 col-xl">

              <transactions-total-widget
                :transactions="transactions"
              />

          </div>
          <div class="col-12 col-lg-6 col-xl">

            <transactions-count-widget
                :transactions="transactions"
            />

          </div>
          <div class="col-12 col-lg-6 col-xl">

              <budget-progress-widget
                :transactions="transactions"
              />

          </div>
          <div class="col-12 col-lg-6 col-xl">

              <transaction-average-widget
                :transactions="transactions"
              />

          </div>
        </div> <!-- / .row -->
        <div class="row">
          <div class="col-12 col-xl-4">
              <accounts-table-card
                :accounts="accounts"
              />
          </div>
          <div class="col-12 col-xl-8">
              <transactions-table-card
                :transactions="transactions"
              />
          </div>
        </div> <!-- / .row -->
      </div>
    </div>

</template>

<script>
    import AccountsGraphCard from './cards/AccountsGraphCard'
    import TransactionsGraphCard from './cards/TransactionsGraphCard'
    import TransactionsTableCard from './cards/TransactionsTableCard'
    import AccountsTableCard from './cards/AccountsTableCard'

    import TransactionsTotalWidget from './widgets/TransactionsTotalWidget'
    import TransactionsCountWidget from './widgets/TransactionsCountWidget'
    import BudgetProgressWidget from './widgets/BudgetProgressWidget'
    import TransactionAverageWidget from './widgets/TransactionAverageWidget'

    export default {
        name: 'dashboard-page-component',
        props: [
            'accounts',
            'transactions'
        ],
        components: {
            AccountsGraphCard,
            TransactionsGraphCard,
            TransactionsTableCard,
            AccountsTableCard,
            TransactionsTotalWidget,
            TransactionsCountWidget,
            BudgetProgressWidget,
            TransactionAverageWidget
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
