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
            <h4 style="padding-top: 10px; text-align: center" >
               Merchant Registration
            </h4>
            <form @submit.prevent="Register">
              <div class="form-group">
                <label class="form-label" for="input-email">Name</label>
                <input
                  type="text"
                  name="Name"
                  placeholder="EX:mohammod"
                  id="input-email"
                  class="form-control"
                  autocomplete="off"
                  v-model="form.name"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                  placeholder="write your email"
                  autofocus
                  v-model="form.email"
                  type="text"
                  name="email"
                  id=""
                />
                <has-error :form="form" field="email"> </has-error>
              </div>

              <div class="form-grop">
                <label class="form-label" for="input-email">Mobile_no</label>
                <input
                  type="text"
                  name="phone"
                  placeholder="01xxx-xxxxx"
                  class="form-control"
                  autocomplete="off"
                  maxlength="11"
                  :class="{ 'is-invalid': form.errors.has('phone') }"
                  v-model="form.phone"
                />
                <has-error :form="form" field="phone"></has-error>
              </div>
       
              <div class="form-group">
                <label for="company_name">Company Name</label>
                <input
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('company_name') }"
                  placeholder="write your company_name"
                  autofocus
                  v-model="form.company_name"
                  type="text"
                  name="company_name"
                />
                <has-error :form="form" field="company_name"> </has-error>
              </div>
              <div class="form-group">
                <label for="address">Write Address</label>

                <textarea
                  name="address"
                  :class="{ 'is-invalid': form.errors.has('address') }"
                  placeholder="type address details"
                  class="form-control"
                  v-model="form.address"
                  rows="3"
                ></textarea>
                <has-error :form="form" field="address"> </has-error>
              </div>
              <div class="form-group">
                <label class="form-label" for="input-password"
                  >Password</label
                >
                <input
                  type="password"
                  name="password"
                  value
                  placeholder="Password"
                  id="input-password"
                  class="form-control"
                  autocomplete="off"
                  :class="{ 'is-invalid': form.errors.has('password') }"
                  v-model="form.password"
                />
                <has-error :form="form" field="password"></has-error>

                <br />
                <button
                  :disabled="form.busy"
                  class="btn btn-block btn_register"
                  type="submit"
                >
                  <i class="fa fa-spinner fa-spin" v-if="form.busy"></i>REGISTER
                </button>
              </div>
              <a
                style="background: #367fa9; color: #fff"
                class="btn btn-block"
               href="/merchant/backend/login"
                >Login
              </a>
              <br/>

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
        name: "",
        email: "",
        address: "",
        company_name: "",
        phone: "",
        password: "",
      }),
    };
  },
  methods: {
    Register() {
      this.form
        .post("/api/merchant/register", {
          transformRequest: [
            function (data, headers) {
              return objectToFormData(data);
            },
          ],
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "OK") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 8000,
            });
            this.$router.push({ name: "welcome" });
            location.reload();
          }
        })
        .catch();
    },
  },
};

document.addEventListener("DOMContentLoaded", () => {
  let sidebar = document.getElementsByClassName("main-sidebar")[0];
  let footer = document.getElementsByClassName("main-footer")[0];
  if (
    window.location.href == "http://127.0.0.1:8000//merchant/panel/login/view"
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
}

.logo_mohasagor{
  margin-top: 30px;
  margin-bottom: 5px !important;
}

.btn_register{
  background:#00acd6;
  color:#fff;
}
</style>
