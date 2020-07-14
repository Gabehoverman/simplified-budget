<script>
import { Pie, mixins, Doughnut } from 'vue-chartjs'
const { reactiveProp } = mixins

export default {
  extends: Doughnut,
  mixins: [reactiveProp],
  props: {
    chartdata: {
      type: Object,
      default: null
    }
  },
  data() {
      return {
        options: {
            legend: {
                display: false
            },
            scales:{
                xAxes: [{
                    display: false //this will remove all the x-axis grid lines
                }],
                yAxes: [{
                    display: false
                }]
            },
            tooltips: {
                display: false,
            },
            responsive: true,
            maintainAspectRatio: false,
            height: '100px',
            style: {
                height: '100px'
            }
        }
    }
  },
  mounted () {
    // this.chartData is created in the mixin.
    // If you want to pass options please create a local options object
    this.renderChart(this.chartData, this.options)
  }
}
</script>
