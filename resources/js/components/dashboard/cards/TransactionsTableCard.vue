<template>
    <!-- Goals -->
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">

                    <!-- Title -->
                    <h4 class="card-header-title">
                        Recent Transactions
                    </h4>

                </div>
                <div class="col-auto">
                    <a href="/transactions" class="small">View all</a>
                </div>
            </div> <!-- / .row -->
        </div>

        <div class="table-responsive mb-0" data-toggle="lists" data-lists-values='["goal-project", "goal-status", "goal-progress", "goal-date"]'>
            <table class="table table-hover table-sm table-nowrap card-table">
                <thead>
                <tr>
                    <th>
                        <a href="#" class="text-muted sort" data-sort="goal-project">
                            #
                        </a>
                    </th>
                    <th>
                        <a href="#" class="text-muted sort" data-sort="goal-status">
                            Category
                        </a>
                    </th>
                    <th>
                    <a href="#" class="text-muted sort" data-sort="goal-progress">
                        Amount
                    </a>
                    </th>
                    <th>
                    <a href="#" class="text-muted sort" data-sort="goal-date">
                        Vendor
                    </a>
                    </th>
                    <th class="text-right">
                        Account
                    </th>
                      <th class="text-right">
                        Date
                    </th>
                    <!-- <th></th> -->
                </tr>
                </thead>
                <tbody class="list">
                <tr v-for="(transaction, index) in dataTransactions" :key="transaction.id">
                    <td class="goal-project">
                        {{ index + 1 }}
                    </td>
                    <td class="goal-progress">
                        <!-- <span :class="'text-' + transaction.category">●</span>  -->
                        {{ formatString( transaction.category ) }}
                    </td>
                    <td class="goal-date">
                        <div :class="'badge '+getBadgeType( transaction )">
                            {{ transaction.amount }}
                        </div>
                    </td>
                    <td class="text-right">
                        {{ transaction.vendor }}
                    </td>
                    <td class="text-right">
                        {{ transaction.account.name }}
                    </td>
                    <td class="text-right">
                        {{ getFormattedDate( transaction.date ) }}
                    </td>
                    <!-- <td class="text-right">
                    <div class="dropdown">
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
                    </div>
                    </td> -->
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    export default {
        name:'transactions-table-card',
        props: ['transactions'],
        mounted() {
        },
        computed: {
            dataTransactions() {
                return this.transactions.slice(0,5)
            }
        }
    }
</script>
