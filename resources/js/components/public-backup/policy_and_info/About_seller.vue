<template>
  <div >
        <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading>

    <frontend-header></frontend-header>
      <div class="row text-center">
            <div :style="{
                height: '300px',
                marginTop: '-10px',
                backgroundImage: 'url(/public/images/background.jpg)',
                backgroundPosition: 'center center',
                backgroundSize: 'cover'
                }" class="background_image">
               
            </div>
      </div>

     <div class="row">
            <div class="col-sm-12 col-md-12"> 
              <div style="background-color:#eee" class="container-fluid ">
                <div style="margin-top:20px;" class="container">   
                  <div class="box bg-white shadow desc_info"> 
                  <h4 style="padding:15px" class="heading" > <i class="fa fa-eye"></i><b>About Seller</b>   </h4>    
                     <p> নতুন সেলার পার্টনার হওয়ার জন্য যোগাযোগ করুন: </p> 
                       
                        <p style="padding-bottom:20px;">  
                        01945 393 889 বা 01618 20 60 20
                        mohasagor.com এর কার্যালয়: Office: House:02, Lane:11,Block:A, Banaroshi Polli, section-10,
                          Mirpur,Dhaka. </p>

                 </div>
                </div>
              </div>    
            </div>
          </div>
          
    <frontend-footer></frontend-footer>>
  </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  created(){

    setTimeout(()=>{
      this.isLoading=false;
    },1000)
  },
  data(){
    return {
      isLoading: true,
      fullPage: true,
    }
  },
  components:{
Loading
  }
}
</script>

<style >
  .desc_info p {

      padding:5px;
      margin:10px;
      padding-bottom:5px;
  }
</style>