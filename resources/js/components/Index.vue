<template>
  <div class="content" >
      <div class="row" style="overflow-y:hidden;">
          <div class="col-md-12">
              <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="1000">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active test ">
                    <img style="width: auto; height: 700px;"  class="d-block w-100" src="https://wallpaperstock.net/lamborghini-aventador-taillight-wallpapers_36681_1366x768.jpg" alt="First slide">
                   
                    <div class="carousel-caption d-none d-md-block" style="    ;top: 30%;height: auto;max-height: 120px; color:black">
                    <h1>CarTal</h1>
                    <p>Luxury cars at less</p>
                    </div>
                    </div>
                    <div class="carousel-item test ">
                    <img style="width: auto; height: 700px; " class="d-block w-100" src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1500&q=80" alt="Second slide">
                   <div class="carousel-caption d-none d-md-block" style="    ;top: 30%;height: auto;max-height: 120px; color:black">
                    <h1>CarTal</h1>
                    <p>Luxury cars at less</p>
                    </div>
                    </div>
                    <div class="carousel-item test ">
                    <img style="width: auto; height: 700px;" class="d-block w-100" src="https://images.unsplash.com/photo-1562911791-c7a97b729ec5?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1408&q=80" alt="Third slide">
                   <div class="carousel-caption d-none d-md-block" style="top: 30%;height: auto;max-height: 120px; color:black">
                    <h1>CarTal</h1>
                    <p>Luxury cars at less</p>
                    </div>
                    </div>
                </div>
                <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a> -->
                </div>
          </div>
      </div>
      
      <div style="text-align:center">
          <br><br>
        <h1>CarTal</h1>
        <p>Luxury cars at less</p>
      </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>
@media (min-width: 200px) {
  div.test > img{ height: 300px !important ;}
}

@media (min-width: 300px) {
  div.test > img{ height: 300px !important; }
}

@media (min-width: 400px) {
  div.test > img{ height: 300px !important; }
}
@media (min-width: 600px) {
  div.test > img{ height: 400px !important ;}
}
@media (min-width: 800px) {
  div.test > img{ height: 600px !important ; }
}
</style>