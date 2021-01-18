<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Background and Color Setting</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header text-center with-border">
                <h2 class="box-title">SET THEME COLOR </h2>
              </div>
              <div class="box-body">
                <div class="alert-danger alert" v-if="error">{{ error }}</div>

                <form
                  @submit.prevent="updateColorSetting"
                  enctype="multipart/form-data"
                >
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <div class="row text-center">
                            <div class="col-md-1"></div>
                            <div class="col-md-4"> <h5> PLACEMENT</h5> </div>
                            <div class="col-md-4"> <h5> SELECT COLOR </h5> </div>
                            <div class="col-md-3"> <h6> ENTER SIX DIGITS HEX CODE <br/> 
                                    <span style="font-size:12px;color:green">  example: #fc721e </span>  </h6> </div>
                        </div>
                       <div class="row">
                           <div class="col-md-1"></div>
                           <div class="col-md-4"> <label> Primary Color </label></div>
                           <div class="col-md-4">
                             <input
                                class="form-control"
                                type="color"
                                v-model="form.primary_color"
                                />
                           </div> 
                           <div class="col-md-3">
                              <input type="text" v-model="form.primary_color" class="form-control" >
                          </div>
                       </div>
                     </div>

                    <div class="form-group">
                       <div class="row">
                           <div class="col-md-1"></div>
                           <div class="col-md-4"> <label> Primary Text Color </label></div>
                           <div class="col-md-4">
                             <input
                                class="form-control"
                                type="color"
                                v-model="form.primary_text_color"
                                />
                           </div> 
                              <div class="col-md-3">
                              <input type="text" v-model="form.primary_text_color" class="form-control" >
                            </div>
                       </div>
                     </div>

                     <div class="form-group">
                       <div class="row">
                           <div class="col-md-1"></div>
                           <div class="col-md-4"> <label> Primary Background Color </label></div>
                           <div class="col-md-4">
                             <input
                                class="form-control"
                                type="color"
                                v-model="form.primary_background_color"
                                />
                           </div> 
                            <div class="col-md-3">
                              <input type="text" v-model="form.primary_background_color" class="form-control" >
                            </div>
                       </div>
                     </div>


                     <div class="form-group">
                       <div class="row">
                           <div class="col-md-1"></div>
                           <div class="col-md-4"> <label> Menu Background Color </label></div>
                           <div class="col-md-4">
                             <input
                                class="form-control"
                                type="color"
                                v-model="form.menu_background_color"
                                />
                           </div> 
                            <div class="col-md-3">
                              <input type="text" v-model="form.menu_background_color" class="form-control" >
                            </div>
                       </div>
                     </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-1"></div>
                           <div class="col-md-4"> <label> Menu Text Color </label></div>
                           <div class="col-md-4">
                             <input
                                class="form-control"
                                type="color"
                                v-model="form.menu_text_color"
                                />
                           </div> 
                              <div class="col-md-3">
                              <input type="text" v-model="form.menu_text_color" class="form-control" >
                          </div>
                       </div>
                     </div>


                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-1"></div>
                           <div class="col-md-4"> <label> Sub Menu Background Color </label></div>
                           <div class="col-md-4">
                             <input
                                class="form-control"
                                type="color"
                                v-model="form.sub_menu_background_color"
                                />
                           </div> 
                            <div class="col-md-3">
                              <input type="text" v-model="form.sub_menu_background_color" class="form-control" >
                            </div>
                       </div>
                     </div>


                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-1"></div>
                           <div class="col-md-4"> <label> Sub Menu Text Color </label></div>
                           <div class="col-md-4">
                             <input
                                class="form-control"
                                type="color"
                                v-model="form.sub_menu_text_color"
                                />
                           </div> 
                              <div class="col-md-3">
                              <input type="text" v-model="form.sub_menu_text_color" class="form-control" >
                            </div>
                       </div>
                     </div>

                       <br/>
                      <div class="form-group text-center">
                        <button
                          :disabled="form.busy"
                          type="submit"
                          class="btn btn-primary"
                        >
                          <i class="fa fa-spin fa-spinner" v-if="form.busy"></i
                          > Change Theme
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
    this.getThemeSetting();
  },
  data() {
    return {
      form: new Form({
        id: "",
        primary_color: "",
        primary_background_color: "",
        menu_background_color: "",
        sub_menu_background_color: "",
        primary_text_color: "",
        menu_text_color: "",
        sub_menu_text_color: "",
    
      }),
      error: "",
      loading: true,
    };
  },

  methods: {
    getThemeSetting() {
      axios.get("/api/get/site/theme/info")
      .then((resp) => {
        console.log(resp);
        if (resp.data.status == "OK") {
          this.form.id = resp.data.setting.id;
          this.form.primary_color = resp.data.setting.primary_color;
          this.form.primary_background_color = resp.data.setting.primary_background_color;
          this.form.menu_background_color = resp.data.setting.menu_background_color;
          this.form.sub_menu_background_color = resp.data.setting.sub_menu_background_color;
          this.form.primary_text_color = resp.data.setting.primary_text_color;
          this.form.menu_text_color = resp.data.setting.menu_text_color;
          this.form.sub_menu_text_color = resp.data.setting.sub_menu_text_color;

        }
      });
    },

    updateColorSetting() {
      this.form
        .post("/api/edit/site/theme/info/"+this.form.id, {
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
            this.getThemeSetting();
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

<style scoped>
    
    input {
        cursor: pointer;
    }

</style>