// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import EventBus from './plugins/event-bus'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import axios from 'axios'


Vue.use(EventBus)
Vue.use(Vuetify)

Vue.config.productionTip = false

axios.defaults.baseURL = 'http://localhost:8000/api'

window.axios = axios

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
