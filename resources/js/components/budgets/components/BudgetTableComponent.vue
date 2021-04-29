<template>
    <!-- Header -->
    <div class="row">
        <div class="col-md-12">
            <overview-card
                :month="month"
                :budgets="budgets"
                :totals="totals"
            />
        </div>
        <div :class=" (!selectedBudget.id ? 'col-md-12' : 'col-md-8') + ' breakdown-table'">

            <mapped-table-card
                :user="user"
                :budgets="budgets"
                :computed-budgets="computedBudgets"
                @editBudget="editBudget($event)"
                @saveBudget="saveBudget($event)"
                @deleteBudget="deleteBudget($event)"
                @selectBudget="selectBudget($event)"
            />
        </div>

        <div :class=" !selectedBudget.id ? '' : 'col-md-4'">
            <!-- <budget-list-card
                v-if="!selectedBudget.id"
                :budgets="budgets"
            /> -->
            <details-card
                v-if="selectedBudget.id"
                :selectedBudget="selectedBudget"
                :budgets="budgets"
                :accounts="accounts"
                @selectBudget="selectBudget($event)"
                @unselectBudget="unselectBudget($event)"
            />
        </div>
    </div>
</template>

<style scoped>
    .breakdown-table {
        min-height: 600px;
    }
</style>

<script>
    import OverviewCard from '../cards/OverviewCard'
    import DetailsCard from '../cards/DetailsCard'
    import TableCard from '../cards/TableCard'
    import MappedTableCard from '../cards/MappedTableCard'
    import BudgetListCard from '../cards/BudgetListCard'

    export default {
        props: ['user', 'budgets', 'computedBudgets', 'accounts', 'totals', 'selectedBudget', 'month'],
        data() {
            return {
                modalKey: 0,
                dataBudgets: this.budgets
                // selectedBudget: {},
            }
        },
        components: {
            OverviewCard,
            DetailsCard,
            TableCard,
            MappedTableCard,
            BudgetListCard
        },
        methods: {
            selectBudget( budget ) {
                this.$emit('selectBudget', budget)
            },
            unselectBudget() {
                this.$emit('unselectBudget')
            },
            editBudget ( budget ) {
                this.selectedBudget = budget
                this.$emit('editBudget', budget)
            },
            saveBudget( budget ) {
                this.$emit('saveBudget', budget)
            },
            deleteBudget( budget ) {
                this.$emit('deleteBudget', budget)
            }
        }
    }
</script>
