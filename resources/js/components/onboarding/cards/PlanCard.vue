<template>
    <div class="modal-content">
         <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                <!-- Pretitle -->
                <h6 class="mb-4 text-uppercase text-muted">
                    Step 2 of 5
                </h6>

                <!-- Title -->
                <h1 class="mb-3">
                    Now let's choose your plan.
                </h1>

                <!-- Subtitle -->
                <p class="mb-5 text-muted">
                    We offer three plans to help best suit your budgeting needs.
                </p>

            </div>
        </div> <!-- / .row -->

        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-4">

                        <!-- Card -->
                        <div :class="selectedPlan == 'Free' ? 'selected-plan' : '' ">
                            <div class="">

                                <!-- Title -->
                                <h6 class="text-uppercase text-center text-muted ">
                                Free
                                </h6>

                                <!-- Price -->
                                <div class="row no-gutters align-items-center justify-content-center">
                                <div class="col-auto">
                                    <div class="h2 mb-0">$</div>
                                </div>
                                <div class="col-auto">
                                    <div class="display-2 mb-0">0</div>
                                </div>
                                </div> <!-- / .row -->

                                <!-- Period -->
                                <div class="h6 text-uppercase text-center text-muted mb-5">
                                / month
                                </div>

                                <!-- Features -->
                                <div class="mb-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Unlimited Accounts</small> <i class="fe fe-alert-octagon text-danger"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Automatic Transaction Recording</small> <i class="fe fe-alert-octagon text-danger"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Members</small> <small>10 members</small>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Admins</small> <small>No access</small>
                                    </li>
                                </ul>
                                </div>

                                <!-- Button -->
                                    <a v-if="currentPlan == 'Free'" :class="'btn btn-block btn-light '  + (currentPlan == selectedPlan || selectedPlan == null ? 'disabled': '' )" @click="deselectPlan()">
                                    Current Plan
                                </a>
                                <a v-else href="#!" class="btn btn-block btn-primary" @click="selectPlan('Free')">
                                    {{ selectedPlan == 'Free' ? 'Selected' : 'Choose Plan' }}
                                </a>

                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-4">

                        <!-- Card -->
                        <div :class="selectedPlan == 'Monthly' ? 'selected-plan' : '' ">
                            <div class="">

                                <!-- Title -->
                                <h6 class="text-uppercase text-center text-muted ">
                                Monthly
                                </h6>

                                <!-- Price -->
                                <div class="row no-gutters align-items-center justify-content-center">
                                <div class="col-auto">
                                    <div class="h2 mb-0">$</div>
                                </div>
                                <div class="col-auto">
                                    <div class="display-2 mb-0">9</div>
                                </div>
                                </div> <!-- / .row -->

                                <!-- Period -->
                                <div class="h6 text-uppercase text-center text-muted mb-5">
                                / month
                                </div>

                                <!-- Features -->
                                <div class="mb-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Unlimited Accounts</small> <i class="fe fe-check-circle text-success"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Automatic Transaction Recording</small> <i class="fe fe-check-circle text-success"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Members</small> <small>50 members</small>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Admins</small> <small>5 admins</small>
                                    </li>
                                </ul>
                                </div>

                                <!-- Button -->
                                <a v-if="currentPlan == 'Monthly'" :class="'btn btn-block btn-light '  + (currentPlan == selectedPlan || selectedPlan == null ? 'disabled': '' )" @click="deselectPlan()">
                                    Current Plan
                                </a>
                                <a v-else href="#!" class="btn btn-block btn-primary" disabled @click="selectPlan('Monthly')">
                                    {{ selectedPlan == 'Monthly' ? 'Selected' : 'Choose Plan' }}
                                </a>

                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-4">

                        <!-- Card -->
                        <div :class="selectedPlan == 'Annual' ? 'selected-plan' : '' ">
                            <div class="">

                                <!-- Title -->
                                <h6 class="text-uppercase text-center text-muted ">
                                Yearly
                                </h6>

                                <!-- Price -->
                                <div class="row no-gutters align-items-center justify-content-center">
                                <div class="col-auto">
                                    <div class="h2 mb-0">$</div>
                                </div>
                                <div class="col-auto">
                                    <div class="display-2 mb-0">50</div>
                                </div>
                                </div> <!-- / .row -->

                                <!-- Period -->
                                <div class="h6 text-uppercase text-center text-muted mb-5">
                                / year
                                </div>

                                <!-- Features -->
                                <div class="mb-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Unlimited Accounts</small> <i class="fe fe-check-circle text-success"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Automatic Transaction Recording</small> <i class="fe fe-check-circle text-success"></i>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Members</small> <small>Unlimited</small>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <small>Admins</small> <small>Unlimited</small>
                                    </li>
                                </ul>
                                </div>

                                <!-- Button -->
                                <a v-if="currentPlan == 'Annual'" :class="'btn btn-block btn-light '  + (currentPlan == selectedPlan || selectedPlan == null ? 'disabled': '' )" @click="deselectPlan()">
                                    Current Plan
                                </a>
                                <a v-else href="#!" class="btn btn-block btn-primary" @click="selectPlan('Annual')">
                                    {{ selectedPlan == 'Annual' ? 'Selected' : 'Choose Plan' }}
                                </a>

                            </div>
                        </div>

                    </div>
                </div> <!-- / .row -->
                <br/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                selectedPlan: null,
                currentPlan: this.user.plan
            }
        },
        methods: {
            selectPlan( plan ) {
                this.user.billing = plan
                this.selectedPlan = plan
                this.$emit('selectPlan', plan)
            },
            deselectPlan() {
                this.selectedPlan = null;
            },
            saveChanges() {
                var self = this;
                switch( this.selectedPlan ) {
                    case 'Free':
                        var data = {
                            'subscription': 'Free',
                            'plan': 'Free'
                        }
                        break;
                    case 'Monthly':
                        var data = {
                            'subscription': 'Monthly',
                            'plan': 'price_1HmhHVArvStASqAqDwCX0tsf'
                        }
                        break;
                    case 'Annual':
                        var data = {
                            'subscription': 'Monthly',
                            'plan': 'price_1HmhgnArvStASqAqhZU8kgVk'
                        }
                        break;
                }
                this.asyncSendData(data, '/settings/billing/change-plan', 'POST').then( function( response ) {
                    self.$emit('updateBilling', response);
                })
            }
        },
        mounted() {
        }
    };
</script>

<style scoped>
.selected-plan {
    border: 1px solid #2C7BE5;
    border-radius: 8px;
    padding: 5px;
    margin: -5px;
}


.selected-plan .btn-block {
    border-radius: 0px 0px 7px 7px !important;
    margin: 0px -5px -5px;
    width: calc(100% + 10px);
}
</style>
