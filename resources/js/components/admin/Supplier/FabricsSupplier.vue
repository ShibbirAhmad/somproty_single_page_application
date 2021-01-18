<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'supllierAdd' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Suppliers</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="row mt-2">
                    <div class="col-md-6">
                      <h3 class="box-title">Suppliers table</h3>
                    </div>
                    <div class="col-md-4">
                      <input
                        type="text"
                        placeholder="name, address or phone "
                        @keyup="searchSupplier"
                        v-model="search"
                        class="form-control"
                      />
                    </div>
                    <div class="col-lg-2">
                      <select
                        @change="supplierList"
                        v-model="item"
                        class="form-control"
                        id=""
                      >
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">company_name</th>
                        <th scope="col">phone</th>
                        <th scope="col">address</th>
                        <th scope="col">status</th>
                        <!-- <th scope="col">Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-for="(supplier, index) in suppliers.data"
                        v-bind:key="index"
                      >
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ supplier.name }}</td>
                        <td>
                          <router-link
                            :to="{
                              name: 'SupplierAmount',
                              params: { id: supplier.id },
                            }"
                          >
                            {{ supplier.company_name }}
                          </router-link>
                        </td>
                        <td>{{ supplier.phone }}</td>
                        <td>{{ supplier.address }}</td>
                        <td>
                          <span class="badge" v-if="supplier.status == 1"
                            >Active</span
                          >
                          <span class="badge text-bold" v-else>De-Active</span>
                        </td>
                        <!-- <td>
                          <router-link
                            :to="{
                              name: 'supplierEdit',
                              params: { id: supplier.id },
                            }"
                            class="btn btn-success btn-sm"
                            ><i class="fa fa-edit"></i
                          ></router-link>
                          <a
                            class="btn btn-sm btn-warning"
                            title="De-active"
                            @click="deActive(supplier)"
                            v-if="supplier.status == 1"
                            ><i class="fa fa-ban"></i
                          ></a>
                          <a
                            class="btn btn-sm btn-primary"
                            title="active"
                            @click="active(supplier)"
                            v-else
                            ><i class="fa fa-check"></i
                          ></a>
                        </td> -->
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                      <pagination
                        :data="suppliers"
                        @pagination-change-page="supplierList"
                      >
                      </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ suppliers.from }}</strong> to
                        <strong>{{ suppliers.to }}</strong> of total
                        <strong>{{ suppliers.total }}</strong> entries
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
    this.supplierList();
  },
  data() {
    return {
      suppliers: {},
      loading: true,
      basePath: "storage/",
      search: "",
      item: "",
    };
  },
  methods: {
    supplierList(page = 1) {
      axios
        .get("/list/supplier?page=" + page, {
          params: {
            type: 2,
          },
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.suppliers = resp.data.suppliers;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    searchSupplier(page = 1) {
      axios
        .get("/api/search/supplier/" + this.search + "?page=" + page)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "OK") {
            this.suppliers = resp.data.suppliers;
          } else {
            this.supplierList();
          }
        })
        .catch();
    },

    deActive(supplier) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't de-active this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/deActive/supplier/" + supplier.id)
            .then((resp) => {
              //  console.log(resp)
              if (resp.data.status == "SUCCESS") {
                this.supplierList();
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
    active(supplier) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't active this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/active/supplier/" + supplier.id)
            .then((resp) => {
              if (resp.data.status == "SUCCESS") {
                this.supplierList();
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
};
</script>

<style scoped>
</style>
