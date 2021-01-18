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
                }" >
               
            </div>
      </div>

     <div class="row">
            <div class="col-sm-12 col-md-12"> 
              <div style="background-color:#eee" class="container-fluid ">
                <div style="margin-top:20px;" class="container">   
                  <div class="box bg-white shadow desc_info"> 
                  <h4 style="padding:15px" class="heading" > <i class="fa fa-eye"></i><b> RETURN POLICY</b>   </h4>    
                  <p v-html="return_policy" ></p>
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
    this.getReturnPolicy();
  },
  data(){
    return {
      isLoading: true,
      return_policy:"",
      fullPage: true,
    }
  },
  methods:{
      
     getReturnPolicy(){
         
         axios.get('/_public/api/get/info/order/return/shipment')
         .then(resp=>{
           console.log(resp);
           if (resp.data.status=="OK") {
             this.return_policy=resp.data.setting.return_policy ;
             this.isLoading=false;
           }
         })
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
      padding-bottom:20px;
  }
</style>