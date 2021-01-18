<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'resellerAdd' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Reseller</li>
        </ol>
      </section>

      <section class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="row">
                    <div style="margin-left: 10px" class="col-md-2">
                      <select
                        @change="getResellerList"
                        v-model="item"
                        class="form-control"
                        id=""
                      >
                        <option selected value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                      </select>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-3">
                      <input
                        type="text"
                        placeholder="type username,email,phone or company_name"
                        @keyup="searchReseller"
                        v-model="search"
                        class="form-control"
                        autofocus
                      />
                    </div>
                    <div class="col-lg-2">
                      <button
                        @click="exportReseller"
                        class="btn btn-success btn-sm"
                      >
                        <i class="fa fa-download"></i> Export
                      </button>
                    </div>
                  </div>
                </div>

                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th style="width: 10px">C_name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">phone</th>
                        <th scope="col">Bkash Number</th>
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
                        v-for="(reseller, index) in resellerList.data"
                        :key="index"
                      >
                        <td>{{ index+1 }}</td>
                        <td>
                          <a
                            :href="'/admin/to/reseller/' + reseller.id"
                            target="_blank"
                            >{{ reseller.name }}</a
                          >
                        </td>
                        <td>{{ reseller.username }}</td>
                        <td style="width: 2px">{{ reseller.company_name }}</td>
                        <td>{{ reseller.email }}</td>
                        <td>
                          <img
                            v-if="reseller.image"
                            :src="basePath + reseller.image"
                            class="img-circle small-image"
                            alt="reseller Image"
                          />
                          <img
                            v-else
                            :src="basePath + 'images/static/noimage.png'"
                            class="img-circle small-image"
                            alt="admin Image"
                          />
                        </td>
                        <td>{{ reseller.phone }}</td>
                        <td>{{ reseller.bkash_number }}</td>
                        <td>{{ reseller.address }}</td>
                        <td>
                          <span class="badge" v-if="reseller.status == 1"
                            >Active</span
                          >
                          <span class="badge text-bold" v-else>De-Active</span>
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'resellerEdit',
                              params: { id: reseller.id },
                            }"
                            class="btn btn-sm btn-success"
                          >
                            <i class="fa fa-sm fa-edit"></i>
                          </router-link>
                          <a
                            class="btn btn-sm btn-warning"
                            title="De-active"
                            @click="deActive(reseller.id, index)"
                            v-if="reseller.status == 1"
                            ><i class="fa fa-sm fa-ban"></i
                          ></a>
                          <a
                            class="btn btn-sm btn-primary"
                            title="active"
                            @click="active(reseller.id, index)"
                            v-else
                            ><i class="fa fa-sm fa-check"></i
                          ></a>
                          <a class="btn btn-sm btn-danger">
                            <i
                              @click="trash_reseller(reseller.id, index)"
                              class="fa fa-sm fa-trash"
                            ></i>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-md-6">
                      <pagination
                        :data="resellerList"
                        :limit="3"
                        @pagination-change-page="getResellerList"
                      >
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                      </pagination>
                    </div>
                    <div
                      class="col-md-6"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        showing <strong>{{ resellerList.from }} </strong> to
                        <strong>{{ resellerList.from }} </strong> of total
                        entities {{ resellerList.total }}
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
  mounted() {
    console.log("mounted reseller");
    setTimeout(() => {
      this.loading = false;
    }, 500);
    this.getResellerList();
  },

  data() {
    return {
      resellerList: {},
      loading: true,
      item: 10,
      basePath: this.$store.getters.image_base_link,
      search: "",
    };
  },

  methods: {
    getResellerList(page = 1) {
      axios
        .get("/api/reseller/list?page=" + page, {
          params: { item: this.item },
        })
        .then((resp) => {
          if (resp.data.success == "OK") {
            this.resellerList = resp.data.resellers;
          }
        })
        .catch();
    },

    searchReseller(page = 1) {
      axios
        .get("/api/search/reseller/" + this.search + "?page=" + page)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "OK") {
            this.resellerList = resp.data.resellers;
          } else {
            this.getResellerList();
          }
        })
        .catch();
    },

    trash_reseller(reseller_id, index) {
      if (confirm("Are you sure to remove")) {
        axios
          .get("/api/reseller/remove/" + reseller_id)
          .then((resp) => {
            if (resp.data.success == "OK") {
              alert(resp.data.message);
              this.getResellerList();
            } else {
              alert(resp.data.message);
            }
          })
          .catch();
      }
    },
    deActive(reseller_id, index) {
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
            .get("/api/deactive/reseller/" + reseller_id)
            .then((resp) => {
              console.log(resp);
              if (resp.data.status == "SUCCESS") {
                this.resellerList.data[index].status = 0;
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
              console.log(error);
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
    active(reseller_id, index) {
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
            .get("/api/active/reseller/" + reseller_id)
            .then((resp) => {
              if (resp.data.status == "SUCCESS") {
                this.resellerList.data[index].status = 1;

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
    exportReseller() {
      window.open("/api/export/resellers", "_blank");
    },
  },
};
</script>



<style scoped>
.dropbtn {
  width: 100% !important;
  margin-bottom: 5px !important;
}
.dropbtn-active {
  display: block !important;
}
.dropdown-action {
  display: none;
  width: 90px;
  position: absolute;
}
</style>