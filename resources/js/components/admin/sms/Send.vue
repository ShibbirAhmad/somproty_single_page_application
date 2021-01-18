<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">SMS Campaign</li>
        </ol>
      </section>
      <section class="content">
        <div style="margin-top: 50px" class="row justify-content-center">
          <div class="col-lg-6 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title t text-uppercase">send sms</h3>
              </div>
              <div class="box-body">
                <h1 v-if="loading"><i class="fa fa-spinner fa-spin"></i></h1>
                <form
                  v-else
                  @submit.prevent="sendMessage"
                  @keydown="form.onKeydown($event)"
                  enctype="multipart/form-data"
                >
                  <div class="alert-danger alert" v-if="error">
                    {{ error }}
                  </div>
                  <div class="form-group">
                    <label>To</label>
                    <select
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('customer_type'),
                      }"
                      v-model="form.customer_type"
                      name="customer_type"
                      @change="customeFile"
                    >
                      <option value="" selected disabled>select one</option>
                      <option value="wholesale">Wholesale customers</option>
                      <option value="officesale">Office sale customers</option>
                      <option value="retailsale">Retail customers</option>
                      <option value="admins">Admins</option>
                      <option value="resellers">Resellers</option>
                      <option value="merchants">Merchants</option>
                      <option value="instantMessage">
                        <i class="fa fa-edit"> </i>
                        Send Instant Message
                      </option>
                      <option value="customMessage">import customer from xlsx/csv</option>
                    </select>
                    <has-error :form="form" field="customer_type"></has-error>
                  </div>

                  <div id="instNumber"></div>

                  <div class="form-group">
                    <label>Message</label>
                    <textarea
                      @keyup="counter"
                      v-model="form.message"
                      name="message"
                      placeholder="write message with in 170 character "
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('message') }"
                      rows="5"
                      id="text_field"
                    ></textarea>
                    <span style="float: right; margin-top: 10px" class="bg-info"
                      >{{ total_char }}/170</span
                    >

                    <has-error :form="form" field="message"></has-error>
                  </div>
                  <br />
                  <button
                    :disabled="submitValidation"
                    type="submit"
                    class="btn btn-primary btn-block text-uppercase"
                  >
                    <i class="fa fa-spin fa-spinner" v-if="form.busy"></i>send
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
    setTimeout(() => {
      this.loading = false;
    }, 500);
  },
  data() {
    return {
      form: new Form({
        customer_type: "",
        message: "",
        file: "",
        instantContants: "",
      }),
      total_char: "0",
      loading: true,
      submitValidation: true,
      error: "",
    };
  },

  methods: {
    counter() {
      this.total_char = this.form.message.length;
      if (this.form.customer_type.length && this.form.message.length <= 170) {
        this.submitValidation = false;
      }

      if (this.form.message.length < 1) {
        this.submitValidation = true;
      }
    },
    sendMessage() {
      if (this.form.customer_type == "instantMessage") {
        this.form.instantContants = document.getElementById("inputHolder").value;
      }

      this.form
        .post("/api/send/message/to/customer", {
          transformRequest: [
            function (data, headers) {
              return objectToFormData(data);
            },
          ],
        })
        .then((resp) => {
          console.log(resp);
          this.form.customer_type = "";
          if (resp.data.status == "OK") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 4000,
            });
          }
          this.form.message = "";
          this.submitValidation = true;
          if (resp.data.status == "FAIL") {
            this.$toasted.show(resp.data.message + resp.data.sub_message, {
              type: "error",
              position: "top-center",
              duration: 4000,
            });
          }
        })
        .catch((error) => {
          console.log(error);
          this.error = "some thing want to wrong";
        });
    },
    customeFile() {
      if (this.form.customer_type == "customMessage") {
        // console.log('hghg')
        Swal.fire({
          title: "Browse csv or xlsx file",
          input: "file",
        }).then((result) => {
          if (result.value) {
            this.form.file = result.value;
          }
        });
        return;
      }
      if (this.form.customer_type == "instantMessage") {
        this.instantMessage();
      } else {
        let ele = document.getElementById("instantGroup");
        if (ele) {
          ele.remove();
        }
      }

      this.counter();
    },

    instantMessage() {
      let template = `
    <div class="form-group" id="instantGroup">
                  <label>  Type Number</label>
                  <input type="text" id="inputHolder" placeholder="01xxxxxxxxx|01xxxxxxxxx" class="form-control">
    </div>
     `;

      let el = document.getElementById("instNumber");
      let existInput = document.getElementById("instantGroup");
      if (!existInput) {
        el.innerHTML += template;
      } else {
        existInput.style.display = "block";
      }
    },
  },
};
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}
</style>
