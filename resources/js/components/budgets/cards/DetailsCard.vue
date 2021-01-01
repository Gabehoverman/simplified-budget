<template>
    <div class="card">
        <div class="card-header col-12">
            <h4 class="card-header-title">Budget Details</h4>
            <a href="#" class="pull-right text-right" @click="unselectBudget()">
                x
            </a>
        </div>
        <div class='card-body'>
            <div class="list-group list-group-flush my-n3" style="min-height: 520px; overflow-x: none;">
                <!-- <div class="col-6 col-md-12 col-lg-6 mt-3">
                    <h4 class="mb-1">

                    </h4>
                </div>
                <div class="col-6 col-md-12 col-lg-6 mt-3 text-xs-right text-right text-md-left text-lg-right">
                    <span class="text-muted">${{ selectedBudget.total }}</span>

                    <span class="text-muted">| ${{ selectedBudget.monthly_amount }}</span>
                </div> -->

                <!-- progress bar -->

                <div class="list-group-item">
                    <div class="row">
                        <div class="col-8">
                            <small class="muted mr-2">{{ calculatePercentage( selectedBudget ) }}%</small>
                        </div>
                        <div class="col-4 text-right">
                            <span :class="'badge badge-pill badge-soft-' + (dataRemainder > 0 ? 'success' : 'danger')">
                                ${{  formatCurrency( dataRemainder )  }}
                            </span>
                        </div>
                        <div class="col-12  col-md-12 col-lg-12 mt-3">
                            <!-- Progress -->
                            <div class="progress progress-sm">
                                <div
                                    :class="'progress-bar ' + getProgressClass( selectedBudget )"
                                    role="progressbar"
                                    :style="'width: '+ calculatePercentage( selectedBudget ) +'%'"
                                    :aria-valuenow="calculatePercentage( selectedBudget )"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- / progress bar -->
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            Category:
                        </div>
                        <div class="col-md-6">
                            {{ selectedBudget.category }}
                        </div>
                    </div>
                </div>

                <div class="list-group-item" v-if="selectedBudget.sub_category">
                    <div class="row">
                        <div class="col-md-6">
                            Sub Category:
                        </div>
                        <div class="col-md-6">
                            {{ selectedBudget.sub_category }}
                        </div>
                    </div>
                </div>

                <div class="list-group-item" v-if="getMonthlyBudgetAmount( selectedBudget) != selectedBudget.monthly_amount">
                    <div class="row">
                        <div class="col-md-6">
                            Current Month Amount:
                        </div>
                        <div class="col-md-6">
                            ${{ formatCurrency( getMonthlyBudgetAmount( selectedBudget ) ) }}
                        </div>
                    </div>
                </div>

                <div class="list-group-item" v-if="getMonthlyBudgetAmount( selectedBudget) != selectedBudget.monthly_amount">
                    <div class="row">
                        <div class="col-md-6">
                            Typical Monthly Amount:
                        </div>
                        <div class="col-md-6">
                            ${{ formatCurrency( selectedBudget.monthly_amount ) }}
                        </div>
                    </div>
                </div>

                <div class="list-group-item" v-if="getMonthlyBudgetAmount( selectedBudget) == selectedBudget.monthly_amount">
                    <div class="row">
                        <div class="col-md-6">
                            Monthly Amount:
                        </div>
                        <div class="col-md-6">
                            ${{ formatCurrency( getMonthlyBudgetAmount( selectedBudget ) ) }}
                        </div>
                    </div>
                </div>

                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            Annual Amount:
                        </div>
                        <div class="col-md-6">
                            ${{ formatCurrency( selectedBudget.annual_amount ) }}
                        </div>
                    </div>
                </div>

                <!-- <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            Timeframe:
                        </div>
                        <div class="col-md-6">
                            {{ selectedBudget.timeframe == 1 ? 'Annually' : 'Monthly' }}
                        </div>
                    </div>
                </div> -->

                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            Monthly Spend:
                        </div>
                        <div class="col-md-6">
                            ${{ formatCurrency( selectedBudget.total ) }}
                        </div>
                    </div>
                </div>

                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            Budget Remainder:
                        </div>
                        <div class="col-md-6">
                            ${{  formatCurrency( dataRemainder )  }}
                        </div>
                    </div>
                </div>

                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-12">
                            <b>Previous Month</b>
                        </div>
                    </div>
                </div>

                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            Monthly Spend:
                        </div>
                        <div class="col-md-6">
                            ${{ formatCurrency( selectedBudget.previousMonthlyTotal ) }}
                        </div>
                    </div>
                </div>

                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            Monthly Remainder:
                        </div>
                        <div class="col-md-6">
                            ${{ formatCurrency( dataPreviousRemainder ) }}
                        </div>
                    </div>
                </div>

            </div>
        </div> <!-- / .row -->
    </div>
</template>

<script>
    export default {
        props: ['budgets', 'selectedBudget'],
        data() {
            return {
                dataBudgets: this.budgets,
            }
        },
        methods: {
            selectBudget( budget ) {
                event.preventDefault()
                this.$emit('selectBudget', budget)
            },
            unselectBudget( ) {
                event.preventDefault()
                this.$emit('unselectBudget')
            },
            getTotal( vendorData ) {
                let sum = 0;
                vendorData.forEach(transaction => {
                    sum += parseFloat(transaction.monthly_amount)
                });
                return sum.toFixed(2);
            },
            getRemainder( budget ) {
                return this.getMonthlyBudgetAmount( budget ) - budget.total
            },
            getPreviousRemainder( budget ) {
                if (!budget.previousMonthlyTotal) {
                    return 0;
                }
                return this.getMonthlyBudgetAmount( budget ) - budget.previousMonthlyTotal
            },
            calculatePercentage( budget ) {
                let percent = 0;
                percent = (( budget.total / this.getMonthlyBudgetAmount( budget ) ) * 100)

                if ( isNaN(percent) ) {
                    return 0;
                }
                return percent.toFixed(2)
            },
            getProgressClass( budget ) {
                let percent = this.calculatePercentage(budget)
                if ( percent >= 100) {
                    return 'bg-danger'
                } else if (percent >= 85) {
                    return 'bg-warning'
                } else {
                    return 'bg-primary'
                }
            },
        },
        computed: {
            dataRemainder() {
                return this.getRemainder(this.selectedBudget)
            },
            dataPreviousRemainder() {
                return this.getPreviousRemainder(this.selectedBudget)
            }
        }
    }
</script>
