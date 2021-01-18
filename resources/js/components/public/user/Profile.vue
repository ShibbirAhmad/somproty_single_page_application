<template>
  <div class="wrapper-wide">
    <!-- <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading> -->

    <frontend-header></frontend-header>

    <div id="container">
      <div class="container">
        <!-- Breadcrumb End-->
        <div class="row text-center"></div>

        <div class="row user-content">
          <div
            class="col-lg-2 col-md-2 col-sm-2 text-white bg-success user-side-bar"
          >
            <sidebar> </sidebar>
          </div>

          <div class="col-lg-8 col-md-8 col-sm-10">
            <div class="custom-box">
              <div class="card">
                <div class="card-header text-center"></div>
                <div v-if="loading">
                  <h3><i class="fa fa-spinner fa-spin"></i></h3>
                </div>
                <div class="card-body" v-else>
                  <dl class="row">
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">
                      {{ user.name }}
                    </dd>
                    <dt class="col-sm-3">Phone</dt>
                    <dd class="col-sm-9">
                      {{ user.mobile_no }}
                    </dd>
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">
                      {{ user.email }}
                    </dd>
                    <dt class="col-sm-3">City</dt>
                    <dd class="col-sm-9">
                      {{ userCity(user.city_id) }}
                    </dd>
                    <dt class="col-sm-3">Address</dt>
                    <dd class="col-sm-9">
                      {{ user.address }}
                    </dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-2 col-lg-2 col-sm-2"></div>
        </div>
      </div>
      <frontend-footer></frontend-footer>
    </div>
  </div>
</template>

<script>
import sidebar from "./Sidebar";

import { Form, HasError } from "vform";

export default {
  props: ["categories"],

  created() {
    this.getCity();
    setTimeout(() => {
      this.loading = false;
    }, 100);
  },

  data() {
    return {
      city: "",
      cities: "",
      loading: true,
    };
  },

  methods: {
    getCity() {
      axios
        .get("/_public/others")
        .then((resp) => {
          this.cities = resp.data.cities;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    userCity(city_id) {
      let city = "";
      this.cities.forEach((element) => {});

      this.cities.forEach((element) => {
        if (element.id == city_id) {
          city = element.name;
        }
      });
      return city;
    },
  },

  mounted() {
    this.$store.dispatch("user");
  },
  computed: {
    user() {
      return this.$store.getters.user;
    },
  },

  components: {
    sidebar,
  },
};
</script>
