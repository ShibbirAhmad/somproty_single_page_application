<template>
  <div class="wrapper-wide">
    <!-- <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading> -->

    <frontend-header></frontend-header>

    <div id="container">
      <div class="container">
      
        <div class="row user-content ">
         
       <div class=" col-lg-2 col-md-2 col-sm-2 text-white bg-success user-side-bar ">
   
      
        <sidebar></sidebar>
    
    </div>
<div class="col-lg-2"></div>
      <div class="col-lg-4 col-md-4 col-sm-4 bg-white shadow" style="margin-bottom:10px;">

              <div  class="card">
                   <div class="card-heading text-center ">
                       <h4 class="card-title">Change your password </h4>
                  </div>
                  <div class="card-body" style="margin-top:20px;padding:50px;">
                      <form @submit.prevent="changePassword" class="form">

                          <div  class="form-group ">
                                <label for="old_password">Current password</label>
                                <input type="password" v-model="form.old_password" :class="{'is-invalid' : form.errors.has('old_password') }" name="old_paasword" autofocus autocomplete="off" placeholder="your current password" class="form-control" id="">
                                <has-error :form="form" field="old_password "> </has-error>
                          </div>

                          <div class="form-group">
                                <label for="old_password">New password</label>
                                <input type="password" v-model="form.new_password" :class="{'is-invalid' : form.errors.has('new_password') }" name="new_paasword" autofocus autocomplete="off" placeholder=" new password" class="form-control" id="">
                                <has-error :form="form" field="new_password "> </has-error>
                          </div>

                              <button :disabled="form.busy" class="btn btn-info btn-block" type="submit"> <i class="fa fa-spiner" v-if="form.busy"></i> Change</button> 
                      </form>
                      
                  </div>
              </div>    
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
import {Form, HasError} from "vform" ;
export default {
    mounted(){

        console.log("customer dashboard mounted");
    },

    data(){
        return{
        
        form : new Form({
             old_password : '',
             new_password : '',
        }),

        }
    },

    methods: {

  changePassword(){
             this.form.post("/_public/user/password/update",{
                  ternsfromRequest :[
                      function(data , headers){
                          return objectToFormData(data);
                      }
                  ]
             })
             .then(resp => {
                 if (resp.data.success == "OK") {
                     alert(resp.data.message);
                     this.$router.push({ name: 'UserDashboard'});
                 }else{
                     alert(resp.data.message); 
                 }
             })
             .catch() 
               
           } 
    },
    components:{
        sidebar
    }
}
</script>