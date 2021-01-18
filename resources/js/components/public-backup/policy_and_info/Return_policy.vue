<template>
  <div >
        <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading>

    <frontend-header></frontend-header>
      <div class="row text-center">
            <div :style="{
                height: '300px',
                marginTop: '-10px',
                backgroundImage: 'url(/public/images/background.jpg)',
                backgroundPosition: 'center center',
                backgroundSize: 'cover'
                }" >
               
            </div>
      </div>

     <div class="row">
            <div class="col-sm-12 col-md-12"> 
              <div style="background-color:#eee" class="container-fluid ">
                <div style="margin-top:20px;" class="container">   
                  <div class="box bg-white shadow desc_info"> 
                  <h4 style="padding:15px" class="heading" > <i class="fa fa-eye"></i><b> RETURN POLICY</b>   </h4>    
                  <p>   পণ্য গ্রহনের পরে আপনি পণ্যের যে কোন সমস্যায় (যেমন : পণ্য ভাঙ্গা , ছেঁড়া, পণ্য কাজ না করা, ছবির সাথে পণ্যের মিল না থাকা ইত্যাদি) ক্ষেত্রে আপনি পরিবর্তিত পণ্য গ্রহণ করতে পারবেন। সেক্ষেত্রে পণ্য গ্রহনের পর সর্বোচ্চ ৪৮ ঘণ্টার মধ্যে আপনি complain@mohasagor.com এ ই মেইল করতে হবে অথবা আমাদের হটলাইন নাম্বার 09-636-203040 এ আমাদের অবহিত করতে হবে। উল্লেখ্য যে, আপনার মনের পরিবর্তনের ফলে কোন পণ্য রিপ্লেস করলে হলে কুরিয়ার খরচ আপনাকে বহন করতে হবে এবং mohasagor.com কর্তৃক কোন পণ্যে সমস্যা থাকলে 
                      সেটা mohasagor.com বহন করবে। আপনার - প্রশ্ন - মতামত – অভিযোগ আমাদের জানান- ফোন: 01627-444999, ই-মেইল: complain@mohasagor.com</p> 
                  
                 </div>
                </div>
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
  created(){

    setTimeout(()=>{
      this.isLoading=false;
    },1000)
  },
  data(){
    return {
      isLoading: true,
      fullPage: true,
    }
  },
  components:{
Loading
  }
}
</script>

<style >
  .desc_info p {

      padding:5px;
      margin:10px;
      padding-bottom:20px;
  }
</style>