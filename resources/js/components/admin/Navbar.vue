<template>
  <header class="main-header">
    <a href="#" class="logo">
      <span class="logo-mini"><b>A</b>LT</span>
      <span class="logo-lg"><b>Mohasagor</b>.com</span>

      <span class="logo-lg"><b>Mohasagor </b>.com</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img
                :src="base_url + getAdmin.image"
                class="user-image"
                :alt="getAdmin.name"
                v-if="getAdmin.image"
              />
              <img
                :src="base_url + 'images/static/user2-160x160.jpg'"
                class="user-image"
                :alt="getAdmin.name"
                v-else
              />
              <span class="hidden-xs">{{ getAdmin.name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img
                  :src="base_url + getAdmin.image"
                  class="img-circle"
                  :alt="getAdmin.name"
                  v-if="getAdmin.image"
                />
                <img
                  :src="base_url + 'images/static/user2-160x160.jpg'"
                  class="img-circle"
                  :alt="getAdmin.name"
                  v-else
                />

                <p>
                  {{ getAdmin.name }} - admin
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <li class="user-body"></li>
              <li class="user-footer">
                <div class="row">
                  <div class="col-md-3">
                    <div>
                      <router-link
                        :to="{ name: 'adminProfile' }"
                        style="color: #000 !important"
                        class="btn btn-default btn-flat"
                        >Profile</router-link
                      >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="passowrdChange">
                      <router-link
                        style="color: #000 !important"
                        class="btn btn-default btn-flat"
                        :to="{
                          name: 'passwordChange',
                          params: { id: getAdmin.id },
                        }"
                        >change password</router-link
                      >
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div>
                      <a
                        href="#"
                        style="color: #000 !important"
                        class="btn btn-default btn-flat"
                        @click="logout"
                        >Sign out</a
                      >
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  created() {
    this.$store.dispatch("admin");
  },
  data() {
    return {
      admin: {},
      base_url: this.$store.state.image_base_link,
    };
  },
  methods: {
    //method inital for logout user
    logout() {
      axios
        .get("/logout/admin")
        .then((resp) => {
          //if success resp, then admin redirect to login page
          if (resp.data.status == "SUCCESS") {
            this.$store.commit("admin", null);
            this.user = null;
            localStorage.removeItem("admin_token");
            this.$router.push({ name: "adminLogin" });
            this.$toasted.show("Logout successfully ! you are back soon .", {
              type: "error",
              position: "top-center",
              duration: 10000,
            });
          }
        })
        .catch(() => {
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 4000,
          });
        });
    },
  },
  computed: {
    getAdmin() {
      return this.$store.getters.admin;
    },
  },
};
</script>

