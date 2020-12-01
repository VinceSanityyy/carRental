<template>
    <div class="container">
        <gmap-autocomplete @place_changed="setPickupPlace"></gmap-autocomplete>
        <gmap-autocomplete @place_changed="setToPlace"></gmap-autocomplete>
  
        <div class="row justify-content-center">
            <GmapMap :center="center" :zoom="14" map-type-id="roadmap" style="width: 500px; height: 300px">
              <gmap-marker :position="fromLocation" :clickable="true" :draggable="false" icon="http://maps.google.com/mapfiles/ms/icons/blue-dot.png" @drag="dragging($event, false, 'from')" />
              <gmap-marker :position="toLocation" :clickable="true" :draggable="false" icon="http://maps.google.com/mapfiles/ms/icons/yellow-dot.png" @drag="dragging($event, false, 'to')" />
              <gmap-polyline v-bind:path.sync="newpath" v-bind:options="{ strokeColor:'#008000'}"></gmap-polyline>
            </GmapMap>
        </div>

    </div>
</template>

<script>
import {gmapApi} from 'vue2-google-maps'
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
            fromLocation: null,
            toLocation: null,
            newpath: [],
            newpath2: [],
            distanceText: '',
            distanceValue: '',
            time: ''
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
            this.currentPlace = place;
            if (this.currentPlace.geometry) {
                const marker = {
                    lat: this.currentPlace.geometry.location.lat(),
                    lng: this.currentPlace.geometry.location.lng()
                };
                console.log(this.currentPlace.formatted_address)
                console.log(marker)
                this.toLocation = marker
                this.center = marker
                this.directions(this.fromLocation, this.toLocation, 'DRIVING')
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
                        self.time = response.routes[0].legs[0].duration.value / 3600;
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
    },
    mounted() {
        console.log('Component mounted.')
    },
}
</script>
