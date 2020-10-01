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
                <div class="form-group">
                    <label for="vendorInput">Name</label>
                    <input v-model="budget.name" type="text"
                                :class="'form-control '+($v.budget.name.$error ? 'is-invalid ' : '')" id="nameInput" placeholder="Groceries Budget">
                </div>

                <div class="form-group">
                    <label for="accountSelect">Account</label>
                    <select v-model="budget.account_id" :class="'form-control '+($v.budget.account_id.$error ? 'is-invalid ' : '')" id="accountSelect">
                        <option value="undefined" selected disabled>Select an Account</option>
                        <option value="0" selected>All Accounts</option>
                        <option v-for="( account ) in accounts" :key="account.id" :value="account.id">{{ account.name }}</option>
                    </select>
                </div>

                  <div class="form-group" v-if="budget.type != 1">
                    <label for="categorySelect">Category</label>
                    <select v-model="budget.category"
                                :class="'form-control '+($v.budget.category.$error ? 'is-invalid ' : '')"
                                id="categorySelect" name="category">
                        <option value="undefined" selected disabled>Select a Category</option>
                        <option v-for="(category, key) in $transactionCategories" :key="key" :value="key"> {{ category }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amountInput">Monthly Budget</label>
                    <input v-model="budget.amount" type="text"
                                :class="'form-control '+($v.budget.amount.$error ? 'is-invalid ' : '')" id="amountInput" placeholder="$250.00">
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
      'budget'
  ],
  data() {
      return {
        //   budget: {}
      }
  },
  methods: {
      saveBudget() {
        this.$v.budget.$touch()
        if (!this.$v.$invalid) {
            this.$emit('saveBudget', this.budget)
            $('#budgetModal').modal('hide')
        }
      }
  },
  validations: {
      budget: {
        account_id: {
            required
        },
        name: {
            required
        },
        category: {
            required: requiredIf(function() {
                return this.budget.type != 1;
            })
        },
        amount: {
            required
        },
      }
  },
  mounted() {
  }
};
</script>
