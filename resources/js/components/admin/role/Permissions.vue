<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'role' }" class="btn btn-primary"
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
                <h3 class="box-title">Edit Role Permissions</h3>
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
                    <label>Role Name</label>
                    <input type="text" :value="role.name" readonly class="form-control" />
                  </div>
                      
                      <h3><strong>PERMISSIONS LIST </strong></h3>
                    <div class="row">
                     
                      <div class="col-lg-3" v-for="permission in permissons" :key="permission.id">

                       <label :for="'permission_'+permission.id">
                         <input :id="'permission_'+permission.id" v-model="form.permissons_id"   :value="permission.id" type="checkbox" >
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

      role:'',
      permissons:[],
      role_has_permissons:[],
     loading: true,
      error: "",
    };
  },

  methods: {

    getPermissonList(){
      axios.get('/api/permissions/edit/role/'+this.$route.params.id)
      .then(resp=>{
        console.log(resp.data.role_has_permissons)
        this.role=resp.data.role;
        this.permissons.push(...resp.data.permissons)
           
           if(resp.data.role_has_permissons.length){
              resp.data.role_has_permissons.forEach(element => {
                  this.form.permissons_id.push(element)
              });
            }
           
        this.loading=false;    
      })
      .catch(error=>{
        console.log(error);
      })
    },

    update() {
   
      this.form
        .post("/api/permissions/update/role/"+this.$route.params.id)
        .then((resp) => {
          if (resp.data) {
            this.$router.push({name:"role"})
            this.$toasted.show(resp.data, {
              type: "success",
              position: "top-right",
              duration: 3000,
            });
          } else {
            this.error = "some thing want to wrong";
          }
        })
        .catch((error) => {
          console.log(error);
          this.error = "some thing want to wrong";
        });
    },
  },
}
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}
</style>
