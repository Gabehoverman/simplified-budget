<template>
  <!-- Orders -->
  <div class="card">
    <div class="card-header">
      <div class="row align-items-center">
        <div class="col">
          <!-- Title -->
          <h4 class="card-header-title">Breakdown</h4>
        </div>
        <div class="col text-right">
            <span class="text-muted">${{ total }}</span>
        </div>
        <div class="col-auto mr--3"></div>
        <div class="col-auto"></div>
      </div>
      <!-- / .row -->
    </div>
    <div class="card-body">
      <!-- Chart -->
      <div class="chart" v-if="budgets.length > 0">
        <category-chart :key="toggle" style="height: 300px" :chart-data="datacollection"></category-chart>
      </div>
    </div>
  </div>
</template>

<script>
import BudgetChart from "../charts/BudgetChart";

export default {
  props: ["budgets"],
  components: {
    BudgetChart
  },
  data() {
    return {
      toggle: false,
      datacollection: {},
      dataset: [],
      datalabels: [],
      dataColors: [],
      totalBudgets: this.total
    };
  },
  mounted() {
    this.fillData();
  },
  methods: {
    fillData() {
    this.parseData(this.budgets)
      this.datacollection = {
        labels: this.datalabels,
        datasets: [
          {
            label: "Data One",
            // backgroundColor: ["rgba(0, 149, 247, 1)", "rgba(0, 149, 247, .8)", "rgba(0, 149, 247, .6)", "rgba(0, 149, 247, .4)", "rgba(0, 149, 247, .2)"],
            backgroundColor: this.dataColors,
            data: this.dataset
          }
        ]
      };
    },
    parseData( data ) {
        this.dataset = [];
        this.datalabels = [];
        this.dataColors = [];
        var self = this;
        for (const [key, value] of Object.entries(data)) {
            let sum = 0;
            sum = parseFloat(value.monthly_amount);
            console.log(sum)
            self.datalabels.push( value.name )
            self.dataColors.push(this.getColor( value ))
            self.dataset.push( sum )
        }
        return true;
      },
      getRandomInt() {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5;
      },
      getColor( budget ) {
        let percent = ((budget.total / budget.monthly_amount) * 100)
        if ( percent >= 100) {
            return '#d01a3b'
        } else if (percent >= 85) {
            return '#F6C343'
        } else {
            return '#2C7BE5'
        }
      }
  },
  watch: {
      budgets() {
          console.log('budgets')
           this.fillData();
           this.toggle = !this.toggle;
      }
  },
  computed: {
      total() {
          let total = 0;
          this.budgets.forEach( function( budget ) {
              total += parseFloat(budget.monthly_amount)
          })
          return total
      }
  }
};
</script>
