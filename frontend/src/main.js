import Vue from "vue";
import App from "./App";
import router from "./router/index";

import BlackDashboard from "./plugins/blackDashboard";
import Auth from './services/auth.js';
import EventBus from './plugins/event-bus';
import axios from 'axios';


Vue.use(BlackDashboard);
Vue.use(Auth);
Vue.use(EventBus);

window.axios = axios

const token = localStorage.getItem('user_token')
if (token) {
  window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

window.axios.defaults.baseURL = 'http://localhost:8000/api';

/* eslint-disable no-new */
new Vue({
  router,
  render: h => h(App)
}).$mount("#app");
