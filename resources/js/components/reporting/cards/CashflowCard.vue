<template>
    <div class="card">
        <div class="card-header col-12">
            <h4 class="card-header-title">Cashflow</h4>
        </div>
        <div class='card-body row'>
            <div class="col-9 mt-3">

                <!-- Progress -->
                <div class="progress progress-md">
                    <div class="progress-bar" role="progressbar" :style="'width: '+incomePercentage+'%; background-color: rgb(129, 214, 184)'" :aria-valuenow="incomePercentage" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-3">
                <span class="text-small">est. ${{ formatCurrency(monthlyIncome) }}</span>
            </div>
            <div class="col-9 mt-5">

                <!-- Progress -->
                <div class="progress progress-md">
                    <div class="progress-bar" role="progressbar" :style="'width: '+expensesPercentage+'%'" :aria-valuenow="expensesPercentage" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-3 mt-5">
                <span class="text-small">est. $2,000</span>
            </div>

            <div class="col-12 col-lg-12 mt-5 row">
                <div class="col-4">
                    <h5><span style="color: rgb(129, 214, 184)">●</span> ${{ formatCurrency(income) }}</h5> Income
                </div>
                <div class="col-4">
                    <h5><span class="text-primary">●</span> ${{ formatCurrency(expenses) }}</h5> Expenses
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'user',
            'income',
            'expenses',
        ],
        computed: {
            monthlyIncome() {
                return this.user.pay ? this.user.pay : (this.user.income / 12)
            },
            incomePercentage() {
                let monthlyIncome = this.user.pay ? this.user.pay : (this.user.income / 12)
                return (this.income / (monthlyIncome)) * 100;
            },
            expensesPercentage() {
                return (this.expenses / 2000) * 100;
            }
        }
    }
</script>
