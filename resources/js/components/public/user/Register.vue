<template>
  <div class="wrapper-wide">
    <!-- <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading> -->

    <frontend-header></frontend-header>

    <div id="container">
      <div class="container">
        <!-- Breadcrumb End-->
        <div class="row">
          <!--Middle Part Start-->
          <div class="col-lg-3"></div>
          <div id="content" class="col-sm-12 col-lg-5">
            <div class="custom-box" style="height:auto;">
              <h2 class="title">Account Register</h2>
              <form @submit.prevent="register">
                <div class="form-group">
                  <label class="control-label" for="input-email">Name</label>
                  <input
                    type="text"
                    name="Name"
                    value
                    placeholder="EX:mohammod"
                    id="input-email"
                    class="form-control"
                    autocomplete="off"
                    autofocus
                    v-model="form.name"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                  />
                  <has-error :form="form" field="name"></has-error>
                </div>
                <div class="form-grop">
                  <label class="control-label" for="input-email">Mobile_no</label>
                  <input
                    type="text"
                    name="mobile_no"
                    placeholder="01xxx-xxxxx"
                    class="form-control"
                    autocomplete="off"
                    maxlength="11"
                    :class="{ 'is-invalid': form.errors.has('mobile_no') }"
                    v-model="form.mobile_no"
                  />
                  <has-error :form="form" field="mobile_no"></has-error>
                </div>
                <br />
                <div class="form-group">
                  <label class="control-label" for="input-password">Password</label>
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

                </div>
                <button :disabled="form.busy" class="btn btn-block btn-primary" type="submit">
                  <i class="fa fa-spinner fa-spin" v-if="form.busy"></i>REFGISTER
                </button>
                
                  <br />
                  <router-link :to="{name:'UserLogin'}">Login your account</router-link>
              </form>
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
    // setTimeout(()=>{
    //   this.isLoading=false;
    // },1500)
  },
  data() {
    return {
      form: new Form({
        name: "",
        mobile_no: "",
        password: "",
      }),
      pre_route: null,
      isLoading: true,
      fullPage: true,
    };
  },
  methods: {
    register() {
      this.form
        .post("/_public/userToRegister")
        .then((resp) => {
          // console.log(resp.data.status == "FAILD");

          if (resp.data.status == "SUCCESS") {
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
            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 2000,
            });
          }
        })
        .catch((error) => {
         // console.log(error);
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
    //  console.log();
      vm.pre_route = from.name;
    });
  },
  components:{
    Loading
  }
};
</script>