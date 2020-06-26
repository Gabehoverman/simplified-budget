<template>
    <!-- Projects -->
    <div class="card">
        <div class="card-header">
        <div class="row align-items-center">
            <div class="col">

            <!-- Title -->
            <h4 class="card-header-title">
                Accounts
            </h4>

            </div>
            <div class="col-auto">

            <!-- Link -->
            <a href="/accounts" class="small">View all</a>

            </div>
        </div> <!-- / .row -->
        </div>
        <div class="card-body">

            <div v-for="account in accounts" :key="account.id">

                <div class="row align-items-center">
                    <div class="col-auto">

                    <!-- Avatar -->
                    <a href="/accounts" class="avatar avatar-4by3 avatar-account">
                        <p>{{ getInitials(account.name) }}</p>

                        <!-- <img :src="asset('img/avatars/projects/project-1.jpg')" alt="..." class="avatar-img rounded"> -->
                    </a>

                    </div>
                    <div class="col ml--2">

                    <!-- Title -->
                    <h4 class="card-title mb-1">
                        <a href="/accounts">{{ account.name }}</a>
                    </h4>

                    <!-- Time -->
                    <p class="card-text small text-muted">
                        <time datetime="2018-05-24">{{ account.transactions.length }} transactions</time>
                    </p>

                    </div>
                    <div class="col-auto">

                    <!-- Dropdown -->
                    <!-- <div class="dropdown">
                        <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="window">
                        <i class="fe fe-more-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <a href="#!" class="dropdown-item">
                            Action
                        </a>
                        <a href="#!" class="dropdown-item">
                            Another action
                        </a>
                        <a href="#!" class="dropdown-item">
                            Something else here
                        </a>
                        </div>
                    </div> -->

                    </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr>

            </div>

        </div> <!-- / .card-body -->
    </div> <!-- / .card -->
</template>

<script>
export default {
    name: 'accounts-table-card',
    props: ['accounts'],
}
</script>
