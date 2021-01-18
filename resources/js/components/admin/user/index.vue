<template>
  <div>
    <div class="content-wrapper">
      <section style="margin-bottom: 20px" class="content-header">
          <h1>
          <button @click="exportUsers" class="btn  btn-success"> <i class="fa fa-download"></i> Export Users </button>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">User</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-lg-10 offset-1">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">User table</h3>
                  <div style="margin-top: 5px" class="row">
                    <div class="col-md-2">
                      <select class="form-control" v-model="item">
                        <option value="10">10</option>
                        <option value="10">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                      </select>
                    </div>
                    <div class="col-md-5"></div>
                    <div class="col-md-4">
                      <form action="">
                        <input
                          type="text"
                          @keyup="searchUser"
                          v-model="search"
                          placeholder="user name or 01xxxxxxxxx "
                          class="form-control"
                          id=""
                        />
                      </form>
                    </div>
                    <div class="col-md-1">
                      <button
                        style="margin-left: -23px"
                        type="submit"
                        class="btn btn-success"
                      >
                        search
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
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">City</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-for="(user, index) in users.data"
                        v-bind:key="index"
                      >
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.mobile_no }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                          <img
                            :src=" user.image ? basePath+user.image : basePath+'images/static/noimage.png' "
                            class="img-circle small-image"
                            alt="user Image"
                          />
                        </td>
                        <td>{{ user.user_city ? user.user_city.name : "null" }}</td>
                        <td>{{ user.address }}</td>

                        <td>
                          <span class="badge" v-if="user.status == 1"
                            >Active</span
                          >
                          <span class="badge text-bold" v-else>De-Active</span>
                        </td>
                        <td>
                          <a
                            class="btn btn-warning"
                            title="De-active"
                            @click="deActive(user)"
                            v-if="user.status == 1"
                            ><i class="fa fa-ban"></i
                          ></a>
                          <a
                            class="btn btn-primary"
                            title="active"
                            @click="active(user)"
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
                        :data="users"
                         :limit="3"
                        @pagination-change-page="userList"
                      >
                      </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ users.from }}</strong> to
                        <strong>{{ users.to }}</strong> of total
                        <strong>{{ users.total }}</strong> entries
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
      this.userList();
    }, 500);
    // this.getResults();
  },
  data() {
    return {
      users: {},
      loading: true,
     basePath: this.$store.getters.image_base_link,
      item: 10,
      search: "",
    };
  },
  methods: {

    searchUser() {
        if (this.search.length >=2) {
        axios.get("/user/search/" + this.search)
        .then((resp) => {
        console.log(resp);
        if (resp.data.success == "OK") {
          console.log(resp);
          this.users = resp.data.users;
        } 
      });   
        } else {
           this.userList(); 
        }

    },
    userList(page = 1) {
      axios.get("/list/user/all?page=" + page, {
          params: {
            item: this.item,
          },
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.success == "OK") {
            this.users = resp.data.users;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deActive(user) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want de-active this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/deactive/user/" + user.id)
            .then((resp) => {
              if (resp.data.status == "SUCCESS") {
                this.userList();
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
    active(user) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want active this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/active/user/" + user.id)
            .then((resp) => {
              if (resp.data.status == "SUCCESS") {
                this.userList();
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
    exportUsers(){
      window.open('/api/export/users','_blank');
    }
  },
  computed: {},
  watch: {
    item: function (value) {
      this.userList();
    },
  },
};
</script>

<style scoped>
</style>
