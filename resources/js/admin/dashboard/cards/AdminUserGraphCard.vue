<template>
    <!-- Orders -->
    <div class="card">
        <div class="card-header">
        <div class="row align-items-center">
            <div class="col">

            <!-- Title -->
            <h4 class="card-header-title">
                Analytics
            </h4>

            </div>
            <div class="col-auto mr--3">

            <!-- Caption -->
            <!-- <span class="text-muted">
                Show affiliate:
            </span>

            </div>
            <div class="col-auto"> -->

            <!-- Toggle -->
            <!-- <div class="custom-control custom-checkbox-toggle">
                <input type="checkbox" class="custom-control-input" id="cardToggle" data-toggle="chart" data-target="#ordersChart" data-add='{"data":{"datasets":[{"data":[15,10,20,12,7,0,8,16,18,16,10,22],"backgroundColor":"#d2ddec","label":"Affiliate"}]'>
                <label class="custom-control-label" for="cardToggle"></label>
            </div> -->

            </div>
        </div> <!-- / .row -->

        </div>
        <div class="card-body">
            <div class="row">
                <!-- {{ analyticsData.totalsForAllResults }} -->
                <div class="col">
                    <h6 class="text-uppercase text-muted">Total User Sessions</h6>
                    <span class="h2">{{ analyticsData.totalsForAllResults['ga:sessions'] }}</span>
                </div>
                <div class="col">
                    <h6 class="text-uppercase text-muted">Total Page Views</h6>
                    <span class="h2">{{ analyticsData.totalsForAllResults['ga:pageviews'] }}</span>
                </div>
            </div>

        <!-- Chart -->
        <div class="chart">
            <canvas id="ordersChart" class="chart-canvas"></canvas>
        </div>

        </div>
    </div>
</template>

<script>
export default {
    name: 'accounts-graph-card',
    props: ['analyticsData']
}
</script>
