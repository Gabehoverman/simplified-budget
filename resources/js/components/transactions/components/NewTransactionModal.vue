<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-sm btn-primary"
      data-toggle="modal"
      data-target="#newTransactionModal"
      :disabled="accounts.length < 1 ? true : false"
    >Add Transaction</button>
    <!-- Modal -->
    <div
      class="modal fade"
      id="newTransactionModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="newTransactionModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="newTransactionModalLabel">Add Transaction</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form>
                <div class="form-group">
                    <label for="accountSelect">Account</label>
                    <select v-model="transaction.account_id" :class="'form-control '+($v.transaction.account_id.$error ? 'is-invalid ' : '')" id="accountSelect">
                        <option value="undefined" selected disabled>Select an Account</option>
                        <option v-for="( account ) in accounts" :key="account.id" :value="account.id">{{ account.name }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="transactionTypeSelect">Transaction Type</label>
                    <select v-model="transaction.type"
                                :class="'form-control '+($v.transaction.type.$error ? 'is-invalid ' : '')" id="transactionTypeSelect">
                        <option value="undefined" selected disabled>Select a Type</option>
                        <option value="1">Income</option>
                        <option value="0">Expense</option>
                    </select>
                </div>

                  <div class="form-group">
                    <label for="categorySelect">Category</label>
                    <select v-model="transaction.category"
                                :class="'form-control '+($v.transaction.category.$error ? 'is-invalid ' : '')"
                                id="categorySelect" name="category">
                        <option value="undefined" selected disabled>Select a Category</option>
                        <option value="shopping">Shopping</option>
                        <option value="dining">Dining</option>
                        <option value="utilities">Utilities</option>
                        <option value="subscriptions">Subscriptions</option>
                        <option value="housing">Rent / Mortgage</option>
                        <option value="misc">Misc</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amountInput">Amount</label>
                    <input v-model="transaction.amount" type="text"
                                :class="'form-control '+($v.transaction.amount.$error ? 'is-invalid ' : '')" id="amountInput" placeholder="$12.34">
                </div>

                <div class="form-group">
                    <label for="vendorInput">Vendor</label>
                    <input v-model="transaction.vendor" type="text"
                                :class="'form-control '+($v.transaction.vendor.$error ? 'is-invalid ' : '')" id="vendorInput" placeholder="Target">
                </div>

                <div class="form-group">
                    <label for="vendorInput">Transaction Date</label>
                    <input v-model="transaction.date" type="date"
                                :class="'form-control '+($v.transaction.date.$error ? 'is-invalid ' : '')" id="dateInput" placeholder="">
                </div>
            </form>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button @click="saveTransaction()" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength } from 'vuelidate/lib/validators'

export default {
  name: 'new-transaction-model',
  props: [
      'accounts'
  ],
  data() {
      return {
          transaction: {}
      }
  },
  methods: {
      saveTransaction() {
        this.$v.transaction.$touch()
        if (!this.$v.$invalid) {
            this.$emit('saveTransaction', this.transaction)
            $('#newTransactionModal').modal('toggle')
            $('.modal-backdrop').remove();
        }
      }
  },
  validations: {
      transaction: {
        account_id: {
            required
        },
        type: {
            required
        },
        vendor: {
            required
        },
        category: {
            required
        },
        type: {
            required
        },
        amount: {
            required
        },
        date: {
            required
        }
      }
  }
};
</script>
