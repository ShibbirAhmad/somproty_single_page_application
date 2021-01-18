<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'add_factory' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">factory</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-lg-offset-1">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">factory table</h3>
                </div>
                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-for="(factory, index) in factorys.data"
                        :key="index"
                      >
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ factory.name }}</td>
                        <td>{{ factory.address }}</td>
                        <td>
                          <span class="badge" v-if="factory.status == 1"
                            >Active</span
                          >
                          <span class="badge text-bold" v-else>De-Active</span>
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'edit_factory',
                              params: { id: factory.id },
                            }"
                            class="btn btn-success btn-sm"
                            ><i class="fa fa-edit"></i
                          ></router-link>
                          <a
                            class="btn btn-sm btn-warning"
                            title="De-active"
                            @click="deActive(factory)"
                            v-if="factory.status == 1"
                            ><i class="fa fa-ban"></i
                          ></a>
                          <a
                            class="btn  btn-sm btn-primary"
                            title="active"
                            @click="active(factory)"
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
                        :data="factorys"
                        @pagination-change-page="factoryList"
                      >
                      </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ factorys.from }}</strong> to
                        <strong>{{ factorys.to }}</strong> of total
                        <strong>{{ factorys.total }}</strong> entries
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
      this.factoryList();
    }, 500);
  },
  data() {
    return {
      factorys: {},
      loading: true,
    };
  },
  methods: {
    factoryList(page = 1) {
      axios
        .get("/api/list/factory?page=" + page)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.factorys = resp.data.factories;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deActive(factory) {
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
            .get("/api/deActive/factory/" + factory.id)
            .then((resp) => {
              //  console.log(resp)
              if (resp.data.status == "SUCCESS") {
                this.factoryList();
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
    active(factory) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want active this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/api/active/factory/" + factory.id)
            .then((resp) => {
              if (resp.data.status == "SUCCESS") {
                this.factoryList();
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
