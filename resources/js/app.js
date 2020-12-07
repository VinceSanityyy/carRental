
require('./bootstrap');

window.Vue = require('vue');
import * as VueGoogleMaps from 'vue2-google-maps'
import toastr from 'admin-lte/plugins/toastr/toastr.min.js'
import swal from 'admin-lte/plugins/sweetalert2/sweetalert2.min.js'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import VueRouter from 'vue-router'


Vue.use(VueRouter)
Vue.use(toastr)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Home', require('./components/Home.vue').default);


const routes = [
  { path: '/home', component: require('./components/Home.vue').default },
]

window.swal = swal;
window.toastr = require('toastr')

Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyCrB9vRQ_X7_uPV_q4IOGrT6h3Kh40oFJw',
      libraries: 'places', 
    },
})

const router = new VueRouter({
  mode: 'history',
  routes
})

const app = new Vue({
    el: '#app',
    router
});
