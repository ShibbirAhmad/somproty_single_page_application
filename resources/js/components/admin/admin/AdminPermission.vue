<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'admin' }" class="btn btn-primary"
            ><i class="fa fa-arrow-right"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Permissons</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Assign Permissions</h3>
              </div>
              <div class="box-body">
                <h1 v-if="loading"><i class="fa fa-spinner fa-spin"></i></h1>
                <form
                  v-else
                  @submit.prevent="update"
                  @keydown="form.onKeydown($event)"
                  enctype="multipart/form-data"
                >
                  <div class="alert-danger alert" v-if="error">
                    {{ error }}
                  </div>
                  <div class="form-group">
                    <label>Admin Name</label>
                    <input type="text" :value="admin_name" readonly class="form-control" />
                  </div>
                      
                   <h3><strong>PERMISSIONS LIST </strong> </h3> 
                    <div class="row">
                     
                      <div class="col-lg-3" v-for="permission in permissons" :key="permission.id">
                        
                       <label :for="'permission_'+permission.id">
                         <input :id="'permission_'+permission.id"  v-model="form.permissons_id" :value="permission.id" type="checkbox" >
                           {{permission.name}}
                        </label>
                    </div>
                    </div>
                    <br />
                  <button
                    :disabled="form.busy"
                    type="submit"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-spin fa-spinner" v-if="form.busy"></i>Submit
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>


<script>
import Vue from "vue";
import { Form, HasError, AlertError } from "vform";

Vue.component(HasError.name, HasError);
export default {
  name: "Add",
  created() {
    this.getPermissonList()
  },
  data() {
    return {
      form: new Form({
        permissons_id:[],
      }),
      admin_name:"",
      role:'',
      permissons:[],
     loading: true,
      error: "",
    };
  },

  methods: {

    getPermissonList(){
        axios.get('/api/get/admin/permission/list/'+this.$route.params.id )
        .then(resp =>{
            console.log(resp);
            if (resp.data.status == "OK") {
                this.admin_name = resp.data.admin_name[0].name;
                this.permissons.push(...resp.data.permissions) ;
                if (resp.data.admin_has_permissions_id.length) {
                    resp.data.admin_has_permissions_id.forEach(element => {
                       this.form.permissons_id.push(element);
                    });
                }
                this.loading=false ;
            }
        })
    },

   update(){
     this.form
     .post("/api/assign/admin/permissions/"+this.$route.params.id,{
           ternsformRequest:[ function(data, headers) {
             return objectToFormData(data);
           }],
     })
     .then(resp => { 
       console.log(resp);
       if (resp.data.status== "OK") {
         this.$toasted.show(resp.data.message,{
           type : 'success',
           duration: 4000,
           position:'top-center',
         });
         this.$router.push({name: 'admin'});
       }
     })
   }
   
},

}

</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}
</style>
