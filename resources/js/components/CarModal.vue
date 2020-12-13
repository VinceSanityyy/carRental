<template>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{isEdit}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Car Model</label>
                    <input v-model="model" type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Car Brand</label>
                    <input v-model="brand" type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                </div>
              </div>

               <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Plate No.</label>
                    <input v-model="plateno" type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                </div>
              </div>
               <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Reservation Fee</label>
                    <input v-model="reservationfee" type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                </div>
              </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Price Per Day</label>
                    <input v-model="priceperday" type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                </div>
              </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Primary Image</label>
                    <input @change="onFileChange" type="file" class="form-control" id="exampleInputEmail1" placeholder="">
                </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" @click="addCar" class="btn btn-primary">Add Car</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
    name: 'CarModal',
    props:{
        isEdit:String
    },
    data(){
      return{
      image:'',
      reservationfee:'',
      model:'',
      priceperday:'',
      brand:'',
      plateno:''
      }
    },
    methods:{
      onFileChange(e) {
        let file = e.target.files[0];
        this.image = file
      },
      addCar(){
        var bodyForm = new FormData()
        bodyForm.append('brand', this.brand)
        bodyForm.append('model', this.model)
        bodyForm.append('image', this.image)
        bodyForm.append('plate_no', this.brand)
        bodyForm.append('pricePerDay', this.priceperday)
        bodyForm.append('reservation_fee', this.reservationfee)

        console.log('Axios')
        axios.post('/addCar',bodyForm).then((res)=>{
          $('#exampleModal').modal('hide')
          toastr.success('Success')
          console.log(res)
          this.$root.$refs.Cars.getCars();
        })
      },
      getCars(){
           axios.get('/getCars').then((res)=>{
              this.cars = res.data
        })
      }
    },
    created(){
        console.log(this.isEdit)
        this.getCars()
    }
}
</script>

<style>

</style>