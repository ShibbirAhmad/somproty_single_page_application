<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'debit' }" class="btn btn-primary"
            ><i class="fa fa-arrow-right"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Debit</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-10 col-lg-offset-1">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Add Debit</h3>
              </div>
              <div class="box-body">
                <h1 v-if="loading"><i class="fa fa-spinner fa-spin"></i></h1>
                <form
                  v-else
                  @submit.prevent="add"
                  @keydown="form.onKeydown($event)"
                  enctype="multipart/form-data"
                >
                  <div class="alert-danger alert" v-if="error">
                    {{ error }}
                  </div>
                  <div class="form-group">
                    <label>Date</label>

                    <date-picker
                      autocomplete="off"
                      v-model="form.date"
                      :config="options"
                      :class="{ 'is-invalid': form.errors.has('date') }"
                    ></date-picker>

                    <has-error :form="form" field="date"></has-error>
                  </div>
                  <div class="form-group">
                    <label>Purpose</label>
                    <select
                      class="form-control"
                      v-model="form.purpose"
                      name="purpose"
                      @change="selectPurpose"
                      :class="{ 'is-invalid': form.errors.has('purpose') }"
                    >
                      <option value="" selected disabled>Select Purpose</option>
                      <option
                        v-for="purpose in purposes"
                        :key="purpose.id"
                        :value="purpose.id"
                      >
                        {{ purpose.text }}
                      </option>
                    </select>
                    <has-error :form="form" field="purpose"></has-error>
                  </div>
                  <div class="form-group">
                    <label>Amount</label>
                    <input
                      type="text"
                      name="amount"
                      v-model="form.amount"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('amount') }"
                      autocomplete="off"
                    />
                    <has-error :form="form" field="amount"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Comment</label>
                    <input
                      type="text"
                      name="comment"
                      class="form-control"
                      v-model="form.comment"
                      :class="{ 'is-invalid': form.errors.has('comment') }"
                      autocomplete="off"
                    />
                    <has-error :form="form" field="comment"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Debit From</label>
                    <select
                      name="debit_from"
                      id=""
                      class="form-control"
                      v-model="form.debit_from"
                      :class="{ 'is-invalid': form.errors.has('debit_from') }"
                    >
                      <option value="Cash">Cash</option>
                      <option value="Bkash(personal)">Bkash(personal)</option>
                      <option value="Bkash(merchant)">Bkash(merchant)</option>
                      <option value="Bank">Bank(SIBL)</option>
                       <option value="Bank(AIBL)">Bank(AIBL)</option>
                    </select>
                    <has-error :form="form" field="debit_from"></has-error>
                  </div>
                  <div
                    class="form-group"
                    id="signatur-pad"
                  >
                    <label for="">Signature</label>

                    <sig
                      ref="signature"
                      style="margin-bottom: 5px"
                      :class="{ 'is-invalid': form.errors.has('signature') }"
                      id="sig"
                      class="bg-warning"
                      :sigOption="option"
                      :disabled="disabled"
                    >
                    </sig>

                    <button type="button" @click.prevent="clear" style="position: absolute;
                    right: 10px" class="m-1">
                      clear
                    </button>
                      <button type="button" @click.prevent="form.signature_write=true" style="position: absolute;
                    right: 60px" class="m-1">
                      Perfect
                    </button>
                    <!-- <button @click="save" variant="success" class="m-1"> save </button> -->
                  </div>
                  <!-- <canvas> </canvas> -->

                  <br />
                  <button
                    :disabled="form.busy || form.signature_write == false"
                    type="submit"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-spin fa-spinner" v-if="form.busy"></i>Submit
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
import sig from "vue-signature";

Vue.component(HasError.name, HasError);
export default {
  name: "Add",
  created() {
    this.accountPurpose();
  },
  data() {
    return {
      form: new Form({
        purpose: "",
        amount: "",
        date: "",
        comment: "",
        employee_id: "",
        debit_from: "Cash",
        supplier_id: "",
        signature: null,
        signature_write: false,
      }),

      loading: true,
      error: "",
      purposes: "",

      //for date picker
      options: {
        format: "YYYY-MM-DD",
        useCurrent: false,
      },

      //signature pad.......
      option: {
        penColor: "rgb(0, 0, 0)",
        backgroundColor: "yellow",
      },
      disabled: false,
    };
  },

  methods: {
    accountPurpose() {
      axios
        .get("/api/account/purpose")
        .then((resp) => {
          console.log(resp);
          if (resp.data) {
            this.purposes = resp.data;
            this.loading = false;
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    selectPurpose() {
      let value = this.form.purpose;
      if (value == 1) {
        this.employeeList();
      } else if (value == 9) {
        this.supplierList();
      } else {
        this.form.employee_id = "";
        this.form.supplier_id = "";
      }
    },
    employeeList() {
      axios
        .get("/api/employee/list")
        .then((resp) => {
          let options = {};
          resp.data.forEach((element) => {
            options[element.id] = element.name + "-" + element.designation;
          });
          Swal.fire({
            title: "Select a employee",
            input: "select",
            inputOptions: options,
            inputPlaceholder: "Select One",
            showCancelButton: true,
          }).then((result) => {
            if (result.value) {
              this.form.employee_id = result.value;
            } else {
              this.form.purpose = "";
              this.form.employee_id = "";
            }
          });
        })
        .catch((e) => {
          console.log(e);
        });
    },
    supplierList() {
      axios
        .get("/api/supplier/list")
        .then((resp) => {
          console.log(resp);
          let options = {};
          resp.data.forEach((element) => {
            options[element.id] = element.company_name + "-" + element.name;
          });
          Swal.fire({
            title: "Select a supplier",
            input: "select",
            inputOptions: options,
            inputPlaceholder: "Select One",
            showCancelButton: true,
          }).then((result) => {
            if (result.value) {
              this.form.supplier_id = result.value;
            } else {
              this.form.supplier_id = "";
            }
          });
        })
        .catch((e) => {
          console.log(e);
        });
    },
    add() {
      this.save();
      console.log(this.form.signature);
      this.form
        .post("/debit/store")
        .then((resp) => {
          console.log(resp);
          console.log("resp");
          if (resp.data.status == "SUCCESS") {
            this.$router.push({ name: "debit" });
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
          } else {
            this.error = "some thing want to wrong";
          }
        })
        .catch((error) => {
          //  console.log(error)
          this.error = "some thing want to wrong";
        });
    },

    //method initial for  get current date
    pDate() {
      //current date
      let d = new Date();

      //current mount
      //current day
      let month = d.getMonth() + 1;
      let day = d.getDate();
      let output =
        d.getFullYear() +
        "-" +
        (("" + month).length < 2 ? "0" : "") +
        month +
        "-" +
        (("" + day).length < 2 ? "0" : "") +
        day;
      this.form.date = output;
    },

    save() {
      var _this = this;
      var png = _this.$refs.signature.save();
      this.form.signature = png;
    },
    clear() {
      var _this = this;
      _this.$refs.signature.clear();
      this.form.signature_write=false;
    },
    sigantureFocus() {
      let element = document.getElementById("signatur-pad");

      element.classList.add("focus-signature");
    },
  },
  mounted() {
    this.pDate();
  },
  components: {
    sig,
  },
};
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}
#signatur-pad {
  height: 300px;
}
</style>
