<template>
  <div class="content">
      <div class="content-header">
          <div class="container-fluid">

          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="card card-primary card-outline">
                  <div class="card-header">
                      <h3 class="card-title">
                          Reservation Details
                      </h3>
                  </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-6">
                              <h6>Pickup address</h6>
                          </div>
                           <div class="col-md-6">
                              <h6>{{reservationDetails.locationFrom}}</h6>
                          </div>

                            <div class="col-md-6">
                              <h6>Destination</h6>
                          </div>
                            <div class="col-md-6">
                              <h6>{{reservationDetails.locationTo}}</h6>
                          </div>
                          
                            <div class="col-md-6">
                              <h6>Total distance</h6>
                          </div>
                            <div class="col-md-6">
                              <h6>{{reservationDetails.totalDistance}}</h6>
                          </div>
                          
                            <div class="col-md-6">
                              <h6>Estimated travel duration</h6>
                          </div>
                            <div class="col-md-6">
                              <h6>{{reservationDetails.estimatedDuration}}</h6>
                          </div>
                          <br><br>
                            <div class="col-md-12">
                                <h5 style="text-align:center">Car Details</h5>
                            </div>      
                            <br><br>                
                            <div class="col-md-3">
                              <h6>Car Model</h6>
                          </div>
                            <div class="col-md-3">
                              <h6>{{reservationDetails.car.model}}</h6>
                          </div>
                                                    
                            <div class="col-md-3">
                              <h6>Plate Number</h6>
                          </div>
                            <div class="col-md-3">
                              <h6>{{reservationDetails.car.plate_no}}</h6>
                          </div>
                                                                              
                            <div class="col-md-3">
                              <h6>Reservation Fee</h6>
                          </div>
                            <div class="col-md-3">
                              <h6>{{reservationDetails.car.reservation_fee}} Php</h6>
                          </div>
                                                                              
                            <div class="col-md-3">
                              <h6>Price per day</h6>
                          </div>
                            <div class="col-md-3">
                              <h6>{{reservationDetails.car.pricePerDay}} Php</h6>
                          </div>
                      </div>
                  </div>
                  <div class="card-footer">
                      <button @click="payReservation(reservationDetails.car.reservation_fee)" class="btn btn-primary btn-block">Pay reservation fee</button>
                       <button class="btn btn-danger btn-block">Cancel reservation</button>
                       <br><br>
                       <small>Payment is non refundable</small>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            reservationId: this.$route.query.reservationId,
            reservationDetails:[]
        }
    },
    methods:{
        getDetails(){
            axios.get('/getReservationDetails?id='+this.reservationId).then((res)=>{
                this.reservationDetails = res.data
                console.log(res.data)
                // console.log(this.reservationDetails)
            })
        },
        payReservation(amount){
            this.$alertify.confirm('Confirm reservation payment amount: ' + amount, ()=>{
                console.log(amount)
                let loader = this.$loading.show({
                    container: this.fullPage ? null : this.$refs.formContainer,
                    onCancel: this.onCancel,
                    color: '#c91010',
                    loader: 'bars',
                    width: 80,
                    height: 100,
                })
               
                axios.post('/charge',{
                    amount: amount,
                    reservation_id: this.reservationId
                }).then((res)=>{
                    loader.hide()
                    console.log(res)
                    window.location.href = res.data
                })
            })
        }
    },
    created(){
        this.getDetails()
        console.log(this.$route.query.reservationId)
    }
}
</script>

<style>

</style>