<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="budgetModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="budgetModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="budgetModalLabel">Add Budget</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
                <!-- <div class="form-group">
                    <label for="vendorInput">Name</label>
                    <input v-model="budget.name" type="text"
                                :class="'form-control '+($v.budget.name.$error ? 'is-invalid ' : '')" id="nameInput" placeholder="Groceries Budget">
                </div> -->

                <div class="form-group">
                    <label for="accountSelect">Account</label>
                    <select v-model="budget.account_id" :class="'form-control '+($v.budget.account_id.$error ? 'is-invalid ' : '')" id="accountSelect">
                        <option value="undefined" selected disabled>Select an Account</option>
                        <option value="0" selected>All Accounts</option>
                        <option v-for="( account ) in accounts" :key="account.id" :value="account.id">{{ account.name }}</option>
                    </select>
                </div>

                  <div class="form-group">
                    <label for="categorySelect">Category</label>
                    <select v-model="budget.category"
                                :class="'form-control '+($v.budget.category.$error ? 'is-invalid ' : '')"
                                @change="unsetSubCategory()"
                                id="categorySelect" name="category">
                        <option value="undefined" selected disabled>Select a Category</option>
                        <option v-for="(category, key) in computedCategories" :key="key" :value="category"> {{ category }}</option>
                    </select>
                </div>

                <div class="form-group" v-if="budget.category" :key="budget.id">
                    <label for="categorySelect">Sub Category</label>
                    <select v-model="budget.sub_category"
                                :class="'form-control '+($v.budget.sub_category.$error ? 'is-invalid ' : '')"
                                id="categorySelect" name="category">
                        <option value="undefined" selected v-if="!budget.id">All Sub Categories</option>
                        <option :value="null" selected v-if="budget.id">All Sub Categories</option>
                        <option v-for="(category, key) in computedSubCategories" :key="key" :value="category"> {{ category }}</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light" v-if="this.budget.id && (this.timeframe != this.budget.timeframe || this.amount != this.budget.amount)">
                            Editing the timeframe or budgeted amount will reset the individual monthly budgets.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amountInput">Budgeted Amount</label>
                            <input v-model="budget.amount" type="text"
                                        :class="'form-control '+($v.budget.amount.$error ? 'is-invalid ' : '')" id="amountInput" placeholder="$250.00">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categorySelect">Timeframe</label>
                            <select v-model="budget.timeframe"
                                        :class="'form-control '+($v.budget.category.$error ? 'is-invalid ' : '')"
                                        id="categorySelect" name="timeframe">
                                <option value="undefined" disabled>Select a Timeframe</option>
                                <option value="0" selected>Monthly</option>
                                <option value="1">Annually</option>
                            </select>
                        </div>
                    </div>
                </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            <button @click="saveBudget()" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength, requiredIf } from 'vuelidate/lib/validators'

export default {
  name: 'new-budget-model',
  props: [
      'accounts',
      'budget',
      'computedBudgets',
      'categories'
  ],
  data() {
      return {
        //   budget: {}
        timeframe: this.budget.timeframe,
        amount: this.budget.amount,
      }
  },
  methods: {
      saveBudget() {
        this.$v.budget.$touch()
        if (!this.$v.$invalid) {
            this.$emit('saveBudget', this.budget)
            $('#budgetModal').modal('hide')
        }
      },
      unsetSubCategory() {
          this.budget.sub_category = 'undefined';
      }
  },
  computed: {
      computedCategories() {
          if (!this.budget.id) {
            //   return this.categories
              return this.$transactionCategories
          } else {
              return this.$transactionCategories
          }
      },
      computedSubCategories() {
          console.log( 'computed' )
          console.log( this.budget )
          var categories = [];
          var selectedCategories = [];
          var self = this

          if ( this.budget.category ) {
              categories = this.$transactionSubCategoriesMapped[this.budget.category]
          }

        if ( this.computedBudgets[this.budget.category] ) {
            this.computedBudgets[this.budget.category].budgets.forEach( function( mappedBudget ) {
                if (mappedBudget.id != self.budget.id) {
                    selectedCategories.push(mappedBudget.sub_category);
                }
            })
        }

        for (const [key, value] of Object.entries(categories)) {
            if ( selectedCategories.includes( value ) && this.budget.sub_category != value ) {
                // delete categories[key]
            }
        }

        if ( selectedCategories.includes( null ) ) {
            return [];
        }

        return categories;
      }
  },
  validations: {
      budget: {
        account_id: {
            required
        },
        category: {
            required: requiredIf(function() {
                return this.budget.type != 1;
            })
        },
        sub_category: {

        },
        timeframe: {
            required
        },
        amount: {
            required
        },
      }
  },
  mounted() {
      console.log('mounted')
  }
};
</script>
