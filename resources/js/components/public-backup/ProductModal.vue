<template>
  <div class="product-modal">
    <div class="container">
      <div class="content-p-m">
        <div class="content-header">
          <button class="btnClose" @click="closemodal">X</button>
        </div>
        <div class="content-body">
          <div class="row">
              
            <div class="col-lg-4 product-img">
              <img :src="base_url + product.product_image[0].product_image" />
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-">
               <ul class="list-unstyled description">
                  <li>
                                  <h3 class="title" itemprop="name">{{ product.name }}</h3>

                  </li> 
                    <li>
                      <h4>
                        <b>Product Code:</b>
                        <span itemprop="mpn">{{ product.product_code }}</span>
                      </h4>
                    </li>
                    <li>
                      <h4>
                        <b>Availability:</b>
                        <span class="instock" v-if="product.stock > 0">In Stock</span>
                        <span class="outstcok" v-else>Out Stock</span>
                      </h4>
                    </li>
                  </ul>
                  <ul class="price-box">
                    <li class="price">
                      <span class="price-old" v-if="product.discount">&#2547 {{product.sale_price}}</span>
                      <span class="price-new">&#2547 {{product.price}}</span>
                    </li>
                    <li></li>
                  </ul>
                  <div id="product">
                    <div v-if="product.product_attribute">
                      <h3 class="subtitle">Available Options</h3>
                      <div class="form-group required">
                        <h4 class="control-label">
                          <b>{{ product.product_attribute.attribute.name }}</b>
                        </h4>
                        <select
                          class="form-control"
                          v-model="variant_index"
                          @change="SelectVaraint"
                          name="option[200]"
                        >
                          <option value disabled>--- Please Select ---</option>
                          <option
                            value
                            v-for="(variant,v) in product.product_variant"
                            :key="v"
                            :value="v"
                          >{{variant.variant.name}}</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
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
                           
                          />

                          <div class="clear"></div>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <button
                          @click.prevent="CartToAdd"
                          type="button"
                          :disabled="disabled || product.stock<=0"
                          id="button-cart"
                          class="btn btn-primary btn-lg btn-block"
                          style="margin-top:38px;"
                        >Add to Cart</button>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
        <div class="content-footer"></div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["id"],
  mounted() {
    this.getProduct();
  },
  data() {
    return {
      product: "",
      related_products: [],
      base_url: "/../storage/",
      cart: {
        product_id: "",
        variant_id: "",
        attrribute_id: "",
        quantity: 1,
      },
    };
  },
  methods: {
    getProduct() {
      console.log(this.id);
      axios
        .get("/_public/product/id/wise/" + this.id)
        .then((resp) => {
          if (resp.data) {
            this.product = resp.data.product;
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    closemodal() {
      this.$refs.Dialog.hide();
    },
  },
};
</script>
<style scoped>
.content-p-m {
  width: 70%;
  position: absolute;
  left: 15%;
  background: rgb(247, 248, 250);
  top: 15%;
}
.product-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  background: rgb(0, 0, 0, 0.5);
  z-index: 999999999;
  justify-content: center;
  display: flex;
  margin: 0;
  padding: 0;
  transition: 0.3s;
}
.content-header {
  margin: 0;
  padding: 0;
  background: #eee;
  display: flex;
}
.btnClose {
  margin-left: auto;
  border: none;
  width: 70px;
  background: red;
  color: #fff;
  font-size: 25px;
}
.content-body {
  background: #fff;
}
</style>