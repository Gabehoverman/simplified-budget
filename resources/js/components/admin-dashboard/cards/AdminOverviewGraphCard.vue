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
                  User Growth: +{{ users.length }}
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
                    <a href="#" :class="'nav-link text-center'+(dataTab == 'annually' ? ' active' : '')" @click="fillData( 'annually' )">
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
                    <admin-overview-chart class="small" :chart-data="datacollection"></admin-overview-chart>
                </div>
            </div>

          </div>

        </div>
      </div> <!-- / .header -->

</template>

<script>
  import AdminOverviewChart from './AdminOverviewChart'

  export default {
    props: ['users'],
    components: {
      AdminOverviewChart
    },
    data () {
      return {
        datacollection: null,
        dataTab: 'weekly'
      }
    },

    methods: {
      fillData ( tab ) {
        this.dataTab = tab;
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
        return Math.floor(Math.random() * (100 - 5 + 1)) + 5
      }
    },
    mounted () {
      this.fillData('weekly')
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
