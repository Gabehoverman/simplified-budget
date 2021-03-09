<template>
    <div class="card">
        <div class="card-header col-12">
            <h4 class="card-header-title">Top Places You Spent</h4>
        </div>
        <div class='card-body'>
            <div class="list-group list-group-flush list-group-activity my-n3">
                <div v-if="!vendors.length" class="list-group-item" >
                    Not enough data for this month.
                </div>
                <div v-else class="list-group-item" v-for="(vendor, name) in vendors" :key="name">
                    <div class="row" >
                        <div class="col-auto">
                        <!-- Avatar -->
                        <div class="avatar avatar-sm">
                            <div class="avatar-title font-size-lg bg-primary-soft rounded-circle text-primary">
                            <i class="fe fe-mail"></i>
                            </div>
                        </div>

                        </div>
                        <div class="col ml-n2 mt-3">

                            <!-- Heading -->
                            <h4 class="mb-1">
                                {{ vendor.category }}
                            </h4>

                        </div>
                        <div class="col ml-n2 mt-3 text-right">
                            <span class="text-muted">${{ vendor.sum }}</span>

                            <!-- <span class="text-muted">${{ getTotal(vendor) }}</span> -->
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['vendors'],
        methods: {
            getTotal( vendorData ) {
                let sum = 0;
                vendorData.forEach(transaction => {
                    sum += parseFloat(transaction.amount)
                });
                return sum.toFixed(2);
            }
        }
    }
</script>
