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
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="moneySaverModalLabel">Details</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
                <div class="form-group row">
                    <div class="col-md-7 text-left">
                        <h2>{{ moneySaver.name }}</h2>
                    </div>
                    <div class="col-md-5 text-right">
                          <div class="text-muted small" v-if="moneySaver.recommended">
                            <i class="fe fe-star"></i>
                            {{ moneySaver.recommended ? 'SB Recommended' : ''}}
                        </div>
                    </div>
                </div>

                 <div class="form-group">
                    <label for="categorySelect"><b>SB Rating:</b></label>
                    {{ moneySaver.rating }} <span class="text-muted small">/ 10</span>
                </div>

                <div class="form-group" v-for="(feature, index) in moneySaver.features" :key="index">
                    <label for="categorySelect"><b>{{ feature.label }}:</b></label>
                    {{ feature.value }}
                </div>

                <div class="form-group">
                    <label for="categorySelect"><b>Full Details:</b></label>
                    {{ moneySaver.details }}
                </div>

                <div class="form-group">
                    <label for="categorySelect"><b>Our Take:</b></label>
                    {{ moneySaver.our_take }}
                </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            <a :href="'/what-if/?moneysaver='+moneySaver.id" target="_blank" type="button" class="btn btn-primary">Compare</a>
            <a :href="moneySaver.link" target="_blank" type="button" class="btn btn-primary">See Details</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength, requiredIf } from 'vuelidate/lib/validators'

export default {
  name: 'new-moneySaver-model',
  props: [
      'accounts',
      'moneySaver',
      'categories'
  ],
  data() {
      return {
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
      }
  },
  computed: {
      computedCategories() {
          if (!this.moneySaver.id) {
              return this.categories
          } else {
              return this.$transactionCategories
          }
      }
  },
  validations: {
      moneySaver: {
        account_id: {
            required
        },
        category: {
            required: requiredIf(function() {
                return this.moneySaver.type != 1;
            })
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
