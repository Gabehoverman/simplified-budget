<template>
   <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                <h3 class="mt-3">Results</h3>
            </div>
            <div class="card-body col-md-12 row">
                <div class="col-md-6 mt-2">
                    <h4>Monthly</h4>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    New Monthly Income:
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.monthly_spending
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    New Monthly Budget Total:
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.monthly_spending_budget
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    Potential Budget Remainder:
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.monthly_spending -
                                                projectionResults.monthly_spending_budget
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- todo: show change for month to month basis -->
                </div>

                <div class="col-md-6 mt-2">
                    <h4>Annual</h4>
                    <!-- todo: show change for annual basis -->
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    New Annual Income:
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.annual_spending
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    New Annual Budget Amount:
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.annual_spending_budget
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    Potential Annual Budget Remainder:
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.annual_spending -
                                                projectionResults.annual_spending_budget
                                        )
                                    }}
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
