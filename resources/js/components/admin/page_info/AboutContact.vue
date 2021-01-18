<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">setting</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header text-center with-border">
                <h3 class="box-title">About And Contact Information</h3>
              </div>
              <div class="box-body">
                <div class="alert-danger alert" v-if="error">{{ error }}</div>

                <form
                  @submit.prevent="updateAboutAndContact"
                  @keydown="form.onKeydown($event)"
                  enctype="multipart/form-data"
                  >
                      <div class="row">
                    <div class="col-lg-12">
                
                      <div class="form-group">
                        <label for="invoice">Contact Details </label>
                        <ckeditor
                          :editor="editor"
                          name="contact_info"
                          :class="{
                            'is-invalid': form.errors.has('contact_info'),
                          }"
                          v-model="form.contact_info"
                          :config="editorConfig"
                        ></ckeditor>
                        <has-error
                          :form="form"
                          field="contact_info"
                        ></has-error>
                      </div>

                    </div>
                      <br/>
                  <div class="col-lg-12">
                
                      <div class="form-group">
                        <label for="invoice">About Information Details </label>
                        <ckeditor
                          :editor="editor"
                          name="about_info"
                          :class="{
                            'is-invalid': form.errors.has('about_info'),
                          }"
                          v-model="form.about_info"
                          :config="editorConfig"
                        ></ckeditor>
                        <has-error
                          :form="form"
                          field="about_info"
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
    this.getAboutAndContact();
  },
  data() {
    return {
      form: new Form({
        id: "",
        contact_info: "",
        about_info: "",
      }),
      editor: ClassicEditor,
      editorConfig: {},
      error: "",
      loading: true,
    };
  },

  methods: {
    getAboutAndContact() {
      axios.get("/api/get/about/contact")
      .then((resp) => {
        console.log(resp);
        if (resp.data.status == "OK") {
          this.form.id = resp.data.setting.id;
          this.form.contact_info = resp.data.setting.contact_info;
          this.form.about_info = resp.data.setting.about_info;
          this.loading=false;
        }
      });
    },

    updateAboutAndContact() {
      this.form
        .post("/api/edit/about/contact/info/"+this.form.id, {
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
            this.getAboutAndContact();
          } else {
            this.error = "some thing want to wrong";
          }
        })
 
    },
  },
};
</script>
