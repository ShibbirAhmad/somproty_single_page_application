<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#">
              <i class="fa fa-dashboard"></i>Dashboard
            </a>
          </li>
          <li class="active">General Setting</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header text-center with-border">
                <h3 class="box-title ">
                  General Information 
                </h3>
              </div>
              <div class="box-body">
                <div class="alert-danger alert" v-if="error">{{error}}</div>

                <form
                  @submit.prevent="updateGeneralSetting"

                  @keydown="form.onKeydown($event)"
                  enctype="multipart/form-data"
                  >
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label> Title </label>
                        <input class="form-control" 
                        :class="{'is-invalid' : form.errors.has('header_contact_number') }"
                         type="text"  v-model="form.title" />
                         <has-error :form="form" field="header_contact_number"> </has-error>
                      </div>
                       <br/>
                    

                          <div class="form-group"> 
                            <label > Upload Favicon </label>
                              <img id="preview_icon" @click="clickFavicon" :src="preview_icon" >
                            <input
                              id="upload_icon"
                              type="file"
                              @change="uploadIcon"
                              name="icon"
                            >
                          </div>

                          <div class="form-group">
                            <label for="logo">Upload Logo</label>
                             <img @click="clickImage" id="preview_logo"  :src="preview_logo"  />
                              <input
                              id="uploadLogo"
                                class="form-control"
                                type="file"
                                @change="uploadLogo"
                                name="logo"
                              />
                          </div>
                  

                       <div class="form-group">
                        <label> Header Contact Number </label>
                        <input class="form-control" 
                          :class="{'is-invalid':form.errors.has('header_contact_number')}"
                          type="text" v-model="form.header_contact_number" />
                          <has-error :form="form" field="header_contact_number"> </has-error>
                      </div>
                      <div class="form-group">
                      <label for="invoice">Invoice Address Details </label>
                      <ckeditor
                        :editor="editor"
                        name="invoice_address_details"
                        :class="{ 'is-invalid': form.errors.has('invoice_address_details') }"
                        v-model="form.invoice_address_details"
                        :config="editorConfig"
                      ></ckeditor>
                       <has-error :form="form" field="invoice_address_details"></has-error>
                      </div>
                  
                    </div>
                  </div>
                   <div class="form-group text-center">
                    <button
                    :disabled="form.busy || disabled"
                    type="submit"
                    class="btn btn-primary "
                  >
                    <i class="fa fa-spin fa-spinner" v-if="form.busy"></i>Submit
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
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

Vue.component(HasError.name, HasError);
export default {
  name: "subCategory",
  created() {
    this.getGeneralSetting();
  },
  data() {
    return {
      form: new Form({
        id:"",
        logo: "",
        icon: "",
        title: "",
        invoice_address_details:"",
        header_contact_number:"",
      }),
      editor: ClassicEditor,
      editorConfig: {},
      error: "",
      loading: true,
      disabled: false, 
      logo_width: 155,
      logo_height: 60,
      ilogo_size:550,
      logo_size_text: "Image size must be 150*40px",
      icon_width: 32,
      icon_height: 32,
      icono_size:550,
      icon_size_text: "Image size must be 32*32px",
      base_url:this.$store.state.image_base_link,
      preview_logo:this.$store.state.image_base_link+"images/no_image.jpg",
      preview_icon:this.$store.state.image_base_link+"images/no_image.jpg",
    };

  },

  methods: {

    getGeneralSetting(){
            
        axios.get('/api/get/site/info')
        .then(resp => {
          console.log(resp);
          if (resp.data.status=="OK") {
            this.form.id=resp.data.setting.id;
            this.form.title= resp.data.setting.title ;
            this.form.logo= resp.data.setting.logo ;
            this.form.icon= resp.data.setting.icon ;
            this.form.header_contact_number= resp.data.setting.header_contact_number ;
            this.form.invoice_address_details= resp.data.setting.invoice_address_details ;

            if(this.form.logo){
              this.preview_logo=this.base_url+this.form.logo;
             }

           if(this.form.icon){
              this.preview_icon=this.base_url+this.form.icon;
            }
 
          }
        })    
    },

    updateGeneralSetting() {
      this.form
        .post("/api/edit/site/info/"+this.form.id, {
          transformRequest: [
            function (data, headers) {
              return objectToFormData(data);
            },
          ],
        })
        .then((resp) => {
          console.log(resp)
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 4000,
            });
            this.getGeneralSetting();
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

    uploadLogo(e) {
      const file = e.target.files[0];
     if (!file.type.match("image.*")) {
         Swal.fire({
          type:'warning',
          text:'this is not any kind of image',
        });
        return;
      }
       if(file.size/1024>this.logo_size){
        Swal.fire({
          type:'warning',
          text:`File size can not be bigger then ${this.logo_size}KB. maximum file size is 500k KB`,
        });
        return;
      }
 ///let image file size check
      let reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = (evt) => {
        let img = new Image();
        img.onload = () => {
          console.log(img.width, img.height);
          if (
            img.width == this.logo_width &&
            img.height == this.logo_height
          ) {
            this.setLogo(file, evt);
            return;
          } else {
            this.disabled = true;

            Swal.fire({
              type:'error',
              text:  "Image size need " + this.logo_width +"*" + this.logo_height +  "px. But Upload imaze size " + img.width+ "*" +
                img.height +
                "px"
            })
            return;
          }
        };
        img.src = evt.target.result;
      };
    },

    setLogo(file, evt) {
      this.disabled = false;
      this.form.logo = file;
      this.preview_logo =evt.target.result;
    },


     uploadIcon(e) {
      const file = e.target.files[0];
     if (!file.type.match("image.*")) {
         Swal.fire({
          type:'warning',
          text:'this is not any kind of image',
        });
        return;
      }
       if(file.size/1024>this.logo_size){
        Swal.fire({
          type:'warning',
          text:`File size can not be bigger then ${this.logo_size}KB. maximum file size is 500k KB`,
        });
        return;
      }
 ///let image file size check
      let reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = (evt) => {
        let img = new Image();
        img.onload = () => {
          console.log(img.width, img.height);
          if (
            img.width == this.icon_width &&
            img.height == this.icon_height
          ) {
            this.setIcon(file, evt);
            return;
          } else {
            this.disabled = true;

            Swal.fire({
              type:'error',
              text:  "Image size need " + this.icon_width +"*" + this.icon_height +  "px. But Upload imaze size " + img.width+ "*" +
                img.height +
                "px"
            })
            return;
          }
        };
        img.src = evt.target.result;
      };
    },
    
    setIcon(file, evt) {
      this.disabled = false;
      this.form.icon = file;
      this.preview_icon = evt.target.result;
    },
    clickImage(){
      let logo_file=document.getElementById('uploadLogo')
          logo_file.click()
   
  
    },

    clickFavicon(){
       let favicon_file = document.getElementById('upload_icon');    
           favicon_file.click();
    }      


  },

};
</script>

<style>



#uploadLogo {
    display: none;
}

#preview_logo {
    border: 1px solid #ddd;
    padding: 5px;
    cursor: pointer;
    margin-left:25px;
}



#upload_icon {
    display: none;
}

#preview_icon {
    padding: 15px;
    cursor: pointer;
    margin-left:50px;
}

</style>