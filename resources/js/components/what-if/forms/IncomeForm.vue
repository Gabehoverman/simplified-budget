<template>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="mt-3">Details</h3>
            </div>
            <div class="card-body">
                <div class="col-md-12 row">

                    <div class="form-group col-md-12">
                        <label>Current Annual Income</label>
                        <input
                            type="text"
                            :class="'form-control '+($v.projectionData.income_amount.$error ? 'is-invalid ' : '')"
                            v-model="projectionData.income_amount"
                        />
                    </div>

                    <div class="form-group col-md-12 mt-4">
                        <label>New Annual Income</label>
                        <input
                            type="text"
                            :class="'form-control '+($v.projectionData.income_new_amount.$error ? 'is-invalid ' : '')"
                            v-model="projectionData.income_new_amount"
                        />
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
    props: ["projectionData", "projectionResults", "user"],
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
            income_amount: {
                required
            },
            income_new_amount: {
                required
            }
        },
    },
    mounted() {
        console.log( this.projectionData.income_amount )
    }
};
</script>
