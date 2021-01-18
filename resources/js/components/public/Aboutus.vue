<template>
  <div class="wrapper-wide">
    <loading
      :active.sync="isLoading"
      :can-cancel="true"
      :is-full-page="fullPage"
    ></loading>

    <frontend-header></frontend-header>
    <div id="container">
      <div class="container">
        <div class="row">
          <!--Middle Part Start-->
          <div id="content" class="col-sm-12 bg-white shadow">
            <h4 class="title">About Us</h4>
            <div class="row">
              <div class="col-sm-12">
                <p v-html="about_info">

                </p>
 
              </div>
            </div>
          </div>
          <!--Middle Part End -->
        </div>
      </div>
    </div>

    <frontend-footer></frontend-footer>>
  </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  created() {
    this.getAboutusInfo();
  },
  data() {
    return {
      isLoading: true,
      fullPage: true,
      about_info:"",
    };
  },
  methods:{
 
     getAboutusInfo(){
         axios.get('/_public/api/get/info/abou/contact')
         .then(resp=>{
           console.log(resp);
           if (resp.data.status=="OK") {
             this.about_info=resp.data.setting.about_info ;
             this.isLoading=false;
           }
         })
     }
  },
  components: {
    Loading,
  },
};
</script>

<style scoped>
@media screen and (max-width: 350px) {
  h4 {
    margin-left: 10px;
  }
  p {
    font-size: 13px;
    padding: 10px;
    line-height: 24px;
  }
}
#content {
  min-height: 400px;
  padding: 50px 50px;
}
</style>
