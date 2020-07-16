<template>
  <!-- Orders -->
  <div class="card">
    <div class="card-header">
      <div class="row align-items-center">
        <div class="col">
          <!-- Title -->
          <h4 class="card-header-title">Categories</h4>
        </div>
        <div class="col-auto mr--3"></div>
        <div class="col-auto"></div>
      </div>
      <!-- / .row -->
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
import CategoryChart from "../charts/CategoryChart";

export default {
  props: ["categories"],
  components: {
    CategoryChart
  },
  data() {
    return {
      datacollection: {},
      dataset: [],
      datalabels: [],
    };
  },
  mounted() {
    this.fillData();
  },
  methods: {
    fillData() {
    this.parseData(this.categories)
      this.datacollection = {
        labels: this.datalabels,
        datasets: [
          {
            label: "Data One",
            backgroundColor: ["#0095f7", "rgba(0, 149, 247, .7)"],
            data: this.dataset
          }
        ]
      };
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
        getRandomInt() {
            console.log(this.categories)
            return Math.floor(Math.random() * (50 - 5 + 1)) + 5;
        }
  }
};
</script>
