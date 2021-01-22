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
                                    Current Monthly Income:
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.current_monthly_income
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
                                    New Monthly Income
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.new_monthly_income
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
                                    Potential Income Increase
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.monthly_income_difference
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
                                    Potential Budget Increase
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.new_monthly_budget
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
                                    Current Annual Income:
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.current_annual_income
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
                                    New Annual Income
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.new_annual_income
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
                                    Potential Annual Income Increase:
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.annual_income_difference
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
                                    Potential Annual Budget Increase
                                </div>
                                <div class="col-md-6">
                                    {{
                                        formatCurrency(
                                            projectionResults.new_annual_budget
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
                                <div class="col-md-12">
                                    {{ projectionResults.annual_income_difference > 0 ? 'Increasing' : 'Decreasing' }} your income by ${{ formatCurrency(Math.abs(projectionResults.annual_income_difference.toFixed(2)) ) }} per year could
                                    {{ projectionResults.annual_income_difference > 0 ? 'net' : 'cost' }} you ${{ formatCurrency( projectionResults.monthly_income_difference.toFixed(2) ) }} each month,
                                    and increase your total monthly income to ${{ formatCurrency( projectionResults.new_monthly_income ) }}.
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
