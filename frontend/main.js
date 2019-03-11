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

// Set axios base URL
const origin = window.location.origin
const api = `${origin}/fleet_training_request/api/`
ApiService.init(api)

Vue.mixin({
  data () {
    return {
      base_url: process.env.MIX_PROD_URL
    }
  }
})

new Vue({
  store,
  render: h => h(App)
}).$mount('#app')
