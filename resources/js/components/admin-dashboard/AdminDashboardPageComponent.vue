<template>
        <!-- MAIN CONTENT
    ================================================== -->
    <div>
      <!-- HEADER -->
      <div class="header bg-dark pb-5">
        <div class="container-fluid">

          <!-- Body -->
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">

                <!-- Pretitle -->
                <h6 class="header-pretitle text-secondary">
                  Overview
                </h6>

                <!-- Title -->
                <h1 class="header-title text-white">
                  User Growth
                </h1>

              </div>
              <div class="col-auto">

                <!-- Nav -->
                <ul class="nav nav-tabs header-tabs">
                  <li class="nav-item" data-toggle="chart" data-target="#headerChart" data-update='{"data":{"datasets":[{"data":[0,10,5,15,10,20,15,25,20,30,25,40]}]' data-prefix="$" data-suffix="k">
                    <a href="#" class="nav-link text-center active" data-toggle="tab">
                      <h6 class="header-pretitle text-secondary">
                        <!-- Breakdown -->
                        &nbsp
                      </h6>
                      <h3 class="text-white mb-0">
                        Daily
                      </h3>
                    </a>
                  </li>
                  <li class="nav-item" data-toggle="chart" data-target="#headerChart" data-update='{"data":{"datasets":[{"data":[50,75, 35,25,55,87,67,53,25,80,87,45]}]' data-prefix="" data-suffix="k">
                    <a href="#" class="nav-link text-center" data-toggle="tab">
                      <h6 class="header-pretitle text-secondary">
                        <!-- Sessions -->
                        &nbsp
                      </h6>
                      <h3 class="text-white mb-0">
                        Weekly
                      </h3>
                    </a>
                  </li>
                  <li class="nav-item" data-toggle="chart" data-target="#headerChart" data-update='{"data":{"datasets":[{"data":[40,57,25,50,57,32,46,28,59,34,52,48]}]' data-prefix="" data-suffix="%">
                    <a href="#" class="nav-link text-center" data-toggle="tab">
                      <h6 class="header-pretitle text-secondary">
                        Breakdown
                        <!-- &nbsp -->
                      </h6>
                      <h3 class="text-white mb-0">
                        Monthly
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
              <canvas id="headerChart" class="chart-canvas"></canvas>
            </div>

          </div>

        </div>

      </div>
    </div>

</template>

<script>


    export default {
        name: 'admin-dashboard-page-component',
        props: [
            'accounts',
            'transactions'
        ],
        components: {

        }
    }
</script>
