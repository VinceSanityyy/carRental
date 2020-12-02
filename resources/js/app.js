
require('./bootstrap');

window.Vue = require('vue');
import * as VueGoogleMaps from 'vue2-google-maps'
import toastr from 'admin-lte/plugins/toastr/toastr.min.js'
import swal from 'admin-lte/plugins/sweetalert2/sweetalert2.min.js'

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Home', require('./components/Home.vue').default);
Vue.use(VueRouter)
Vue.use(toastr)

Vue.use(VueGoogleMaps, {
    load: {
      // key: 'AIzaSyCZS1-x2tYC7qwUoiCsy3pJdezTeo2O6xA',
      key: 'AIzaSyCrB9vRQ_X7_uPV_q4IOGrT6h3Kh40oFJw',

      libraries: 'places', // This is required if you use the Autocomplete plugin
      // OR: libraries: 'places,drawing'
      // OR: libraries: 'places,drawing,visualization'
      // (as you require)
   
      //// If you want to set the version, you can do so:
      // v: '3.26',
    },
   
    //// If you intend to programmatically custom event listener code
    //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
    //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
    //// you might need to turn this on.
    // autobindAllEvents: false,
   
    //// If you want to manually install components, e.g.
    //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
    //// Vue.component('GmapMarker', GmapMarker)
    //// then disable the following:
    // installComponents: true,
  })

const app = new Vue({
    el: '#app',
});
