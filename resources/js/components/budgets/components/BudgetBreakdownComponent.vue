<template>
    <!-- Header -->
    <div class="row">
        <div class="col-md-8">
            <insights-card
                :budgets="budgets"
            />

            <graph-card
                :user="user"
                :budgets="budgets"
                @selectBudget="selectBudget($event)"
            />
        </div>

        <div class="col-md-4">
            <details-card
                :key="modalKey"
                :budget="selectedBudget"
                :budgets="budgets"
                :accounts="accounts"
                @selectBudget="selectBudget($event)"
            />
        </div>
    </div>
</template>

<script>
    import InsightsCard from '../cards/InsightsCard'
    import DetailsCard from '../cards/DetailsCard'
    import GraphCard from '../cards/GraphCard'

    export default {
        props: ['user', 'budgets', 'accounts'],
        data() {
            return {
                modalKey: 0,
                selectedBudget: {},
            }
        },
        components: {
            InsightsCard,
            DetailsCard,
            GraphCard
        },
        methods: {
            selectBudget( budget ) {
                this.$emit('selectBudget', budget)
            },
            editBudget ( budget ) {
                this.selectedBudget = budget
            },
        }
    }
</script>
