<template>
  <div class="wrapper-wide">
    <!-- <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading> -->

    <frontend-header></frontend-header>

    <div id="container">
      <div class="container">
        <!-- Breadcrumb End-->
        <div class="row text-center ">
           <h4 class="heading"> Welcome to your buying activity </h4> 
        </div>
        
        <div class="row user-content ">
         
       <div class=" col-lg-2 col-md-2 col-sm-2 text-white bg-success user-side-bar ">
   
      
        <sidebar></sidebar>
    
    </div>

      <div class="col-lg-8 col-md-8 col-sm-8">

      </div>

       <div class="col-lg-2 col-md-2 col-sm-2">

      </div>


      </div>
    </div>
    <frontend-footer></frontend-footer>
  </div>
  </div>
  
</template>

<script>

import sidebar from "./Sidebar";

export default {
    mounted(){

        console.log("customer dashboard mounted");
    },

    data(){
        return{


        }
    },

    methods: {


    },
    components:{
        sidebar
    }
}
</script>