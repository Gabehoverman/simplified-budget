<template>
    <div class="tab-pane fade show active" id="wizardStepThree" role="tabpanel" aria-labelledby="wizardTabThree">

        <!-- Header -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

            <!-- Pretitle -->
            <h6 class="mb-4 text-uppercase text-muted">
                Step 3 of 4
            </h6>

            <!-- Title -->
            <h1 class="mb-3">
                Let’s record some transactions.
            </h1>

            <!-- Subtitle -->
            <p class="mb-5 text-muted">
                Recording transactions is how we can analyze your financial habits.
            </p>

            </div>
        </div> <!-- / .row -->

        <div class="row">
            <div class="col-6 text-center">
                <a class="btn btn-primary text-white" @click="generateTransactions()">Auto Record Transactions</a>
            </div>
            <div class="col-6 text-center">
                <a class="btn btn-primary text-white">Input Transactions Manually</a>
            </div>
        </div>

        <hr class="divider">

        <div class="row" v-if="transactions.length > 0">
            <div class="col-12">
                <div class="table-responsive" >
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
                        <tbody class="list">
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
    export default {
        props: ['user', 'transactions'],
        // data() {
        //     return {
        //         transactions: []
        //     }
        // },
        methods: {
            generateTransactions() {
                let transaction = {
                    'category': 'dining',
                    'amount': 12.99,
                    'type': 0,
                    'vendor': 'Target',
                    'account_id': 1,
                    'user_id': this.user.id,
                    'date': this.formatDate(new Date()),

                }
                this.transactions.push(transaction)
                this.transactions.push(transaction)
                this.transactions.push(transaction)
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
        }
    }
</script>
