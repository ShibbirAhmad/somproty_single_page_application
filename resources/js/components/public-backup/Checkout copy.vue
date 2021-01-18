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
                      ></textarea>
                      <has-error :form="form" field="address"></has-error>

                      <br />
                      <div class="form-grop">
                        <label class="control-label" for="input-email">City</label>
                        <select name id class="form-control" v-model="form.city">
                          <option value>Select City</option>
                          <option
                            value
                            v-for="(city,index) in cities"
                            :key="index"
                            :value="city.id"
                          >{{city.name}}</option>
                        </select>
                        <has-error :form="form" field="mobile_no"></has-error>
                      </div>
                      <br />
                    </div>
                    <button :disabled="form.busy" class="btn btn-block btn-primary" type="submit">
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
                          <td>Cart total</td>
                          <td colspan="4"></td>
                          <td>
                            :
                            <strong>&#2547</strong>
                            120
                          </td>
                        </tr>
                        <br />
                        <tr>
                          <td>shipping cost</td>
                          <td colspan="4"></td>
                          <td>
                            :
                            <strong>&#2547</strong>
                            120
                          </td>
                        </tr>
                        <br />
                        <tr>
                          <td>Total</td>
                          <td colspan="4"></td>
                          <td>
                            :
                            <strong>&#2547</strong>
                            {{ }}
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
    this.$store.dispatch("user");
    this.$store.dispatch("getCartContent");
    this.cart = this.$store.getters.cartContent;
    //this.total=cart.total;
    this.getCity();
    setTimeout(() => {
      this.isLoading = false;
      this.user = this.$store.getters.user;
      this.setUser();
    }, 1000);
  },
  data() {
    return {
      form: new Form({
        mobile_no: "",
        name: "",
        address: "",
        city: "",
        total: "",
        cart: "",
      }),
      isLoading: true,
      fullPage: true,
      user: null,
      cities: "",
      cart: "",
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

    setUser() {
      this.form.mobile_no = this.user.mobile_no;
      this.form.name = this.user.name;
      this.form.address = this.user.address;
      this.form.city = this.user.city_id;
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
  },
  components: {
    Loading,
  },

  watch: {
    cart: function (val) {
      console.log(typeof val)
    },
  },
};
</script>