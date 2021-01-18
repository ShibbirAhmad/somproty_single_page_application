<template>
  <div class="wrapper-wide">
    <!-- <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading> -->

    <frontend-header></frontend-header>

    <div id="container">
      <div class="container">
        <!-- Breadcrumb End-->
        <div class="row">
          <div class="col-lg-3"></div>
          <div id="content" class="col-sm-12 col-lg-5">
            <div style="margin-top:50px;" class="custom-box ">
              <h4 class="title">Password Forgotten </h4>
              <form @submit.prevent="resetPassword">
                <div class="form-grop">
                  <label class="control-label" for="input-email">your Email</label>
                  <input
                    type="email"
                    name="email"
                    placeholder="exampole@gmail.com"
                    class="form-control"
                    autocomplete="off"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                    v-model="form.email"
                    autofocus
                  />
                  <has-error :form="form" field="email"></has-error>
                </div>
                <br />
                 
                <button :disabled="form.busy" class="btn btn-block btn-primary" type="submit">
                  <i class="fa fa-spinner fa-spin" v-if="form.busy"></i>Send Code
                </button>
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
    // setTimeout(() => {
    //   this.isLoading = false;
    // }, 1500);
  },
  data() {
    return {
      form: new Form({
        email: "",
      }),
      pre_route: null,
      isLoading: true,
      fullPage: true,
    };
  },
  methods: {
    resetPassword() {
      this.form
        .post("/_public/send/code/forgotten/user",{
           transformRequest:[
              function(data,headers){
                   return objectToFormData(data);
              }
           ]   
        })
        .then((resp) => {
             console.log(resp)
          if (resp.data.status == "OK") {
            
          } else {
            this.$toasted.show(
              "Your are not existing user",
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
  // beforeRouteEnter(to, from, next) {

  //    next((vm) => {
  //     vm.from = from;
  //   });
  //   if (from.name == "Chekout") {
  //     this.pre_route=from.name;
  //   } else {
  //     this.pre_route="welcome";
  //   }

  // },

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