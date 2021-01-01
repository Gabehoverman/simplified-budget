<template>
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="billingModalLabel">
                Update Address
            </h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form>
                <div class="form-group">
                    <label for="amountInput">Stress Address</label>
                    <input v-model="dataBilling.address" type="text" name="address"
                                :class="'form-control '+($v.dataBilling.address.$error ? 'is-invalid ' : '')" id="amountInput" placeholder="">
                </div>

                    <div class="form-group">
                    <label for="amountInput">Unit</label>
                    <input v-model="dataBilling.unit" type="text" name="unit"
                                :class="'form-control '+($v.dataBilling.unit.$error ? 'is-invalid ' : '')" id="amountInput" placeholder="">
                </div>

                <div class="form-group">
                    <label for="vendorInput">City</label>
                    <input v-model="dataBilling.city" type="text" name="city"
                                :class="'form-control '+($v.dataBilling.city.$error ? 'is-invalid ' : '')" id="vendorInput" placeholder="">
                </div>

                <div class="form-group">
                    <label for="vendorInput">State</label>
                    <input v-model="dataBilling.state" type="text" name="state"
                                :class="'form-control '+($v.dataBilling.state.$error ? 'is-invalid ' : '')" id="dateInput" placeholder="">
                </div>

                <div class="form-group">
                    <label for="vendorInput">Zip</label>
                    <input v-model="dataBilling.zip" type="text" name="zip"
                                :class="'form-control '+($v.dataBilling.zip.$error ? 'is-invalid ' : '')" id="dateInput" placeholder="">
                </div>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="saveChanges()">Save changes</button>
        </div>
    </div>
</template>

<script>
    import { required, minLength, sameAs } from 'vuelidate/lib/validators'

    export default {
        props: ['billing', 'user', 'validations'],
        data() {
            return {
                dataBilling: {
                    address: this.user.address,
                    unit: this.user.unit,
                    state: this.user.state,
                    city: this.user.city,
                    zip: this.user.zip,
                }
            }
        },
        methods: {
            saveChanges() {
                var self = this;
                this.$v.dataBilling.$touch()
                if (!this.$v.dataBilling.$invalid) {
                    this.asyncSendData(this.dataBilling, '/settings/billing/update-profile', 'POST').then( function( response ) {
                        self.$emit('updateAddress', response);
                    })
                }
            }
        },
          validations: {
            dataBilling: {
                address: {
                    required,
                    minLength: 5
                },
                unit: {
                },
                city: {
                    required,
                    minLength: 2
                },
                state: {
                    required,
                    minLength: 2
                },
                zip: {
                    required,
                    minLength: 5
                }
            }
        }
    }
</script>
