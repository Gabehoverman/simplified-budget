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
                                    Future Cast / Projections
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title">
                                    What If
                                </h1>
                            </div>

                            <div class="col text-right">
                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div>

                <div class="card" v-if="moneySavers.length < 1">
                    <div class="card-body row">

                        <div class="col-md-12 row">
                            <label class="col-md-2">What if I...</label>
                            <select class="form-control col-md-10" v-model="projectionData.type">
                                <option value="0">Select an Option</option>
                                <option value="income">Changed My Income</option>
                                <!-- <option value="spending">Changed My Spending Habits</option> -->
                                <option value="account">Paid down a Debt</option>
                                <option value="debt">Added a Debt</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="row">

                <income-form
                    v-if="projectionData.type == 'income'"
                    :user="user"
                    :projection-data="projectionData"
                    :projection-results="projectionResults"
                    @calculate="calculate()"
                />

                <account-form
                    v-if="projectionData.type == 'account'"
                    :projection-data="projectionData"
                    :projection-results="projectionResults"
                    :accounts="accounts"
                    @calculate="calculate()"
                />

                <debt-form
                    v-if="projectionData.type == 'debt'"
                    :projection-data="projectionData"
                    :projection-results="projectionResults"
                    @calculate="calculate()"
                />

                <spending-form
                    v-if="projectionData.type == 'spending'"
                    :projection-data="projectionData"
                    :projection-results="projectionResults"
                    @calculate="calculate()"
                />

                <!-- Calc Card -->

                 <account-card
                    v-if="projectionData.type == 'account' && projectionResults.timeframe_one"
                    :projection-data="projectionData"
                    :projection-results="projectionResults"
                 />

                 <debt-card
                    v-if="projectionData.type == 'debt' && projectionResults.monthly_debt"
                    :projection-data="projectionData"
                    :projection-results="projectionResults"
                 />

                <income-card
                    v-if="projectionData.type == 'income' && projectionResults.monthly_income"
                    :projection-data="projectionData"
                    :projection-results="projectionResults"
                 />

                 <spending-card
                    v-if="projectionData.type == 'spending' && projectionResults.monthly_spending"
                    :projection-data="projectionData"
                    :projection-results="projectionResults"
                 />
                 </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AccountCard from './cards/AccountCard'
    import DebtCard from './cards/DebtCard'
    import IncomeCard from './cards/IncomeCard'
    import SpendingCard from './cards/SpendingCard'

    import AccountForm from './forms/AccountForm';
    import DebtForm from './forms/DebtForm';
    import IncomeForm from './forms/IncomeForm';
    import SpendingForm from './forms/SpendingForm';

    export default {
        props: ['user', 'moneySavers', 'accounts', 'totals'],
        data() {
            return {
                modalKey: 0,
                projectionType: 0,
                projectionData: {
                    'income_amount': this.user.income
                },
                projectionResults: {},
                selectedMoneySaver: this.moneySavers.length > 0 ? this.moneySavers[0] : [],
                selectedTab: 'tiles',
            }
        },
        components: {
            AccountCard,
            DebtCard,
            IncomeCard,
            SpendingCard,

            AccountForm,
            DebtForm,
            IncomeForm,
            SpendingForm
        },
        methods: {
            calculate() {
                event.preventDefault()
                var self = this;
                this.asyncSendData(this.projectionData, '/what-if' ,'POST').then( function( response ) {
                    self.projectionResults = response;
                    console.log( self.projectionResults )
                })
            },
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
