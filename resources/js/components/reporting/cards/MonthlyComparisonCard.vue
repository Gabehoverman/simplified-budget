<template>
    <!-- Orders -->
    <div class="card">
        <div class="card-header">
        <div class="row align-items-center">
            <div class="col">

            <!-- Title -->
            <h4 class="card-header-title">
                Monthly Comparison
            </h4>

            </div>
            <div class="col-auto mr--3">

            </div>
            <div class="col-auto">

            </div>
        </div> <!-- / .row -->

        </div>
        <div class="card-body">

        <!-- Chart -->
        <div class="chart">
            <monthly-comparison-chart style="height: 220px" :chart-data="datacollection"></monthly-comparison-chart>
            <div class="col-12 col-lg-12 mt-5 row">
                <div class="col-6">
                    <h5><span class="text-primary">●</span> $12</h5> This Month
                </div>
                <div class="col-6">
                    <h5><span class="text-info">●</span> $875</h5> Last Month
                </div>
            </div>
        </div>

        </div>
    </div>
</template>

<script>
  import MonthlyComparisonChart from '../charts/MonthlyComparisonChart'

  export default {
    components: {
      MonthlyComparisonChart
    },
    data () {
      return {
        datacollection: {}
      }
    },
    mounted () {
      this.fillData()
    },
    methods: {
      fillData () {
        this.datacollection = {
          labels: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()],
          datasets: [
            {
              label: 'New Users',
              backgroundColor: 'rgba(0, 149, 247, .6)',
              borderColor: '#0095f7',
              data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
            }, {
              label: 'Paid Users',
              backgroundColor: 'rgba(255, 255, 255, .75)',
              borderColor: 'rgba(255, 255, 255, 1)',
              data: [this.getRandomInt()/3, this.getRandomInt()/3, this.getRandomInt()/3, this.getRandomInt()/3,  this.getRandomInt()/3, this.getRandomInt()/3]
            }
          ]
        }
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      }
    }
  }
</script>
