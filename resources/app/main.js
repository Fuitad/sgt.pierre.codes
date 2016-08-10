import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './components/App'
import Erp from './components/Erp'

/* eslint-disable eol-last */

Vue.config.debug = true

Vue.use(VueRouter)
Vue.use(require('vue-resource'))

// Vue.http.options.root = 'http://vumen.home/rest'

Vue.filter('number', {
  read: (value) => {
    return value ? parseInt(value, 10) : 0
  },
  write: (value, old) => {
    return value ? parseInt(value, 10) : 0
  }
})

var router = new VueRouter({
  history: true,
  saveScrollPosition: true,
  transitionOnLoad: true
})

// router.mode = 'html5'

router.map({
  /*
  '/': {
    name: 'dashboard',
    component: function (resolve) {
      require(['./pages/Home'], resolve)
    }
  },

  '/users': {
    name: 'users',
    component: function (resolve) {
      require(['./pages/Users'], resolve)
    }
  },

  '/products': {
    name: 'products',
    component: function (resolve) {
      require(['./pages/Products'], resolve)
    }
  },

  '/orders': {
    name: 'orders',
    component: function (resolve) {
      require(['./pages/Orders'], resolve)
    }
  }
  */
  '/erp': {
    component: Erp
  }
})

router.beforeEach(function (transition) {
  console.log('Navigating to: ' + transition.to.path)
  transition.next()
})

router.afterEach(function (transition) {
  console.log('Navigated to: ' + transition.to.path)
})

router.start(App, 'body')
