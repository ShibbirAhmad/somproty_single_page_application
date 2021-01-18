<template>
    <div id="_qvm">
     <loading :active.sync="isLoading" 
        
        :is-full-page="fullPage"></loading>
      <div  v-if="quick_view_modal" style="display:block;" class="modal modal_overlay" >
        <div class="modal-dialog modal-xl" >
          <div class="row">
            <div class="col-md-10 col-sm-12">
               <div class="modal-content">

             <div v-if="quick_loading" class="animator  text-center">
               <i  class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
               <span class="sr-only">Loading...</span>
              </div>
               
              <div v-else class="quick_content">
                  <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button " class="close close_sign" data-dismiss="modal" @click="closeModal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                  <div class="modal-body">
  
                    <div class="row">
                      <div class="col-md-4 col-sm-12">
                          <img class="quick_view_image" v-if="quick_view_product.product_image" :src="base_url+quick_view_product.product_image[0].product_image" alt="">
                      </div>

                       <div class="col-md-4 col-sm-12">
                       
                      <ul class="list-unstyled description">
                               <li>
                      <h4 class="title" itemprop="name">{{  quick_view_product.name  }}</h4>

                      </li>
                        <li>
                          <h4>
                            <b>Product Code:</b>
                            <span itemprop="mpn">{{ quick_view_product.product_code }}</span>
                          </h4>
                        </li>
                            <li>
                              <h4>
                                <b>Availability:</b>
                                <span class="instock" v-if="quick_view_product.stock > 0">Stock In <small>({{quick_view_product.stock }})</small></span>
                                <span class="outstcok" v-else>Stock Out</span>
                              </h4>
                            </li>
                          </ul>
                          <ul class="price-box">
                          <li class="price">
                          <h3>
                              <span class="price-old" v-if="quick_view_product.discount">&#2547 {{quick_view_product.sale_price}}</span>
                            <span class="price-new">&#2547 {{quick_view_product.price}}</span>
                          </h3>
                          </li>
                          <li></li>
                        </ul>
                        <div id="product">
                          <div v-if="quick_view_product.product_variant.length>0 && quick_view_product.product_attribute">
                            <!-- <h3 class="subtitle">Available Options</h3> -->
                            <div class="form-group required">
                              <h4 class="control-label">
                                <b>{{ quick_view_product.product_attribute.attribute.name }}</b>
                              </h4>
                              <select
                                class="form-control"
                                v-model="variant_index"
                                @change="SelectVaraint"
                                name="option[200]"
                              >
                                <option value disabled>--Please Select--</option>
                                <option
                                  value
                                  v-for="(variant,v) in quick_view_product.product_variant"
                                  :key="v"
                                  :value="v"
                                >{{variant.variant.name}}</option>
                              </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-sm-6 ">
                              <div class>
                                <h4 class="control-label" for="input-quantity">
                                  <b>Quantity</b>
                                </h4>
                                <input
                                  type="number"
                                  name="quantity"
                                  v-model="cart.quantity"
                                  size="2"
                                  value="1"
                                  class="form-control"
                                  @change="validation"
                                  @keyup="validation"
                                />

                                <div class="clear"></div>
                              </div>
                            </div>

                            <div class="col-md-6 col-sm-6 ">
                              <button
                                @click.prevent="CartToAdd"
                                type="button"
                                id="button-cart"
                                class="btn btn-primary btn-lg  btn-block"
                                style="margin-top:38px;"
                              
                          
                          >Add to Cart</button>
                        </div>
                    </div>
                  </div>
                       </div>

                      <div class="col-md-4 col-sm-12 ">
                       <p class="quick_description" v-html="quick_view_product.details" >  </p>
                        
                      </div>
                    </div>

                    <div class="row related_quick_row">
                         <div class="r_quick_heading text-center"> 
                            <h4 class="heading"> Recomended Products </h4>
                         </div>
                         <div class="r_quick_body">

                            <div v-for="(r_product,index) in recommended_products " :key="index" class="col-md-2 "> 
                                  <img :src="base_url+r_product.product_image[0].product_image" class="img-responsive r_p_image" >
                                  <a class="r_p_title" @click.prevent="recommended_replace(index)" >{{ r_product.name }} </a>
                                  
                            </div>

                         </div>

                    </div>

                  </div>
               </div>
              </div>
            </div>
          </div>
         
        </div>
      </div>
    </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
    // Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
  name:"quick_view_modal",
  created() {
    this.productQuickView();
  },
  props: ["quick_v_p_id"],

  data() {
    return {
      isLoading: true,
      fullPage: true,
      quick_loading: false,
      disabled: true,
      variant_index: "",
      base_url: this.$store.state.image_base_link,
      cart: {
        product_id: "",
        variant_id: "",
        attrribute_id: "",
        quantity: 1,
      },
      quick_view_product: "",
      quick_view_modal: false,
      recommended_products:"",
      isLoading: true,
     fullPage: true
    };
  },

  methods: {
    
    productQuickView() {
      this.$Progress.start();
      
      axios
        .get(
          "/_public/api/get/single/prodocut/for/quick/view/" + this.quick_v_p_id
        )
        .then((resp) => {
         this.$Progress.finish();
         this.isLoading=false;
           console.log(resp);
          if (resp.data.status == "OK") {
            this.quick_view_product = resp.data.product;
            this.recommended_products=resp.data.recommended_products;
            this.quick_view_modal = true;
            this.quick_loading = false;
          }
        });
    },

    recommended_replace(index){
      this.$Progress.start()
      this.quick_view_product=this.recommended_products[index];
      console.log(this.recommended_products[index])
      this.$Progress.finish();
    },

    closeModal() {
      this.quick_view_modal = false;
      this.$emit("clicked");
    },

    CartToAdd() {
      axios
        .get("/_public/addToCart", {
          params: {
            slug: this.quick_view_product.slug,
            attribute_id: this.cart.attrribute_id,
            variant_id: this.cart.variant_id,
            quantity: this.cart.quantity,
          },
        })
        .then((resp) => {
          // console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              position: "bottom-left",
              type: "success",
              duration: 1000,
            });
            this.$store.dispatch("getCartContent");
          } else if (resp.data.status == "error") {
            this.$toasted.show(resp.data.message, {
              position: "bottom-center",
              type: "error",
              duration: 1000,
            });
          }
        })
        .then((error) => {
          // console.log(error);
        });
    },
    validation() {
      if (this.cart.quantity < 1) {
        this.cart.quantity = 1;
        alert("Quantity at least 1");
        return;
      }
      if (this.quick_view_product.product_attribute) {
        if (this.cart.attrribute_id < 1) {
          this.disabled = true;
        } else {
          this.disabled = false;
        }
      } else {
        this.disabled = false;
      }
    },
    SelectVaraint() {
      // this.product.product_variant.length=0;
      let index = this.variant_index;
      let variant_id = this.quick_view_product.product_variant[index]
        .variant_id;
      let attribute_id = this.quick_view_product.product_variant[index].variant
        .attribute_id;
      this.cart.attrribute_id = attribute_id;
      this.cart.variant_id = variant_id;
      this.validation();
    },

  },
  components:{
    Loading
  }
};
</script>

