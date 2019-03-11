import Vue from 'vue'
import Vuex from 'vuex'
import VeeValidate from 'vee-validate'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import '@fortawesome/fontawesome-free/css/all.min.css'
import {store} from './store/index';
import ApiService from './services/api.service'
import App from './App'

Vue.use(Vuetify)
Vue.use(Vuex)
Vue.use(VeeValidate)

Vue.mixin({
  data () {
    return {
      base_url: process.env.MIX_PROD_URL
    }
  }
})

// Set axios base URL
ApiService.init(process.env.MIX_API_URL)

// Set axios x-csrf-token
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
else console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');

new Vue({
  store,
  render: h => h(App)
}).$mount('#app')
