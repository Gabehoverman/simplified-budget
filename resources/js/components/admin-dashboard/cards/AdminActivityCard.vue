<template>
    <!-- Devices -->
    <div class="card">
        <div class="card-header">

            <!-- Title -->
            <h4 class="card-header-title">
                Recent Activity
            </h4>

            <!-- Button -->
            <a class="small text-right" href="#!">View all</a>

        </div>
        <div class="card-body">

            <!-- List group -->
            <div class="list-group list-group-flush list-group-activity my-n3">
                <div class="list-group-item">
                <div class="row">
                    <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                        <div class="avatar-title font-size-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-mail"></i>
                        </div>
                    </div>

                    </div>
                    <div class="col ml-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                        Daily Newsletter Sent
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                        Sent to all 1,851 subscribers over a 24 hour period
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                        2m ago
                    </small>

                    </div>
                </div> <!-- / .row -->
                </div>
                <div class="list-group-item">
                <div class="row">
                    <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                        <div class="avatar-title font-size-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-archive"></i>
                        </div>
                    </div>

                    </div>
                    <div class="col ml-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                        New Transactions
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                        1,253 new transactions were added automatically
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                        2h ago
                    </small>

                    </div>
                </div> <!-- / .row -->
                </div>
                <div class="list-group-item">
                <div class="row">
                    <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                        <div class="avatar-title font-size-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-code"></i>
                        </div>
                    </div>

                    </div>
                    <div class="col ml-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                        Update Deployed
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                        A new update was successfully deployed to the server.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                        4h ago
                    </small>

                    </div>
                </div> <!-- / .row -->
                </div>
                <div class="list-group-item">
                <div class="row">
                    <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                        <div class="avatar-title font-size-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-dollar-sign"></i>
                        </div>
                    </div>

                    </div>
                    <div class="col ml-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                        Subscriptions successfully processed.
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                        16 monthly subscriptions were successfuly processed.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                        5h ago
                    </small>

                    </div>
                </div> <!-- / .row -->
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: 'transactions-graph-card',
    props: ['transactions']
}
</script>
