<template>
    <div>
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

<style scoped>
.modal_overlay{
      background: #00000073;
}
.quick_view_image {
  width: 250px !important;
  height: 250px !important;
}

.close_sign {
  font-size: 40px !important;
  margin-top: -19px !important;
  color: red !important;
}

.animator {
  margin-top: 100px;
  padding: 100px;
}

.animator i {
  font-size: 70px;
}

.modal-body h4 p {
  margin-left: 20px !important;
}

.modal-dialog {
  width: 90% !important;
  position: absolute;
  left: 10%;
  transition: .3s;
}

.quick_content{
  background: #fff;
}
.quick_description {
  font-size: 14px;
}



.r_p_title{
  font-size: 12px ;
}

.r_p_image {
   width:110px;
   height:100px;
   border-radius: 5px;
}

.r_p_button {
    margin-left: 35px;
    border-radius: 5px;
}

.r_p_button:hover {
    border-radius: 50px;
    background: #db3700;
}
.related_quick_row[data-v-587a0637] {
    margin: 5px;
    max-height: 180px;
    overflow-y: scroll;
}
.r_quick_body {
    padding: 15px 10px;
}


@media screen and (max-width: 350px) {
  .related_quick_row {
    display: none;
  }

  .modal-dialog {
    margin-top: 10px !important;
    width: 400px !important;
    height: 512px;
  }

  .close_sign {
    margin-right: 145px !important;
    font-size: 40px !important;
    margin-top: -19px !important;
    color: red !important;
  }

  .quick_view_image {
    width: 120px !important;
    height: 110px !important;
    margin-bottom: 26px !important;
    margin-left: 50px;
  }

  .title {
    margin: 0px !important;
  }

  .modal-body .form-group {
    margin-bottom: 5px !important;
  }
  .modal-body ul {
    margin-top: -26px;
  }
  .modal-body b {
    font-weight: normal;
  }
  .modal-body .btn-lg {
    width: 35%;
    margin-top: 5px !important;
    margin-bottom: 5px !important;
    margin-left: 56px !important;
    padding: 5px 0px;
    font-size: 14px;
    border-radius: 5px;
  }

  .quick_description {
    font-size: 14px;
    line-height: 15px;
    margin-left:-30px;
  }

  .animator {
    margin-top: 10px;
    padding: 10px;
  }

  .animator i {
    font-size: 20px;
  }

  .modal-body h4 {
    margin-left: 5px !important;
    font-size: 14px !important;
  }

  .modal-body p span {
    margin-left: 5px !important;
    font-size: 10px !important;
    line-height: 10px;
  }

  .modal-body span {
    margin-left: 5px !important;
    font-size: 10px !important;
    margin-top: -10px;
  }

  .modal-body select,
  input {
    width: 130px !important;
    height: 30px !important;
    margin-top: -30px;
    margin-left: 56px;
  }
}
.col-md-2 {
    margin-bottom: 25px;
}
</style>