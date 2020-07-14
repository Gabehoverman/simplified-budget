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
                                    Reporting
                                </h1>

                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <insights-card

                />
            </div>

            <div class="col-12 col-lg-6">
                <budget-card

                />
            </div>

            <div class="col-12 col-lg-6">
                <monthly-comparison-chart

                />
            </div>

            <div class="col-12 col-lg-6">
                <category-chart

                />
            </div>

            <div class="col-12 col-lg-6">
                <top-category-card

                />
            </div>

            <div class="col-12 col-lg-6">
                <cashflow-card

                />
            </div>

        </div>
    </div>
</template>

<script>
    import InsightsCard from './cards/InsightsCard'
    import BudgetCard from './cards/BudgetCard'
    import MonthlyComparisonChart from './charts/MonthlyComparisonChart'
    import CategoryChart from './cards/CategoryCard';
    import TopCategoryCard from './cards/TopCategoryCard'
    import CashflowCard from './cards/CashflowCard'

    export default {
        components: {
            InsightsCard,
            MonthlyComparisonChart,
            CategoryChart,
            BudgetCard,
            TopCategoryCard,
            CashflowCard
        }
    }
</script>
