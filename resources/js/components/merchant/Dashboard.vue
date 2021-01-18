<template>
    
<div>
  <navbar> </navbar> 

   <div class="content-wrapper">
       <section class="content-header">
        <h1>Summary overview</h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i> Home</a>
          </li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div  class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3> {{ orders.today_order }}</h3>

                  <p>Today Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col delivered -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3> {{ orders.total_delivered_order }} </h3>

                  <p>Delivered Orders</p>
                </div>
                <div class="icon">
                <i class="ion-android-done-all"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

              <!-- ./col delivered -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{  orders.total_order_items }}</h3>

                  <p> total ordered item </p>
                </div>
                <div class="icon">
                <i class="ion-android-done-all"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
              <!-- /total products -->
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3> {{ orders.total_order }} </h3>

                  <p>Total Orders</p>
                </div>
                <div class="icon">
                 <i class="ion-aperture"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
               <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3> {{ products.product_total}} </h3>

                  <p>Total products</p>
                </div>
                <div class="icon">
                  <i class="ion-android-home"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <!-- ./col  approved-->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3> {{ products.product_approved}} </h3>

                  <p>Approved products</p>
                </div>
                <div class="icon">
                 <i class="ion-android-checkbox"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
               <!-- ./col pending -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3> {{ products.product_pending}} </h3>

                  <p>Pending products</p>
                </div>
                <div class="icon">
                  <i class="ion-eye-disabled"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col cancel -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3> {{ orders.cancel_order }} </h3>

                  <p>Cancel Order</p>
                </div>
                <div class="icon">
                 <i class="ion-android-close"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
        

        </section>
   </div>
  <!-- Main content -->

</div>

    
</template>




<script >

import Vue from 'vue' ;
import navbar from './Navbar' ;
export default ({
    
    mounted(){
        console.log("Merchant dashboard mounted");
        this.DashboardData();
    },
    data() {
      return {
        products:"",
        orders:"",

      }
    },
    methods: {
      DashboardData(){

          axios.get('/api/get/merchant/dashboard/data')
          .then(resp => {
            console.log(resp);
            this.products=resp.data.products ;
            this.orders=resp.data.orders ;
          })

      }
    },
    components:{
       
        navbar
    }


    
})
</script>