<template>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="mt-3">Details</h3>
            </div>
            <div class="card-body">
                <div class="col-md-12 row">

                    <div class="form-group col-md-12">
                        <label>Change</label>
                        <select :class="'form-control '+($v.projectionData.spending_type.$error ? 'is-invalid ' : '')"
                                    v-model="projectionData.spending_type">
                            <option value="increase">Increased</option>
                            <option value="decrease">Decreased</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12 mt-4">
                        <label>Amount</label>
                        <input
                            type="text"
                            :class="'form-control '+($v.projectionData.spending_amount.$error ? 'is-invalid ' : '')"
                            v-model="projectionData.spending_amount"
                        />
                    </div>

                    <div class="form-group col-md-12 mt-4">
                        <label>Timeframe</label>
                        <select :class="'form-control '+($v.projectionData.spending_timeframe.$error ? 'is-invalid ' : '')"
                                    v-model="projectionData.spending_timeframe">
                            <option value="monthly">Monthly</option>
                            <option value="annually">Annually</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12 text-right">
                        <a href="#" class="btn btn-primary" @click="calculate">Calculate</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { required, minLength, sameAs } from "vuelidate/lib/validators";

export default {
    props: ["projectionData", "projectionResults"],
    methods: {
        calculate() {
            this.$v.projectionData.$touch()

            if (!this.$v.projectionData.$invalid) {
                this.$emit('calculate');
            }
        }
    },
    validations: {
        projectionData: {
            spending_type: {
                required
            },
            spending_amount: {
                required
            },
            spending_timeframe: {
                required
            }
        },
    },
};
</script>
