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
                                    Budgets / All
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title">
                                    Budgets
                                </h1>
                            </div>

                            <div class="col text-right">
                                <div class="nav btn-group d-inline-flex" role="tablist" style="margin-right: 20px;">
                                    <button :class="'btn btn-white '+(selectedTab == 'table' ? 'active' : '')"  @click="selectTab('table')">
                                        <span class="fe fe-list"></span>
                                    </button>
                                    <button :class="'btn btn-white '+(selectedTab == 'tiles' ? 'active' : '')" @click="selectTab('tiles')">
                                        <span class="fe fe-grid"></span>
                                    </button>
                                </div>

                                <button
                                    @click="unselectBudget()"
                                    type="button"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#budgetModal"
                                    :disabled="accounts.length < 1 ? true : false"
                                    >New Budget
                                </button>

                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div>

                <budget-tile-component
                    :class="(selectedTab == 'tiles' ? '' : 'hidden')"
                    :budgets="budgets"
                    @selectBudget="selectBudget($event)"
                    @deleteBudget="deleteBudget($event)"
                />

                <budget-table-component
                    :class="(selectedTab == 'table' ? '' : 'hidden')"
                    :budgets="budgets"
                    :categories="budgetCategories"
                    :totals="totals"
                    :selectedBudget="selectedBudget"
                    @saveBudget="saveBudget($event)"
                    @selectBudget="selectBudget($event)"
                    @unselectBudget="unselectBudget($event)"
                    @deleteBudget="deleteBudget($event)"
                />

                <new-budget-component
                    :key="modalKey"
                    :budget="selectedBudget"
                    :accounts="accounts"
                    :categories="budgetCategories"
                    @saveBudget="saveBudget($event)"
                    @deleteBudget="deleteBudget($event)"
                  />
            </div>
        </div>
    </div>
</template>

<script>
    import BudgetTileComponent from './components/BudgetTileComponent'
    import NewBudgetComponent from './components/NewBudgetComponent'
    import BudgetBreakdownComponent from './components/BudgetBreakdownComponent'
    import BudgetTableComponent from './components/BudgetTableComponent'

    export default {
        props: ['user', 'budgets', 'accounts', 'totals'],
        data() {
            return {
                modalKey: 0,
                selectedBudget: {},
                selectedTab: 'table'
            }
        },
        components: {
            BudgetTileComponent,
            NewBudgetComponent,
            BudgetBreakdownComponent,
            BudgetTableComponent
        },
        methods: {
            selectBudget( budget ) {
                console.log(this.selectedBudget)
                this.selectedBudget = budget;
            },
            editBudget ( budget ) {
                this.selectedBudget = budget
            },
            unselectBudget() {
                this.selectedBudget = {};
            },
            selectTab( tab ) {
                this.selectedTab = tab;
            },
            saveBudget( budget ) {
                console.log('save')
                var self = this;
                let url = '/budgets' + ( budget.id ? '/'+budget.id : '')
                let method = budget.id ? 'PUT' : 'POST'
                this.asyncSendData(budget, url, method).then( function( response ) {
                    if (!budget.id) {
                        self.$set(self.budgets, self.budgets.length, response)
                        self.showNotification('success', 'Budget Created Successfully!')
                    } else {
                        let index = self.budgets.map(function (x) { return x.id; }).indexOf(response.id);
                        self.$set(self.budgets, index, response)
                        if (response.id == self.selectedBudget.id) {
                            self.$set(self.selectedBudget, response)
                            self.selectedBudget = response;
                        }
                        self.showNotification('success', 'Budget Updated Successfully!')
                    }
                    self.modalKey += 1;
                })
            },
            deleteBudget( budget ) {
                var self = this;
                this.asyncSendData(budget, '/budgets/'+budget.id, 'DELETE').then( function( response ) {
                    let index = self.budgets.map(function (x) { return x.id; }).indexOf(budget.id);
                    self.$delete(self.budgets, index)
                    self.showNotification('success', 'Budget Successfully Removed!')
                })
            }
        },
        computed: {
            budgetCategories() {
                var categories = Object.values(this.$transactionCategories)
                this.budgets.forEach( function( budget ) {
                    let index = categories.map( function(category) { return category }).indexOf( budget.category )
                    if (index !== -1) {
                        categories.splice( index, 1 )
                    }
                })
                return categories
            }
        }
    }
</script>
