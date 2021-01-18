<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'loanerAdd' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
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
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-lg-offset-1">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Loaner table</h3>

                 
                </div>
                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-for="(loaner, index) in loaners.data"
                        v-bind:key="index"
                      >
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ loaner.name }}</td>
                        <td>{{ loaner.email }}</td>
                        <td>{{ loaner.phone }}</td>
                     <td>{{ loaner.address }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                      <pagination
                        :data="loaners"
                        @pagination-change-page="getPagination"
                      >
                      </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ loaners.from }}</strong> to
                        <strong>{{ loaners.to }}</strong> of total
                        <strong>{{ loaners.total }}</strong> entries
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
    this.adminList();
  },
  data() {
    return {
      loaners: {},
      loading: true,
      basePath: this.$store.getters.image_base_link,
      item: "",
      search: "",
    };
  },
  methods: {
    adminList() {
      axios.get("/api/loaner")
        .then((resp) => {
          console.log(resp)
          if (resp.data.success == "OK") {
            this.loaners = resp.data.loaners;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    searchAdmin(page = 1) {
      axios
        .get("/api/search/admin/" + this.search + "?page=" + page)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "OK") {
            this.admins = resp.data.admins;
          } else {
            this.adminList();
          }
        })
        .catch();
    },

    deActive(admin) {
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
            .get("/deactive/admin/" + admin.id)
            .then((resp) => {
              if (resp.data.status == "SUCCESS") {
                this.adminList();
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
          this.$toasted.show("OK ! no action here", {
            position: "top-center",
            type: "info",
            duration: 3000,
          });
        }
      });
    },
    active(admin) {
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
            .get("/active/admin/" + admin.id)
            .then((resp) => {
              if (resp.data.status == "SUCCESS") {
                this.adminList();
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
      axios.get("/list/admin?page=" + page).then((response) => {
        this.loading = false;
        this.admins = response.data.admins;
      });
    },
  },
  computed: {},
};
</script>

<style scoped>
</style>
