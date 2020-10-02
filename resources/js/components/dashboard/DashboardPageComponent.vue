<template>
        <!-- MAIN CONTENT
    ================================================== -->
    <div>

        <overview-graph-card
            :transactions="transactions"
            :weeklyExpenses="weeklyExpenses"
            :monthlyExpenses="monthlyExpenses"
            :annualExpenses="annualExpenses"
            @updateDate="updateData( $event )"
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

              <transaction-expense-widget
                :transactions="transactions"
                :filter="dataFilter"
              />

          </div>
        <div class="col-12 col-lg-6 col-xl">

              <transaction-income-widget
                :transactions="transactions"
                :filter="dataFilter"
              />

          </div>
          <div class="col-12 col-lg-6 col-xl">

              <budget-progress-widget
                :transactions="transactions"
                :budgets="budgets"
                :filter="dataFilter"
              />

          </div>
          <div class="col-12 col-lg-6 col-xl">

            <transactions-count-widget
                :transactions="transactions"
                :filter="dataFilter"
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

    import TransactionExpenseWidget from './widgets/TransactionExpenseWidget'
    import TransactionIncomeWidget from './widgets/TransactionIncomeWidget'
    import TransactionsCountWidget from './widgets/TransactionsCountWidget'
    import BudgetProgressWidget from './widgets/BudgetProgressWidget'

    export default {
        name: 'dashboard-page-component',
        props: [
            'accounts',
            'transactions',
            'budgets',
            'weekly-expenses',
            'monthly-expenses',
            'annual-expenses'
        ],
        components: {
            OverviewGraphCard,
            AccountsGraphCard,
            TransactionsGraphCard,
            TransactionsTableCard,
            AccountsTableCard,
            TransactionExpenseWidget,
            TransactionIncomeWidget,
            TransactionsCountWidget,
            BudgetProgressWidget,
        },
        data() {
            return {
                dataFilter: 'weekly',
                dataSet: this.weeklyExpenses
            }
        },
        methods: {
            updateData( data ) {
                this.dataFilter = data;
            }
        },
        mounted() {
        }
    }
</script>
