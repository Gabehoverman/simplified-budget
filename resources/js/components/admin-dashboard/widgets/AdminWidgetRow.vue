<template>
    <div class="row">
        <div class="col-12 col-lg-6">

        <!-- Card -->
        <div class="card">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col">

                <!-- Title -->
                <h6 class="text-uppercase text-muted mb-2">
                    Total New Users
                </h6>

                <!-- Heading -->
                <span class="h2 mb-0">
                    {{ users.length }}
                </span>

                <!-- Badge -->
                <span class="badge badge-soft-success mt-n1">
                    +3.5%
                </span>

                </div>
                <div class="col-auto">

                <!-- Icon -->
                <span class="h2 fe fe-user text-muted mb-0"></span>

                </div>
            </div> <!-- / .row -->

            </div>
        </div>

        </div>
        <div class="col-12 col-lg-6">

        <!-- Card -->
        <div class="card">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col">

                <!-- Title -->
                <h6 class="text-uppercase text-muted mb-2">
                    Total Users
                </h6>

                <!-- Heading -->
                <span class="h2 mb-0">
                    {{ users.length }}
                </span>

                </div>
                <div class="col-auto">

                <!-- Icon -->
                <span class="h2 fe fe-users text-muted mb-0"></span>

                </div>
            </div> <!-- / .row -->

            </div>
        </div>

        </div>
        <div class="col-12 col-lg-6">

        <!-- Card -->
        <div class="card">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col">

                <!-- Title -->
                <h6 class="text-uppercase text-muted mb-2">
                    Paid subscriptions
                </h6>

                <div class="row align-items-center no-gutters">
                    <div class="col-auto">

                    <!-- Heading -->
                    <span class="h2 mr-2 mb-0">
                        0%
                    </span>

                    </div>
                    <div class="col">

                    <!-- Progress -->
                    <div class="progress progress-sm">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    </div>
                </div> <!-- / .row -->

                </div>
                <div class="col-auto">

                <!-- Icon -->
                <span class="h2 fe fe-clipboard text-muted mb-0"></span>

                </div>
            </div> <!-- / .row -->

            </div>
        </div>

        </div>
        <div class="col-12 col-lg-6">

        <!-- Card -->
        <div class="card">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col">

                <!-- Title -->
                <h6 class="text-uppercase text-muted mb-2">
                    Recurring Revenue Per User
                </h6>

                <!-- Heading -->
                <span class="h2 mb-0">
                    $0.00
                </span>

                </div>
                <div class="col-auto">

                </div>
            </div> <!-- / .row -->

            </div>
        </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: ['users']

    }
</script>
