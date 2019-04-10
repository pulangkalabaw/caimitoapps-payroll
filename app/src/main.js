// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
import mixins from './mixins'
import Axios from 'axios'
import 'bootstrap/dist/css/bootstrap.min.css';

// Custom notication (Alert)
import notif from '@/components/pages/includes/notif.vue'
Vue.component('notif', notif);

// VModal
import VModal from 'vue-js-modal'
// Vue.use(VModal)
Vue.use(VModal, { componentName: "foo-modal" })

// Navdir
import navdir from '@/components/pages/includes/navdir.vue'
Vue.component('navdir', navdir);

// Moment
var moment = require('moment');
Vue.prototype.$moment = moment

// Toastr
import Notifications  from 'vue-notification'
Vue.use(Notifications)

// Pagination Tag
Vue.component('pagination', require('laravel-vue-pagination'));

// Session
import VueSession from 'vue-session'
Vue.use(VueSession)

Vue.config.productionTip = false
Vue.prototype.$axios = Axios

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  mixins: ['mixins'],
  components: { App },
  template: '<App/>'
})
