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
                <monthly-comparison-card

                />
            </div>

            <div class="col-12 col-lg-6">
                <category-chart

                />
            </div>

            <div class="col-12 col-lg-6">
                <top-vendor-card

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
    import MonthlyComparisonCard from './cards/MonthlyComparisonCard'
    import CategoryChart from './cards/CategoryCard';
    import TopVendorCard from './cards/TopVendorCard'
    import CashflowCard from './cards/CashflowCard'

    export default {
        components: {
            InsightsCard,
            MonthlyComparisonCard,
            CategoryChart,
            BudgetCard,
            TopVendorCard,
            CashflowCard,
        }
    }
</script>
