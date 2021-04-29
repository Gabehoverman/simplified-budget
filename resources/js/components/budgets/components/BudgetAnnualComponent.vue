<template>
    <!-- Header -->
    <div class="row">

        <div class="col-md-12 mapped-annual-budgets-card">
            <mapped-annual-card
                :user="user"
                :budgets="dataBudgets"
                :computed-budgets="computedBudgets"
                @saveBudget="saveBudget($event)"
                @editBudget="editBudget($event)"
                @deleteBudget="deleteBudget($event)"
                @selectBudget="selectBudget($event)"
            />
        </div>

    </div>
</template>

<script>
    import TableCard from '../cards/TableCard'
    import MappedAnnualCard from '../cards/MappedAnnualCard'


    export default {
        props: ['user', 'budgets', 'computedBudgets', 'accounts', 'totals', 'selectedBudget'],
        data() {
            return {
                dataBudgets: this.budgets,
                modalKey: 0,
            }
        },
        components: {
            TableCard,
            MappedAnnualCard
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
