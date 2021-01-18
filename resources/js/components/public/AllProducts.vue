<template>
  <div class="wrapper-wide">
    <frontend-header></frontend-header>
    <div id="container">
      <div class="container">
   
        <!-- Breadcrumb End-->
        <div class="row">

          <div id="content" class="col-sm-12">
           <div class="row">
              <div class="col-lg-3 col-sm-6 col-md-6 col-xs-6 " v-for="product in products" :key="product.id">
            <div class="product-card small-card">
              <div class="prodict-card-body">
                <router-link :to="{name: 'single', params: { slug: product.slug } }">
                  <img   v-if="product.product_image.length" :src=" base_url +product.product_image[0].product_image"/>
                </router-link>
                <div class="product-detail small-detail">
                  <h4>   <router-link class="product-link" :to="{name: 'single', params: { slug: product.slug } }">{{ product.name }}</router-link ></h4>
                  <p class="price">
                    <span class="price-new">{{
                      product.price
                    }}</span>
                    <span
                      class="price-old"
                      v-if="product.discount"
                      >{{ product.sale_price }}</span
                    >
                    <!-- <span class="saving">-26%</span> -->
                  </p>
                </div>
              </div>
              <div class="product-card-footer">
                    <button class="btn btn-primary btnQuick" style="cursor:pointer" @click="quick_v_product_id=product.id"  >view</button>
              </div>
            </div>
          </div>
              <infinite-loading @infinite="getAllProducts">
                <div slot="no-more"></div>
              </infinite-loading>
            </div>
          </div>
        </div>
  </div>
  <frontend-footer></frontend-footer>
      <quick-view v-if="quick_v_product_id" v-on:clicked="closedModal($event)" :quick_v_p_id="quick_v_product_id">  </quick-view>
  </div>
  </div>
</template>
<script>
import carousel from "vue-owl-carousel";

export default {
  created() {
    window.scrollTo(0, 0);

    this.$Progress.start();
    setTimeout(() => {
      this.$Progress.finish();
    }, 500);
  },
  data() {
    return {
      products:"",
      category_name: "",
      page: 1,
      price_page: 1,
       base_url: this.$store.state.image_base_link,
       quick_v_product_id:"",
       o_modal:false
    };
  },
  methods: {
    getAllProducts() {
      axios
        .get("/_public/api/get/all/products")
        .then((resp) => {
         console.log(resp);
          if (resp.data.status=="OK") {
            this.products=resp.data.products;
          } 
        })
       
    },

  closedModal(close){
       this.quick_v_product_id="";
    }

  },
  
};
</script>

<style >
.search-box {
  margin-top: 20px;
}

.btn_search {
  background: #ff4d03;
  color: #fff;
  border: 1px dashed;
}

.product-card-footer {
  padding:0px;
}
.btnQuick:hover{

   background: #ff4d03; 

}


@media screen and (max-width: 350px) {

  .small-card  
    {
    width: 100%;
    height: auto;
    background: #fff;
    border: 1px solid #ddd;
    text-align: center;
    margin-bottom: 25px;
    }

  .small-card  p
    {
    font-size: 13px;
    line-height: 0px;
    margin-top: -5px;
    }

  .small-detail h4 
   {
    font-size: 13px;
    padding-bottom: 3px;
    margin-top: -5px;
   }

 .prodict-card-body img {
	width: 120px !important;
	height: 130px !important;

 }


}

</style>