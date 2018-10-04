require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');
window.VueScrollTo = require('vue-scrollto');
window.Swal = require('sweetalert');

import 'material-design-icons-iconfont/dist/material-design-icons.css';
import '@fortawesome/fontawesome-free/css/all.min.css';

Vue.use(Vuex);
Vue.use(VueScrollTo);