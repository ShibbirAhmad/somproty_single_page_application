<template>
 <div>

    <div  class="container">
 
    <div  class="text-center">
      <h2 class="logo_mohasagor">
        <a>
          <b style="color: #000">Mohasagor</b>.com
        </a>
      </h2>
    </div>

     <div class="row">
      <div class="col-md-4 col-sm-12"> </div>
      <div class="col-md-4 col-sm-12 form_column bg-white">
        <div class="form-wrapper ">
            <h3 style="padding-top: 10px; text-align: center" >
               Update Password
            </h3>
              <form @submit.prevent="submit">
                <div class="form-grop">
                  <label class="control-label" for="input-email">New Password</label>
                  <input
                    type="password"
                    name="password"
                    placeholder="xxxxx"
                    class="form-control"
                    autocomplete="off"
                   :class="{ 'is-invalid': form.errors.has('password') }"
                    v-model="form.password"
                    autofocus />
                  <has-error :form="form" field="password"></has-error>
                </div>
                <br />
                
                <div class="form-group">
                  <button :disabled="form.busy" class="btn btn-block btn-primary" type="submit">
                  <i class="fa fa-spinner fa-spin" v-if="form.busy"></i>Update Password
                </button>
                </div>
              </form>
          </div>
      </div>
      <div class="col-md-4 col-sm-12"> </div>
    </div>

  
 </div>
 </div>
</template>

<script>
import Vue from "vue";
import { Form, HasError } from "vform";
import LoginVue from "../public/Login.vue";

Vue.component(HasError.name, HasError);

export default {
  created() {},
  data() {
    return {
       form: new Form({
        phone: "",
      }),
    };
  },
  methods: {
    submit() {
      this.form
        .post("/api/merchant/new/password/set/"+this.$route.params.phone)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
            this.$router.push({name:"merchant_login"});
          } else {
           this.$toasted.show(resp.data.message, {
              type: "error",
              position: "top-center",
              duration: 3000,
            });
          }
        })
        .catch((error) => {
          console.log(error);
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 2000,
          });
        });
    },
  },
};

document.addEventListener("DOMContentLoaded", () => {
  let sidebar = document.getElementsByClassName("main-sidebar")[0];
  let footer = document.getElementsByClassName("main-footer")[0];
  if (
    window.location.href == "http://127.0.0.1:8000/merchant/backend/login"
  ) {
    sidebar.classList.add("none");
    footer.classList.add("none");
  }
});
</script>
<style >
.none {
  display: none !important;
}


.form-wrapper {
   
    margin: 0px 10px;
 
}

.form_column{
     margin-bottom: 20px;
     box-shadow: 1px 1px 5px 1px #2e2e2e;
}

.btn_group{
    margin-bottom: 16px;
    margin-top: 10px;
}

.logo_mohasagor{
  margin-top: 50px;
  margin-bottom: 5px !important;
}

.btn_register{
  background:#00acd6;
  color:#fff;
}
</style>
