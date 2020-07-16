<template>
    <!-- HEADER -->
      <div class="header bg-dark pb-5">
        <div class="container-fluid" style="padding-left: 0px !important; padding-right: 0px !important">
          <!-- Body -->
          <div class="header-body" style="padding: 1.5rem 36px">
            <div class="row align-items-end">
              <div class="col">

                <!-- Pretitle -->
                <h6 class="header-pretitle text-secondary">
                  Overview
                </h6>

                <!-- Title -->
                <h1 class="header-title text-white">
                  Spending
                </h1>

              </div>
              <div class="col-auto">
                <!-- Nav -->
                <ul class="nav nav-tabs header-tabs">
                  <li class="nav-item">
                    <a href="#" :class="'nav-link text-center'+(dataTab == 'weekly' ? ' active' : '')" @click="fillData( 'weekly' )">
                      <h6 class="header-pretitle text-secondary">
                        <!-- Breakdown -->
                        &nbsp
                      </h6>
                      <h3 class="text-white mb-0">
                        Weekly
                      </h3>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" :class="'nav-link text-center'+(dataTab == 'monthly' ? ' active' : '')" @click="fillData( 'monthly' )">
                      <h6 class="header-pretitle text-secondary">
                        <!-- Sessions -->
                        &nbsp
                      </h6>
                      <h3 class="text-white mb-0">
                        Monthly
                      </h3>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" :class="'nav-link text-center'+(dataTab == 'annual' ? ' active' : '')" @click="fillData( 'annual' )">
                      <h6 class="header-pretitle text-secondary">
                        Breakdown
                        <!-- &nbsp -->
                      </h6>
                      <h3 class="text-white mb-0">
                        Annually
                      </h3>
                    </a>
                  </li>
                </ul>

              </div>
            </div> <!-- / .row -->
          </div> <!-- / .header-body -->

          <!-- Footer -->
          <div class="header-footer">

            <!-- Chart -->
            <div class="chart">
              <!-- <canvas id="headerChart" class="chart-canvas"></canvas> -->
                <div class="small">
                    <overview-chart class="small" :chart-data="datacollection"></overview-chart>
                </div>
            </div>

          </div>

        </div>
      </div> <!-- / .header -->

</template>

<script>
  import OverviewChart from './OverviewChart'

  export default {
    props: [
        'weeklyExpenses',
        'monthlyExpenses',
        'annualExpenses'
    ],
    components: {
      OverviewChart
    },
    data () {
      return {
        datacollection: {},
        datalabels: [],
        dataset: [],
        dataTab: 'weekly'
      }
    },
    methods: {
      fillData ( tab ) {
        this.dataTab = tab;
        this.parseData( eval ('this.'+tab+'Expenses') )
        this.$emit('updateDate', tab)
        this.datacollection = {
          labels: this.datalabels,
          datasets: [
            {
              label: 'Spending',
              backgroundColor: 'rgba(0, 149, 247, .5)',
              borderColor: '#0095f7',
              data: this.dataset
            }
          ]
        }
      },
      parseData( data ) {
            this.dataset = [];
            this.datalabels = [];
            var self = this;
            for (const [key, value] of Object.entries(data)) {
                let sum = 0;
                value.forEach( expense => {
                    sum = parseFloat(sum) + parseFloat(expense.amount);
                })
                self.datalabels.push(key)
                self.dataset.push(sum)
            }
            return true;
      },
      getRandomInt () {
        return Math.floor(Math.random() * (100 - 5 + 1)) + 5
      }
    },
    mounted () {
      this.fillData('weekly')
    //   this.parseData(this.weeklyExpenses)
    },
  }
</script>

<style>
  .small {
    max-height: 360px;
    width: 100%;
    margin: auto;
  }
</style>
