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
          <div class="col-lg-6 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Debit</h3>
              </div>
              <div class="box-body">
                <h1 v-if="loading"><i class="fa fa-spinner fa-spin"></i></h1>
                <form
                  v-else
                  @submit.prevent="update"
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
                    <input
                      type="text"
                      name="purpose"
                      v-model="form.purpose"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('purpose') }"
                      autocomplete="off"
                    />
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

                  <br />
                  <button
                    :disabled="form.busy"
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
        purpose: "",
        amount: "",
        date: "",
        comment: "",
      }),

      loading: true,
      error: "",

      //for date picker
      options: {
        format: "YYYY-MM-DD",
        useCurrent: false,
      },
    };
  },

  methods: {
    //mehod initial for get credit data
    edit() {
      axios
        .get("/debit/edit/" + this.$route.params.id)
        .then((resp) => {
          console.log(resp);

          //onely success resp
          if (resp.data.status == "SUCCESS") {
            this.form.date = resp.data.debit.date;
            this.form.purpose = resp.data.debit.purpose;
            this.form.comment = resp.data.debit.comment;
            this.form.amount = resp.data.debit.amount;
          }
          //other wise success resp
          else {
            this.error = "some thing want to wrong";
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    //method inital for update credit
    update() {
      this.form
        .post("/debit/update/" + this.$route.params.id)
        .then((resp) => {
          //only success resp
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
  },
  mounted() {
    this.edit();
  },
};
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}
</style>
