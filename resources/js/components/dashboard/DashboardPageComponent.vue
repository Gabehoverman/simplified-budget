<template>
        <!-- MAIN CONTENT
    ================================================== -->
    <div>
        <notifications group="notification"/>

        <customize-widget
            :user="user"
            @updateCustomDashboard="updateCustomDashboard( $event )"
        />

        <div v-for="(row, index) in dataDashWidgets" :key="row.key">

        <!-- Card 1 -->
        <div :class="index != 0 ? 'container-fluid'  : '' " v-if="row.key == 'spending_overview' && row.show == true">
            <overview-graph-card
                :class="index != 0 ? 'card'  : '' "
                :transactions="transactions"
                :weeklyExpenses="weeklyExpenses"
                :monthlyExpenses="monthlyExpenses"
                :annualExpenses="annualExpenses"
                @updateDate="updateData( $event )"
            />
        </div>

      <!-- CARDS -->
      <div :class="index != 0 ? 'container-fluid'  : 'container-fluid mt--6' " v-if="row.key == 'spending_overview' && row.show == true">
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
      </div>
      <!-- /Card 1 -->

      <!-- Card 2 -->
      <div class="container-fluid stretch-row" v-if="row.key == 'account_overview' && row.show == true">
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
      <!-- /Card 2 -->

      <!-- Card 3 -->

        <!-- Budget Card -->

        <!-- Monthly Spending (chart)-->

        <div class="container-fluid stretch-row" v-if="row.key == 'budget_overview' && row.show == true">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <insights-card
                        :monthlyTransactions="monthlyExpenses"
                        :previousMonthlyTransactions="previousMonthlyTransactions"
                        :categories="categories"
                    />
                </div>

                <div class="col-12 col-lg-6">
                    <budget-card
                        :user="user"
                        :budgets="budgets"
                        :expenses="expenses"
                    />
                </div>
            </div>
        </div>

        <!-- Overall Spending for current Month-->

      <!-- / Card 3 -->


    <!-- Card 4 -->

        <!-- Account Snapshot -->

        <!-- Cashflow? -->
    <div class="container-fluid stretch-row" v-if="row.key == 'cashflow_overview' && row.show == true">
        <div class="row">

            <div class="col-12 col-lg-6">
                <top-vendor-card
                    :vendors="vendors"
                />
            </div>

            <div class="col-12 col-lg-6">
                <cashflow-card
                    :user="user"
                    :income="income"
                    :expenses="expenses"
                />
            </div>
        </div>
    </div>

      <!-- / Card 4 -->

        </div>
    </div>

</template>

<script>
    import OverviewGraphCard from './cards/OverviewGraphCard';

    import AccountsGraphCard from './cards/AccountsGraphCard'
    import TransactionsGraphCard from './cards/TransactionsGraphCard'
    import TransactionsTableCard from './cards/TransactionsTableCard'
    import AccountsTableCard from './cards/AccountsTableCard'
    import CashflowCard from '../reporting/cards/CashflowCard'
    import TopVendorCard from '../reporting/cards/TopVendorCard'
    import BudgetCard from '../reporting/cards/BudgetCard'
    import InsightsCard from '../reporting/cards/InsightsCard'

    import TransactionExpenseWidget from './widgets/TransactionExpenseWidget'
    import TransactionIncomeWidget from './widgets/TransactionIncomeWidget'
    import TransactionsCountWidget from './widgets/TransactionsCountWidget'
    import BudgetProgressWidget from './widgets/BudgetProgressWidget'
    import CustomizeWidget from './widgets/CustomizeWidget'

    export default {
        name: 'dashboard-page-component',
        props: [
            'user',
            'accounts',
            'transactions',
            'budgets',
            'weekly-expenses',
            'monthly-expenses',
            'annual-expenses',
            'vendors',
            'income',
            'expenses',
            'previous-monthly-transactions',
            'categories'
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
            CashflowCard,
            TopVendorCard,
            CustomizeWidget,
            BudgetCard,
            InsightsCard
        },
        data() {
            return {
                dataFilter: 'weekly',
                dataSet: this.weeklyExpenses,
                dataDashWidgets: this.user.custom_dashboard
            }
        },
        methods: {
            updateData( data ) {
                this.dataFilter = data;
            },
            updateCustomDashboard( customDashboard ) {
                var self = this
                this.user.custom_dashboard = customDashboard
                this.dataDashWidgets = customDashboard
                this.asyncSendData(this.user, '/dashboard/update-custom', 'post').then( function( response ) {
                    self.user = response;
                    self.showNotification('success', 'Dashboard Updated Successfully!')
                })
            }
        },
        mounted() {
        }
    }
</script>

<style scoped>
    @media ( min-width: 1200px ) {
        .stretch-row .card {
            height: calc(100% - 25px )
        }

        .stretch-row .card .card-header {
            max-height: 60px !important;
        }

        .stretch-row.container-fluid {
            /* padding-bottom: 25px; */
        }
    }
</style>
