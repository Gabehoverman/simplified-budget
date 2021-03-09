<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="moneySaverTypeModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="moneySaverTypeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document" style="max-width: none; width: 800px;">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="moneySaverTypeModalLabel">Add Money Saver Type</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="row">
                <div class="col-md-6" style="border-right: 1px solid #efefef">
                    <p><b>Features</b> </p>

                    <div class="form-group">
                        <label for="vendorInput">Name</label>
                        <input v-model="moneySaverType.name" type="text"
                                    :class="'form-control '+($v.moneySaverType.name.$error ? 'is-invalid ' : '')" id="fieldInput" placeholder="Name">
                    </div>


                    <div class="form-group">
                        <label for="vendorInput">Account Type</label>
                        <select class="form-control" v-model="moneySaverType.account_type">
                            <option value="0">Checking</option>
                            <option value="1">Savings</option>
                            <option value="2">Credit</option>
                            <option value="3">Loan</option>
                            <option value="4">Mortgage</option>
                            <option value="5">Investment</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <p>Active</p>
                        </div>

                        <div class="custom-control custom-control-circle custom-checkbox col-md-6 text-right">
                            <input
                                v-model="moneySaverType.status"
                                type="checkbox"
                                class="list-checkbox custom-control-input"
                                :id="'moneySaverTypeActive' + moneySaverType.id"
                            />
                            <label class="custom-control-label" :for="'moneySaverTypeActive' + moneySaverType.id"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" :key="moneySaveDetailsKey">
                    <p><b>Fields</b></p>
                    <div class="form-group" v-for="( feature, index ) in moneySaverType.features" :key="index">
                        <input v-model="feature.label" type="text"
                                    style="width: 40%; display: inline"
                                    class="form-control" id="nameInput" placeholder="Label">

                        <select class="form-control" name="compare-to" style="width: 40%; display: inline; margin-left: 5%;" v-model="feature.compare_to">
                            <option :value="undefined">Compare To</option>
                            <option value="apr">APR</option>
                            <option value="minimum_payment">Minimum Payment</option>
                        </select>
                        <a href="#" @click="removeField( index )" style="float: right; padding-top: 15px;">X</a>
                    </div>
                    <a href="#" class="btn btn-primary" @click="addFeature">Add Feature</a>
                </div>
                <br>
                <div class="col-md-12 mt-4 pt-4" style="border-top: 1px solid #efefef" :key="moneySaverRulesKey">
                    <p><b>Rules</b></p>

                    <div class="form-group row" v-for="( rule, index ) in moneySaverType.rules" :key="index">
                        <div class="col-md-2">
                            <select v-model="rule.type" type="text" class="form-control" id="nameInput" @change="updateJSON">
                               <option value="CMP">Scoped</option>
                                <option value="CST">Global</option>
                                <!-- <option value="CNT">Contains</option> -->
                            </select>
                        </div>

                         <div class="col-md-3">
                            <select v-model="rule.model" type="text" class="form-control" id="nameInput" @change="updateJSON">
                               <option value="Account">Account</option>
                                <option value="Budgets\Budget">Budget</option>
                                <option value="Transactions\Transaction">Transaction</option>
                                <option v-if="rule.type != 'CMP'" value="User">User</option>
                            </select>
                        </div>

                         <div class="col-md-2">
                            <select v-model="rule.field" type="text" class="form-control" id="nameInput" :key="rule.model" @change="updateJSON">
                                <option value="balance" v-if="rule.model == 'Account' ">Balance</option>
                                <!-- <option value="interest" v-if="rule.model == 'Account' ">Interest</option> -->
                                <option value="type" v-if="rule.model == 'Account' && rule.type != 'CMP'">Type</option>
                                <option value="name" v-if="rule.model == 'Account' ">Name</option>
                                <option value="institution_id" v-if="rule.model == 'Account' && rule.type != 'CMP'">Institution</option>

                                <option value="category" v-if="rule.model == 'Budgets\\Budget' || rule.model == 'Transactions\\Transaction' ">Category</option>
                                <option value="amount" v-if="rule.model == 'Budgets\\Budget' ">Amount</option>

                                <option value="plan" v-if="rule.model == 'User'">Plan</option>
                                <option value="income" v-if="rule.model == 'User' ">Income</option>
                                <option value="pay" v-if="rule.model == 'User' ">Monthly Pay</option>

                            </select>
                        </div>

                        <div class="col-md-2">
                             <select class="form-control" v-model="rule.comparison" @change="updateJSON">
                                 <option v-if="getClassifier( '<', rule.field )" value="<">Less Than</option>
                                 <option v-if="getClassifier( '<=', rule.field )"  value="<=">Less Than or Equal To</option>
                                 <option v-if="getClassifier( '=', rule.field )"  value="=">Equals</option>
                                 <option v-if="getClassifier( '!=', rule.field )"  value="!=">Does Not Equal</option>
                                 <option v-if="getClassifier( '<=', rule.field )"  value=">=">Greater Than or Equal To</option>
                                 <option v-if="getClassifier( '>', rule.field )"  value=">">Greater Than</option>
                             </select>
                        </div>

                        <div class="col-md-2">

                            <select v-if="rule.field == 'institution_id'" class="form-control" v-model="rule.feature" @change="updateJSON">
                                 <option v-for="( institution ) in institutions" :key="institution.id" :value="institution.id">{{ institution.name }}</option>
                            </select>

                            <select v-else-if="rule.field == 'type' && rule.type != 'CMP'" class="form-control" v-model="rule.feature" @change="updateJSON">
                                <option value="0">Checking</option>
                                 <option value="1">Savings</option>
                                 <option value="2">Credit</option>
                                 <option value="3">Loan</option>
                                 <option value="4">Mortgage</option>
                                 <!-- <option value="5">Investment</option> -->
                             </select>

                            <select v-else-if="rule.field == 'category' && rule.type != 'CMP'" class="form-control" v-model="rule.feature" @change="updateJSON">
                                  <option v-for="(category, key) in $transactionCategories" :key="key" :value="category"> {{ category }}</option>
                             </select>

                            <select v-else-if="rule.field == 'plan'" class="form-control" v-model="rule.feature" @change="updateJSON">
                                <option value="Free">Free</option>
                                 <option value="Monthly">Monthly</option>
                                 <option value="Annual">Annual</option>
                             </select>

                            <input class="form-control" v-else-if="rule.type == 'CST'" v-model="rule.feature" @change="updateJSON">

                            <select v-else class="form-control" v-model="rule.feature" @change="updateJSON">
                                 <option v-for="( feature, index ) in moneySaverType.features" :key="index" :value="feature.label">{{ feature.label }}</option>
                             </select>
                        </div>

                        <div class="col-md-1 pt-3">
                            <a href="#" @click="removeRule(index)">X</a>
                        </div>
                    </div>

                    <a href="#" class="btn btn-primary" @click="addRule">Add Rule</a>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            <button @click="saveMoneySaver()" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, optional, minLength, requiredIf } from 'vuelidate/lib/validators'

export default {
  name: 'new-money-saver-model',
  props: [
      'accounts',
      'moneySaverType',
      'categories',
      'institutions'
  ],
  data() {
      return {
          dataMoneySaverType: this.moneySaverType,
          moneySaveDetailsKey: 5000,
          moneySaverRulesKey: 15000,
          dataFeatures: this.moneySaverType.features,
          dataRules: this.moneySaverType.rules
      }
  },
  methods: {
      saveMoneySaver() {
        this.$v.moneySaverType.$touch()
        if (!this.$v.$invalid) {
            this.$emit('saveMoneySaverType', this.moneySaverType)
            $('#moneySaverTypeModal').modal('hide')
        }
      },
      addFeature() {
          if (this.moneySaverType.features == null) {
              this.moneySaverType.features = [];
              this.$set(this.moneySaverType, this.moneySaverType);
          }
          this.moneySaverType.features.push({label: null, value: null});
          this.moneySaveDetailsKey++
      },
      removeField( index ) {
          this.$delete( this.moneySaverType.features, index )
      },
      addRule() {
        if (this.moneySaverType.rules == null) {
            this.moneySaverType.rules = [];
            this.$set(this.moneySaverType, this.moneySaverType);
        }
        this.moneySaverType.rules.push({type: null, feature: null, comparison: null, model: null, field: null});
        this.moneySaverRulesKey++
      },
      removeRule( index ) {
          this.$delete(this.moneySaverType.rules, index);
      },
      updateJSON() {
        this.$set(this.moneySaverType.rules, this.moneySaverType.rules);
        this.moneySaverRulesKey++
      },
      getClassifier( operator ,field ) {
          // Arrays contain fields this should not show for
        switch( operator ) {
            case '<':
                return !['type', 'name', 'institution_id', 'category', 'plan'].includes(field);
            case '<=':
                return !['type', 'name', 'institution_id', 'category', 'plan'].includes(field);
            case '=':
                return true;
            case '!=':
                return true;
            case '>=':
                return !['type', 'name', 'institution_id', 'category', 'plan'].includes(field);
            case '>':
                return !['type', 'name', 'institution_id', 'category', 'plan'].includes(field);
          }
      }
  },
  computed: {
      computedCategories() {
          if (!this.moneySaverType.id) {
              return this.categories
          } else {
              return this.$transactionCategories
          }
      },
  },
  validations: {
      moneySaverType: {
        name: {
            required
        },
        features: {
            required
        }
      }
  },
  mounted() {
      if ( this.moneySaverType.features == null ) {
          this.moneySaverType.features = [];
      }
      if ( this.moneySaverType.rules == null ) {
          this.moneySaverType.rules = [];
          this.dataRules = this.moneySaverType.rules
      }
   }
};
</script>
