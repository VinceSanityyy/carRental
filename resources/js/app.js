
require('./bootstrap');

window.Vue = require('vue');
import * as VueGoogleMaps from 'vue2-google-maps'
import toastr from 'admin-lte/plugins/toastr/toastr.min.js'
import swal from 'admin-lte/plugins/sweetalert2/sweetalert2.min.js'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import VueRouter from 'vue-router'
import CarModal from './components/CarModal';
import VueAlertify from 'vue-alertify';


Vue.use(VueRouter)
Vue.use(toastr)
Vue.use(Loading)
Vue.use(VueAlertify,{
  movable: false,
  glossary: {
    title: 'Confirm',
    ok: 'OK',
    cancel: 'Cancel',
  },
});


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Home', require('./components/Home.vue').default);
Vue.component('Cars', require('./components/Cars.vue').default);
Vue.component('CarModal', require('./components/CarModal.vue').default);
Vue.component('SelectCar', require('./components/SelectCar.vue').default);
Vue.component('login',require('./components/Login.vue').default);
const routes = [
  { path: '/home', component: require('./components/Home.vue').default },
  { path: '/cars', component: require('./components/Cars.vue').default },
  { path: '/selectCar', component: require('./components/SelectCar.vue').default },
  { path: '/reservationList', component: require('./components/reservationList.vue').default },
  { path: '/reservationInfo', component: require('./components/ReservationDetails.vue').default },
  // { path: '/reservationDetails/:reservationId', component: require('./components/ReservationDetails.vue').default },
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
    router,
    components:{
      CarModal
    }
});
