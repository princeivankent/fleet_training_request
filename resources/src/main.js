require('../assets/js/bootstrap');

import Vue from 'vue'
import Vuex from 'vuex'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import '@fortawesome/fontawesome-free/css/all.min.css'
import {store} from './store/index';

import App from './App'

Vue.use(Vuetify)
Vue.use(Vuex)

Vue.mixin({
  data () {
    return {
      base_url: process.env.MIX_DEV_URL
    }
  },
})

new Vue({
  store,
  render: h => h(App)
}).$mount('#app')
