<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'admin' }" class="btn btn-primary"
            ><i class="fa fa-arrow-right"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Loaner</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Add Loaner</h3>
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
                    <label>Name</label>
                    <input
                      v-model="form.name"
                      type="text"
                      name="name"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                      autofocus
                      autocomplete="off"
                      placeholder="name"
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input
                      v-model="form.email"
                      type="email"
                      name="email"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('email') }"
                      autofocus
                      autocomplete="off"
                      placeholder="email"
                    />
                    <has-error :form="form" field="email"></has-error>
                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input
                      v-model="form.phone"
                      type="text"
                      name="email"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('phone') }"
                      autofocus
                      autocomplete="off"
                      placeholder="phone"
                    />
                    <has-error :form="form" field="phone"></has-error>
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input
                      v-model="form.address"
                      type="text"
                      name="address"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('address') }"
                      autofocus
                      autocomplete="off"
                      placeholder="address"
                    />
                    <has-error :form="form" field="address"></has-error>
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
    }, 100);
  },
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        phone:"",
        address:"",
      
      }),

      loading: true,
      error: "",
    };
  },

  methods: {
    add() {
      console.log("add");
      this.form
        .post("/api/loaner/store")
        .then((resp) => {
          console.log(resp);
          if (resp.data.success == "OK") {
            this.$router.push({ name: "loaner" });
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-right",
              duration: 4000,
            });
          } else {
            this.error = "some thing want to wrong";
          }
        })
        .catch((error) => {
          console.log(error);
          this.error = "some thing want to wrong";
        });
    },
  },
  computed: {},
};
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}
</style>
