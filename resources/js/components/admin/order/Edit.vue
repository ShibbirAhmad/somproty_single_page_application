<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'order' }" class="btn btn-primary">
            <i class="fa fa-arrow-right"></i>
          </router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Order</li>
        </ol>
      </section>
      <section class="content">
        <form @submit.prevent="searchProduct" id="ProductSearch"></form>
        <h1 v-if="loading">
          <i class="fa fa-spin fa-spinner"></i>
        </h1>
       
        <form v-else @submit.prevent="add" @keydown="form.onKeydown($event)">
          <div class="row justify-content-center">
            <div
              class="alert alert-danger alert-dismissible"
              v-if="error"
              role="alert"
            >
              {{ error }}
              <span
                aria-hidden="true"
                class="close"
                data-dismiss="alert"
                style="color: #fff"
                aria-label="Close"
                >&times;</span
              >
            </div>
            <div class="col-lg-4">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Customer information</h3>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label>Customer_mobile</label>
                    <input
                      type="text"
                      name="customer_mobile"
                      class="form-control"
                      autofocus
                      autocomplete="off"
                      placeholder="Enter customer 11 digit mobile number"
                      v-model="form.customer_mobile"
                      @keyup="searchCustomer"
                      :class="{
                        'is-invalid': form.errors.has('customer_mobile'),
                      }"
                    />
                    <has-error :form="form" field="customer_mobile"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Name</label>
                    <input
                      type="text"
                      name="name"
                      class="form-control"
                      autofocus
                      autocomplete="off"
                      placeholder="Name"
                      v-model="form.customer_name"
                      :class="{
                        'is-invalid': form.errors.has('customer_name'),
                      }"
                    />
                    <has-error :form="form" field="customer_name"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Address</label>
                    <input
                      type="text"
                      name="address"
                      class="form-control"
                      autofocus
                      autocomplete="off"
                      placeholder="address"
                      v-model="form.customer_address"
                      :class="{
                        'is-invalid': form.errors.has('customer_address'),
                      }"
                    />
                    <has-error
                      :form="form"
                      field="customer_address"
                    ></has-error>
                  </div>

                  <div class="form-group">
                    <label>City</label>
                    <select
                      name="city"
                      id
                      class="form-control"
                      v-model="form.city"
                      @change="selectCity"
                      :class="{ 'is-invalid': form.errors.has('city') }"
                    >
                      <option value>select city</option>
                      <option v-for="city in cities" :value="city.id">
                        {{ city.name }}
                      </option>
                    </select>
                    <has-error :form="form" field="city"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Shipping_cost</label>
                    <input
                      type="text"
                      name="shipping_cost"
                      class="form-control"
                      v-model="form.shipping_cost"
                      :class="{
                        'is-invalid': form.errors.has('shipping_cost'),
                      }"
                    />
                    <has-error :form="form" field="shipping_cost"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Courier</label>
                    <select
                      name="courier"
                      v-model="form.courier"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('courier') }"
                    >
                      <option value>select courier</option>
                      <option v-for="courier in couriers" :value="courier.id">
                        {{ courier.name }}
                      </option>
                    </select>
                    <has-error :form="form" field="courier"></has-error>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-8">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Product information</h3>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label>Product</label>
                    <input
                      type="text"
                      name="name"
                      class="form-control"
                      autofocus
                      autocomplete="off"
                      placeholder="Enter Product Code"
                     
                      v-model="product_code"
                      form="ProductSearch"
                    />
                  </div>

                  <div class="row">
                    <div class="col-lg-12">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Attribute</th>
                            <th>Variant</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>total</th>
                            <th>Remove</th>
                          </tr>
                        </thead>
                        <tbody v-if="products.length > 0">
                          <tr v-for="(product, index) in products" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>
                              {{ product.name + "-" + product.product_code }}
                              <input type="hidden" :value="product.id" />
                            </td>
                            <td>
                              <select
                                class="form-control"
                                v-model="form.products[index].attribute_id"
                              >
                                <option value>select attribute</option>
                                <option
                                  v-if="product.attributes"
                                  v-for="(
                                    product_attribute, index
                                  ) in product.attributes"
                                  :key="index"
                                  :value="product_attribute.attribute.id"
                                >
                                  {{ product_attribute.attribute.name }}
                                </option>
                              </select>
                            </td>
                            <td>
                              <select
                                class="form-control"
                                v-model="form.products[index].variant_id"
                              >
                                <option value>select attribute</option>
                                <option
                                  v-if="product.variants"
                                  v-for="(
                                    product_variant, index
                                  ) in product.variants"
                                  :key="index"
                                  :value="product_variant.variant.id"
                                >
                                  {{ product_variant.variant.name }}
                                </option>
                              </select>
                            </td>
                            <td>
                              <input
                                type="number"
                                v-model="form.products[index].quantity"
                                @keyup="quantity(index)"
                                @change="quantity(index)"
                                style="width: 50px"
                              />
                              <span class="badge badge-danger">{{
                                product.stock
                              }}</span>
                            </td>
                            <td>
                              <input
                                v-model="form.products[index].price"
                                @keyup="totalCalculation && quantity(index)"
                                v-if="form.order_type == 3"
                              />
                              <strong v-else>{{ product.price }}</strong>
                            </td>
                            <td>{{ form.products[index].total }}</td>
                            <td>
                              <a
                                class="btn btn-danger btn-sm"
                                @click="remove(index)"
                                ><i class="fa fa-trash"></i
                              ></a>
                            </td>
                          </tr>
                          <tr v-if="products.length > 0">
                            <td colspan="5"></td>
                            <td>Total Amount</td>
                            <td>{{ form.total }}</td>
                          </tr>
                          <tr v-if="products.length > 0">
                            <td colspan="5"></td>
                            <td>Discout</td>
                            <td>
                              <input
                                class="form-control"
                                @keyup="totalCalculation"
                                v-model="form.discount"
                                style="width: 60px"
                              />
                            </td>
                          </tr>
                          <tr v-if="products.length > 0">
                            <td colspan="5"></td>
                            <td>Paid</td>
                            <td>
                              <input
                                v-model="form.paid"
                                @keyup="totalCalculation"
                                class="form-control"
                              />
                            </td>
                          </tr>
                          <tr v-if="products.length > 0">
                            <td colspan="5"></td>
                            <td>Shipping_charge</td>
                            <td>{{ form.shipping_cost }}</td>
                          </tr>
                          <tr v-if="products.length > 0">
                            <td colspan="5"></td>
                            <td>Amoutn due</td>
                            <td>{{ form.due }}</td>
                          </tr>
                          <button
                            class="btn btn-success"
                            style="margin-top: 12px"
                            type="submit"
                          >
                            Submit
                          </button>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</template>


<script>
import Vue from "vue";
import { Form, HasError, AlertError } from "vform";
import datePicker from "vue-bootstrap-datetimepicker";

Vue.component(HasError.name, HasError);

export default {
  name: "Add",
  created() {
    this.others();
    this.edit();
  },
  data() {
    return {
      form: new Form({
        customer_mobile: "",
        customer_name: "",
        customer_address: "",
        city: "",
        courier: "",
        products: [],
        shipping_cost: 0,
        courier: "",
        total: 0,
        discount: 0,
        paid: 0,
        due: 0,
        order_type: "",
      }),
      attribute_id: "",
      variant_id: "",
      product_code: "",
      city_id: "",
      courier_id: "",
      shipping_cost: "",
      products: [],
      product_attributes: null,
      product_variants: null,
      cities: null,
      couriers: null,
      product_quantity: 1,
      error: "",
      loading: true,
    };
  },

  methods: {
    //method initial for get data
    edit() {
      axios.get("/order/view/" + this.$route.params.id).then((resp) => {
        console.log(resp);
        console.log(resp.data.order.cutomer_phone);
        if (resp.data.status == "SUCCESS") {
          let order = resp.data.order;
          this.form.customer_mobile = order.cutomer_phone;
          this.form.customer_name = order.customer.name;
          this.form.customer_address = order.customer.address;
          this.form.city = order.customer.city_id;
          this.form.shipping_cost = order.shipping_cost;
          this.form.courier = order.courier_id;
          this.form.paid = order.paid;
          this.form.discount = order.discount;
          this.form.total = order.total;
          this.form.order_type = order.order_type;
          this.form.due =parseInt(order.total) - (parseInt(order.paid) + parseInt(order.discount)) + parseInt(order.shipping_cost);

          //problem is there product attribute

          let products = [];
          for (let i = 0; i < resp.data.items.length; i++) {
            products[i] = {
              product_id: resp.data.items[i].product.id,
              name: resp.data.items[i].product.name, //product name
              product_code: resp.data.items[i].product_code,
              quantity: resp.data.items[i].quantity,
              price: resp.data.items[i].price,
              variants: resp.data.items[i].product.product_variant,
            };
            this.products.push(products[i]);
            this.form.products.push(products[i]);
            this.form.products[i].total = resp.data.items[i].total;
            this.form.products[i].variant_id = resp.data.items[i].variant_id;
            this.form.products[i].attribute_id =
              resp.data.items[i].attribute_id;
          }

          console.log(...products);
          console.log(products);
          this.loading = false;
        }
      });
    },
    //method initial for submit data
    add() {
      this.form
        .post("/update/order/" + this.$route.params.id)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.$router.push({ name: "order" });
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
            //other wise success, show a error
          } else {
            this.$toasted.show(resp.data, {
              type: "error",
              position: "top-center",
              duration: 4000,
            });
          }
        })
        .catch((error) => {
          this.error =
            "Missing submit information. please check all field below and try again";
        });
    },

    //method iniital for get other data to create order, like cit, courier and other.......
    others() {
      axios
        .get("/others")

        //success resp only
        .then((resp) => {
          if (resp.data.status == "SUCCESS") {
            this.cities = resp.data.cities;
            this.couriers = resp.data.couriers;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    //method initial for search product

    searchProduct() {
      let length = this.product_code.length;
      //  alert(length)
      if (length == 4) {
        axios
          .get("/search/product/with/code/" + this.product_code)

          .then((resp) => {
            //when resp success
            if (resp.data.status == "SUCCESS") {
              let product = {
                product_id: "",
                price: "",
                quantity: 1,
                attribute_id: "",
                variant_id: "",
                total: "",
              };
              for (let i = 0; i < resp.data.product.length; i++) {
                //check the product stcok availity
               

                this.products.push(resp.data.product[i]);
                product.product_id = resp.data.product[i].id;
                product.price = resp.data.product[i].price;
                product.total = resp.data.product[i].price;
              }
              this.form.products.push(product);
              this.totalCalculation();
            }
            //when not resp success
            else {
              this.$toasted.show(
                "Product not found with " + this.product_code,
                {
                  position: "top-center",
                  type: "danger",
                  duration: 2000,
                }
              );
            }
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },

    //method initial search customer
    searchCustomer() {
      if (this.form.customer_mobile.length == 11) {
        axios
          .get(
            "/search/customer/with/phone/number/" + this.form.customer_mobile
          )
          .then((resp) => {
            //when com data from t resp
            if (resp.data) {
              if (resp.data.customer) {
                (this.form.customer_name = resp.data.customer.name),
                  (this.form.customer_address = resp.data.customer.address);
                this.form.city = resp.data.customer.city_id;
              }
              this.$toasted.show(resp.data.message, {
                type: "error",
                position: "top-center",
                duration: 4000,
              });
            }
          })
          .catch((error) => {
            //console.log(error);
          });
      }
    },

    //set product attribute
    attribute(index) {
      this.form.products[index].attribute_id = this.attribute_id;
    },
    //set product variant
    variant(index) {
      this.form.products[index].variant_id = this.variant_id;
    },
    //when chage qauntity
    quantity(index) {
      this.form.products[index].total =
        this.form.products[index].price * this.form.products[index].quantity;

      this.totalCalculation();
    },

    //total amount calculation
    totalCalculation() {
      let products = this.form.products;
      let total = 0;
      for (let i = 0; i < products.length; i++) {
        total += parseInt(products[i].price) * parseInt(products[i].quantity);
      }
      this.form.total = parseInt(total);
      this.form.due =parseInt(this.form.total) -  parseInt(this.form.discount) -  parseInt(this.form.paid)+parseInt(this.form.shipping_cost);
    },

    //select city
    selectCity() {
      let id = this.form.city;
      let cities = this.cities;
      for (let i = 0; i < cities.length; i++) {
        if (cities[i].id == id) {
          this.form.shipping_cost = parseInt(cities[i].delivery_charge);
        }
      }
      this.totalCalculation();
    },

    remove(index) {
      // console.log(index);
      console.log(this.form.products[index]);
      this.form.products.splice(index, 1);
      this.products.splice(index, 1);
      this.totalCalculation();
    },
  },
  computed: {},
  components: {
    datePicker,
  },
};
//Date picker
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}

.autocomplete {
  max-height: 120px;
  overflow-y: scroll;
  position: absolute;
  width: 100%;
  z-index: 454;
}

.autocomplete li:hover {
  background: #222d32;
  color: #ffffff;
}
</style>
