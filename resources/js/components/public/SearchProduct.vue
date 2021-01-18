<template>
  <div class="wrapper-wide">
    <frontend-header></frontend-header>
    <div id="container">
      <div class="container">
        <div class="row">
          <div class="col-lg-6" style="margin-left:30px">
            <div class="row">
              <div class="col-lg-8">
                <input
                  class="form-control"
                  placeholder="Search Product"
                  v-model="search"
                  @keyup="searchProducts"
                />
              </div>
              <div class="col-lg-4">
                <button
                  type="button"
                  class="btn btn-success"
                  @click.prevent="searchProducts"
                >Search More</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="margin-top:15px;">

          <div
            class="col-lg-3 col-sm-6 col-md-6 col-xs-6 width-20"
           v-for="product in products" v-if="products"
            :key="product.id"
          >
            <div class="product-card small-card">
              <div class="prodict-card-body">
                <router-link
                  :to="{ name: 'single', params: { slug: product.slug } }"
                >
                  <img v-if="product.product_image.length" :src="base_url + product.product_image[0].product_image"
                  />
                </router-link>
                <div class="product-detail">
                  <h4>
                    <router-link
                      class="product-link"
                      :to="{ name: 'single', params: { slug: product.slug } }"
                      >{{ product.name }}</router-link
                    >
                  </h4>
                  <p class="price">
                    <span class="price-new">{{ product.price }}</span>
                    <span class="price-old" v-if="product.discount">{{
                      product.sale_price
                    }}</span>
                    <!-- <span class="saving">-26%</span> -->
                  </p>
                </div>
              </div>
                <div class="product-card-footer">
                    <button class="btn btn-primary btnQuick" style="cursor:pointer" @click="quick_v_product_id=product.id"  >quick view</button>
              </div>
            </div>
          </div>

         

          <div class="col-lg-12 text-center" v-if="products.length < 1 ">
            <h3 class="alert alert-warning">No product Found</h3>
          </div>
        </div>
      </div>
    </div>

    <frontend-footer></frontend-footer>
    <quick-view v-if="quick_v_product_id" v-on:clicked="closedModal($event)" :quick_v_p_id="quick_v_product_id">  </quick-view>

  </div>
</template>
<script>
export default {
  created() {
    this.searchProducts();
    window.scrollTo(0, 0);
  },
  data() {
    return {
      products: "",
      search: this.$route.params.search,
       base_url:this.$store.state.image_base_link,
       quick_v_product_id:"",
       o_modal:false
    };
  },

  methods: {
    searchProducts() {
      this.$Progress.start();
      axios
        .get("/_public/search/products/" + this.search)
        .then((resp) => {
          console.log(resp);
          this.products = resp.data;
          this.$Progress.finish();
        })
        .catch((error) => {
          console.log(error);
        });
    },

    
  closedModal(close){
       this.quick_v_product_id="";
    }


  },
};
</script>

<style  scoped>

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