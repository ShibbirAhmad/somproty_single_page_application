<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'add_sub_city' }" class="btn btn-primary"
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
                  <h3 class="box-title">Sub Cities</h3>
                </div>

                <div class="box-body">
                  <div style="margin-bottom: 10px" class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      <input
                        type="text"
                        class="form-control"
                        v-model="search_data"
                        placeholder="search here"
                        @keyup="searchSubCity"
                      />
                    </div>
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Serial</th>
                        <th scope="col">City Name</th>
                        <th scope="col">Sub City Name</th>
                        <th scope="col">status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr v-for="(city, index) in cities.data" :key="index">
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ city.city.name }}</td>
                        <td>{{ city.name }}</td>

                        <td>
                          <span class="badge" v-if="city.status == 1"
                            >Active</span
                          >
                          <span class="badge text-bold" v-else>De-Active</span>
                        </td>
                        <td>
                          <router-link
                            :to="{ name: 'edit_sub_city', params: { id: city.id } }"
                            class="btn btn-success btn-sm"
                            ><i class="fa fa-edit"></i
                          ></router-link>
                          <a
                            class="btn btn-warning"
                            title="De-active"
                            @click="deActiveSubCity(city)"
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
                        @pagination-change-page="subCityList"
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
    this.subCityList();
  },
  data() {
    return {
      cities: {},
      loading: true,
      search_data: "",
    };
  },
  methods: {
    subCityList(page=1) {
      axios
        .get("/api/list/sub/city?page="+page)
        .then((resp) => {
            // console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.cities = resp.data.cities;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    searchSubCity() {
      if (this.search_data.length >= 3) {
        axios.get("/api/search/sub/city/"+this.search_data)
        .then((resp) => {
        //   console.log(resp);
          this.cities = resp.data.cities;
        });
      } else {
        this.subCityList();
      }
    },

    deActiveSubCity(city) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want de-active this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/api/deActive/sub/city/"+city.id)
            .then((resp) => {
               console.log(resp)
              if (resp.data.status == "SUCCESS") {
                this.subCityList();
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
        text: "You wantt active this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/api/active/sub/city/"+city.id)
            .then((resp) => {
              if (resp.data.status == "SUCCESS") {
                this.subCityList();
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

  },
  computed: {},
};
</script>

<style scoped>
</style>
