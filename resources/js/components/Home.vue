<template>
    <div class="container">
                  <gmap-autocomplete class="introInput" >
                    <template v-slot:input="slotProps">
                        <v-text-field outlined
                                      prepend-inner-icon="place"
                                      placeholder="Location Of Event"
                                      ref="input"
                                      v-on:listeners="slotProps.listeners"
                                      v-on:attrs="slotProps.attrs"
                                      v-model="from">
                        </v-text-field>
                    </template>
                </gmap-autocomplete>
                   <gmap-autocomplete class="introInput" >
                    <template v-slot:input="slotProps">
                        <v-text-field outlined
                                      prepend-inner-icon="place"
                                      placeholder="Location Of Event"
                                      ref="input"
                                      v-on:listeners="slotProps.listeners"
                                      v-on:attrs="slotProps.attrs"
                                      v-model="to">
                        </v-text-field>
                    </template>
                </gmap-autocomplete>
        <div class="row justify-content-center">
            <GmapMap
            :center="{lat:7.0720, lng:125.6132}"
            :zoom="14"
            map-type-id="roadmap"
            style="width: 500px; height: 300px"
            />
        </div>
    </div>
</template>

<script>
import {gmapApi} from 'vue2-google-maps'
    export default {
        data(){
            return{
                from:'',
                to:''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>
