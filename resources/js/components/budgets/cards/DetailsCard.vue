<template>
    <div class="card">
        <div class="card-header col-12">
            <h4 class="card-header-title">Budget Details</h4>
        </div>
        <div class='card-body'>
            <div class="list-group list-group-flush my-n3">
                <div v-if="dataBudgets.length == 0">
                    <p>No Budgets to show.</p>
                </div>
                <div class="list-group-item" v-for="(budget) in dataBudgets" :key="budget.id">
                    <div class="row" @click="selectBudget(budget)">
                        <!-- <div class="col-lg-3 col-md-12">
                            <div :style="'width: 50px; height: 50px; border-radius: 50%; background: '+$transactionCategoryColors[budget.category]">
                                <div style="padding-top: 10px;" v-html="$transactionCategoryIcons[budget.category]"></div>
                            </div>
                        </div> -->
                            <div class="col-6 col-md-12 col-lg-6 mt-3">

                                <!-- Heading -->
                                <h4 class="mb-1">
                                      <a href="#" class="item-name budget-name"
                                        data-toggle="modal"
                                        data-target="#budgetModal"
                                        @click="selectBudget(budget)"
                                    >{{ budget.name }}
                                    </a>
                                </h4>

                            </div>
                            <div class="col-6 col-md-12 col-lg-6 mt-3 text-xs-right text-right text-md-left text-lg-right">
                                <span class="text-muted">${{ budget.total }}</span>

                                <span class="text-muted">| ${{ budget.amount }}</span>

                                <!-- todo: Add in progress bar -->
                            </div>

                            <!-- progress bar -->
                            <div class="col-12">
                                <div class="row">
                                <div class="col-4 col-md-12 col-lg-4">
                                    <!-- Value -->
                                    <small class="muted mr-2">{{ calculatePercentage( budget.amount, budget.total ) }}%</small>
                                </div>
                                <div class="col-8 col-md-12 col-lg-8 mt-3">
                                    <!-- Progress -->
                                    <div class="progress progress-sm">
                                    <div
                                        :class="'progress-bar ' + getProgressClass( budget )"
                                        role="progressbar"
                                        :style="'width: '+ calculatePercentage( budget.amount, budget.total ) +'%'"
                                        :aria-valuenow="calculatePercentage( budget.amount, budget.total )"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                    ></div>
                                    </div>
                                </div>
                                </div>
                            <!-- / progress bar -->

                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['budgets'],
        data() {
            return {
                dataBudgets: this.budgets
            }
        },
        methods: {
            selectBudget( budget ) {
                this.$emit('selectBudget', budget)
            },
            getTotal( vendorData ) {
                let sum = 0;
                vendorData.forEach(transaction => {
                    sum += parseFloat(transaction.amount)
                });
                return sum.toFixed(2);
            },
            calculatePercentage( amount, total ) {
                let percent = ((total / amount) * 100)
                return percent.toFixed(2)
            },
            getProgressClass( budget ) {
                let percent = this.calculatePercentage(budget.amount, budget.total)
                if ( percent >= 100) {
                    return 'bg-danger'
                } else if (percent >= 85) {
                    return 'bg-warning'
                } else {
                    return 'bg-primary'
                }
            },
        }
    }
</script>
