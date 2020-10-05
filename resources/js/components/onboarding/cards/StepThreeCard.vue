<template>
    <div class="tab-pane fade show active" id="wizardStepThree" role="tabpanel" aria-labelledby="wizardTabThree">

        <!-- Header -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

            <!-- Pretitle -->
            <h6 class="mb-4 text-uppercase text-muted">
                Step 3 of 5
            </h6>

            <!-- Title -->
            <h1 class="mb-3">
                Now, let’s record some transactions.
            </h1>

            <!-- Subtitle -->
            <p v-if="account" class="mb-5 text-muted">
                Recording transactions is how we can analyze your financial habits.
            </p>
            <p v-else class="mb-5 text-muted">
                Recording transactions is how we can analyze your financial habits.
            </p>

            </div>
        </div> <!-- / .row -->

        <div class="row">
            <!-- <div class="col-6 text-center">
                <a class="btn btn-primary text-white" @click="generateTransactions()">Auto Record Transactions</a>
            </div> -->
            <!-- <div class="col-6 text-center">
                <a class="btn btn-primary text-white">Input Transactions Manually</a>
            </div> -->
        </div>

        <hr class="divider">

        <div class="row" v-if="transactions.length < 1">
            <div class="col-md-8 offset-md-2">
                <content-loader
                    :width="200"
                    :height="150"
                    :speed="2"
                    primaryColor="#f3f3f3"
                    secondaryColor="#ecebeb"
                >
                    <circle cx="10" cy="20" r="8" />
                    <rect x="25" y="15" rx="5" ry="5" width="220" height="6" />
                    <circle cx="10" cy="50" r="8" />
                    <rect x="25" y="45" rx="5" ry="5" width="220" height="6" />
                    <circle cx="10" cy="80" r="8" />
                    <rect x="25" y="75" rx="5" ry="5" width="220" height="6" />
                    <circle cx="10" cy="110" r="8" />
                    <rect x="25" y="105" rx="5" ry="5" width="220" height="6" />
                </content-loader>
            </div>
        </div>

        <div class="row" v-if="transactions.length > 0">
            <div class="col-12">
                <div class="table-responsive" style="max-height: 400px;">
                    <table id="transactions-table" class="table table-hover table-sm table-nowrap card-table">
                        <thead>
                            <tr>
                            <th>
                                <a href="#" class="text-muted sort" data-sort="orders-order">
                                    #
                                </a>
                            </th>
                            <th>
                                <a href="#" class="text-muted sort" data-sort="orders-category">
                                Category
                                </a>
                            </th>
                            <th>
                                <a href="#" class="text-muted sort" data-sort="orders-amount">
                                Amount
                                </a>
                            </th>
                            <th>
                                <a href="#" class="text-muted sort" data-sort="orders-vendor">
                                Vendor
                                </a>
                            </th>
                            <th>
                                <a href="#" class="text-muted sort" data-sort="orders-date">
                                Date
                                </a>
                            </th>
                            </tr>
                        </thead>
                        <tbody class="list" :key="transactions.length">
                            <tr v-for="(transaction, index ) in transactions" :key="index">
                            <td class="orders-order">
                                #{{ index + 1 }}
                            </td>
                            <td class="orders-category">
                                {{ formatString(transaction.category) }}
                            </td>
                            <td class="orders-amount">
                                <div :class="'badge '+getBadgeType( transaction )">
                                    ${{ transaction.amount }}
                                </div>
                            </td>
                            <td class="orders-vendor">
                                {{ transaction.vendor }}
                            </td>
                            <td class="orders-date">
                                <time :datetime="transaction.date">{{ getFormattedDate( transaction.date ) }}</time>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr class="divider"  v-if="transactions.length > 0">
    </div>
</template>

<script>
    import { ContentLoader } from 'vue-content-loader'

    export default {
        props: ['user', 'account', 'transactions'],
        components: {
            ContentLoader
        },
        methods: {
            generateTransactions() {
                var self = this
                let date = new Date()
            },
            formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;

                return [year, month, day].join('-');
            }
        },
        mounted() {
            this.generateTransactions();
        }
    }
</script>
