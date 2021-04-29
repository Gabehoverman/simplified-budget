<template>
        <!-- Header -->
        <div class="card" style="height: calc(100% - 24px);">
            <!-- Table View where user can add budgets, select the category from a dropdown, and input the amount -->
            <div class="card-header">
                <h4 class="card-header-title">Monthly Budget Breakdown</h4>
            </div>
              <div class="row" style="height: 100%">
                <div class="table-responsive col-12">
                    <table id="budgets-table" class="table table-sm table-nowrap card-table scroll-table">
                        <thead>
                            <tr>
                                <!-- <th>
                                    <a href="#" class="text-muted sort" data-sort="orders-order">
                                        #
                                    </a>
                                </th> -->
                                <th>
                                    <a href="#" class="text-muted">
                                        Category
                                    </a>
                                </th>

                                <th>
                                    <a href="#" class="text-muted">
                                        Monthly Budget
                                    </a>
                                </th>

                                <th>
                                    <a href="#" class="text-muted">
                                        Monthly Spending
                                    </a>
                                </th>

                                <th>
                                    <a href="#" class="text-muted">
                                        Monthly Remainder
                                    </a>
                                </th>

                                <th>
                                    <a href="#" class="text-muted">
                                        Annual Amount
                                    </a>
                                </th>
                                <th width="50">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list" :key="computedBudgets.length">
                            <tr v-for="( budget, index ) in computedBudgets" :key="index">
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>
                                                {{ index }}
                                            </th>
                                        </tr>
                                        <tr v-for="subBudget in budget.budgets" :key="subBudget.id">
                                            <td class="orders-category">
                                                <a href="#" @click="selectBudget( subBudget )">
                                                    {{ subBudget.sub_category ? subBudget.sub_category : 'All ' + subBudget.category }}
                                                </a>
                                            </td>
                                            <td class="orders-amount budget-currency">
                                                {{ formatCurrency( getMonthlyBudgetAmount( subBudget ) ) }}
                                            </td>
                                            <td class="orders-amount budget-currency">
                                                {{ formatCurrency(subBudget.total) }}
                                            </td>
                                            <td class="budget-currency">
                                                {{  formatCurrency( getRemainder(subBudget) )  }}
                                            </td>
                                            <td class="orders-amount budget-currency">
                                                {{ formatCurrency(subBudget.annual_amount) }}
                                            </td>
                                            <td v-if="!hideActions" width="50" class="text-right">
                                                <a href="#" class="show-on-hover" @click="editBudget( subBudget )">
                                                    <span class="fe fe-edit"></span>
                                                </a>
                                                <a class="show-on-hover" @click="deleteBudget( subBudget )" href="#">
                                                    <span class="fe fe-trash-2"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- / .row -->
</template>

<script>
    import BankCard from '../../accounts/step-cards/BankCard'
    import CredentialsCard from '../../accounts/step-cards/CredentialsCard'
    import SettingsCard from '../../accounts/step-cards/SettingsCard'

    export default {
        props: ['account', 'budgets', 'computedBudgets', 'errors', 'hideActions'],
        data() {
            return {
                dataBudgets: this.budgets
            }
        },
        methods: {
            addBudget() {
                event.preventDefault()
                let budget = {
                    'category': '',
                    'amount': 0,
                    'account_id': '',
                }
                this.$emit('saveBudget', budget)
            },
            saveBudget( budget ) {
                this.$emit('saveBudget', budget)
            },
            deleteBudget( budget ) {
                event.preventDefault()
                if ( confirm('Are you sure you\'d like to delete this budget?') ) {
                    this.$emit('deleteBudget', budget)
                }
            },
            selectBudget( budget ) {
                event.preventDefault()
                this.$emit('selectBudget', budget);
            },
            editBudget( budget ) {
                event.preventDefault()
                this.$emit('editBudget', budget);
            },
            // getMonthlyBudgetAmount( budget ) {
            //     // if (budget.timeframe == 1) {
            //     //     return parseFloat( ( budget.amount / 12 ) ).toFixed(2)
            //     // } else {
            //         return budget.monthly_amount;
            //     // }
            // },
            getRemainder( budget ) {
                // if (budget.timeframe == 1) {
                //     return parseFloat( ( budget.amount / 12 ) - budget.total )
                // } else {
                    return budget.monthly_amount - budget.total
                // }
            },
            getAnnualSum( budget ) {
                var sum = 0;
                for ( var month in budget.monthly_budgets ) {
                    sum += parseFloat(budget.monthly_budgets[month])
                }
                return sum;
            },
        },
        computed: {
            budgetCategories() {
                var categories = Object.values(this.$transactionCategories)
                this.budgets.forEach( function( budget ) {
                    let index = categories.map( function(category) { return category }).indexOf( budget.category )
                    if (index !== -1) {
                        categories.splice( index, 1 )
                    }
                })
                return categories
            }
        },
        mounted() {
            if (!this.budgets) {
                this.addBudget()
            }
        }
    }
</script>


<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        transition: opacity .5s
    }
    tr {
        width: 100%;
        display: inline-table;
        table-layout: fixed;
        background: white;
    }

    tr th {
        background: white;
    }

    table.scroll-table {
        display: -moz-groupbox;
        max-height: 100%;
        overflow: scroll;
    }
    tbody::-webkit-scrollbar {
        width: 0px;  /* Remove scrollbar space */
        background: transparent;  /* Optional: just make scrollbar invisible */
        display: none;
    }
    .scroll-table > tbody {
        overflow-y: scroll;
        width: 97%;
        position: absolute;
        height: 475px;
    }
    select, input {
        border-bottom: 0px;
         -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
        border-color:  #d2ddec
    }
    tr:hover select, tr:hover input {
        border-bottom: 1px solid #d2ddec;
    }

    .show-on-hover {
        display: none;
    }

    tr:hover .show-on-hover {
        display: inline-block;
    }

      .budget-currency {
        position: relative;
    }

    .budget-currency:before {
        content: '$';
        position: absolute;
        left: 6px;
        font-size: 12px;
    }
</style>

