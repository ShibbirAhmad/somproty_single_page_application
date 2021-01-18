<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">setting</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header text-center with-border">
                <h3 class="box-title">Order Shipment And Return Policy</h3>
              </div>
              <div class="box-body">
                <div class="alert-danger alert" v-if="error">{{ error }}</div>

                <form
                  @submit.prevent="updateOrderShipmentReturn"
                  @keydown="form.onKeydown($event)"
                  enctype="multipart/form-data"
                >
                 <div class="row">
                    <div class="col-lg-12">
                
                      <div class="form-group">
                        <label for="invoice">Order Details </label>
                        <ckeditor
                          :editor="editor"
                          name="order_info"
                          :class="{
                            'is-invalid': form.errors.has('order_info'),
                          }"
                          v-model="form.order_info"
                          :config="editorConfig"
                        ></ckeditor>
                        <has-error
                          :form="form"
                          field="order_info"
                        ></has-error>
                      </div>

                    </div>

                      <br/>
                  <div class="col-lg-12">
                
                      <div class="form-group">
                        <label for="invoice">Shipment Details </label>
                        <ckeditor
                          :editor="editor"
                          name="shipment_info"
                          :class="{
                            'is-invalid': form.errors.has('shipment_info'),
                          }"
                          v-model="form.shipment_info"
                          :config="editorConfig"
                        ></ckeditor>
                        <has-error
                          :form="form"
                          field="shipment_info"
                        ></has-error>
                      </div>

                 </div>

               <div class="col-lg-12">
                
                      <div class="form-group">
                        <label for="invoice">Return Policy </label>
                        <ckeditor
                          :editor="editor"
                          name="return_policy"
                          :class="{
                            'is-invalid': form.errors.has('return_policy'),
                          }"
                          v-model="form.return_policy"
                          :config="editorConfig"
                        ></ckeditor>
                        <has-error
                          :form="form"
                          field="return_policy"
                        ></has-error>
                      </div>

                      <div class="form-group text-center">
                        <button
                          :disabled="form.busy"
                          type="submit"
                          class="btn btn-primary"
                        >
                          <i class="fa fa-spin fa-spinner" v-if="form.busy"></i
                          >Submit
                        </button>
                      </div>
                 </div>

                  </div>
                
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
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

Vue.component(HasError.name, HasError);
export default {
  name: "subCategory",
  created() {
    this.getOrderShipmentReturn();
  },
  data() {
    return {
      form: new Form({
        id:"",
        order_info:"",
        shipment_info:"",
        return_policy:"",
      }),
      editor: ClassicEditor,
      editorConfig: {},
      error: "",
      loading: true,
    };
  },

  methods: {
    getOrderShipmentReturn() {
      axios.get("/api/get/shipment/order/return")
      .then((resp) => {
        console.log(resp);
        if (resp.data.status == "OK") {
          this.form.id = resp.data.setting.id;
          this.form.order_info = resp.data.setting.order_info;
          this.form.shipment_info = resp.data.setting.shipment_info;
          this.form.return_policy = resp.data.setting.return_policy;
          this.loading=false;
        }
      });
    },

    updateOrderShipmentReturn() {
      this.form
        .post("/api/edit/shipment/return/order/"+this.form.id, {
          transformRequest: [
            function (data, headers) {
              return objectToFormData(data);
            },
          ],
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 4000,
            });
            this.getOrderShipmentReturn();
          } else {
            this.error = "some thing want to wrong";
          }
        })
        .catch((error) => {
          this.error = error.response.data.errors;
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 5000,
          });
        });
    },
  },
};
</script>
