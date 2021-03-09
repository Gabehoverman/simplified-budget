<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-header-title">Current Month: {{ month }}</h4>
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
        props: ['budgets', 'totals', 'month'],
        methods: {
        },
        computed: {
            budgetTotals() {
                var sum = 0;
                var self = this;

                this.budgets.forEach( function( budget ) {
                    sum += parseFloat( self.getMonthlyBudgetAmount( budget ) )
                })

                return sum;
            }
        }
    }
</script>
