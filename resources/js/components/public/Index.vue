<template>
  <div class="wrapper-wide">
    <frontend-header></frontend-header>

    <div class="slider slider-animation bv xz">
      <div class="row slider_background">
        <div class="col-lg-1"></div>
        <div class="col-lg-2">
          <div class="category-menu" id="category-menu">
            <ul class="category-menu-list list-group" >
              <li
                class="category-name "
                v-for="category in categories"
                :key="category.id"
              >
                <img :src="category.icon_image?base_url+category.icon_image : '' " >
                <a href="#" class="category-link">{{ category.name }}</a>

                <ul
                  class="sub-category-menu-list"
                  v-if="category.sub_category.length > 0"
                >
                  <li
                    class="sub-category-name"
                    v-for="sub_category in category.sub_category"
                    :key="sub_category.id"
                  >
                    <a href="" class="sub-category-link">{{
                      sub_category.name
                    }}</a>

                    <ul
                      class="sub-sub-category-list"
                      v-if="sub_category.sub_sub_category.length > 0"
                    >
                      <li
                        class="sub-sub-category-name"
                        v-for="sub_sub_category in sub_category.sub_sub_category"
                        :key="sub_sub_category.id"
                      >
                        <a href="#" class="sub-sub-category-name">
                          {{ sub_sub_category.name }}
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>

        <div style="padding-left:45px;"  class="col-lg-8 ">
          <div class="slider">
            <carousel
              v-if="sliders"
              :items="1"
              :nav="false"
              :autoplay="true"
              :autoplayTimeout="2000"
            >
              <a v-for="slider in sliders" :href="slider.url" :key="slider.id">
                <img
                  class="slider_imge"
                  style="min-height: 450px"
                  :src="base_url + slider.image"
                />
              </a>
            </carousel>
          </div>
        </div>

        <!-- <div class="col-lg-3 d-sm-none">
            <a href="">
              <img :src="base_url + slider_banner.image" />
            </a>
          </div> -->
      </div>
    </div>
    <div class="container">
    
      <div class="best-selling">
        <h4>Top Selling Products</h4>
        <div class="row" v-if="Object.keys(best_selling_produtcs).length">
          <carousel
            :nav="false"
            :autoplay="true"
            :autoplayTimeout="4000"
            :responsive="{ 0: { items: 2 }, 600: { items: 5 } }"
          >
            <div
              class="col-lg-3 col-sm-6 col-md-6 col-xs-6"
              v-for="best_slllers_product in best_selling_produtcs"
              :key="best_slllers_product.id"
            >
              <div class="product-card top-product-card-small">
                <div class="prodict-card-body">
                  <router-link
                    :to="{
                      name: 'single',
                      params: { slug: best_slllers_product.slug },
                    }"
                  >
                    <img
                      v-if="best_slllers_product.product_image.length"
                      :src="
                        base_url +
                        best_slllers_product.product_image[0].product_image
                      "
                    />
                  </router-link>
                  <div class="product-detail">
                    <h4>
                      <router-link
                        class="product-link"
                        :to="{
                          name: 'single',
                          params: { slug: best_slllers_product.slug },
                        }"
                        >{{ best_slllers_product.name }}</router-link
                      >
                    </h4>
                    <p class="price">
                      <span class="price-new">{{
                        best_slllers_product.price
                      }}</span>
                      <span
                        class="price-old"
                        v-if="best_slllers_product.discount"
                        >{{ best_slllers_product.sale_price }}</span
                      >
                    </p>
                  </div>
                </div>
                <div class="product-card-footer">
                  <button
                    class="btn btn-primary btnQuick"
                    style="cursor: pointer"
                    @click="quick_v_product_id = best_slllers_product.id"
                  >
                    view
                  </button>
                </div>
              </div>
            </div>
          </carousel>
        </div>
      </div>

      <div v-if="isScroll > 0">
       
        <div class="product_carousel flash_sale"
       
         v-for="(campaign,index) in sale_campaign" :key="index" v-if="campaign.campaign_products.length > 0"
          :style="{backgroundColor:campaign.background_color,border:campaign.border_width+'px solid '+campaign.border_color}"
        >
          <div>
             <h4 class="text-uppercase text-center campaign-text">{{ campaign.name}} </h4> 
            <span>
              <flip-countdown  :deadline="campaign.expired_date+' 00:00:00'"></flip-countdown>
            </span>
            
          </div>
          <carousel
            v-if="Object.keys(campaign.campaign_products).length"
            :nav="false"
            :autoplay="true"
            :autoplayTimeout="4000"
            :responsive="{ 0: { items: 2 }, 600: { items: 7 } }"
          >
            <div
              class="product-thumb clearfix"
              v-for="campaign_product in campaign.campaign_products"
              :key="campaign_product.id"
            >
              <div class="image">
                <router-link
                  :to="{
                    name: 'single',
                    params: { slug: campaign_product.slug },
                  }"
                >
                  <img
                    v-if="campaign_product.product_image.length"
                    :src="
                      base_url +
                      campaign_product.product_image[0].product_image
                    "
                    :alt="campaign_product.name"
                    :title="campaign_product.name"
                    class="img-responsive"
                  />
                </router-link>
              </div>
              <div class="caption">
                <h4>
                  <router-link
                    :to="{
                      name: 'single',
                      params: { slug: campaign_product.slug },
                    }"
                    >{{ campaign_product.name }}</router-link
                  >
                </h4>
                <p class="price">
                  <span class="price-new">{{ campaign_product.price }}</span>
                  <span class="price-old" v-if="campaign_product.discount">{{
                    campaign_product.sale_price
                  }}</span>
                </p>
              </div>
            </div>
          </carousel>
        </div>

        <div v-if="product_category.length <= 0">
          <h1 class="text-center"><i class="fa fa-spin fa-spinner"></i></h1>
        </div>
      
              <div class="row  __product_category" v-else v-for="(category, idx) in product_category" :key="idx">

              <div v-if="category.product.length > 0">
                <div class="col-lg-2">
                  <ul class="__sub_category list-group">
                  <h4 class="__list_headig" >{{category.name}}</h4>
                  <li class="__sub-category_name list-group-item" v-for="sub_category in category.sub_category" :key="sub_category.id">
                    <router-link :to="{name:'welcome'}"  class="__sub_category_link">
 
                      {{sub_category.name  }}
                    </router-link>
                  </li>
                </ul>
              </div>
              <div class="col-lg-10">
                <div class="row">
                  <div class="col-lg-3 col-sm-6 col-md-6 col-xs-6" v-for="(product,index) in category.product"  :key="index" v-if="index < 8">
                       <div class="product-card ">
                  <div class="prodict-card-body ">
                    <router-link
                      :to="{ name: 'single', params: { slug: product.slug } }"
                    >
                      <img
                        v-if="product.product_image.length"
                        :src="base_url + product.product_image[0].product_image"
                      />
                    </router-link>
                    <div class="product-detail">
                      <h4>
                        <router-link
                          class="product-link"
                          :to="{
                            name: 'single',
                            params: { slug: product.slug },
                          }"
                          >{{ product.name }}</router-link
                        >
                      </h4>
                      <p class="price">
                        <span class="price-new">{{ product.price }}</span>
                        <span class="price-old" v-if="product.discount">{{
                          product.sale_price
                        }}</span>
                      </p>
                    </div>
                  </div>

                  <div class="product-card-footer">
                    <button
                      class="btn btn-primary btnQuick"
                      style="cursor: pointer"
                      @click="quick_v_product_id = product.id"
                    > view
                    </button>
                  </div>
                </div>
                  </div>
                </div>
              </div>
              </div>
            
            </div>
        
        

        <!-- <infinite-loading @infinite="productsList">
        <div slot="no-more"></div>
      </infinite-loading> -->
      </div>
    </div>

    <frontend-footer></frontend-footer>
    <quick-view
      v-if="quick_v_product_id"
      v-on:clicked="closedModal($event)"
      :quick_v_p_id="quick_v_product_id"
    >
    </quick-view>
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import carousel from "vue-owl-carousel";
  import FlipCountdown from 'vue2-flip-countdown'


export default {
  name: "welcome",
  data() {
    return {
      loading: true,
      // sub_categories: [],
      page: 1,
      offers: [],
      product_id: null,
      background_parallax:this.$store.state.image_base_link+'images/parallax.jpg' ,
      base_url: this.$store.state.image_base_link,
      isScroll: 0,
      quick_v_product_id: "",
      o_modal: false,
    };
  },
  methods: {
    handleScrol() {
      this.isScroll = 1;
      // if(window.scrollY>400){
      //   this.$store.dispatch('sub_sub_category_product')
      // }
      console.log();
    },

    productDetals(product_id) {
      this.prdoct_modal = true;
      this.product_id = product_id;
    },
    closedModal(close) {
      this.quick_v_product_id = "";
    },
  },
  components: {
    Loading,
    carousel,
    FlipCountdown 
  },
  mounted() {
    window.addEventListener("scroll", this.handleScrol);
    this.$store.dispatch("category");
    this.$store.dispatch("sliders");
    this.$store.dispatch("offer_banner");
   // this.$store.dispatch("flash_sale_products");
        this.$store.dispatch("sale_campaign");

  },

  computed: {

    categories() {
      return this.$store.getters.categories;
    },
    slider_banner() {
      return this.$store.getters.slider_banner;
    },
    sliders() {
      return this.$store.getters.sliders;
    },
    getOffers() {
      return this.$store.getters.offer_banner;
    },
    best_selling_produtcs() {
      return this.$store.getters.best_selling_produtcs;
    },

    // flash_sale_products() {
    //   return this.$store.getters.flash_sale_products;
    // },
    product_category() {
      return this.$store.getters.home_page_products;
    },
     sale_campaign() {
      return this.$store.getters.sale_campaign;
    },
  },
  watch: {
    isScroll: function (value) {
      if (value == 1) {
        this.$store.dispatch("home_page_products");
      }
    },
  },
};

//show sub  menu in mobile menu
document.addEventListener("DOMContentLoaded", () => {
  //set a time our function. this function call after 2 sec on domloaded
  setTimeout(() => {
    //find the click element
    let sub_menu = document.getElementsByClassName("show-sub");

    for (let i = 0; i < sub_menu.length; i++) {
      //set a click event
      sub_menu[i].addEventListener("click", function () {
        let show_sub_menu = sub_menu[i].parentElement.querySelector(
          ".left-sub-menu"
        );
        //set active class
        show_sub_menu.classList.toggle("nav-active");
        sub_menu[i].classList.toggle("fa-minus");
      });
    }
  }, 2000);
});
</script>

<style scoped>
.flip-clock{
  text-align: right !important;
  margin: none;
  margin-top: -34px !important;
  margin-left: -17px !important;
}
.flip-card{
    font-size: 2.5rem !important;
}
</style>


