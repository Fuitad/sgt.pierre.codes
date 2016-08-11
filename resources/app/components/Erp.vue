<template>
  <section class="section">
    <div class="container">
      <div class="heading">
        <h1 class="title is-1">Pratique ERP</h1>
        <h2 v-if="!isSessionActive" class="subtitle">Commencer une nouvelle session</h2>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div v-if="!isSessionActive">
        <div class="control is-horizontal">
          <div class="control-label">
            <label class="label">Durée de la session</label>
          </div>
          <div class="control">
            <p class="control has-addons">
              <input class="input" min="1" type="number" pattern="[0-9]*" inputmode="numeric" v-model="sessionDuration">
              <a class="button is-info" @click.prevent="startNewSession()">Commencer</a>
            </p>
          </div>
        </div>
      </div>

      <div v-if="isSessionActive">
        <div class="columns">
          <div class="column is-3">
            <p class="title has-text-centered">
              Temps restant
            </p>

            <h1 class="title is-1 has-text-centered">
              {{ timeLeftInSession }}
            </h1>

            <p class="has-text-centered" v-if="!isSessionCompleted">
              <a class="button is-medium" v-if="!isPaused" @click.prevent="togglePause()">
                <icon name="pause" class="icon" scale=1 label="Pause"></icon>
                <span>Pause</span>
              </a>
              <a class="button is-medium" v-if="isPaused" @click.prevent="togglePause()">
                <icon name="play" class="icon" scale=1 label="Continuer"></icon>
                <span>Continuer</span>
              </a>
            </p>
          </div>
          <div class="column is-6">
            <erp-line-chart :height=150 :data.sync="chartData" :options="chartOptions"></erp-line-chart>
          </div>
          <div class="column is-3">
            <p class="title has-text-centered">Tics</p>

            <ul class="ticsBox">
              <li v-for="tic in sessionData.tics">
                {{ ticTime(tic.tick) }} - {{ tic.tic }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section" v-if="isSessionActive">
    <div class="container">
      <h3 class="title is-3">Effort</h3>

      <div class="columns is-multiline is-mobile">
        <template v-for="effortScore in effortButtons">
          <div class="tile">
            <a :disabled="isPaused || isSessionCompleted"
              class="button is-medium is-info effortButton"
              @click.prevent="addNewScore(effortScore)">{{ effortScore }}</a>
          </div>
        </template>
      </div>

      <p>&nbsp;</p>
      <p>&nbsp;</p>

      <h3 class="title is-3">Tics</h3>

      <div class="columns is-multiline is-mobile">
        <template v-for="tic in ticButtons">
          <div class="column is-2">
            <a :disabled="isPaused || isSessionCompleted"  class="button is-medium" @click.prevent="addNewTic(tic)">{{ tic }}</a>
          </div>
        </template>
        <div class="column is-2">
          <a class="button is-medium" @click.prevent="registerNewTic()">
            <icon name="plus" class="icon"></icon>
            <span>Ajouter</span>
          </a>
        </div>
      </div>

      <p>&nbsp;</p>
      <pre v-if="isSessionCompleted">{{ sessionData | json }}</pre>
    </div>

  </section>
</template>

<script>
  /* eslint-disable eol-last */

  import _ from 'lodash'
  import Icon from 'vue-awesome'
  import ErpLineChart from './ErpLineChart'
  import moment from 'moment'
  import 'moment-duration-format'

  export default {
    components: { ErpLineChart, Icon },
    data: function () {
      return {
        modelName: 'erpsession',
        sessionDuration: 15,
        tics: ['Bec', 'Cheville', 'Cou', 'Coude', 'Doigt', 'Épaule', 'Genou', 'Raclement', 'Grenouille', 'Grimace', 'Culotte', 'Poignet', 'Reniflement', 'Sifflement', 'Vocal'],
        now: 0,
        effortButtons: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        sessionData: false,
        isPaused: false,
        tickStep: 1
      }
    },

    watch: {
      'now': function (newValue, oldValue) {
        if (this.isSessionActive && !this.isPaused && !this.isSessionCompleted) {
          this.sessionData.ticks = this.sessionData.ticks + this.tickStep

          if (this.sessionCompleted) {
            // save session
          }
        }
      }
    },

    computed: {
      chartOptions: function () {
        return {
          scales: {
            xAxes: [{
              type: 'linear',
              position: 'bottom',
              ticks: {
                max: this.sessionData.duration,
                min: 0,
                stepSize: 60,
                beginAtZero: true,
                callback: function (value) {
                  return value / 60
                }
              }
            }],
            yAxes: [{
              ticks: {
                max: 10,
                min: 0,
                beginAtZero: true
              }
            }]
          }
        }
      },

      chartData: function () {
        return {
          datasets: [
            {
              label: 'Tics',
              type: 'bubble',
              backgroundColor: '#FF6384',
              hoverBackgroundColor: '#FF6384',
              data: this.sessionData && this.sessionData.tics.length
                ? _.map(this.sessionData.tics, function (tic) {
                  return {
                    x: tic.tick,
                    y: 0,
                    r: 5
                  }
                })
                : []
            },
            {
              label: 'Effort',
              fill: false,
              lineTension: 0.1,
              backgroundColor: 'rgba(75,192,192,0.4)',
              borderColor: 'rgba(75,192,192,1)',
              borderCapStyle: 'butt',
              borderDash: [],
              borderDashOffset: 0.0,
              borderJoinStyle: 'miter',
              pointBorderColor: 'rgba(75,192,192,1)',
              pointBackgroundColor: '#fff',
              pointBorderWidth: 1,
              pointHoverRadius: 5,
              pointHoverBackgroundColor: 'rgba(75,192,192,1)',
              pointHoverBorderColor: 'rgba(220,220,220,1)',
              pointHoverBorderWidth: 2,
              pointRadius: 1,
              pointHitRadius: 10,
              spanGaps: false,
              data: this.sessionData.scores.length
                ? _.map(this.sessionData.scores, function (score) {
                  return {
                    x: score.tick,
                    y: score.score
                  }
                })
                : []
            }
          ]
        }
      },

      ticButtons: function () {
        return _.sortBy(this.tics, function (i) { return i.latinise().toLowerCase() })
      },

      isSessionActive: function () {
        return this.sessionData !== false
      },

      isSessionCompleted: function () {
        return this.sessionData.ticks >= this.sessionData.duration
      },

      timeLeftInSession: function () {
        if (!this.isSessionActive) {
          return 0
        }

        return moment.duration(this.sessionData.duration - this.sessionData.ticks, 'seconds').format('mm:ss', { trim: false })
      }
    },
    methods: {
      ticTime: function (tic) {
        return moment.duration(tic, 'seconds').format('mm:ss', { trim: false })
      },

      togglePause: function () {
        this.isPaused = !this.isPaused
      },

      generateNewSessionData: function () {
        return {
          startTime: this.now,
          duration: this.sessionDuration * 60,
          ticks: 0,
          scores: [],
          tics: []
        }
      },

      startNewSession: function () {
        this.sessionData = this.generateNewSessionData()
        this.paused = false
      },

      addNewTic: function (tickName) {
        var newTic = {
          ts: this.now,
          tick: this.sessionData.ticks,
          tic: tickName
        }

        this.sessionData.tics.push(newTic)
        this.updateChart()
      },

      addNewScore: function (score) {
        var newScore = {
          ts: this.now,
          tick: this.sessionData.ticks,
          score: score
        }

        this.sessionData.scores.push(newScore)
        this.updateChart()
      },

      updateChart: function () {
        this.$broadcast('Erp::UpdatedChartData', this.chartData)
      },

      registerNewTic: function () {
        var tickName = window.prompt('Name')

        if (!_.isString(tickName) || !tickName.length) {
          console.warn('Tic name not provided')
          return
        }

        if (_.findIndex(this.tics, tickName) !== -1) {
          console.warn('Tic already in array')
          return
        }

        this.tics.push(tickName)
      }
    },
    ready: function () {
      window.setInterval(() => {
        this.now = Math.trunc((new Date()).getTime() / 1000)
      }, 1000)
    }
  }
</script>

<style scoped>
  .effortButton {
    width: 80px;
  }

  .section {
    padding-top: 8px !important;
    padding-bottom: 8px !important;
  }

  .ticsBox {
    min-height: 215px;
    max-height: 215px;
    overflow-y: scroll;
  }
</style>
