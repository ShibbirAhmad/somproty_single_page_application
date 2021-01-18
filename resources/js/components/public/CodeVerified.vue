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
            <div class="custom-box">
              <h2 class="title">Code Verification</h2>
              <form @submit.prevent="submit">

                <div class="form-grop">
                  <label class="control-label" for="input-email">Code</label>
                  <input
                    type="text"
                    name="code"
                    placeholder="xxxxx"
                    class="form-control"
                    autocomplete="off"
                    :class="{ 'is-invalid': form.errors.has('code') }"
                    v-model="form.code"
                    autofocus />
                  <has-error :form="form" field="code"></has-error>
                </div>
                <br />
                
                <button :disabled="form.busy" class="btn btn-block btn-primary" type="submit">
                  <i class="fa fa-spinner fa-spin" v-if="form.busy"></i>Verify
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
        code: "",
      }),
    
    };
  },
  methods: {

    submit() {
       this.form
        .post("/_public/api/user/password/verify/code/"+this.$route.params.mobile_no)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });

            this.$router.push({name:'NewPasswordUser'});

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
 

  
  components: {
    Loading,
  },
};
</script>