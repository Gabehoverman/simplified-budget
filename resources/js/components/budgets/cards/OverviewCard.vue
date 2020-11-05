<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-header-title">Current Month</h4>
        </div>
        <div class="card-body row">
            <div class="col-sm-6 col-md-4">
                <p>Income In This Month:</p>
                <p>Spending This Month:</p>
            </div>
            <div class="col-sm-6 col-md-2">
                <p>${{ formatCurrency( totals.income ) }}</p>
                <p>${{ formatCurrency( totals.spending ) }}</p>
            </div>
            <div class="col-sm-6 col-md-4">
                <p>Estimated Monthly Income:</p>
                <p>Monthly Budgeted Amount:</p>
            </div>
            <div class="col-sm-6 col-md-2">
                <p>${{ formatCurrency( totals.estimated_income ) }}</p>
                <p>${{ formatCurrency( budgetTotals ) }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['budgets', 'totals'],
        methods: {
        },
        computed: {
            budgetTotals() {
                var sum = 0;

                this.budgets.forEach( function( budget ) {
                    if (budget.timeframe == 1) {
                        sum += parseFloat(budget.amount) / 12
                    } else {
                        sum += parseFloat(budget.amount)
                    }
                })

                return sum;
            }
        }
    }
</script>
