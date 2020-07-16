<template>
    <div class="card">
        <div class="card-header col-12">
            <h3>Top Places you Spent</h3>
        </div>
        <div class='card-body'>
            <div class="list-group list-group-flush list-group-activity my-n3">
                <div class="list-group-item" v-for="(i, key) in ['1','2','3',]" :key="key">
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
                                Publix
                            </h4>

                        </div>
                        <div class="col ml-n2 mt-3 text-right">
                            <span class="text-muted">$12.99</span>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>
