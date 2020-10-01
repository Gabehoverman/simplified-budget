<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-header-title">Insights</h4>
        </div>
        <div class="card-body">
            <p>{{ message() }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['budgets'],
        methods: {
            message() {
                let overBudget = 0;
                let approachingBudgets = 0;
                if (this.budgets.length == 0 ) {
                    return "Set up your first budget to keep track of your spending."
                }
                this.budgets.forEach( function( budget ) {
                    if (budget.amount < budget.total ) {
                        overBudget++;
                    } else if ( ( budget.total / budget.amount ) * 100 > 85 && ( budget.total / budget.amount ) * 100 < 100) {
                        approachingBudgets++;
                    }
                })

                if (overBudget > 0) {
                    return "You went over on "+overBudget+' budget so far this month. Try adjusting the budget amount for better reporting!'
                }

                if (approachingBudgets > 0) {
                    if (approachingBudgets == 1) {
                        return approachingBudgets+' of your budgets is approaching the monthly limit.';
                    }
                    return approachingBudgets+' of your budgets are approaching the monthly limit.';
                }

                return "All your budgets are on track this month. Congrats!"
            }
        }
    }
</script>
