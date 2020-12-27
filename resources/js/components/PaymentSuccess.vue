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
      <br><br><br>
      <div class="col-md-12">
          <div class="card card-primary card-outline">
              <div class="card-header">
                  
              </div>
              <div class="card-body table-responsive">
                  <h4 style="text-align:center">Payment has been confirmed</h4>
                  <br><br>
                  <button @click="gotoIndex()" class="btn btn-primary btn-block">Go to Reservations</button>
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
        gotoIndex(){
            this.$router.push('/reservationList')
        }
    }
}
</script>

<style>

</style>