<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'cityAdd' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Merchant</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-lg-offset-1">
              <div class="box box-primary">
                <div class="box-header with-border text-center">
                  <h3 class="box-title">City table</h3>
                </div>
                <div class="box-body">
                  <div style="margin-bottom:10px;" class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      <input
                        type="text"
                        class="form-control"
                        v-model="search_data"
                        placeholder="search by city name"
                        @keyup="searchCity"
                      />
                    </div>
                  </div>

                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Delivery Charge</th>

                        <th scope="col">status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr v-for="(city, index) in cities.data">
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ city.name }}</td>
                        <td>{{ city.delivery_charge }}</td>

                        <td>
                          <span class="badge" v-if="city.status == 1"
                            >Active</span
                          >
                          <span class="badge text-bold" v-else>De-Active</span>
                        </td>
                        <td>
                          <router-link
                            :to="{ name: 'editCity', params: { id: city.id } }"
                            class="btn btn-success btn-sm"
                            ><i class="fa fa-edit"></i
                          ></router-link>
                          <a
                            class="btn btn-warning"
                            title="De-active"
                            @click="deActive(city)"
                            v-if="city.status == 1"
                            ><i class="fa fa-ban"></i
                          ></a>
                          <a
                            class="btn btn-primary"
                            title="active"
                            @click="active(city)"
                            v-else
                            ><i class="fa fa-check"></i
                          ></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                      <pagination
                        :data="cities"
                        @pagination-change-page="getPagination"
                      >
                      </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ cities.from }}</strong> to
                        <strong>{{ cities.to }}</strong> of total
                        <strong>{{ cities.total }}</strong> entries
                      </p>
                    </div>
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
export default {
  created() {
    setTimeout(() => {
      this.cityList();
    }, 500);
    // this.getResults();
  },
  data() {
    return {
      cities: {},
      loading: true,
      basePath: "storage/",
      search_data: "",
    };
  },
  methods: {
    cityList() {
      axios
        .get("/list/city")
        .then((resp) => {
          if (resp.data.status == "SUCCESS") {
            this.cities = resp.data.cities;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    searchCity() {
      if (this.search_data.length >= 3) {
        axios.get("/api/search/city/" + this.search_data).then((resp) => {
          this.cities = resp.data.cities;
        });
      } else {
        this.cityList();
      }
    },

    deActive(city) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't de-active this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/deActive/city/" + city.id)
            .then((resp) => {
              //  console.log(resp)
              if (resp.data.status == "SUCCESS") {
                this.cityList();
                this.$toasted.show(resp.data.message, {
                  position: "top-center",
                  type: "success",
                  duration: 4000,
                });
              } else {
                this.$toasted.show("some thing want to wrong", {
                  position: "top-center",
                  type: "error",
                  duration: 4000,
                });
              }
            })
            .catch((error) => {
              // console.log(error)
              this.$toasted.show("some thing want to wrong", {
                position: "top-center",
                type: "error",
                duration: 4000,
              });
            });
        } else {
          this.$toasted.show("OK ! no action here", {
            position: "top-center",
            type: "info",
            duration: 3000,
          });
        }
      });
    },
    active(city) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't active this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/active/city/" + city.id)
            .then((resp) => {
              if (resp.data.status == "SUCCESS") {
                this.cityList();
                this.$toasted.show(resp.data.message, {
                  position: "top-center",
                  type: "success",
                  duration: 4000,
                });
              } else {
                this.$toasted.show("some thing want to wrong", {
                  position: "top-center",
                  type: "error",
                  duration: 4000,
                });
              }
            })
            .catch((error) => {
              this.$toasted.show("some thing want to wrong", {
                position: "top-center",
                type: "error",
                duration: 4000,
              });
            });
        } else {
          this.$toasted.show("Ok ! no action here", {
            position: "top-center",
            type: "info",
            duration: 3000,
          });
        }
      });
    },
    getPagination(page = 1) {
      this.loading = true;
      axios.get("/list/city?page=" + page).then((response) => {
        this.loading = false;
        this.cities = response.data.cities;
      });
    },
  },
  computed: {},
};
</script>

<style scoped>
</style>
