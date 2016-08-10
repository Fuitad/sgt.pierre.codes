<style lang="sass">
@import "../../scss/bulma.scss"
</style>

<style>
@import "../../../node_modules/sweetalert/dist/sweetalert.css";
</style>

<template>
  <div id="app">
    <nav class="topnav nav has-shadow">
      <div class="nav-left">
        <a class="nav-item is-brand" href="#">
          Outil SGT
        </a>
      </div>

      <div class="nav-right">
        <span class="nav-item">
          <a class="button" href="#">
            <icon name="eye" class="icon" scale=1 label="Tics"></icon>
            <span>Tics</span>
          </a>
          <a class="button is-primary" v-link="{ path: '/erp' }">
            <icon name="area-chart" class="icon" scale=1 label="ERP"></icon>
            <span>ERP</span>
          </a>
        </span>
      </div>
    </nav>

    <router-view></router-view>
  </div>
</template>

<script>
  /* eslint-disable eol-last */

  import Icon from 'vue-awesome'

  export default {
    components: { Icon },
    replace: false
  }
</script>
