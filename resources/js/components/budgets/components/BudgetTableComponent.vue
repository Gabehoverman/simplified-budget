<template>
    <!-- Header -->
    <div class="row">
        <div class="col-md-12">
            <overview-card
                :budgets="budgets"
                :totals="totals"
            />
        </div>
        <div class="col-md-8">

            <table-card
                :user="user"
                :budgets="budgets"
                @saveBudget="saveBudget($event)"
                @deleteBudget="deleteBudget($event)"
                @selectBudget="selectBudget($event)"
            />
        </div>

        <div class="col-md-4">
            <budget-list-card
                v-if="!selectedBudget.id"
                :budgets="budgets"
            />
            <details-card
                v-if="selectedBudget.id"
                :selectedBudget="selectedBudget"
                :budgets="budgets"
                :accounts="accounts"
                @selectBudget="selectBudget($event)"
                @unselectBudget="unselectBudget($event)"
            />
            <!-- <details-card
                :key="modalKey"
                :budget="selectedBudget"
                :budgets="budgets"
                :accounts="accounts"
                @selectBudget="selectBudget($event)"
            /> -->
        </div>
    </div>
</template>

<script>
    import OverviewCard from '../cards/OverviewCard'
    import DetailsCard from '../cards/DetailsCard'
    import TableCard from '../cards/TableCard'
    import BudgetListCard from '../cards/BudgetListCard'

    export default {
        props: ['user', 'budgets', 'accounts', 'totals', 'selectedBudget'],
        data() {
            return {
                modalKey: 0,
                // selectedBudget: {},
            }
        },
        components: {
            OverviewCard,
            DetailsCard,
            TableCard,
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
