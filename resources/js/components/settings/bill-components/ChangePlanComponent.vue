<template>
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="billingModalLabel">
                Update Plan
            </h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
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
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button v-if="currentPlan != selectedPlan && selectedPlan != null" type="button" class="btn btn-primary" @click="saveChanges()">Save changes</button>
            <button v-else type="button" class="btn btn-light disabled">Save changes</button>

        </div>
    </div>
</template>

<script>
    export default {
        props: ['stripe-pk', 'user'],
        data() {
            return {
                selectedPlan: null,
                currentPlan: this.user.plan
            }
        },
        methods: {
            selectPlan( plan ) {
                this.selectedPlan = plan
            },
            deselectPlan() {
                this.selectedPlan = null;
            },
            saveChanges() {
                var self = this;
                switch( this.selectedPlan ) {
                    case 'Free':
                        var data = {
                            'plan': 'Free',
                            'subscription': 'Free',
                        }
                        break;
                    case 'Monthly':
                        var data = {
                            'plan': 'Monthly',
                            'subscription': 'price_1HmhHVArvStASqAqDwCX0tsf'
                        }
                        break;
                    case 'Annual':
                        var data = {
                            'plan': 'Annual',
                            'subscription': 'price_1HmhgnArvStASqAqhZU8kgVk'
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
