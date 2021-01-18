<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">General Setting</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header text-center with-border">
                <h3 class="box-title">Footer Information</h3>
              </div>
              <div class="box-body">
                <div class="alert-danger alert" v-if="error">{{ error }}</div>

                <form
                  @submit.prevent="updateFooterSetting"
                  @keydown="form.onKeydown($event)"
                  enctype="multipart/form-data"
                >
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label> Facebook URL </label>
                        <input
                          class="form-control"
                          type="text"
                          v-model="form.facebook_url"
                        />
                      </div>

                      <div class="form-group">
                        <label> Youtube URL </label>
                        <input
                          class="form-control"
                          type="text"
                          v-model="form.youtube_url"
                        />
                      </div>

                      <div class="form-group">
                        <label> Twitter URL </label>
                        <input
                          class="form-control"
                          type="text"
                          v-model="form.twitter_url"
                        />
                      </div>

                      <div class="form-group">
                        <label> Linkedin URL </label>
                        <input
                          class="form-control"
                          type="text"
                          v-model="form.linkedin_url"
                        />
                      </div>

                      <div class="form-group">
                        <label> Copyright Info. </label>
                        <textarea
                          class="form-control"
                          v-model="form.copyright_info"
                          rows="2"
                        ></textarea>
                      </div>

                      <div class="form-group">
                        <label for="invoice">Footer Short Description </label>
                        <ckeditor
                          :editor="editor"
                          name="footer_description"
                          :class="{
                            'is-invalid': form.errors.has('footer_description'),
                          }"
                          v-model="form.footer_description"
                          :config="editorConfig"
                        ></ckeditor>
                        <has-error
                          :form="form"
                          field="footer_description"
                        ></has-error>
                      </div>

                      <div class="form-group text-center">
                        <button
                          :disabled="form.busy"
                          type="submit"
                          class="btn btn-primary"
                        >
                          <i class="fa fa-spin fa-spinner" v-if="form.busy"></i
                          >Submit
                        </button>
                      </div>
                    </div>
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
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

Vue.component(HasError.name, HasError);
export default {
  name: "subCategory",
  created() {
    this.getFooterSetting();
  },
  data() {
    return {
      form: new Form({
        id: "",
        facebook_url: "",
        twitter_url: "",
        youtube_url: "",
        linkedin_url: "",
        copyright_info: "",
        footer_description: "",
      }),
      editor: ClassicEditor,
      editorConfig: {},
      error: "",
      loading: true,
    };
  },

  methods: {
    getFooterSetting() {
      axios.get("/api/get/site/footer/info")
      .then((resp) => {
        console.log(resp);
        if (resp.data.status == "OK") {
          this.form.id = resp.data.setting.id;
          this.form.facebook_url = resp.data.setting.facebook_url;
          this.form.twitter_url = resp.data.setting.twitter_url;
          this.form.youtube_url = resp.data.setting.youtube_url;
          this.form.linkedin_url = resp.data.setting.linkedin_url;
          this.form.copyright_info = resp.data.setting.copyright_info;
          this.form.footer_description = resp.data.setting.footer_description;

        }
      });
    },

    updateFooterSetting() {
      this.form
        .post("/api/edit/site/footer/info/"+this.form.id, {
          transformRequest: [
            function (data, headers) {
              return objectToFormData(data);
            },
          ],
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 4000,
            });
            this.getFooterSetting();
          } else {
            this.error = "some thing want to wrong";
          }
        })
        .catch((error) => {
          this.error = error.response.data.errors;
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 5000,
          });
        });
    },
  },
};
</script>
