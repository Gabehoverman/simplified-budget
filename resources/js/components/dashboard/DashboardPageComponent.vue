<template>
        <!-- MAIN CONTENT
    ================================================== -->
    <div>

        <overview-graph-card
            :transactions="transactions"
        />

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
    import OverviewGraphCard from './cards/OverviewGraphCard';

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
            OverviewGraphCard,
            AccountsGraphCard,
            TransactionsGraphCard,
            TransactionsTableCard,
            AccountsTableCard,
            TransactionsTotalWidget,
            TransactionsCountWidget,
            BudgetProgressWidget,
            TransactionAverageWidget
        }
    }
</script>
