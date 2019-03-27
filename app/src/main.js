// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
import mixins from './mixins'
import Axios from 'axios'
import 'bootstrap/dist/css/bootstrap.min.css';

// Navdir
import navdir from '@/components/pages/includes/navdir.vue'
Vue.component('navdir', navdir);

Vue.config.productionTip = false
Vue.prototype.$axios = Axios

// Moment
var moment = require('moment');
Vue.prototype.$moment = moment

//
import VueSession from 'vue-session'
Vue.use(VueSession)


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  mixins: ['mixins'],
  components: { App },
  template: '<App/>'
})
