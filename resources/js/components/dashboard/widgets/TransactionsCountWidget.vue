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
               {{ transactions.length }}
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
    props: ['transactions']
}
</script>
