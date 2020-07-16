<template>
    <!-- Orders -->
    <div class="card">
        <div class="card-header">
        <div class="row align-items-center">
            <div class="col">

            <!-- Title -->
            <h4 class="card-header-title">
                Categories
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
            <category-chart style="height: 300px" :chart-data="datacollection"></category-chart>
        </div>

        </div>
    </div>
</template>

<script>
  import CategoryChart from '../charts/CategoryChart'

  export default {
    components: {
      CategoryChart
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
          labels: ['Housing', 'Grocery'],
          datasets: [
            {
              label: 'Data One',
              backgroundColor: ['#0095f7', 'rgba(0, 149, 247, .7)'],
              data: [this.getRandomInt(), this.getRandomInt()]
            }
            // }, {
            //   label: 'Data One',
            //   backgroundColor: '#f87979',
            //   data: [this.getRandomInt(), this.getRandomInt()]
            // }
          ]
        }
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      }
    }
  }
</script>
