<template>
    <div class="tab-pane fade show active mb-5" id="wizardStepTwo" role="tabpanel" aria-labelledby="wizardTabTwo">

        <!-- Header -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 text-center">

                <!-- Pretitle -->
                <h6 class="mb-4 text-uppercase text-muted">
                    Step 4 of 5
                </h6>

                <!-- Title -->
                <h1 class="mb-3">
                    Let's set up some budgets.
                </h1>

                <!-- Subtitle -->
                <p class="mb-5 text-muted">
                    Budgets help us get an idea of your overall financial health.
                </p>

            </div>

            <!-- Table View where user can add budgets, select the category from a dropdown, and input the amount -->
              <div class="col-12">
                <div class="table-responsive">
                    <table id="budgets-table" class="table table-hover table-sm table-nowrap card-table">
                        <thead>
                            <tr>
                            <!-- <th>
                                <a href="#" class="text-muted sort" data-sort="orders-order">
                                    #
                                </a>
                            </th> -->
                            <th style="width: 40%">
                                <a href="#" class="text-muted sort" data-sort="orders-category">
                                Category
                                </a>
                            </th>
                            <th style="width: 40%">
                                <a href="#" class="text-muted sort" data-sort="orders-amount">
                                Amount
                                </a>
                            </th>
                            <th style="width: 20%">
                                <a @click="addBudget()" class="btn btn-sm btn-primary pull-right" href="#">Add Budget</a>
                            </th>
                            </tr>
                        </thead>
                        <tbody class="list" :key="budgets.length">
                            <tr v-for="(budget, index ) in budgets" :key="index">
                            <td class="orders-category">
                                <select class="form-control" name="category" v-model="budget.category" style="background-color: transparent;">
                                    <option v-for="(category, key) in $transactionCategories" :key="key" :value="key"> {{ category }}</option>
                                </select>
                            </td>
                            <td class="orders-amount">
                                <input type="text" class="form-control" style="background-color: transparent;" v-model="budget.amount">
                            </td>
                            <td class="pull-right text-right">
                                <a @click="deleteBudget( index )" href="#">X</a>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-auto text-right">
            </div>
        </div> <!-- / .row -->
    </div>
</template>

<script>
    import BankCard from '../../accounts/step-cards/BankCard'
    import CredentialsCard from '../../accounts/step-cards/CredentialsCard'
    import SettingsCard from '../../accounts/step-cards/SettingsCard'

    export default {
        props: ['account', 'budgets', 'errors'],
        data() {

        },
        methods: {
            addBudget() {
                this.budgets.push({
                    'category': '',
                    'amount': ''
                })
            },
            deleteBudget( index ) {
                this.$delete(this.budgets, index)
            }
        },
        mounted() {
            if (!this.budgets) {
                this.addBudget()
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
    }

    table {
        height: 350px;
        display: -moz-groupbox;
    }
    tbody {
        overflow-y: scroll;
        height: 300px;
        width: 97%;
        position: absolute;
    }
</style>

