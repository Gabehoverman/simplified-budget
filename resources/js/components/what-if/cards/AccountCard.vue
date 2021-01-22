<template>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="mt-3">Results</h3>
            </div>
            <div class="card-body col-md-12 row">
                <div class="col-md-6 mt-2">
                    <h4>Current</h4>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    Timeframe
                                </div>
                                <div class="col-md-6">
                                    {{
                                        projectionResults.timeframe_one
                                    }} months
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    Interest Paid
                                </div>
                                <div class="col-md-6">
                                    $
                                    {{
                                        formatCurrency(
                                            projectionResults.interest_one
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-2">
                    <h4>New</h4>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    Timeframe
                                </div>
                                <div class="col-md-6">
                                    {{
                                        projectionResults.timeframe_two
                                    }} months
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    Interest Paid
                                </div>
                                <div class="col-md-6">
                                   $
                                    {{
                                        formatCurrency(
                                            projectionResults.interest_two
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">

                                <div class="col-md-12" v-if="projectionResults.account_one_time == 1">
                                    Making a one time payment of ${{ formatCurrency( projectionResults.account_new_payment ) }} could save you ${{ projectionResults.interest_difference }} in interest,
                                    and your debt would be paid off {{ Math.abs( projectionResults.timeframe_difference ) }} months faster.
                                </div>
                                <div class="col-md-12" v-else>
                                    {{ projectionResults.payment_difference > 0 ? 'Increasing' : 'Decreasing' }} your payment by ${{ Math.abs(projectionResults.payment_difference) }} per month could
                                    {{ projectionResults.payment_difference > 0 ? 'save' : 'cost' }} you ${{ projectionResults.interest_difference }} in interest,
                                    and your debt would be paid off {{ Math.abs( projectionResults.timeframe_difference ) }} months {{ projectionResults.payment_difference > 0 ? 'faster' : 'slower' }}.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { required, minLength, sameAs } from "vuelidate/lib/validators";

export default {
    props: ["projectionData", "projectionResults"]
};
</script>
