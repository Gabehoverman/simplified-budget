<template>

    <!-- Card -->
    <div class="card">
        <div class="card-body">
        <div class="row align-items-center">
            <div class="col">

            <!-- Title -->
            <h6 class="card-title text-uppercase text-muted mb-2">
                Expenses
            </h6>

            <!-- Heading -->
            <span class="h2 mb-0">
                ${{ transactionTotal }}
            </span>

            <!-- Badge -->
            <span class="badge badge-soft-success mt--1">
                -3.5%
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
    props: ['transactions', 'filter'],
    methods: {
        getFilterDate() {
            let today = new Date();
            switch(this.filter) {
                case 'weekly':
                    let day = today.getDay(),
                    diff = today.getDate() - day + (day == 0 ? -6:0)
                    return new Date(today.setDate(diff));
                case 'monthly':
                    return new Date(today.getFullYear(), today.getMonth(), 1);
                case 'annual':
                    return new Date(new Date().getFullYear(), 0, 1);
            }
            return today
        }
    },
    computed: {
        transactionTotal() {
            let sum = 0;
            let date = this.getFilterDate()
            this.transactions.forEach( function(transaction) {
                if (transaction.type == 0 && new Date(transaction.date) >= date) {
                    sum += parseFloat(transaction.amount);
                }
            })
            return sum.toFixed(2);
        }
    }
}
</script>
