<template>
    <form>
        <div class="row">

            <div class="form-group col-md-4">
                <label for="accountSelect">Account</label>
                <p><b>{{ transaction.account.name }}</b></p>
            </div>

            <div class="form-group col-md-4">
                <label for="transactionTypeSelect">Transaction Type</label>
                <p><b>{{ getTransactionType(transaction.type) }}</b></p>
            </div>

            <div class="form-group col-md-4">
                <label for="amountInput">Amount</label>
                <br/>
                <p><b>${{ transaction.amount }}</b></p>
            </div>

            <div class="form-group col-md-4">
                <label for="vendorInput">Vendor</label>
                <p><b>{{ transaction.vendor }}</b></p>
            </div>

            <div class="form-group col-md-4">
                <label for="vendorInput">Transaction Date</label>
                <p><b>{{ getMonthDayYear( transaction.date ) }}</b></p>
            </div>

            <div class="col-md-4">
                <label>&nbsp;</label>
                <p>
                    <a href="#"  class="" @click="changeModal( 'full' )">
                        Edit Details
                    </a>
                </p>
            </div>
            <hr class="divider col-md-11 mt-0">
        </div>

            <div class="form-group">
            <label for="categorySelect">Category</label>
            <select v-model="transaction.category"
                        :class="'form-control '+($v.transaction.category.$error ? 'is-invalid ' : '')"
                        id="categorySelect" name="category">
                <option value="undefined" selected disabled>Select a Category</option>
                <option v-for="(category, key) in $transactionCategories" :key="key" :value="key">{{ category }}</option>
            </select>
        </div>

        <div class="custom-control custom-checkbox form-group mt-5 mb-0">
            <input v-model="transaction.create_rule" class="custom-control-input" id="checklistOne" type="checkbox" @change="checkForRule()" />
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
      changeModal() {
         this.$emit('changeModal', 'full')
      },
      checkForRule() {
            if ( !this.transaction.create_rule ) {
                return this.rule = null;
            }

            let index = this.rules.map(function (x) { return x.vendor.toLowerCase(); }).indexOf(this.transaction.vendor.toLowerCase());

            if (index < 0) {
                return this.rule = null;
            }
            return this.rule = this.rules[index]
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
