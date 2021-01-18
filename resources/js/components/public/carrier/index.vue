<template>
  <div class="wrapper-wide">
      
    <frontend-header></frontend-header>
    <div id="container">
      <div class="container">

         <div  class="row carrier">
          
           <div v-for="(carrier,index) in carriers " v-bind:key="index"  class="col-md-6 col-lg-6 col-sm-6">
             <div class="job-content bg-white shadow">
              <h4 style="margin-top:20px;"> <router-link class="routeStyle" :to="{name : 'carrier_details' , params:{id:carrier.id}}" > {{ carrier.title }} </router-link> </h4>
              <p> <i class="fa fa-briefcase"></i> vacency : {{ carrier.vacency }} </p> 
              <p> <i class="fa fa-map-marker" aria-hidden="true"></i> Mirpur-10,Dhaka </p> 
              <p> <i class="fa fa-calendar" aria-hidden="true"></i>  Deadline : {{ carrier.deadline }} </p> 
             </div>
             
          </div>
          

         </div>
      </div>
    </div>

    <frontend-footer></frontend-footer>
  </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {

        created(){
           this.getCarrierList();
        },

        data(){
          return {
            preview_image : "",
            carriers: "",
          }

        },
        methods:{
 
          getCarrierList(){
            axios.get('/_public/carrier/list')
            .then(resp => {
              if (resp.data.success == "OK") {
                this.carriers = resp.data.carriers ;
              }
            })
            .catch()
          },
        },
        components:{


      Loading
        }
      }
</script>


<style>

    .contact-li{ list-style-type:none ;
              
                 margin-top:10px;
                 }
    .routeStyle:hover{
        color : rgb(241, 150, 13) ;
    }   

    .job_container {
      width:100%;
      height: 170px;
      background-color: #ddd;
      border: 2px solid pink;
      border-radius: 10px;
      margin:10px;
    } 
    .job-content{
      margin-bottom:5px ;
      padding: 10px 50px;
    }

</style>