<template>
  <canvas class="chartjs" :width="width" :height="height"></canvas>
</template>

<script>
  /* eslint-disable eol-last */

  import _ from 'lodash'
  import Chart from 'chart.js'

  export default {
    props: {
      width: Number,
      height: Number,
      data: {
        type: Object,
        required: true,
        default () {
          return {}
        }
      },
      options: {
        type: Object,
        default () {
          return {}
        }
      }
    },

    ready () {
      const $el = this.$el

      this.chart = new Chart($el, {
        type: 'line',
        data: this.data,
        options: _.extend(this.options, {
          pointHitDetectionRadius: 1,
          hover: {
            mode: 'x-axis'
          }
        })
      })
    },

    data () {
      return {
        chart: null
      }
    },

    events: {
      'Erp::UpdatedChartData': function (chartData) {
        this.$nextTick(() => {
          this.chart.data.datasets[0].data = chartData.datasets[0].data
          this.chart.data.datasets[1].data = chartData.datasets[1].data
          this.chart.update()
        })
      }
    }
  }
</script>
