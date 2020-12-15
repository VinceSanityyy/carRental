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
                          Payment List
                      </h3>
                  </div>
                  <div class="card-body table-responsive">
                      <table id="mytable" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                    <th>Paypal Transaction #</th>
                                    <th>Payer Email</th>
                                    <th>Amount</th>
                                    <th>Reservation ID</th>
                                    <th>Customer Name</th>
                                    <th>Payment Status</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="payment in payments" :key="payment.id">
                                    <td>{{payment.payment_id}}</td>
                                    <td>{{payment.payer_email}}</td>
                                    <td>{{payment.amount}} Php</td>
                                    <td>{{payment.reservation_id}}</td>
                                    <td>{{payment.name}}</td>
                                  <td>
                                      <span class="badge bg-success" v-if="payment.payment_status == 'approved'">Recieved</span>
                                      <span class="badge bg-warning" v-else>Pending</span>
                                  </td>
                                  <!-- <td>
                                      <button @click="viewDetails(reservation.id)" class="btn btn-primary">View Details</button>
                                  </td> -->
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
            payments:[]
        }
    },
    methods:{
        getPayments(){
            axios.get('/getPaymentList').then((res)=>{
                this.payments = res.data
                this.myTable()
            })
        },
        myTable(){
            $(document).ready(function(){
                $('#mytable').DataTable()
            })
        }
    },
    created(){
        this.getPayments()
    }
}
</script>

<style>

</style>