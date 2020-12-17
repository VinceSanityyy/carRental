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
                          Users List
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

        }
    },
    methods:{

    },
    created(){

    }
}
</script>

<style>

</style>