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
                      <table id="mytable" class="table table-bordered table-striped table-responsive">
                          <thead>
                              <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Registered As</th>
                                    <th>Proof</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="user in users" :key="user.id">
                                  <td>{{user.name}}</td>
                                  <td>{{user.email}}</td>
                                  <td>{{user.phone}}</td>
                                  <td>
                                      <span class="badge bg-info" v-if="user.role == 1">Customer</span>
                                      <span class="badge bg-secondary" v-else>Car Owner</span>
                                  </td>
                                  <td>
                                      <button data-toggle="modal" data-target="#exampleModal" @click="viewPhoto(user.image_link)" class="btn btn-primary">View Submitted Photo</button>
                                  </td>
                                  <td>
                                      <span class="badge bg-warning" v-if="user.status == 0">Pending</span>
                                      <span class="badge bg-success" v-else>Approved</span>
                                  </td>
                                  <td>
                                      <button @click="viewDetails(user.id)" class="btn btn-primary">Accept Account</button>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      <!-- modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Picture Submitted</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img :src='imageModal' class="img-fluid" alt="Responsive image" style="display: block; margin-left: auto; margin-right: auto; width: 50%;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
    <!-- modal  -->
  </div>
</template>

<script>
export default {
    data(){
        return{
            users:[],
            imageModal:''
        }
    },
    methods:{
        getUsers(){
            axios.get('/getUsers').then((res)=>{
                this.users = res.data
                console.log(res)
                this.myTable()
            })
        },
        myTable(){
            $(document).ready(function(){
                $('#mytable').DataTable()
            })
        },
        viewDetails(id){
            console.log(id)
            this.$alertify.confirm('Confirm User?',()=>{
                axios.post('/approveUser',{
                    id: id
                }).then((res)=>{
                this.getUsers()
                toastr.success('User Accepted!')
                })
            })
        },
        viewPhoto(link){
            console.log(link)
            this.imageModal = link
        }
    },
    created(){
        this.getUsers()
    }
}
</script>

<style>

</style>