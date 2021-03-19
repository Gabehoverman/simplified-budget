<template>

    <div class="col-md-12 row">

        <div class="col-md-12">
            <button
                @click="unselectBudget()"
                type="button"
                class="btn btn-primary float-right"
                data-toggle="modal"
                data-target="#budgetModal"
                >New Budget
            </button>

                <div class="card col-md-10">
                    <div class="card-header">
                        <h4 class="card-header-title">Budget Breakdown</h4>
                    </div>
                    <div class="card-body row">
                        <div class="col-sm-6 col-md-4">
                            <p>Estimated Monthly Income:</p>
                            <p>Estimated Annual Income:</p>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <p>${{ formatCurrency( totals.estimated_income ) }}</p>
                            <p>${{ formatCurrency( totals.estimated_income * 12 ) }}</p>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <p>Average Monthly Budget:</p>
                            <p>Annual Budgeted Amount:</p>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <p>${{ formatCurrency( annualBudgetTotals / 12 ) }}</p>
                            <p>${{ formatCurrency( annualBudgetTotals ) }}</p>
                        </div>
                    </div>
                </div>


                <new-budget-component
                    :key="modalKey"
                    :budget="selectedBudget"
                    :accounts="accounts"
                    :categories="budgetCategories"
                    :computed-budgets="computedBudgets"
                    @saveBudget="newBudget($event)"
                    @deleteBudget="deleteBudget($event)"
                />

        </div>

        <div class="col-md-12">

            <mapped-annual-card
                :user="user"
                :budgets="dataBudgets"
                :computed-budgets="computedBudgets"
                :hide-actions="true"
                @saveBudget="saveBudget"
            />
        </div>
    </div>
</template>

<script>
    import MappedAnnualCard from '../../budgets/cards/MappedAnnualCard'
    import NewBudgetComponent from '../../budgets/components/NewBudgetComponent'

    export default {
        props: ['user', 'budgets', 'accounts', 'totals'],
        data() {
            return {
                dataBudgets: this.budgets,
                modalKey: 0,
                selectedBudget: {},
            }
        },
        components: {
            MappedAnnualCard,
            NewBudgetComponent
        },
        methods: {
            newBudget( budget ) {
                this.modalKey += 1;
                var amount = budget.timeframe == 1 ? ( budget.amount / 12 ) : budget.amount
                budget.monthly_budgets = {
                    'Jan': amount,
                    'Feb': amount,
                    'Mar': amount,
                    'Apr': amount,
                    'May': amount,
                    'Jun': amount,
                    'Jul': amount,
                    'Aug': amount,
                    'Sep': amount,
                    'Oct': amount,
                    'Nov': amount,
                    'Dec': amount,
                }
                budget.annual_amount = budget.timeframe == 1 ? (budget.amount) : budget.amount * 12
                this.budgets.push( budget )
            },
            saveBudget( budget ) {
                budget.annual_amount = Object.keys(budget.monthly_budgets).reduce((sum,key)=>sum+parseFloat(budget.monthly_budgets[key]||0),0);
            },
            unselectBudget() {
                this.selectedBudget = {};
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
            },
            computedBudgets() {
                // todo: map budgets by main category and have subcategory budgets underneath
                var mappedBudgets = {};
                this.dataBudgets.forEach( function( budget ) {
                    if (!mappedBudgets[budget.category]) {
                        mappedBudgets[budget.category] = {
                            monthly_amount: 0,
                            annual_amount: 0,
                            budgets: []
                        };
                    }

                    mappedBudgets[budget.category].monthly_amount += budget.monthly_amount
                    mappedBudgets[budget.category].annual_amount += budget.annual_amount
                    mappedBudgets[budget.category].budgets.push(budget)
                })

                return mappedBudgets;
            },
            monthlyBudgetTotals() {
                var sum = 0;
                for (const [key, value] of Object.entries( this.computedBudgets )) {
                    sum += value.monthly_amount
                }
                return sum;
            },
            annualBudgetTotals() {
                var sum = 0;
                for (const [key, value] of Object.entries( this.computedBudgets )) {
                    sum += value.annual_amount
                }
                return sum;
            }
        },
    }
</script>
