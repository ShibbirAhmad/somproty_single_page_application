<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section style="margin-bottom: 20px" class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Reply</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div style="margin-top: 50px" class="row">
            <div class="col-md-2"></div>
            <div class="row justify-content-center">
              <div class="col-lg-6 col-lg-6 offset-1">
                <div class="box box-primary">
                  <div class="box-header with-border"></div>
                  <div class="box-body">
                    <form @submit.prevent="ReplyMessage">
                      <div class="form-group row">
                        <label for="to" class="col-sm-1 col-md-1 col-form-label"
                          >To</label
                        >
                        <div class="col-sm-11">
                          <input
                            type="email"
                            class="form-control"
                            v-model="form.customer_email"
                            :class="{
                              'is-invalid': form.errors.has('customer_email'),
                            }"
                            name="customer_email"
                          />
                          <has-error :form="form" field="email"> </has-error>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="to" class="col-sm-1 col-md-1 col-form-label"
                          >Subject
                        </label>
                        <div class="col-sm-11">
                          <input
                            type="text"
                            class="form-control"
                            v-model="form.subject"
                            :class="{
                              'is-invalid': form.errors.has('subject'),
                            }"
                            name="subject"
                          />
                          <has-error :form="form" field="customer_email">
                          </has-error>
                        </div>
                      </div>
                      <!-- <div class="form-group row">
                        <label for="to" class="col-md-1 col-form-label"
                          >Sender Email
                        </label>
                        <div class="col-sm-11">
                          <input
                            type="email"
                            class="form-control"
                            placeholder="myexapmle@gmail.com"
                            v-model="form.replier_email"
                            :class="{
                              'is-invalid': form.errors.has('replier_email'),
                            }"
                            name="replier_email"
                          />
                          <has-error :form="form" field="replier_email">
                          </has-error>
                        </div>
                      </div> -->
                      <!-- <div class="form-group row">
                        <label for="to" class="col-md-4 col-form-label"
                          >Email password of this sender email
                        </label>
                        <div class="col-md-8">
                          <input
                            type="password"
                            class="form-control"
                            v-model="form.replier_password"
                            :class="{
                              'is-invalid': form.errors.has('replier_password'),
                            }"
                            name="replier_password"
                          />
                          <has-error :form="form" field="replier_password">
                          </has-error>
                        </div>
                      </div> -->

                      <div class="form-group">
                        <label>write reply in details : </label>
                        <textarea
                          name="message"
                          v-model="form.message"
                          placeholder=" thanks for your interest ...................... "
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('message') }"
                          rows="6"
                        ></textarea>
                        <button
                          type="submit"  :disabled="form.busy"
                          class="btn btn-primary sub_btn_style"
                        >
                          <i class="fa fa-paper-plane"></i> Send
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
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
  created() {
    this.getContactedCustomer();
  },

  data() {
    return {
      form: new Form({
        customer_email: "",
        // replier_email: "",
        // replier_password: "",
        subject: "",
        message: "",
      }),
      email:"",
    };
  },

  methods: {
    getContactedCustomer() {
      axios
        .get("/api/get/contacted/customer/" + this.$route.params.id)
        .then((resp) => {
          console.log(resp);
          this.form.customer_email = resp.data.customer.email;
          this.email = resp.data.customer.email;
        });
    },

    ReplyMessage() {

        let to=this.form.customer_email
        let subject=this.form.subject
        let message=this.form.message
      
      window.open(`/api/reply/message/to/contacted/customer/${to}/${subject}/${message}`,'_blank')
        // this.form
        //   .post("/api/reply/message/to/contacted/customer/"+this.email)
        //   .then((resp) => {
        //     console.log(resp);
        //     if (resp.data.status == "OK") {
        //       this.$toasted.show(resp.data.message, {
        //         type: "success",
        //         position: "top-center",
        //         duration: 4000,
        //       });
        //     } else {
        //       this.$toasted.show(resp.data.message, {
        //         type: "error",
        //         position: "top-center",
        //         duration: 3000,
        //       });
        //     }
        //   });
    },
  },
};
</script>
<style scoped>
.sub_btn_style {
  margin-top: 20px;
}
</style>