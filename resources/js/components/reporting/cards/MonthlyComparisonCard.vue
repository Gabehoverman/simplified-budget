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
                    <h5><span class="text-primary">●</span> ${{ monthlyTotal }}</h5> This Month
                </div>
                <div class="col-6">
                    <h5><span class="text-info">●</span> ${{ previousMonthlyTotal }}</h5> Last Month
                </div>
            </div>
        </div>

        </div>
    </div>
</template>

<script>
  import MonthlyComparisonChart from '../charts/MonthlyComparisonChart'

  export default {
      props: ['monthlyTransactions', 'previousMonthlyTransactions'],
    components: {
      MonthlyComparisonChart
    },
    data () {
      return {
        datacollection: {},
        monthlydataset: [],
        monthlydatalabels: [],
        previousdataset: [],
        previousdatalabels: [],
        monthlyTotal: 0,
        previousMonthlyTotal: 0,
      }
    },
    mounted () {
      this.fillData()
    },
    methods: {
      fillData () {
          this.parseData( )
        this.datacollection = {
          labels: this.monthlydatalabels,
          datasets: [
            {
              label: 'Current Months Transactions',
              backgroundColor: 'rgba(0, 149, 247, .6)',
              borderColor: '#0095f7',
              data: this.monthlydataset
            }, {
              label: 'Previous Months Transactions',
              backgroundColor: 'rgba(230, 239, 252, .75)',
              borderColor: '#e6effc',
              data: this.previousdataset
            }
          ]
        }
      },
      parseData( ) {
        this.dataset = [];
        this.datalabels = [];

        var date = new Date()
        var lastMonth = new Date()
        lastMonth.setMonth( date.getMonth > 0 ? date.getMonth - 1 : 0)
        var self = this;
        let sum = 0;
        for (const [key, value] of Object.entries(this.monthlyTransactions)) {
            value.forEach( expense => {
                sum = parseFloat(sum) + parseFloat(expense.amount);
            })
            self.monthlydatalabels.push(key)
            self.monthlydataset.push(sum.toFixed(2))
        }
        let previousSum = 0;
        for (const [key, value] of Object.entries(this.previousMonthlyTransactions)) {
            value.forEach( expense => {
                previousSum = parseFloat(previousSum) + parseFloat(expense.amount);
            })
            self.previousdatalabels.push(key)
            self.previousdataset.push(previousSum.toFixed(2))
        }
        console.log(this.previousdatalabels.indexOf)
        console.log(this.previousdataset)

        // Push first day of month if no transactions for that day
        if (!self.monthlydatalabels.includes(date.getFullYear()+'-'+(date.getMonth()+1)+'-01') ) {
            self.monthlydatalabels.unshift(date.getFullYear()+'-'+(date.getMonth()+1)+'-01')
            self.monthlydataset.unshift(0)
        }

        if (!self.previousdatalabels.includes(lastMonth.getFullYear()+'-'+(lastMonth.getMonth()+1)+'-01') ) {
            self.previousdatalabels.unshift(lastMonth.getFullYear()+'-'+(lastMonth.getMonth()+1)+'-01')
            self.previousdataset.unshift(0)
        }

        this.monthlyTotal = sum.toFixed(2);
        this.previousMonthlyTotal = previousSum.toFixed(2);
        return true;
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      }
    }
  }
</script>
