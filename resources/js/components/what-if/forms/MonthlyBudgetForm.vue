<template>
    <div class="col-md-12" style="min-height: 450px">
        <mapped-table-card
            :user="user"
            :budgets="budgets"
            :computed-budgets="computedBudgets"
            :hide-actions="true"
        />
    </div>
</template>

<script>
    import MappedTableCard from '../../budgets/cards/MappedTableCard'

    export default {
        props: ['user', 'budgets'],
        data() {
            return {
                dataBudgets: this.budgets
            }
        },
        components: {
            MappedTableCard
        },
        computed: {
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
        },
    }
</script>
