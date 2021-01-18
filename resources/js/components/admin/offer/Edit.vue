<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{name:'offer'}" class="btn btn-primary">
            <i class="fa fa-arrow-right"></i>
          </router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#">
              <i class="fa fa-dashboard"></i>Dashboard
            </a>
          </li>
          <li class="active">Baner</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">
                  Edit Offer
                  <small>(Image size must be 165*165px)</small>
                </h3>
              </div>
              <div class="box-body">
                <h1 v-if="loading">
                  <i class="fa fa-spinner fa-spin"></i>
                </h1>
                <form
                  v-else
                  @submit.prevent="updateOffer"
                  @keydown="form.onKeydown($event)"
                  enctype="multipart/form-data"
                >
                  <div class="alert-danger alert" v-if="error">{{ error }}</div>
                  <div class="form-group">
                      <img v-if="this.preview_image.length" style="width:100%;height:250px;" :src="this.preview_image" >
                      <img v-else style="width:100%;height:250px;" :src="this.base_url+form.image" >
                    <label>Offer_image</label>
                    <input
                      type="file"
                      name="image"
                      class="form-control"
                      @change="uploadImage"
                      :class="{ 'is-invalid': form.errors.has('image') }"
                    />
                    <has-error :form="form" field="image"></has-error>
                  </div>
                  <div class="form-group">
                    <label>Offer_url</label>
                    <input
                      v-model="form.url"
                      type="text"
                      name="url"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('url') }"
                      autocomplete="off"
                      placeholder="offer"
                    />
                    <has-error :form="form" field="url"></has-error>
                  </div>

                  <br />
                  <button :disabled="form.busy || disabled" type="submit" class="btn btn-primary">
                    <i class="fa fa-spin fa-spinner" v-if="form.busy"></i>Submit
                  </button>
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
  name: "Add",
  created() {
    setTimeout(() => {
      this.loading = false;
    }, 500);
    this.getEditOffer();
  },
  data() {
    return {
      form: new Form({
        image: "",
        url: "",
      }),
      loading: true,
      error: "",
      disabled: true,
      base_url: this.$store.state.image_base_link ,
      preview_image:"",
    };
  },

  methods: {

    getEditOffer(){
        axios.get('/api/edit/offer/item/get/'+this.$route.params.id)
        .then(resp => {
            console.log(resp);
            if (resp.data.status== "OK") {
                this.form.image=resp.data.offer.image ;
                this.form.url= resp.data.offer.url ;
            }
        })
    },  
    updateOffer() {
      this.form
        .post("/api/offer/edit/"+this.$route.params.id, {
          transformRequest: [
            function (data, headers) {
              return objectToFormData(data);
            },
          ],
          onUploadProgress: (e) => {
            // Do whatever you want with the progress event
            console.log(e);
          },
        })
        .then((resp) => {
          //   console.log(resp)
          if (resp.data.status == "SUCCESS") {
            this.$router.push({ name: "offer" });
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 4000,
            });
          } else {
            this.error = "some thing want to wrong";
          }
        })
        .catch((error) => {
          //  console.log(error)
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
          if (img.width == 165 && img.height == 165) {
            this.setImage(file);
            return;
          } else {
            this.disabled = true;
            alert(
              "Image size need 165*165px.But Upload imaze size" +
                img.width +
                "*" +
                img.height +
                "px"
            );
            return;
          }
        };
        img.src = evt.target.result;
        this.preview_image=evt.target.result ;
      };
    },
    setImage(file) {
      this.disabled = false;
      this.form.image = file;
      
    },
  },
};
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}
</style>
