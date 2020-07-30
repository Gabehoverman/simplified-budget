<template>
    <div class="card">
        <div class="card-header col-12">
            <h3>Budget</h3>
        </div>
        <div class="card-body">
            <div class="col">

                <div class="row align-items-center no-gutters">
                    <div class="col-12">

                        <!-- Progress -->
                        <div class="progress progress-md">
                            <div class="progress-bar" role="progressbar" :style="'width: '+expensesPercentage+'%'" :aria-valuenow="expensesPercentage" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12 mt-5 row">
                        <div class="col-4">
                            <h5><span class="text-primary">●</span> ${{ formatCurrency(expenses) }}</h5> Spent
                        </div>
                        <div class="col-4">
                            <h5><span class="text-info">●</span> $875</h5> Upcoming
                        </div>
                        <div class="col-4">
                            <h5><span style="color: #edf2f9">●</span> ${{ formatCurrency(budgetRemainder) }}</h5> Remaining
                        </div>
                    </div>

                </div>
            </div> <!-- / .row -->

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'user',
            'expenses'
        ],
         computed: {
            incomePercentage() {
                let monthlyIncome = this.user.pay ? this.user.pay : (this.user.income / 12)
                return ( monthlyIncome ) * 100;
            },
            expensesPercentage() {
                let monthlyIncome = this.user.pay ? this.user.pay : (this.user.income / 12)
                return ( this.expenses / monthlyIncome ) * 100;
            },
            budgetRemainder() {
                let monthlyIncome = this.user.pay ? this.user.pay : (this.user.income / 12)
                return (monthlyIncome - this.expenses).toFixed(2);
            }
        }
    }
</script>
