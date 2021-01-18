<template>
  <div class="wrapper-wide">
    <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading>

    <frontend-header :categories="categories"></frontend-header>

    <div id="container">
      <div class="container">
        <!-- Breadcrumb End-->
        <div class="row">
          <!--Middle Part Start-->
          <div id="content">
            <div class="row">
              <div class="col-lg-5 col-lsm-12">
                <div class="custom-box">
                  <h2 class="title">Checkout</h2>
                  <form @submit.prevent="chekout">
                    <div class="form-grop">
                      <label class="control-label" for="input-email">Name</label>
                      <input
                        type="text"
                        name="name"
                        class="form-control"
                        autocomplete="off"
                        maxlength="11"
                        :class="{ 'is-invalid': form.errors.has('name') }"
                        v-model="form.name"
                        autofocus
                      />
                      <has-error :form="form" field="name"></has-error>
                    </div>
                    <br />
                    <div class="form-grop">
                      <label class="control-label" for="input-email">Mobile_no</label>
                      <input
                        type="text"
                        name="mobile_no"
                        placeholder="01xxx-xxxxx"
                        class="form-control"
                        autocomplete="off"
                        maxlength="11"
                        :class="{ 'is-invalid': form.errors.has('mobile_no') }"
                        v-model="form.mobile_no"
                        readonly
                      />
                      <has-error :form="form" field="mobile_no"></has-error>
                    </div>
                    <br />
                    <div class="form-group">
                      <label class="control-label" for="input-password">Address</label>
                      <textarea
                        name="address"
                        placeholder="Address"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('address') }"
                        v-model="form.address"
                        @keyup="validation"
                      ></textarea>
                      <has-error :form="form" field="address"></has-error>

                      <br />
                      <div class="form-grop">
                        <label class="control-label" for="input-email">City</label>
                        <select
                          name="city"
                         :class="{ 'is-invalid': form.errors.has('city') }"
                          class="form-control"
                          v-model="form.city"
                          @change="selectCity"
                        >
                          <option value="" selected disabled>Select City</option>
                          <option
                            value
                            v-for="(city,index) in cities"
                            :key="index"
                            :value="city.id"
                          >{{city.name}}</option>
                        </select>
                        <has-error :form="form" field="city"></has-error>
                      </div>
                      <br />
                    </div>
                    <button
                     
                      class="btn btn-block btn-primary"
                      type="submit"
                      :disabled="form.busy || disabled"
                    >
                      <i class="fa fa-spinner fa-spin" v-if="form.busy"></i>PLACE ORDER
                    </button>
                  </form>
                </div>
              </div>
              <div class="col-lg-5 col-lsm-12">
                <div class="custom-box">
                  <div class="cart-total">
                    <table>
                      <tbody>
                        <tr>
                          <td>Total</td>
                          <td colspan="4"></td>
                          <td>
                            :
                            <span v-if="form.shipping_cost">&#2547 {{form.total}}</span>
                            <span v-else>.....</span>
                          </td>
                        </tr>
                        <br />
                        <tr>
                          <td>Shipping cost</td>
                          <td colspan="4"></td>
                          <td>
                            :
                            <span v-if="form.shipping_cost">&#2547 {{ form.shipping_cost }}</span>
                            <span v-else>.....</span>
                          </td>
                        </tr>
                        <br />
                        <tr>
                          <td>Total</td>
                          <td colspan="4"></td>
                          <td>
                            :
                            <span
                              v-if="form.shipping_cost"
                            >&#2547 {{parseInt(form.total.replace(',',''))+parseInt(form.shipping_cost)}}</span>
                            <span v-else>.....</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <frontend-footer></frontend-footer>
  </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import { Form, HasError } from "vform";

export default {
  props: ["categories"],
  created() {
    this.user();
    this.getCity();
    this.getCartContent();

    setTimeout(() => {
      this.isLoading = false;
      this.validation();
    }, 1500);
  },
  data() {
    return {
      form: new Form({
        mobile_no: "",
        name: "",
        address: "",
        city: '',
        total: "",
        cart: "",
        shipping_cost: "",
      }),
      isLoading: true,
      fullPage: true,
      cities: "",
      cart: {
        total: 0,
      },
      disabled: true,
    };
  },
  methods: {
    chekout() {
      this.form
        .post("/_public/checkout")
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            localStorage.setItem("user_token", resp.data.token);
            this.$store.dispatch("user");
            this.$router.push({ name: "welcome" });
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
          } else {
            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 2000,
            });
          }
        })
        .catch((error) => {
          console.log(error);
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 2000,
          });
        });
    },

    getCity() {
      axios
        .get("/_public/others")
        .then((resp) => {
          this.cities = resp.data.cities;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    selectCity() {
      for (let i = 0; i < this.cities.length; i++) {
        if (this.cities[i].id == this.form.city) {
          this.form.shipping_cost = this.cities[i].delivery_charge;
        }
      }
      this.validation();
    },
    user(context) {
      axios.get("/_public/userToCheck").then((resp) => {
        if (resp.data.status == "AUTHORIZED") {
          this.form.mobile_no = resp.data.user.mobile_no;
          this.form.name = resp.data.user.name;
          this.form.address = resp.data.user.address;
        
        } else {
          localStorage.removeItem("user_token");
          this.$route.push({ name: "welocme" });
          this.$toasted.show("sorry! you are unautorized", {
            type: "error",
            position: "top-center",
            duration: 2000,
          });
        }
      });
    },

    getCartContent(context) {
      axios.get("/_public/cartToContent").then((resp) => {
        // console.log(resp.data)
        this.cart.total = resp.data.cart_total;
        this.form.total = resp.data.cart_total;
      });
    },
    validation() {
      if (this.form.address.length < 3) {
        this.disabled = true;
        return;
      }
      if (this.form.city.length <= 0) {
        this.disabled = true;
        return;
      }
      if (this.form.total.length <= 0) {
        this.disabled = true;
        return;
      }
      if (this.form.city <= 0) {
        this.disabled = true;
        return;
      }

      this.disabled = false;
    },
  },
  components: {
    Loading,
  },
  mounted() {
    setTimeout(() => {
      this.selectCity();
    }, 1000);
  },
};
</script>