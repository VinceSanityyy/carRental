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
                     Your Cars
                  </h3>
                     <div class="pull-right">
                         <button data-toggle="modal" data-target="#exampleModal" @click="openCarModal" style="float:right" class="btn btn-primary">Add Car</button>
                     </div>
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
                             <span v-if="car.car_status === 1 " class="badge bg-danger">Booked</span>
                             <span v-else-if="car.car_status === 0" class="badge bg-success">Available for reservation</span>
                              <span v-else class="badge bg-warning">On repair/Maintenance</span>
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
                            <!-- <button @click="viewDetails" class="btn btn-primary btn-block">View Details</button> -->
                           <button @click="markAvailable(car.id)" class="btn btn-primary btn-block">Mark as Available</button>
                           <button :disabled="car.car_status == 1 || car.car_status == 2" @click="markUnavailable(car.id)" class="btn btn-danger btn-block">Mark as Unavailable</button>
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <CarModal :isEdit="this.hello" v-model="carModalOpen"></CarModal>
   </div>
</template>


<script>
import CarModal from '../components/CarModal';
export default {
    components:{
        CarModal
    },
    props:{
        isEdit: 'vince'
    },
    data(){
        return{
            carModalOpen: false,
            hello: 'hello',
            cars:[],
            disable: false
        }
    },
    computed:{
       isDisabled(){
          
       }
    },
    methods:{
        openCarModal(){
            console.log('asd')
            this.carModalOpen = !this.carModalOpen
        },
        disabled(item){
           console.log(item)
           if(item == 2 || item == 1){
              return true
           }else{
              return false
           }
        },
        getCars(){
           axios.get('/getCarsForOwner').then((res)=>{
              this.cars = res.data
           })
        },
        viewDetails(){
            toastr.success('wala pay function')
        },
        markUnavailable(id){
            // toastr.success('wala pay function')
            this.$alertify.confirm('Mark as unavailable/on maintenance?', ()=>{
               console.log(id)
               axios.post('/markAsUnavailable',{
                  id: id
               }).then((res)=>{
                  toastr.success('Marked as unavailable')
                  this.getCars()
               })
            })
        },
         markAvailable(id){
            // toastr.success('wala pay function')
            this.$alertify.confirm('Mark as available?', ()=>{
               console.log(id)
               axios.post('/markAsAvailable',{
                  id: id
               }).then((res)=>{
                  toastr.success('Marked as available')
                  this.getCars()
               })
            })
        }
    },
    created(){
       this.getCars()
       this.$root.$refs.Cars = this;
      //  console.log(this.disabled())
      
    }
}
</script>

<style>

</style>