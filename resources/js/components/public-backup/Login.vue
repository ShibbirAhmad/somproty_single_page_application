<template>
  <div class="wrapper-wide">
    <div>
    <frontend-header></frontend-header>

    <div id="container">
      <div class="container">
        <!-- Breadcrumb End-->
        <div class="row">
          <div class="col-lg-3"></div>
          <div id="content" class="col-sm-10 col-lg-5">
            <div class="custom-box" style="height:auto">
              <h2 class="title">welcome back</h2>
              <form @submit.prevent="login">
                <div class="form-group">
                  <label class="control-label" for="input-email">Email</label>
                  <input
                    type="text"
                    name="email"
                    placeholder="example@gmail.com"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                    v-model="form.email"
                    autofocus
                  />
                  <has-error :form="form" field="email"></has-error>
                </div>
              
                <div class="form-group">
                  <label class="control-label" for="input-password">Password</label>
                  <input
                    type="password"
                    name="password"
                    v-model="form.password"
                    placeholder="Password"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password') }"
                   
                  />
                  <has-error :form="form" field="password"></has-error>

                  <br/>

                  <router-link  :to="{name:'UserPasswordReset'}">Forget Password</router-link>
              </div>
               <button :disabled="form.busy" class="btn btn-block btn-primary" type="submit">
                  <i class="fa fa-spinner fa-spin" v-if="form.busy"></i>LOGIN
                </button>
                 </form>
                <br>
                <br>
                    Don't have an account?   <router-link  :to="{name:'UserRegister'}"> Register here</router-link>

               </div>
                
              
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
import { Form, HasError } from "vform";

export default {
  created() {
    // setTimeout(() => {
    //   this.isLoading = false;
    // }, 1500);
  },
  data() {
    return {
      form: new Form({
        email: "",
        password: "",
      }),
      pre_route: null,
      isLoading: true,
      fullPage: true,
    };
  },
  methods: {
    login() {
      this.form
        .post("/_public/userToLogin")
        .then((resp) => {
          if (resp.data.status == "SUCCESS") {
            console.log(resp)
            localStorage.setItem("user_token", resp.data.token);
            this.$store.dispatch("user");

            if (this.pre_route == "Chekout") {
              this.$router.push({ name: "Chekout" });
            } else {
              this.$router.push({ name: "welcome" });
            }
            
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
          } else {
            this.$toasted.show(
              "Your given credintial don not match our records",
              {
                type: "error",
                position: "top-center",
                duration: 2000,
              }
            );
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

  beforeRouteEnter(to, from, next) {
    next((vm) => {
      console.log();
      vm.pre_route = from.name;
    });
  },
  components: {
    Loading,
  },
};
</script>