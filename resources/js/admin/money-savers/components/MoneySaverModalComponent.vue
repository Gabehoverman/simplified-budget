<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="moneySaverModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="moneySaverModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document" style="max-width: none; width: 800px;">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="moneySaverModalLabel">Add Money Saver</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="row">
                <div class="col-md-6" style="border-right: 1px solid #efefef">
                <p><b>Details</b></p>
                <div class="form-group">
                    <label for="vendorInput">Name</label>
                    <input v-model="moneySaver.name" type="text"
                                :class="'form-control '+($v.moneySaver.name.$error ? 'is-invalid ' : '')" id="nameInput" placeholder="Name">
                </div>

                <div class="form-group">
                        <label for="categorySelect">Type</label>
                        <select v-model="moneySaver.type_id"
                                    :class="'form-control '+($v.moneySaver.type_id.$error  ? 'is-invalid ' : '')"
                                    id="categorySelect" name="timeframe" @change="updateFeatures($event)">
                            <option value="undefined" disabled>Select a Type</option>
                            <option v-for="type in moneySaverTypes" :key="type.id" :value="type.id" >{{ type.name }}</option>
                        </select>
                    </div>

                <div class="form-group">
                    <label for="vendorInput">Vendor</label>
                    <input v-model="moneySaver.vendor" type="text"
                                :class="'form-control '+($v.moneySaver.vendor.$error ? 'is-invalid ' : '')" id="nameInput" placeholder="Vendor">
                </div>

                <div class="form-group">
                    <label for="vendorInput">Link</label>
                    <input v-model="moneySaver.link" type="text"
                                :class="'form-control '+($v.moneySaver.link.$error ? 'is-invalid ' : '')" id="nameInput" placeholder="Link">
                </div>

                  <div class="form-group">
                    <label for="categorySelect">Category</label>
                    <select v-model="moneySaver.category"
                                :class="'form-control '+($v.moneySaver.category.$error ? 'is-invalid ' : '')"
                                id="categorySelect" name="category">
                        <option value="undefined" selected disabled>Select a Category</option>
                        <option v-for="(category, key) in computedCategories" :key="key" :value="category"> {{ category }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="categorySelect">SB Rating</label>
                    <select v-model="moneySaver.rating"
                                :class="'form-control '+($v.moneySaver.rating.$error  ? 'is-invalid ' : '')"
                                id="categorySelect" name="timeframe">
                        <option value="undefined" disabled>Select a Rating (1-10)</option>
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </div>

                  <!-- <div class="custom-control custom-checkbox-toggle">
                    <input type="checkbox" class="custom-control-input" id="cardToggle" data-toggle="chart" data-target="#ordersChart" data-add='{"data":{"datasets":[{"data":[15,10,20,12,7,0,8,16,18,16,10,22],"backgroundColor":"#d2ddec","label":"Affiliate"}]'>
                    <label class="custom-control-label" for="cardToggle"></label>
                </div> -->

                <div class="form-group row">
                    <div class="col-md-6">
                        <p>SB Reommended</p>
                    </div>

                    <div class="custom-control custom-control-circle custom-checkbox col-md-6 text-right">
                        <input
                            v-model="moneySaver.recommended"
                            type="checkbox"
                            class="list-checkbox custom-control-input"
                            :id="'moneySaverRecommended' + moneySaver.id"
                        />
                        <label class="custom-control-label" :for="'moneySaverRecommended' + moneySaver.id"></label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <p>Active</p>
                    </div>

                    <div class="custom-control custom-control-circle custom-checkbox col-md-6 text-right">
                        <input
                            v-model="moneySaver.status"
                            type="checkbox"
                            class="list-checkbox custom-control-input"
                            :id="'moneySaverActive' + moneySaver.id"
                        />
                        <label class="custom-control-label" :for="'moneySaverActive' + moneySaver.id"></label>
                    </div>
                </div>
                </div>

                <div class="col-md-6" :key="featuresLength">
                    <p><b>Features</b></p>

                    <div class="form-group" v-for="( feature, index ) in moneySaver.features" :key="index">
                        <label for="vendorInput">{{ feature.label }}</label>
                        <input v-model="feature.value" type="text"
                                    class="form-control" id="nameInput" placeholder="Value">
                    </div>

                    <div class="form-group">
                        <label for="vendorInput">Details</label>
                        <textarea v-model="moneySaver.details" type="text"
                                    class="form-control" id="nameInput" placeholder="Details"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="vendorInput">Our Take</label>
                        <textarea v-model="moneySaver.our_take" type="text"
                                    class="form-control" id="nameInput" placeholder="Our Take"></textarea>
                    </div>

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
      'moneySaver',
      'categories',
      'moneySaverTypes'
  ],
  data() {
      return {
        //   moneySaver: {}
        timeframe: this.moneySaver.timeframe,
        amount: this.moneySaver.amount,
      }
  },
  methods: {
      saveMoneySaver() {
        this.$v.moneySaver.$touch()
        if (!this.$v.$invalid) {
            this.$emit('saveMoneySaver', this.moneySaver)
            $('#moneySaverModal').modal('hide')
        }
      },
      updateFeatures() {
        let index = this.moneySaverTypes.map(function (x) { return x.id; }).indexOf(this.moneySaver.type_id);
        this.moneySaver.features = this.moneySaverTypes[index].features;
        this.$set(this.moneySaver, this.moneySaver);
      }
  },
  computed: {
      computedCategories() {
          if (!this.moneySaver.id) {
              return this.categories
          } else {
              return this.$transactionCategories
          }
      },
      featuresLength() {
          if (this.moneySaver.features == null) {
              this.moneySaver.features = [];
          }
          return this.moneySaver.features.length
      }
  },
  validations: {
      moneySaver: {
        name: {
            required
        },
        type_id: {
            required
        },
        category: {
            required
        },
        vendor: {
            required
        },
        link: {
        },
        recommended: {
        },
        rating: {
        }
      }
  },
  mounted() {
      console.log('mounted')
   }
};
</script>
