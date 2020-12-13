<template>
   <div class="content">
      <div class="content-header">
         <div class="container-fluid">
            <!-- <div class="row mb-2">
               <div class="col-sm-6">
                   Book
               </div>
               <div class="col-sm-6">
                   <ol class="breadcrumb float-sm-right">
                       <li class="breadcrumb-item"><a href="#">Home</a></li>
                       <li class="breadcrumb-item active">Products</li>
                   </ol>
               </div>
               </div> -->
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-primary card-outline">
               <div class="card-header">
                  <h3 class="card-title">
                     Book
                  </h3>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <div class="card-body">
                        <div class="card ">
                           <div class="card-header">
                              <h3 class="card-title">Book/Reservation</h3>
                           </div>
                           <div class="card-body">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Pick-up Location</label>
                                 <gmap-autocomplete class="form-control" @place_changed="setPickupPlace"></gmap-autocomplete>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputPassword1">Destination</label>
                                 <gmap-autocomplete class="form-control" @place_changed="setToPlace"></gmap-autocomplete>
                              </div>
                              <div class="form-group">
                                    <label for="">From</label>
                                    <date-picker v-model="fromDate" :config="options"></date-picker>
                                    <label for="">To</label>
                                    <date-picker @dp-change="dateDiff" v-model="toDate" :config="options"></date-picker>
                              </div>
                           </div>
                           <div class="card-footer">
                              <button @click="confirmReservation" class="btn btn-primary btn-block">Submit</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="card-body">
                        <GmapMap :center="center" :zoom="12" map-type-id="roadmap" style="width: 1000px; height: 500px">
                           <gmap-marker :position="fromLocation" :clickable="true" :draggable="false" icon="http://maps.google.com/mapfiles/ms/icons/blue-dot.png" @drag="dragging($event, false, 'from')" />
                           <gmap-marker :position="toLocation" :clickable="true" :draggable="false" icon="http://maps.google.com/mapfiles/ms/icons/yellow-dot.png" @drag="dragging($event, false, 'to')" />
                           <gmap-polyline v-bind:path.sync="newpath" v-bind:options="{ strokeColor:'#008000'}"></gmap-polyline>
                        </GmapMap>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
        <div class="row">
         <div class="col-md-12">
            <div class="card card-primary card-outline">
               <div class="card-header">
                  <h3 class="card-title">
                     Additional Details
                  </h3>
               </div>
               <div class="card-body">
                   <div class="card">
                       <div class="card-body">
                           <label for="">Travel Distance: </label> <b>{{distanceText}}</b>
                           <br>
                           <label for="">Estimated Travel Duration: </label> <b>{{time}}</b>
                           <br>
                           <label for="">Total Days: </label> <b>{{totalDays}} days</b>
                       </div>
                   </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import {gmapApi} from 'vue2-google-maps'
import 'bootstrap/dist/css/bootstrap.css';
import datePicker from 'vue-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
Vue.use(datePicker);
import moment from 'moment'

export default {
    data() {
        return {
            center: {
                lat: 7.0709577118409594,
                lng: 125.60799513359066
            },
            from: '',
            to: '',
            currentPlace: null,
            toPlace:null,
            fromLocation: null,
            toLocation: null,
            newpath: [],
            newpath2: [],
            distanceText: '',
            distanceValue: '',
            time: '',
            totalDays:'',
            toDate: new Date(),
            fromDate: new Date(),
            options: {
                format: 'DD/MM/YYYY',
                useCurrent: false,
            }
        }
    },
    methods: {
        setPickupPlace(place) {
            console.log(place)
            this.currentPlace = place;
            if (this.currentPlace.geometry) {
                const marker = {
                    lat: this.currentPlace.geometry.location.lat(),
                    lng: this.currentPlace.geometry.location.lng()
                };
                console.log(this.currentPlace.formatted_address)
                console.log(marker)
                this.fromLocation = marker
                this.center = marker
                this.directions(this.fromLocation, this.toLocation, 'DRIVING')
            }
        },
        setToPlace(place) {
            console.log(place)
            this.toPlace = place;
            if (this.currentPlace.geometry) {
                const marker = {
                    lat: this.toPlace.geometry.location.lat(),
                    lng: this.toPlace.geometry.location.lng()
                };
                console.log(this.toPlace.formatted_address)
                console.log(marker)
                this.toLocation = marker
                this.center = marker
                this.directions(this.toLocation, this.fromLocation, 'DRIVING')
            }
        },
        dragging(location, isSet, fromto) {
            console.log(location)
        },
        directions(origin, destination, travelMode) { // Direction - get direction path can be use for the polyline.
            this.newpath2 = []
            this.newpath2.push(origin)
            this.newpath2.push(destination)
            console.log(this.newpath2)
            console.log('direction called');
            let self = this;
            let directionsService = new google.maps.DirectionsService();
            directionsService.route({
                    origin,
                    destination,
                    travelMode
                },
                (response, status) => {

                    if (status === "OK") {
                        self.newpath = response.routes[0].overview_path;
                        self.distanceText = response.routes[0].legs[0].distance.text;
                        self.distanceValue = response.routes[0].legs[0].distance.value / 1000;
                        self.time = (response.routes[0].legs[0].duration.value / 3600).toFixed(2) + ' hr(s)';
                        console.log(self.time)
                        console.log(self.distanceText)
                        console.log(self.distanceValue)
                    } else {
                        self.distanceText = ''
                        self.distanceValue = ''
                        self.time = '';
                        self.newpath = [];
                    }
                }
            );
        },
        dateDiff(){
         var a = moment(this.fromDate,'DD/MM/YYYY')
         var b = moment(this.toDate,'DD/MM/YYYY')
         console.log(b)
         // console.log(b.diff(a,'days'))
         this.totalDays = b.diff(a,'days')
        },
        confirmReservation(){
            var bodyForm = new FormData();
            bodyForm.append('totalDays',this.totalDays)
            bodyForm.append('fromLocation',this.currentPlace.formatted_address)
            bodyForm.append('toLocation',this.toPlace.formatted_address)
            bodyForm.append('fromDate',this.fromDate)
            bodyForm.append('toDate',this.toDate)
            bodyForm.append('time',this.time)
            bodyForm.append('totalDistance',this.distanceText)

           console.log('clicked')
           var object = {};
            bodyForm.forEach(function(value, key){
               object[key] = value;
            });
            var json = JSON.stringify(object);
            localStorage.setItem('resDetails',json)
            this.$router.push('selectCar')
         //   axios.post('/confirmReservation',bodyForm
         //   ).then((res)=>{
         //      console.log(res)
         //   })
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
}
</script>
