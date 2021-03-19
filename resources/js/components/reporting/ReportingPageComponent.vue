<template>
    <div class="container-fluid ">
    <notifications group="notification"/>

        <div class="row justify-content">
            <div class="col-12 col-lg-12 col-xl-12">

                <!-- Header -->
                <div class="header mt-md-5">
                    <div class="">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Pretitle -->
                                <h6 class="header-pretitle">
                                    Reporting / All
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title">
                                    Reporting for {{ month }}
                                </h1>

                            </div>
                            <div class="col-auto text-right row">
                                <!-- todo: add in a dropdown for the user to select the month they want to view -->
                                <div class="col-auto text-right row">
                                    <form id="month-form" class="col-md-12 card mb-0" method="GET">
                                        <select name="month" v-model="dataMonth" class="form-control" @change="submitForm()">
                                            <option v-for="(month, index) in monthSelect" :key="index">{{ month }}</option>}
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <insights-card
                    :monthlyTransactions="monthlyTransactions"
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

            <div class="col-12 col-lg-6">
                <monthly-comparison-card
                    :timestamp="timestamp"
                    :month="month"
                    :monthlyTransactions="monthlyTransactions"
                    :previousMonthlyTransactions="previousMonthlyTransactions"
                />
            </div>

            <div class="col-12 col-lg-6">
                <category-chart
                    :categories="categories"
                />
            </div>

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
</template>

<script>
    import InsightsCard from './cards/InsightsCard'
    import BudgetCard from './cards/BudgetCard'
    import MonthlyComparisonCard from './cards/MonthlyComparisonCard'
    import CategoryChart from './cards/CategoryCard';
    import TopVendorCard from './cards/TopVendorCard'
    import CashflowCard from './cards/CashflowCard'

    export default {
        props: ['user', 'categories', 'budgets', 'vendors', 'income', 'expenses', 'monthlyTransactions', 'previousMonthlyTransactions', 'month', 'previousMonth', 'nextMonth', 'timestamp'],
        data() {
            return {
                dataMonth: this.month
            }
        },
        components: {
            InsightsCard,
            MonthlyComparisonCard,
            CategoryChart,
            BudgetCard,
            TopVendorCard,
            CashflowCard,
        },
        methods: {
            submitForm() {
                $('#month-form').trigger('submit');
            }
        },
        computed: {
            monthSelect() {
                var date = new Date( this.user.created_at )
                var now = new Date();
                var months = []

                while (date < now ) {
                    months.push( date.toLocaleString('default', { month: 'long' }) +', '+date.getFullYear() )
                    date.setMonth(date.getMonth() + 1 );
                }
                months.reverse()
                return months;
            }
        }
    }
</script>
