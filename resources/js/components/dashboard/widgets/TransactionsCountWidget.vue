<template>
    <!-- Card -->
    <div class="card">
        <div class="card-body">
        <div class="row align-items-center">
            <div class="col">

            <!-- Title -->
            <h6 class="card-title text-uppercase text-muted mb-2">
                Total Transactions
            </h6>

            <!-- Heading -->
            <span class="h2 mb-0">
               {{ transactionCount }}
            </span>

            </div>
            <div class="col-auto">

            <!-- Icon -->
            <span class="h2 fe fe-briefcase text-muted mb-0"></span>

            </div>
        </div> <!-- / .row -->

        </div>
    </div>
</template>

<script>
export default {
    name: 'transactouns-count-widget',
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
        transactionCount() {
            let count = 0;
            let date = this.getFilterDate()
            this.transactions.forEach( function(transaction) {
                if (new Date(transaction.date) >= date) {
                    count++;
                }
            })
            return count;
        }
    }
}
</script>
