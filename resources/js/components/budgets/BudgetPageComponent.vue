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

                            <div class="col-auto text-right row">
                                <form id="month-form" class="col-md-12 card mb-0" method="GET">
                                    <select name="month" v-model="dataMonth" class="form-control" @change="submitForm()">
                                        <option v-for="(month, index) in monthSelect" :key="index">{{ month }}</option>}
                                    </select>
                                </form>
                            </div>

                            <div class="col-auto text-right">
                                <div class="nav btn-group d-inline-flex" role="tablist" style="margin-right: 20px;">
                                    <button :class="'btn btn-white '+(selectedTab == 'table' ? 'active' : '')"  @click="selectTab('table')">
                                        <span class="fe fe-calendar"></span>
                                    </button>
                                    <!-- <button :class="'btn btn-white '+(selectedTab == 'tiles' ? 'active' : '')" @click="selectTab('tiles')">
                                        <span class="fe fe-grid"></span>
                                    </button> -->
                                    <button :class="'btn btn-white '+(selectedTab == 'annual' ? 'active' : '')" @click="selectTab('annual')">
                                        <span class="fe fe-list"></span>
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

                <budget-annual-component
                    :class="(selectedTab == 'annual' ? '' : 'hidden')"
                    :budgets="dataBudgets"
                    :computed-budgets="computedBudgets"
                    @saveBudget="saveBudget($event)"
                    @selectBudget="selectBudget($event)"
                    @editBudget="editBudget($event)"
                    @unselectBudget="unselectBudget($event)"
                    @deleteBudget="deleteBudget($event)"
                />

                <budget-tile-component
                    :class="(selectedTab == 'tiles' ? '' : 'hidden')"
                    :budgets="budgets"
                    @selectBudget="selectBudget($event)"
                    @deleteBudget="deleteBudget($event)"
                />

                <budget-table-component
                    :class="(selectedTab == 'table' ? '' : 'hidden')"
                    :budgets="budgets"
                    :computed-budgets="computedBudgets"
                    :categories="budgetCategories"
                    :totals="totals"
                    :month="month"
                    :selectedBudget="selectedBudget"
                    @saveBudget="saveBudget($event)"
                    @selectBudget="selectBudget($event)"
                    @editBudget="editBudget($event)"
                    @unselectBudget="unselectBudget($event)"
                    @deleteBudget="deleteBudget($event)"
                />

                <new-budget-component
                    :key="modalKey"
                    :budget="selectedBudget"
                    :accounts="accounts"
                    :categories="budgetCategories"
                    :computed-budgets="computedBudgets"
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
    import BudgetAnnualComponent from './components/BudgetAnnualComponent'

    export default {
        props: ['user', 'budgets', 'accounts', 'totals', 'month', 'previousMonth', 'nextMonth'],
        data() {
            return {
                modalKey: 0,
                selectedBudget: {},
                selectedTab: 'table',
                dataBudgets: this.budgets,
                dataMonth: this.month,
            }
        },
        components: {
            BudgetTileComponent,
            NewBudgetComponent,
            BudgetBreakdownComponent,
            BudgetTableComponent,
            BudgetAnnualComponent
        },
        methods: {
            selectBudget( budget ) {
                this.modalKey++;
                console.log(this.selectedBudget)
                this.selectedBudget = budget;
            },
            editBudget ( budget ) {
                this.modalKey++;
                this.selectedBudget = budget
                console.log('edit')
                setTimeout( function() {
                    $('#budgetModal').modal('show')
                }, 200)
            },
            unselectBudget() {
                this.selectedBudget = {};
            },
            selectTab( tab ) {
                this.selectedTab = tab;
            },
            saveBudget( budget ) {
                console.log( budget )
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
            },
            submitForm() {
                $('#month-form').trigger('submit');
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
            },
            computedBudgets() {
                // todo: map budgets by main category and have subcategory budgets underneath
                var mappedBudgets = {};
                this.dataBudgets.forEach( function( budget ) {
                    if (!mappedBudgets[budget.category]) {
                        mappedBudgets[budget.category] = {
                            monthly_amount: 0,
                            annual_amount: 0,
                            budgets: []
                        };
                    }

                    mappedBudgets[budget.category].monthly_amount += budget.monthly_amount
                    mappedBudgets[budget.category].annual_amount += budget.annual_amount
                    mappedBudgets[budget.category].budgets.push(budget)
                })

                return mappedBudgets;
            },
            monthSelect() {
                var date = new Date( this.user.created_at )
                var now = new Date();
                var months = []

                while (date < now ) {
                    months.push( date.toLocaleString('default', { month: 'long' }) +', '+date.getFullYear() )
                    date.setMonth(date.getMonth() + 1 );
                }
                months.reverse()
                return months;
            }
        },
        mounted() {
            var self = this;
            this.budgets.forEach( function(budget, index) {
                console.log(budget.monthly_budgets)
                if ( !budget.monthly_budgets || Array.isArray( budget.monthly_budgets ) && budget.monthly_budgets.length < 1) {
                    let newBudget = budget;
                    newBudget.monthly_budgets = {};
                    var i = 1;
                    while (i <= 12) {
                        let index = (i).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false})
                        newBudget.monthly_budgets[index] = newBudget.timeframe == 0 ? newBudget.amount : newBudget.amount / 12;
                        i++;
                    }
                    self.$set(self.budgets, index, newBudget)
                }
            })
        }
    }
</script>
