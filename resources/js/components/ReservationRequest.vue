<template>
    <div class="content">
      <div class="content-header">
          <div class="container-fluid">
              <!-- <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-2 text-dark">
                          My Reservations
                      </h1>
                  </div>
              </div> -->
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="card card-primary card-outline">
                  <div class="card-header">
                      <h3 class="card-title">
                          Car Reservation Request
                      </h3>
                  </div>
                  <div class="card-body table-responsive">
                      <table id="mytable" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                    <th>Reservation Id</th>
                                    <th>Customer Name</th>
                                    <th>Reservation Fee</th>
                                    <th>Customer Phone</th>
                                    <th>Reservation Status</th>
                                    <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="res in reservationReq" :key="res.id">
                                    <td>{{res.reservation_id}}</td>
                                    <td>{{res.email}}</td>
                                    <td>{{res.reservation_fee}} Php</td>
                                    <td>{{res.phone}}</td>
                                    <td>
                                    <span class="badge bg-success" v-if="res.status == 1">Approved</span>
                                    <span class="badge bg-warning" v-else>Pending</span>
                                    </td>
                                  <td>
                                      <button @click="markAsApproved(res.reservation_id)" class="btn btn-primary">Mark as approved</button>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
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
            reservationReq:[]
        }
    },
    methods:{
        getReservationReq(){
            axios.get('/getReservationRequest').then((res)=>{
                this.reservationReq = res.data
                this.myTable()
            })
        },
        myTable(){
            $(document).ready(function(){
                $('#mytable').DataTable()
            })
        },
        markAsApproved(id){
            console.log(id)
            axios.post('/approveReservation',{
                reservation_id:id
            }).then((res)=>{
                console.log(res)
                toastr.success('Okay')
                 this.getReservationReq()
            })
        }
    },
    created(){
        this.getReservationReq()
    }
}
</script>

<style>

</style>