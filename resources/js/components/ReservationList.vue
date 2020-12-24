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
                          Reservation List
                      </h3>
                  </div>
                  <div class="card-body table-responsive">
                      <table id="mytable" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                    <th>Reservation ID</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="reservation in reservations" :key="reservation.id">
                                  <td>{{reservation.id}}</td>
                                  <td>
                                      <span class="badge bg-warning" v-if="reservation.status == 0">Waiting for Payment</span>
                                      <span class="badge bg-danger" v-else-if="reservation.status == 2">Cancelled</span>
                                      <span class="badge bg-success" v-else>Payment Done</span>
                                  </td>
                                  <td>
                                      <button @click="viewDetails(reservation.id)" class="btn btn-primary">View Details</button>
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
            reservations: []
        }
    },
    methods:{
        getReservations(){
            axios.get('/getReservations').then((res)=>{
                this.reservations = res.data
                console.log(res.data)
                this.myTable()
            })
        },
        myTable(){
            $(document).ready( function () {
                $('#mytable').DataTable();
            });
        },
        viewDetails(id){
            this.$router.push('/reservationInfo?reservationId='+id)
        }
    },
    created(){
        this.getReservations()
    }
}
</script>

<style>

</style>