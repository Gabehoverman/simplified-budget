<template>
    <div class="card">
        <div class="card-header col-12">
            <h4 class="card-header-title">Available Categories</h4>
        </div>
        <div class='card-body'>
            <div class="list-group list-group-flush my-n3" style="max-height: 520px; overflow: auto;">
                <div v-if="dataBudgets.length == 0">
                    <p>No Budgets to show.</p>
                </div>
                <div class="list-group-item" v-for="(budget, index) in budgetCategories" :key="index">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <!-- Heading -->
                            <h4 class="">
                                {{ budget }}
                            </h4>
                        </div>
                    </div>
                </div> <!-- / .row -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['budgets'],
        data() {
            return {
                dataBudgets: this.budgets,
            }
        },
        methods: {
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
        }
    }
</script>
