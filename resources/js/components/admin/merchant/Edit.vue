<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'merchant' }" class="btn btn-primary"
            ><i class="fa fa-arrow-right"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Merchant</a>
          </li>
          <li class="active">Edit</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Merchant Information</h3>
              </div>
              <div class="box-body">
                <h1 v-if="loading"><i class="fa fa-spinner fa-spin"></i></h1>
                <form
                  v-else
                  @submit.prevent="updateMerchant"
                  @keydown="form.onKeydown($event)"
                  enctype="multipart/form-data"
                >
                  <ul class="list-group" v-if="errors">
                    <li
                      class="list-group-item"
                      v-for="(error, index) in errors"
                      :key="index"
                    >
                      {{ error.name }}
                    </li>
                  </ul>
                  <div class="form-group">
                    <label>Name</label>

                    <input
                      v-model="form.name"
                      type="text"
                      name="name"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                      autofocus
                      autocomplete="off"
                      placeholder="name"
                    />

                    <has-error :form="form" field="name"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input
                      v-model="form.email"
                      type="email"
                      name="email"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('email') }"
                      autofocus
                      autocomplete="off"
                      placeholder="email"
                    />
                    <has-error :form="form" field="email"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input
                      type="text"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('phone') }"
                      autocomplete="off"
                      autofocus
                      v-model="form.phone"
                      name="phone"
                      id=""
                    />
                    <has-error :form="form" field="phone"> </has-error>
                  </div>

                  <div class="form-group">
                    <label for="company_name">Compnay Name </label>
                    <input
                      type="text"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('company_name') }"
                      autocomplete="off"
                      autofocus
                      v-model="form.company_name"
                      name="company_name"
                    />
                    <has-error :form="form" field="company_name"> </has-error>
                  </div>

                  <div class="form-group">
                    <label for="address">Address</label>

                    <textarea placeholder="write title about this merchant"
                      v-model="form.address"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('address') }"
                      name="address"
                      rows="3"
                    ></textarea>

                    <has-error :form="form" field="address"> </has-error>
                  </div>
                    <div class="form-group text-center ">
        
                     <img
                      :src=" form.image ? base_url + form.image : base_url + 'images/no_image.jpg'"
                      class="image-responsive"  id="preview_Image"
                      style="max-width:400px;"
                    />
                    </div>

                  <div class="form-group">
                    <label>Image</label>
                    <input
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('image') }"
                      type="file"
                      @change="uploadImage"
                      name="image"
                    />
                    <has-error :form="form" field="image"></has-error>
                  </div>
                  <br />
                  <div class="form-group text-center ">
                   <button
                    :disabled="form.busy"
                    type="submit"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-spin fa-spinner" v-if="form.busy"></i>Update
                  </button>
                  </div>
                </form>
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
  created() {
    setTimeout(() => {
      this.loading = false;
    }, 500);

    this.getmerchant();
  },
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        phone: "",
        company_name: "",
        address: "",
        image: "",
      }),
      base_url: this.$store.state.image_base_link ,
      loading: true,
      errors: [],
    };
  },

  methods: {
    updateMerchant() {
      this.form
        .post("/api/merchant/update/" + this.$route.params.id, {
          transformRequest: [
            function (data, headers) {
              return objectToFormData(data);
            },
          ],
        })

        .then((resp) => {
            console.log(resp)
          if (resp.data.success == "OK") {
            this.$router.push({ name: "merchant" });
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 4000,
            });
          }
        })

        .catch((e) => {
          this.errors = [];
          this.errors.push(e.response.data.errors);
        });
    },

    getmerchant() {
      axios.get("/api/merchant/edit/" + this.$route.params.id).then((resp) => {
        if (resp.data.success == "OK") {
          this.form.name = resp.data.merchant.name;
          this.form.email = resp.data.merchant.email;
          this.form.phone = resp.data.merchant.phone;
          this.form.company_name = resp.data.merchant.company_name;
          this.form.address = resp.data.merchant.address;
          this.form.image = resp.data.merchant.image;
        }
      });
    },

    uploadImage(e) {
      const file = e.target.files[0];
      this.form.image = file;
      ///let image file size check
      let reader = new FileReader();
        
      reader.readAsDataURL(file);
      reader.onload = (evt) => {
        let img = new Image();

        img.onload = () => {
          console.log(img.width + "-" + img.height);
        };
        document.getElementById('preview_Image').src = evt.target.result;
     
      };
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
