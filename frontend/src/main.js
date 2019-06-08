import Vue from "vue";
import App from "./App";
import router from "./router/index";

import BlackDashboard from "./plugins/blackDashboard";
import Auth from './services/auth.js';
import EventBus from './plugins/event-bus';
import axios from 'axios';
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import _ from "lodash";
import VueSelect from 'vue-cool-select'

Vue.use(VueSelect, {
  theme: 'bootstrap'
});

Vue.use(BootstrapVue);
Vue.use(BlackDashboard);
Vue.use(Auth);
Vue.use(EventBus);

window.axios = axios
window._ = _;

const token = localStorage.getItem('user_token')
if (token) {
  window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

window.axios.defaults.baseURL = 'http://www.zleague.com.br:8000/api';

/* eslint-disable no-new */
new Vue({
  router,
  render: h => h(App)
}).$mount("#app");
