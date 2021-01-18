<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'sub_city' }" class="btn btn-primary"
            ><i class="fa fa-arrow-left"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Sub City</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header with-border text-center">
                <h3 class="box-title">Edit Sub City</h3>
              </div>
              <div class="box-body">
                <h1 v-if="loading"><i class="fa fa-spinner fa-spin"></i></h1>
                <form
                  v-else
                  @submit.prevent="editSubCity"
                  @keydown="form.onKeydown($event)"
                  enctype="multipart/form-data"
                >
                  <div class="alert-danger alert" v-if="error">
                    {{ error }}
                  </div>
                  <div class="form-group">
                 <label>City Name</label>
                    <select
                      name="city_id"
                      v-model="form.city_id"
                      :class="{ 'is-invalid': form.errors.has('city_id') }"
                      class="form-control"
                    >
                      <option value="select city">select city</option>

                      <option
                        v-for="(city, index) in cities.data"
                        :key="index"
                        :value="city.id"
                      >
                        {{ city.name }}
                      </option>
                    </select>
                    <has-error :form="form" field="city_id"> </has-error>
                  </div>
                  <div class="form-group">
                    <label>Sub City Name</label>
                    <input
                      v-model="form.name"
                      type="text"
                      name="name"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                      autofocus
                      autocomplete="off"
                      placeholder="Example:Chhatak"
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="form-group text-center">
                    <button
                      :disabled="form.busy"
                      type="submit"
                      class="btn btn-primary"
                    >
                      <i class="fa fa-spin fa-spinner" v-if="form.busy"></i
                      >Update
                    </button>
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

Vue.component(HasError.name, HasError);
export default {
  name: "Add",
  created() {
    this.cityList();
    this.getEditCity();
  },
  data() {
    return {
      form: new Form({
        name: "",
        city_id: "select city",
      }),
      cities: {},
      loading: true,
      error: "",
    };
  },

  methods: {

     getEditCity() {
      axios.get("/api/edit/sub/city/"+this.$route.params.id)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.form.name = resp.data.city.name;
            this.form.city_id = resp.data.city.city_id;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

      
    cityList() {
      axios
        .get("/list/city")
        .then((resp) => {
        //  console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.cities = resp.data.cities;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    editSubCity() {
      this.form
        .post("/api/update/sub/city/"+this.$route.params.id, {
          transformRequest: [
            function (data, headers) {
              return objectToFormData(data);
            },
          ],
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.$router.push({ name: "sub_city" });
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 4000,
            });
          } else {
            this.$toasted.show(resp.data.message, {
              type: "error",
              position: "top-center",
              duration: 4000,
            });
          }
        });
    },
  },
};
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}
</style>
