<template>
<div>
    <div class="row">
        <billing-callout
            :user="user"
        />

        <div class="col-md-8">
            <div class="row">

                <div class="col-md-6 " >
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-header-title">Plan Details</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <h3 v-if="user.plan == 'Monthly'">$9 / Month</h3>
                                    <h3 v-else-if="user.plan == 'Annual'">$50 / Year</h3>
                                    <h3 v-else>$0 / Month</h3>
                                    <p>{{ user.plan }} Plan</p>
                                </div>
                                <div class="col-md-6 col-sm-12 text-right">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#billingModal" @click="selectModal('Change Plan')">Change Plan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" >
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-header-title" v-if="user.plan == 'Free' && !user.bill_date">Free Forever</h2>
                            <h2 class="card-header-title" v-if="user.plan == 'Free' && user.bill_date">Plan Ending</h2>
                            <h2 class="card-header-title" v-else>Next Billing Date</h2>
                        </div>
                        <div class="card-body" v-if="user.plan == 'Free' && !user.bill_date">
                            <h3>Free</h3>
                            <p>on {{ user.bill_date }}</p>
                        </div>
                         <div class="card-body" v-if="user.plan == 'Free' && user.bill_date">
                            <h3>Your previous plan will end</h3>
                            <p>on {{ user.bill_date }}</p>
                        </div>
                        <div class="card-body" v-else>
                            <h3 v-if="user.plan == 'Monthly'">$9.00</h3>
                            <h3 v-else-if="user.plan == 'Annual'">$50.00</h3>
                            <h3 v-else>$0.00</h3>
                            <p>on {{ user.bill_date }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card" style="height: calc(100% - 24px); min-height: 340px">
                        <div class="card-header" style="max-height: 50px;">
                            <h2 class="card-header-title">
                                Payment History
                            </h2>
                        </div>
                        <div class="row">
                            <div class="table-responsive col-md-12" style="">
                                <table id="transactions-table" class="table table-sm table-nowrap card-table" >
                                    <thead>
                                        <tr>
                                        <th width="25">
                                            <a href="#" class="text-muted list-sort" data-sort="orders-order">
                                            </a>
                                        </th>
                                        <th colspan="1">
                                            <a href="#" class="text-muted list-sort" data-sort="orders-amount">
                                            Status
                                            </a>
                                        </th>
                                        <th colspan="1">
                                            <a href="#" class="text-muted list-sort" data-sort="orders-amount">
                                            Amount
                                            </a>
                                        </th>
                                        <th colspan="2">
                                            <a href="#" class="text-muted list-sort" data-sort="orders-vendor">
                                            Reason
                                            </a>
                                        </th>
                                        <th colspan="1">
                                            <a href="#" class="text-muted list-sort" data-sort="orders-date">
                                            Date
                                            </a>
                                        </th>
                                        <!-- <th colspan="2">
                                            <a href="#" class="text-muted list-sort" data-sort="orders-method">
                                            Actions
                                            </a>
                                        </th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <tr v-for="transaction in user.invoices" :key="transaction.id">
                                            <td class="orders-order" width="25">
                                                <!-- {{ transaction.label }} -->
                                            </td>

                                            <td class="orders-amount" colspan="1">
                                                <div :class="'badge badge-'+getBadgeType( transaction.status )">
                                                    {{ transaction.status }}
                                                </div>
                                            </td>
                                            <td class="orders-vendor" colspan="1">
                                                {{ transaction.total }}
                                            </td>
                                            <td class="orders-order" colspan="2">
                                                {{ transaction.label }}
                                            </td>
                                            <td class="orders-date" colspan="1">
                                                <time :datetime="transaction.date">{{ getFormattedDate( transaction.date ) }}</time>
                                            </td>
                                            <td class="hidden orders-filter-date">

                                            </td>
                                            <td class="orders-type hidden">

                                            </td>
                                            <!-- <td class="text-right">
                                                <div class="dropdown">
                                                </div>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-header-title">Payment Information</h2>
                    <a href="#" class="text-right" data-toggle="modal" data-target="#billingModal" @click="selectModal('Edit Payment')">Edit</a>
                </div>
                <div class="card-body row" v-if="user.card_brand && user.card_last_four" style="min-height: 120px;">
                    <div class="col-md-4 col-sm-12 text-center">
                        <img :src="asset('/img/card-icons/'+user.card_brand+'.png')" width="100%" style="max-width: 75px; margin: auto;">
                    </div>
                    <div class="col-md-8 col-sm-12">
                        Card Brand: {{ user.card_brand.toUpperCase() }}<br>
                        Card Last Four: {{ user.card_last_four }}
                    </div>
                </div>
                <div class="card-body row" v-else>
                    <div class="col-md-4 col-sm-12">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#billingModal" @click="selectModal('Edit Payment')">Add Card</button>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        No Card on File
                    </div>
                </div>
            </div>

                <div class="card">
                <div class="card-header">
                    <h2 class="card-header-title">Billing Address</h2>
                    <a href="#" class="text-right" data-toggle="modal" data-target="#billingModal" @click="selectModal('Edit Address')">Edit</a>
                </div>
                <div class="card-body" v-if="user.address">
                    <img src="https://miro.medium.com/max/4064/1*qYUvh-EtES8dtgKiBRiLsA.png" width="100%"><br/>
                    <p class="mt-4">{{ user.address}}, {{ user.unit }}<br>
                    {{ user.city }}, {{ user.state }} {{ user.zip }}</p>
                </div>
                <div class="card-body" v-else>
                    <img src="https://miro.medium.com/max/4064/1*qYUvh-EtES8dtgKiBRiLsA.png" width="100%"><br/>
                    <p class="mt-4">No Address Provided</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="billingModal" tabindex="-1" role="dialog" aria-labelledby="billingModalLabel" aria-hidden="true" :key="modalKey">
        <div class="modal-dialog" role="document">
            <change-plan-component
                v-if="selectedModal == 'Change Plan'"
                :billing="{}"
                :user="user"
                :validations="$v.billing"
                @updateBilling="updateBilling( $event )"
            />

            <edit-payment-component
                v-if="selectedModal == 'Edit Payment'"
                :billing="{}"
                :intent="intent"
                :stripe-pk="stripePk"
                :validations="$v.billing"
                @updateCard="updateCard( $event )"
            />

            <edit-address-component
                v-if="selectedModal == 'Edit Address'"
                :billing="{}"
                :user="user"
                :validations="$v.billing"
                @updateAddress="updateAddress( $event )"
            />
        </div>
    </div>
</div>

</template>

<script>
    import { required, minLength, sameAs } from 'vuelidate/lib/validators'
    import EditAddressComponent from '../bill-components/EditAddressComponent'
    import BillingCallout from '../bill-components/BillingCalloutComponent'

    export default {
        props: ['user', 'stripePk', 'intent', 'modalKey'],
        components: {
            EditAddressComponent,
            BillingCallout
        },
        data() {
            return {
                dataUser: this.user,
                selectedModal: '',
            }
        },
        methods: {
            updateProfile() {
                this.$v.dataUser.$touch()
                if (!this.$v.$invalid) {
                    this.$emit('updateProfile', this.dataUser)
                }
            },
            saveChanges() {
                this.$v.billing.$touch()
                if (!this.$v.billing.$invalid) {
                    alert('invalid')
                }
            },
            selectModal( key ) {
                this.selectedModal = key
            },
            updateCard( user ) {
                this.$emit('updateCard', user)
            },
            updateBilling( user ) {
                this.$emit('updateBilling', user)
            },
            updateAddress( user ) {
                this.$emit('updateAddress', user)
            },
            getBadgeType( status ) {
                switch (status) {
                    case 'paid':
                        return 'success';
                    default:
                        return 'danger'
                }
            }
        },
        validations: {
            dataUser: {
                password: {
                    required
                },
                confirmPassword: {
                    required,
                    sameAsPassword: sameAs('password')
                }
            },
            billing: {
                address: {
                    required
                },
                unit: {
                },
                city: {
                    required
                },
                state: {
                    required
                },
                zip: {
                    required
                }
            }
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        transition: opacity .5s
    }
    tr {
        width: 100%;
        display: inline-table;
        table-layout: fixed;
        background: white;
    }

    tr th {
        background: white;
    }

    table {
        display: -moz-groupbox;
        max-height: 100%;
        overflow: hidden;
    }
    tbody::-webkit-scrollbar {
        width: 0px;  /* Remove scrollbar space */
        background: transparent;  /* Optional: just make scrollbar invisible */
        display: none;
    }
    tbody {
        overflow-y: scroll;
        width: 95%;
        position: absolute;
        height: 475px;
    }
    select, input {
        border-bottom: 0px;
         -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
        border-color:  #d2ddec
    }
    tr:hover select, tr:hover input {
        border-bottom: 1px solid #d2ddec;
    }

    .show-on-hover {
        display: none;
    }

    tr:hover .show-on-hover {
        display: inline-block;
    }

    .table-responsive {
        overflow: hidden;
        padding: 14px;
        height: 100%;
        min-height: 270px
    }
</style>
