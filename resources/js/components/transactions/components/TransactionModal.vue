<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="transactionModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="transactionModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="transactionModalLabel">{{ transaction.id ? 'Edit' : 'Add' }} Transaction</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <new-transaction-modal
                v-if="modalType == 'full' "
                :key="transaction.id"
                :transaction="transaction"
                :accounts="accounts"
                :rules="rules"
                @saveTransaction="saveTransaction($event)"
            />

            <quick-edit-modal
                v-if="modalType == 'min' "
                :key="transaction.id"
                :transaction="transaction"
                :accounts="accounts"
                :rules="rules"
                @changeModal="changeModal($event)"
                @saveTransaction="saveTransaction($event)"
            />

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            <button @click="saveTransaction()" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength, requiredIf } from 'vuelidate/lib/validators'
import NewTransactionModal from './NewTransactionModal'
import QuickEditModal from './QuickEditModal'

export default {
  name: 'new-transaction-model',
  props: [
      'accounts',
      'transaction',
      'modalType',
      'rules'
  ],
  components: {
      NewTransactionModal,
      QuickEditModal
  },
  data() {
      return {
        //   transaction: {}
      }
  },
  methods: {
      saveTransaction() {
        this.$v.transaction.$touch()
        if (!this.$v.$invalid) {
            this.$emit('saveTransaction', this.transaction)
            $('#transactionModal').modal('hide')
        }
      },
      changeModal( type ) {
        //   this.modal = type
          this.$emit('changeModal', type)
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
  }
};
</script>
