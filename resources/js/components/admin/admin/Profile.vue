<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'admin' }" class="btn btn-primary">
            <i class="fa fa-arrow-right"></i>
          </router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Category</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-lg-offset-3">
            <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                <img
                  class="profile-user-img img-responsive img-circle"
                  :src="file"
                  alt="User profile picture"
                />

                <h3 class="profile-username text-center" v-if="form.name">
                  {{ form.name }}
                </h3>
                <h3 class="profile-username text-center" v-else>.......</h3>

                <p class="text-muted text-center">Admin</p>

                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Name</b>
                    <div v-if="!editMode">
                      <a
                        class="pull-right text-bold text-black"
                        v-if="form.name"
                        style="margin-top: -18px"
                        >{{ form.name }}</a
                      >
                      <a class="pull-right" v-else>....</a>
                    </div>
                    <div v-else>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.name"
                        name="name"
                        :class="{ 'is-invalid': form.errors.has('name') }"
                      />
                      <has-error :form="form" field="name"></has-error>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b>
                    <div v-if="!editMode">
                      <a
                        class="pull-right text-bold text-black"
                        v-if="form.email"
                        style="margin-top: -18px"
                        >{{ form.email }}</a
                      >
                      <a class="pull-right" v-else>....</a>
                    </div>
                    <div v-else>
                      <input
                        type="email"
                        class="form-control"
                        v-model="form.email"
                        name="email"
                        :class="{ 'is-invalid': form.errors.has('email') }"
                      />
                      <has-error :form="form" field="email"></has-error>

                      <br />
                      <b>Upload Image</b>
                      <div class="form-group">
                        <input
                          type="file"
                          name="image"
                          class="form-control"
                          @change="uploadImage"
                        />
                      </div>
                    </div>
                  </li>
                </ul>

                <div class="row">
                  <div :class="editMode ? 'col-lg-8' : 'col-lg-12'">
                    <a
                      href="#"
                      class="btn btn-primary btn-block"
                      @click.prevent="edit"
                    >
                      <b>{{ actionText }}</b>
                    </a>
                  </div>
                  <div class="col-lg-4" v-if="editMode">
                    <a
                      href="#"
                      class="btn btn-danger btn-block"
                      @click.prevent="(editMode = false), (actionText = 'Edit')"
                    >
                      <b>cancel</b>
                    </a>
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
import Vue from "vue";
import { Form, HasError, AlertError } from "vform";

Vue.component(HasError.name, HasError);
export default {
  name: "Profile",
  created() {
    this.getAdmin();
    setTimeout(() => {
      this.loading = false;
    }, 500);
  },
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        image: "",
        id: "",
      }),

      loading: true,
      error: "",

      actionText: "Edit",
      editMode: false,
      file: this.$store.state.image_base_link+"images/static/user2-160x160.jpg",
    };
  },

  methods: {
    updateProfile() {
      console.log("add");
      this.form
        .post("/update/admin/" + this.form.id, {
          transformRequest: [
            function (data, headers) {
              return objectToFormData(data);
            },
          ],
        })
        .then((resp) => {
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show("Your profile was updated.", {
              type: "success",
              position: "top-right",
              duration: 1000,
            });
            this.editMode = false;
            this.$router.push({ name: "adminLogin" });
         
          }
        })
        .catch((error) => {
          console.log(error);
          this.error = "some thing want to wrong";
        });
    },
    uploadImage(e) {
      const file = e.target.files[0];

      ///let image file size check
      let reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = (evt) => {
        let img = new Image();
        img.onload = () => {
          if (img.width < 360 && img.height < 360) {
            this.form.image = file;
            this.file = evt.target.result;
            return;
          } else {
            this.disabled = true;
            alert(
              "Image maximu size 360*360px.But Upload imaze size" +
                img.width +
                "*" +
                img.height +
                "px"
            );
            return;
          }
        };
        img.src = evt.target.result;
      };
    },

    getAdmin() {
      axios.get("/single/admin").then((resp) => {
        this.form.name = resp.data.admin.name;
        this.form.email = resp.data.admin.email;
        this.form.id = resp.data.admin.id;
        if (resp.data.admin.image != null) {
          this.file =this.$store.state.image_base_link+resp.data.admin.image;
        }
      });
    },

    edit() {
      if (this.editMode == true) {
        this.updateProfile();
      } else {
        this.editMode = true;
        this.actionText = "Update";
      }
    },
  },
  computed: {},
};
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}
</style>
