<template>
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
                <option value="0">Expense</option>
                <option value="1">Income</option>
                <option value="2">Transfer</option>
                <option value="3">Fee</option>
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
                        :class="'form-control '+($v.transaction.vendor.$error ? 'is-invalid ' : '')" id="vendorInput" placeholder="Target" @change="checkForRule()">
        </div>

        <div class="form-group">
            <label for="vendorInput">Transaction Date</label>
            <input v-model="transaction.date" type="date"
                        :class="'form-control '+($v.transaction.date.$error ? 'is-invalid ' : '')" id="dateInput" placeholder="">
        </div>

        <div class="form-group" v-if="transaction.type != 1 && transaction.type != 2 && transaction.type != 3">
            <label for="categorySelect">Category</label>
            <select v-model="transaction.category"
                        :class="'form-control '+($v.transaction.category.$error ? 'is-invalid ' : '')"
                        id="categorySelect" name="category">
                <option value="undefined" selected disabled>Select a Category</option>
                <option v-for="(category, key) in $transactionCategories" :key="key" :value="key"> {{ category }}</option>
            </select>
        </div>

        <div class="form-group" v-if="transaction.type != 1 && transaction.type != 2 && transaction.type != 3 && transaction.category">
            <label for="categorySelect">Sub Category</label>
            <select v-model="transaction.sub_category"
                        :class="'form-control '+($v.transaction.sub_category.$error ? 'is-invalid ' : '')"
                        @change="unsetSubCategory()"
                        id="categorySelect" name="category">
                <option value="undefined" selected disabled>Select a Category</option>
                <option v-for="(category) in subCategories" :key="category" :value="category"> {{ category }}</option>
            </select>
        </div>

        <div class="custom-control custom-checkbox form-group mt-5 mb-0" v-if="transaction.vendor && transaction.category" @change="checkForRule()">
            <input v-model="transaction.create_rule" class="custom-control-input" id="checklistOne" type="checkbox" />
            <label class="custom-control-label" for="checklistOne"></label>
            <span class="custom-control-caption">
                Categorize all transactions from {{ transaction.vendor }} as {{ transaction.category }}
            </span>
        </div>

        <div class="custom-control form-group mt-3 mb-0 text-muted" v-if="rule != null">
            <span class="custom-control-caption">
                The existing rule for {{ transaction.vendor }} will be overwritten
            </span>
        </div>

        <div class="custom-control custom-checkbox form-group mt-5 mb-0">
            <input v-model="transaction.exclude" class="custom-control-input" id="checklistTwo" type="checkbox" />
            <label class="custom-control-label" for="checklistTwo"></label>
            <span class="custom-control-caption">
                Exclude from Calculations
            </span>
        </div>
    </form>
</template>

<script>
import { required, minLength, requiredIf } from 'vuelidate/lib/validators'

export default {
  name: 'new-transaction-model',
  props: [
      'accounts',
      'transaction',
      'rules'
  ],
  data() {
      return {
            rule: null
      }
  },
  methods: {
      saveTransaction() {
        this.$v.transaction.$touch()
        if (!this.$v.$invalid) {
            this.$emit('saveTransaction', this.transaction)
        }
      },
    checkForRule() {
        if ( !this.transaction.create_rule ) {
            return this.rule = null;
        }
        console.log(this.rules)
        console.log(this.transaction.vendor)
        let index = this.rules.map(function (x) { return x.vendor.toLowerCase(); }).indexOf(this.transaction.vendor.toLowerCase());
        console.log( index )
        if (index < 0) {
            return this.rule = null;
        }
        this.rule = this.rules[index]
      },
        unsetSubCategory() {
          this.transaction.sub_category = 'undefined';
      }
  },
  computed: {
      subCategories() {
        if (this.transaction.category) {
            return this.$transactionSubCategoriesMapped[this.transaction.category]
        } else {
            return this.$transactionSubCategories;
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
            required: requiredIf(function() {
                return this.transaction.type == 0;
            })
        },
        sub_category: {
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
  },
  mounted() {
      this.checkForRule()
  }
};
</script>
