<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
            <h1>
          <router-link :to="{ name: 'sale_campaign' }" class="btn btn-primary"
            ><i class="fa fa-arrow-left"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Sale Campaign</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header text-center with-border">
                <h2 class="box-title">Add Sale Campaign</h2>
              </div>
              <div class="box-body">
                <div class="alert-danger alert" v-if="error">{{ error }}</div>

                <form
                  @submit.prevent="addSaleCampaign"
                  enctype="multipart/form-data"
                >
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="name">Campaign Name</label>
                            <input
                              type="text"
                              name="name"
                              v-model="form.name"
                              :class="{ 'is-invalid': form.errors.has('name') }"
                              class="form-control"
                            />
                            <has-error :form="form" field="name"> </has-error>
                          </div>

                          <div class="col-md-6">
                            <label>Expire Date</label>

                            <date-picker
                              :class="{
                                'is-invaid': form.errors.has('expired_date'),
                              }"
                              v-model="form.expired_date"
                              :config="options"
                              name="expired_date"
                            >
                            </date-picker>
                            <has-error
                              :form="form"
                              field="expired_date"
                            ></has-error>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="name">Border Width </label>
                            <input
                              type="number"
                              name="border_width"
                              v-model="form.border_width"
                              :class="{
                                'is-invalid': form.errors.has('border_width'),
                              }"
                              class="form-control"
                            />
                            <has-error :form="form" field="border_width">
                            </has-error>
                          </div>
                          <div class="col-md-6">
                            <label for="name">Display Position </label>
                            <input
                              type="number"
                              name="order_by"
                              v-model="form.order_by"
                              :class="{
                                'is-invalid': form.errors.has('order_by'),
                              }"
                              class="form-control"
                            />
                            <has-error :form="form" field="order_by">
                            </has-error>
                          </div>
                        </div>
                      </div>

                      <div class="form-group color_group">
                        <div class="row">
                          <div class="col-md-4"><h5>PLACEMENT</h5></div>
                          <div class="col-md-4"><h5>SELECT COLOR</h5></div>
                          <div class="col-md-3">
                            <h6>
                              SIX DIGIT CODE <br />
                              <span style="font-size: 12px; color: green">
                                example: #fc721e
                              </span>
                            </h6>
                          </div>
                        </div>
                      </div>

                      <div class="form-group color_group">
                        <div class="row">
                          <div class="col-md-4">
                            <label> Background Color </label>
                          </div>
                          <div class="col-md-4">
                            <input
                              class="form-control"
                              type="color"
                              v-model="form.background_color"
                            />
                          </div>
                          <div class="col-md-3">
                            <input
                              type="text"
                              v-model="form.background_color"
                              class="form-control"
                            />
                          </div>
                        </div>
                      </div>

                      <div class="form-group color_group">
                        <div class="row">
                          <div class="col-md-4">
                            <label> Border Color </label>
                          </div>
                          <div class="col-md-4">
                            <input
                              class="form-control"
                              type="color"
                              v-model="form.border_color"
                            />
                          </div>
                          <div class="col-md-3">
                            <input
                              type="text"
                              v-model="form.border_color"
                              class="form-control"
                            />
                          </div>
                        </div>
                      </div>

                      <br />
                      <div class="form-group text-center">
                        <button
                          :disabled="form.busy"
                          type="submit"
                          class="btn btn-primary"
                        >
                          <i class="fa fa-spin fa-spinner" v-if="form.busy"></i>
                          Submit
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
import datePicker from "vue-bootstrap-datetimepicker";

Vue.component(HasError.name, HasError);
export default {
  created(){

  },
  data() {
    return {
      form: new Form({
        name: "",
        expired_date:"",
        background_color: "",
        border_color: "",
        border_width: "",
        order_by: "",
      }),
      options: {
        format: "YYYY-MM-DD",
        useCurrent: false,
      },
      error: "",
      loading: true,
    };
  },

  methods: {

    addSaleCampaign() {
      this.form
        .post("/api/sale/campaign/add", {
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
            this.$router.push({name:'sale_campaign'});
          } else {
            this.$toasted.show(resp.data.message, {
              type: "error",
              position: "top-center",
              duration: 4000,
            });
          }
        })
    },
  },
};
</script>

<style scoped>
input {
  cursor: pointer;
}

.color_group {
  margin-left: 20px;
}
</style>