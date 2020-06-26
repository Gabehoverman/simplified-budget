<template>
    <!-- Devices -->
    <div class="card">
        <div class="card-header">
        <div class="row align-items-center">
            <div class="col">

            <!-- Title -->
            <h4 class="card-header-title">
                Devices
            </h4>

            </div>
            <div class="col-auto">

            <!-- Tabs -->
            <ul class="nav nav-tabs nav-tabs-sm card-header-tabs">
                <li class="nav-item" data-toggle="chart" data-target="#devicesChart" data-update='{"data":{"datasets":[{"data":[60,25,15]}]'>
                <a href="#" class="nav-link active" data-toggle="tab">
                    All
                </a>
                </li>
                <li class="nav-item" data-toggle="chart" data-target="#devicesChart" data-update='{"data":{"datasets":[{"data":[15,45,20]}]'>
                <a href="#" class="nav-link" data-toggle="tab">
                    Direct
                </a>
                </li>
            </ul>

            </div>
        </div> <!-- / .row -->

        </div>
        <div class="card-body">

        <!-- Chart -->
        <div class="chart chart-appended">
            <canvas id="devicesChart" class="chart-canvas" data-target="#devicesChartLegend"></canvas>
        </div>

        <!-- Legend -->
        <div id="devicesChartLegend" class="chart-legend"></div>

        </div>
    </div>
</template>

<script>
export default {
    name: 'transactions-graph-card',
    props: ['transactions']
}
</script>
