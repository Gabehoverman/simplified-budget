<template>
    <!-- Card -->
    <div class="card">
        <div class="card-body">
        <div class="row align-items-center">
            <div class="col">

                <!-- Title -->
                <h6 class="card-title text-uppercase text-muted mb-2">
                    Budget Progress
                </h6>

                <div class="row align-items-center no-gutters">
                    <div class="col-auto">

                    <!-- Heading -->
                    <span class="h2 mr-2 mb-0">
                        {{ expensesPercentage }}%
                    </span>

                    </div>
                    <div class="col">

                    <!-- Progress -->
                    <div class="progress progress-sm">
                        <div class="progress-bar" role="progressbar" :style="'width: '+expensesPercentage+'%'" :aria-valuenow="expensesPercentage" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                </div>
            </div> <!-- / .row -->

            </div>
            <div class="col-auto">

            <!-- Icon -->
            <span class="h2 fe fe-clipboard text-muted mb-0"></span>

            </div>
        </div> <!-- / .row -->

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'filter',
            'user',
            'budgets',
            'transactions'
        ],
         computed: {
            filterDate() {
                let today = new Date();
                switch(this.filter) {
                    case 'weekly':
                        let day = today.getDay(),
                        diff = today.getDate() - day + (day == 0 ? -6:0)
                        return new Date(today.setDate(diff));
                    case 'monthly':
                        return new Date(today.getFullYear(), today.getMonth(), 1);
                    case 'annual':
                        return new Date(new Date().getFullYear(), 0, 1);
                }
            },
            expenses() {
                let sum = 0;
                let date = this.filterDate
                this.transactions.forEach( function(transaction) {
                    if (transaction.type == 0 && new Date(transaction.date) >= date) {
                        sum += parseFloat(transaction.amount);
                    }
                })
                return sum.toFixed(2);
            },
            expensesPercentage() {
                let monthlyIncome = this.budgetTotal;
                let sum = (( this.expenses / monthlyIncome ) * 100).toFixed(2);
                if (isNaN(sum) || !isFinite(sum)) {
                    return 0;
                }
                return sum;
            },
            budgetTotal() {
               let sum = 0;
                let date = new Date()
                this.budgets.forEach( function( budget ) {
                    if (budget.timeframe == 1) {
                        sum += budget.amount / 12
                    } else {
                        sum += budget.amount;
                    }
                })
                switch( this.filter ) {
                    case 'weekly':
                        // todo: find current date, check number of days in month / current day, then multiple by that. eg. 15th day of 30 day month would be 50% of budget so far
                        // sum = sum / ( Math.floor(date.getDate() / 7) + 1 )
                        sum = sum / 4;
                    case 'annual':
                         // todo: multiple by number of months in the current year that there are transactions reported
                        sum = sum * ( date.getMonth() + 1 )
                        // sum = sum * 2;
                }
                return sum;
            },
            budgetRemainder() {
                return (this.budgetTotal - this.expenses).toFixed(2);
            },
        }
    }
</script>
