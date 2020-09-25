<template>
    <div class="col-12">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Recorded Transactions</div>

                    <div class="card-body">
                        <div class="row" v-for="(monthTransactions, month) in transactions" :key="month">
                            <div class="col-12 mb-3">
                                <h3>Transactions From {{ month }}</h3>
                            </div>
                            <div class="col-12 row" v-for="transaction in monthTransactions" :key="transaction.id">
                                <div class="col-2">
                                    <p>{{ transaction.date }}</p>
                                </div>
                                <div class="col-2">
                                    <p>{{ formatString(transaction.category) }}</p>
                                </div>
                                <div class="col-6">
                                    <p>{{ transaction.vendor }}</p>
                                </div>
                                <div class="col-2">
                                    <p>${{ transaction.amount }}</p>
                                </div>
                            </div>
                            <hr class="divider">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['account', 'transactions'],
        mounted() {
        }
    }
</script>
