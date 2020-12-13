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
                    Select your Car
                  </h3>
               </div>
               <br>           
               <div class="card-body">
                  <div class="row">
                     <div v-for="car in cars" :key="car.id" class="col-md-4">
                     <div class="card card-widget widget-user">
                        <div class="widget-user-header text-white" :style="'background: url('+car.image_link+');background-repeat:no-repeat; background-size:contain;'">
                        </div>
                        <div class="card-footer">
                            <h4 style="text-align:center">{{car.model}}</h4>
                           <div class="row">
                              <div class="col-sm-12 border-right">
                                 <div  class="description-block">
                                    <h5 class="description-header">Plate No</h5>
                                    <span class="description-text">{{car.plate_no}}</span>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-6 border-right">
                                 <div class="description-block">
                                    <h5 class="description-header">Reservation Fee</h5>
                                    <span class="description-text">{{car.reservation_fee}}</span>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="description-block">
                                    <h5 class="description-header">Price per Day</h5>
                                    <span class="description-text">{{car.pricePerDay}}</span>
                                 </div>
                              </div>
                           </div>
                            <button @click="selectCar(car.id)" class="btn btn-primary btn-block">Select Car</button>
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>


<script>
import alertify from 'alertifyjs';
export default {
    data(){
        return{
            cars:[],
            storage:[]
        }
    },
    methods:{
        openCarModal(){
            console.log('asd')
            this.carModalOpen = !this.carModalOpen
        },
        getCars(){
           axios.get('/getCars').then((res)=>{
              this.cars = res.data
           })
        },
        selectCar(id){
            var self = this
            console.log(id)
            console.log('asd')
            this.$alertify.confirm(
            'Do you want to select this car?',
            ()=> {
                console.log('ok')
                var bodyForm = JSON.parse(localStorage.getItem('resDetails'))
                axios.post('/confirmReservation',{
                    car_id: id,
                    bodyForm
                }).then((res)=>{
                    console.log(res)
                    //  localStorage.clear()
                })
               
            },
            ()=>console.log('no')
            )
        }
    },
    created(){
       this.getCars()
    }
}
</script>

<style>

</style>