<template>
    <div class="container-fluid ">
    <notifications group="notification"/>

        <div class="row justify-content">
            <div class="col-12 col-lg-12 col-xl-12">

                <!-- Header -->
                <div class="header mt-md-5">
                    <div class="">
                        <div class="row align-items-center mb-md-5">
                            <div class="col">

                                <!-- Pretitle -->
                                <h6 class="header-pretitle">
                                    Money Savers / All
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title">
                                    Money Savers
                                </h1>
                            </div>

                            <div class="col text-right">
                            <!-- <div class="nav btn-group d-inline-flex" role="tablist" style="margin-right: 20px;">
                                    <button :class="'btn btn-white '+(selectedTab == 'table' ? 'active' : '')"  @click="selectTab('table')">
                                        <span class="fe fe-calendar"></span>
                                    </button>
                                    <button :class="'btn btn-white '+(selectedTab == 'tiles' ? 'active' : '')" @click="selectTab('tiles')">
                                        <span class="fe fe-grid"></span>
                                    </button>
                                      <button :class="'btn btn-white '+(selectedTab == 'annual' ? 'active' : '')" @click="selectTab('annual')">
                                        <span class="fe fe-list"></span>
                                    </button>
                                </div> -->

                                <!-- <button
                                    @click="unselectMoneySaver()"
                                    type="button"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#moneySaverModal"
                                    :disabled="accounts.length < 1 ? true : false"
                                    >New MoneySaver
                                </button> -->
                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div>

                <money-savers-tile-component
                    :class="(selectedTab == 'tiles' ? '' : 'hidden')"
                    :money-savers="moneySavers"
                    @selectMoneySaver="selectMoneySaver($event)"
                    @deleteMoneySaver="deleteMoneySaver($event)"
                />

                <money-savers-modal
                    :class="(selectedTab == 'tiles' ? '' : 'hidden')"
                    :money-saver="selectedMoneySaver"
                    @selectMoneySaver="selectMoneySaver($event)"
                    @deleteMoneySaver="deleteMoneySaver($event)"
                />

            </div>
        </div>
    </div>
</template>

<script>
    import MoneySaversTileComponent from './components/MoneySaversTileComponent'
    import MoneySaversModal from './components/MoneySaversModal'

    export default {
        props: ['user', 'moneySavers', 'accounts', 'totals'],
        data() {
            return {
                modalKey: 0,
                selectedMoneySaver: this.moneySavers.length > 0 ? this.moneySavers[0] : [],
                selectedTab: 'tiles',
            }
        },
        components: {
            MoneySaversTileComponent,
            MoneySaversModal
        },
        methods: {
            selectMoneySaver( moneySaver ) {
                console.log(this.selectedMoneySaver)
                this.selectedMoneySaver = moneySaver;
            }
        },
        computed: {
            moneySaverCategories() {
                var categories = Object.values(this.$transactionCategories)
                this.moneySavers.forEach( function( moneySaver ) {
                    let index = categories.map( function(category) { return category }).indexOf( moneySaver.category )
                    if (index !== -1) {
                        categories.splice( index, 1 )
                    }
                })
                return categories
            }
        },
        mounted() {
            var self = this;
        }
    }
</script>
