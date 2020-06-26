<template>

    <!-- Card -->
    <div class="card">
        <div class="card-body">
        <div class="row align-items-center">
            <div class="col">

            <!-- Title -->
            <h6 class="card-title text-uppercase text-muted mb-2">
                Total
            </h6>

            <!-- Heading -->
            <span class="h2 mb-0">
                ${{ transactionTotal }}
            </span>

            <!-- Badge -->
            <span class="badge badge-soft-success mt--1">
                +3.5%
            </span>

            </div>
            <div class="col-auto">

            <!-- Icon -->
            <span class="h2 fe fe-dollar-sign text-muted mb-0"></span>

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
        transactionTotal() {
            let sum = 0;
            this.transactions.forEach( function(transaction) {
                sum += parseFloat(transaction.amount);
            })
            return sum.toFixed(2);
        }
    }
}
</script>
