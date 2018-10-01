require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');
window.Vuetify = require('vuetify');
window.VueScrollTo = require('vue-scrollto');

import 'material-design-icons-iconfont/dist/material-design-icons.css';
import 'vuetify/dist/vuetify.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';

Vue.use(Vuex);
Vue.use(Vuetify);
Vue.use(VueScrollTo);