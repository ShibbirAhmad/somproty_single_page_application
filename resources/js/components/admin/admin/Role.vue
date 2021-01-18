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
          <li class="active">Role</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Add Admin</h3>
              </div>
              <div class="box-body">
                <h1 v-if="loading"><i class="fa fa-spinner fa-spin"></i></h1>
                <form
                  v-else
                  @submit.prevent="add"
                  @keydown="form.onKeydown($event)"
                  enctype="multipart/form-data"
                >
                  <div class="alert-danger alert" v-if="error">
                    {{ error }}
                  </div>
                  <div class="form-group">
                    <label>Admin Name</label>
                    <input
                      type="text"
                      :value="admin.name"
                      class="form-control"
                    />
                  </div>

                  <h3><strong>ROLE LIST </strong></h3>
                  <div class="row">
                    <div class="col-lg-3" v-for="role in roles" :key="role.id">
                      <label :for="'role' + role.id">
                        <input
                          :id="'role' + role.id"
                          v-model="form.role"
                          :value="role.id"
                          type="checkbox"
                        />
                        {{ role.name }}
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
    this.getAdminRole();
  },
  data() {
    return {
      form: new Form({
        role: [],
      }),

      loading: true,
      error: "",
      admin: "",
      roles: [],
    };
  },

  methods: {
    add() {
      console.log("add");
      this.form
        .post("/api/role/update/admin/" + this.$route.params.id)
        .then((resp) => {
          console.log(resp);
          if (resp.data) {
            this.$router.push({ name: "admin" });
            this.$toasted.show(resp.data, {
              type: "success",
              position: "top-right",
              duration: 4000,
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
    getAdminRole() {
      axios
        .get("/api/role/get/admin/" + this.$route.params.id)
        .then((resp) => {
          if (resp.data) {
           this.admin = resp.data.admin, 
            this.roles.push(...resp.data.roles);

              if(resp.data.admin_roles.length){
                resp.data.admin_roles.forEach(element => {
                 this.form.role.push(element);
                });
              }
          
            this.loading = false;
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
  computed: {},
};
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}
</style>
