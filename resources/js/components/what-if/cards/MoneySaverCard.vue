<template>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="mt-3">Results</h3>
            </div>
            <div class="card-body col-md-12 row">
                <div class="col-md-6 mt-2">
                    <h4>{{ projectionResults.account.name }}</h4>
                    <div class="list-group list-group-flush" v-for="feature in projectionResults.features" :key="feature.label">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ feature.new.label }}
                                </div>
                                <div class="col-md-6">
                                    {{
                                        feature.current
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-2">
                    <h4>{{ projectionResults.money_saver.name }}</h4>
                    <div class="list-group list-group-flush" v-for="feature in projectionResults.features" :key="feature.label">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ feature.new.label }}
                                </div>
                                <div class="col-md-6">
                                    {{
                                        feature.new.value
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

                                <div class="col-md-12" >
                                    Switching from {{ projectionResults.account.name }} to {{ projectionResults.money_saver.name }} will {{ projectionResults.details }}.
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
