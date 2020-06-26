<template>
        <!-- Card -->
    <div class="card">
        <div class="card-body">
        <div class="row align-items-center">
            <div class="col">

            <!-- Title -->
            <h6 class="card-title text-uppercase text-muted mb-2">
                Average Transaction
            </h6>

            <!-- Heading -->
            <span class="h2 mb-0">
                ${{ transactionAverage }}
            </span>

            </div>
            <div class="col-auto">

            <!-- Icon -->
            <span class="h2 fe fe-clock text-muted mb-0"></span>

            </div>
        </div> <!-- / .row -->

        </div>
    </div>
</template>

<script>
export default {
    name: 'transaction-total-widget',
    props: ['transactions'],
    computed: {
        transactionAverage() {
            let sum = 0;
            this.transactions.forEach( function(transaction) {
                sum += parseFloat(transaction.amount);
            })
            return (sum / this.transactions.length).toFixed(2);
        }
    }
}
</script>
