<template>
  <div class="wrapper-wide">
    <frontend-header></frontend-header>
    <div id="container">
      <div class="container">
        <div style="margin: 20px" class="row bg-white shadow">
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div style="margin-top:20px;" class="job_info">
              <h4 class="heading">{{ title }}</h4>
              <p>
                <i class="fa fa-briefcase"></i> Number of vacency :
                {{ vacency }}
              </p>
              <p>
                <i class="fa fa-lg fa-map-marker" aria-hidden="true"></i>
                Mirpur-10,Dhaka
              </p>
              <p>
                <i class="fa fa-calendar" aria-hidden="true"></i> Deadline :
                {{ deadline }}
              </p>

              <img
                :src="image ? image_base_link+image : image_base_link+'images/no_image.jpg'"
                class="feature_image"
              />
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div style="margin-top:20px;"  class="job_desc">
              <h4 class="heading">Job Description</h4>
              <p
                v-html="description"
                style="word-break: break-all; padding: 10px"
              ></p>
            </div>
          </div>
        </div>

        <div style="margin: 20px" class="row bg-white shadow">
          <div class="col-md-4 col-lg-4 col-sm-4">
            <div  style="margin-top:20px;"  class="job_info">
              <h4 class="heading">Apply Now!</h4>
              <p>
                We are really excited that you are trying to apply to us. But
                sincerely, we are looking for you. Let’s talk, let’s collaborate
                for something new, something exciting!
              </p>
            </div>
          </div>

          <div class="col-md-8 col-lg-8 col-sm-8">
            <div style="margin-bottom: 25px; margin-top:20px" class="job_desc">
              <form
                @submit.prevent="applyJob"
                method="post"
                enctype="multipart/form-data"
              >
                <div class="form-group">
                  <label for="name"> Name</label>
                  <input :class="{ 'is-invalid' : form.errors.has('name') }"
                    class="form-control"
                    autofocus
                    placeholder="write full name"
                    type="text"
                     name="name"
                    v-model="form.name"
                  />
                  <has-error :form="form" field="name" > </has-error>
                </div>

                <div class="form-group">
                  <label for="email"> Email</label>
                  <input :class="{ 'is-invalid' : form.errors.has('email') }"
                    class="form-control"
                    autofocus
                     name="email"
                    placeholder=" example@gmail.com "
                    type="emial"
                    v-model="form.email"
                  />
                    <has-error :form="form" field="email" > </has-error>
                </div>

                  <div class="form-group">
                  <label for="phone"> Phone</label>
                  <input :class="{ 'is-invalid' : form.errors.has('phone') }"
                    class="form-control"
                    autofocus
                     name="phone"
                    placeholder="+88 01xxxxxxxxx "
                    type="text"
                    v-model="form.phone"
                  />
                    <has-error :form="form" field="phone" > </has-error>
                </div>

                <div class="form-group">
                  <label for="name">Applying For </label>
                  <input
                   :class="{ 'is-invalid' : form.errors.has('subject') }"
                    class="form-control"
                    placeholder="applying for  the post of......."
                    autofocus
                    type="text"
                    v-model="form.subject"
                  />
                     <has-error :form="form" field="subject" > </has-error>
                </div>

                <div class="form-group">
                  <label for="name">Write Cover Letter</label>
                  <textarea :class="{ 'is-invalid' : form.errors.has('message') }"
                    v-model="form.message"
                    class="form-control"
                    autofocus
                    placeholder="write cover letter and describe yourself"
                    rows="5"
                  ></textarea>
                     <has-error :form="form" field="message" > </has-error>
                </div>

                <div class="form-group">
                  <label>CV/Resume file (doc, pdf)</label>
                  <input 
                    :class="{ 'is-invalid' : form.errors.has('file') }"
                    @change="uploadFile"
                    type="file"
                    class="form-control"
                    name="file"
                  />
                     <has-error :form="form" field="file" > </has-error>
                </div>

                <button
                   class="btn btnSubmit btn-lg"
                  :disabled="form.busy"
                  type="submit"
                > <i class="fa fa-spiner" v-if="form.busy "></i>Send</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <frontend-footer></frontend-footer>
  </div>
</template>
<script>
import Vue from "vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import { Form, HasError, AlertError } from "vform";
export default {

        created(){
           this.getCarrierDetails();
        },
       
        data(){
          return {

            form: new Form({
                name : '',
                email : '',
                phone:'',
                message : '',
                subject : '',
                file : '',
            }),

            title : "",
            vacency : "",
            deadline:"",
            description:"",
            image : "",
            image_base_link:this.$store.state.image_base_link ,
            

          }
          

        },
        methods:{
 
          getCarrierDetails(){
            axios.get('/_public/carrier/details/'+this.$route.params.id)
            .then(resp => {
         
              if (resp.data.success=="OK") {
                this.title = resp.data.carrier.title ;
                this.description = resp.data.carrier.description ;
                this.deadline = resp.data.carrier.deadline ;
                this.vacency = resp.data.carrier.vacency ;
                this.image = resp.data.carrier.image ;
              }
            })
            .catch()
          },

          uploadFile(e){
               const file = e.target.files[0] ;
                this.form.file=file ;   
               },
     
     
            applyJob(){ 
                this.form.post('/_public/api/carrier/apply/by/job/'+this.$route.params.id,{
                  transformRequest: [
                function (data, headers) {
                return objectToFormData(data);
                },
            ],
              
            })
            .then(resp =>{
               if (resp.data.success == "OK") {
                  this.$toasted.show('Thanks for apply. we will notice your application',{
                    type: 'success',
                    duration:6000,
                    position:'top-center',
                  });

                  this.$router.push({ name : 'carrier_public' });
               }else{
                   
                   this.$toasted.show('sorry :) try agian ',{
                    type: 'error',
                    duration:4000,
                    position:'top-center',
                  });
                  
               } 
               
            })
            
        }
},

  components:{


      Loading
        }
      }
</script>


<style>
.contact-li {
  list-style-type: none;

  margin-top: 10px;
}
p {
    font-size: 18px;
    line-height: 24px;
}
.btnSubmit{
    background:#FF4D03 ;
    color:#fff;
    width: 100px;
    border-radius: 5px;
    margin-top: 10px;
    border: 1px dashed;

}

.feature_image{ 
  width: 250px; 
  height: 200px; 
  border-radius: 10px ;
}


@media screen and (max-width: 350px) {

  p {
      font-size: 14px;
      line-height: 24px;
  }


  .feature_image {
    width: 205px;
    height: 132px;
    border-radius: 10px;
  }



}


</style>