<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'officeSale' }" class="btn btn-primary">
            <i class="fa fa-arrow-right"></i>
          </router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Sale</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Add Company Sale</h3>
              </div>
              <div class="box-body">
                <div class="alert-danger alert" v-if="error">{{ error }}</div>
                <div class="row">
                 
                  <div v-if="form.type == 1">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label>Name</label>
                        <input
                          class="form-control"
                          v-model="form.name"
                          placeholder="Name"
                          autofocus
                          @keyup="finalValidation"
                        />
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label>Mobile_no</label>
                        <input
                          class="form-control"
                          v-model="form.mobile_no"
                          placeholder="017xx-xxxxxx"
                          @keyup="finalValidation"
                        />
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label>Address</label>
                        <input
                          class="form-control"
                          v-model="form.address"
                          placeholder="address"
                          @keyup="finalValidation"
                        />
                      </div>
                    </div>
                  </div>
                  <div v-else>
                    <div class="col-lg-5">
                      <label>Company</label>
                      <select
                        class="form-control"
                        v-model="form.company_id"
                        @change="finalValidation"
                      >
                        <option value="" selected disabled>
                          Select Company
                        </option>
                        <option
                          v-for="company in companies"
                          :value="company.id"
                        >
                          {{ company.name }}
                        </option>
                      </select>
                    </div>
                   
                    <div class="col-lg-5">
                      <label>Invvoice_no</label>
                      <input
                        type="text"
                        class="form-control"
                        @keydown="finalValidation"
                        v-model="form.invoice_no"
                      />
                    </div>
                  </div>
                </div>
                 <br>
                <div class="product_information">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label>Product_code</label>
                        <input
                          class="form-control"
                          autocomplete="off"
                          name="product"
                          v-model="search"
                          placeholder="type product code"
                          @keyup="autocompleteSearh"
                        />

                        <div class="autocomplete" v-show="automcomplete">
                          <ul class="list-group">
                            <li
                              class="list-group-item"
                              v-for="productItem in productItems"
                              @click="selectedProduct(productItem)"
                            >
                              {{
                                productItem.product_code +
                                "-" +
                                productItem.name
                              }}
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label>Price</label>
                        <input
                          v-model="preview_products.price"
                          type="text"
                          ref="price"
                          name="price"
                          class="form-control"
                          autocomplete="off"
                          placeholder="price"
                          @keyup="total"
                        />
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label>Quantity</label>
                        <input
                          v-model="preview_products.quantity"
                          type="text"
                          name="quantity"
                          class="form-control"
                          autocomplete="off"
                          placeholder="quantity"
                          @keyup="total"
                        />
                      </div>
                    </div>

                    <div class="col-lg-2">
                      <div class="form-group">
                        <label>Total</label>
                        <input
                          v-model="preview_products.total"
                          type="text"
                          name="total"
                          class="form-control"
                          autocomplete="off"
                          placeholder="total"
                          readonly
                        />
                      </div>
                    </div>
                    <div class="col-lg-1">
                      <button
                        class="btn btn-success btn-sm"
                        style="margin-top: 25px"
                        @click="productAdd"
                        :disabled="validationPreview"
                      >
                        Add
                      </button>
                    </div>
                  </div>
                </div>
                <div class="product_preview" v-if="form.products.length > 0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>total</th>
                        <th>X</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(product, index) in form.products">
                        <td>{{ index + 1 }}</td>
                        <td>
                          {{
                            product.product_code + "-" + product.product_name
                          }}
                        </td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>{{ product.total }}</td>
                        <td class="text-danger" @click="cancel(index)">
                          <i class="fa fa-trash"></i>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>Total Amount</td>
                        <td>{{ this.form.AmountTotal }}</td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>Paid</td>
                        <td>
                          <input
                            class="form-control"
                            placeholder="Paid"
                            @keyup="amountDue"
                            v-model="form.paid"
                          />
                        </td>
                      </tr>

                      <tr>
                        <td colspan="3"></td>
                        <td>Paid_by</td>
                        <td>
                          <select class="form-control" v-model="form.paid_by">
                             <option value="Cash">Cash</option>
                            <option value="Bkash(personal)">Bkash(personal)</option>
                            <option value="Bkash(merchant)">Bkash(merchant)</option>
                              <option value="Bank">Bank</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>Amount Due</td>
                        <td>{{ form.due }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <br />
                <button
                  :disabled="submitValidation"
                  type="submit"
                  @click="add()"
                  class="btn btn-primary"
                >
                  Submit
                </button>

                <!--                                </form>-->
              </div>
            </div>
          </div>
        </div>
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
    this.companyList();
  },
  data() {
    return {
      //form submit data
      form: new Form({
        type: 2,
        name: "",
        mobile_no: "",
        address: "",

        //multiple product data
        products: [],

        // culation data
        AmountTotal: 0,
        paid: 0,
        due: 0,
        company_id: "",
        paid_by: 'Cash',
        invoice_no: "",
      }),

      companies: "",

      error: "",

      //store product item from to get db when user type product code or product name
      productItems: [],
      //auto complete
      automcomplete: false,
      search: "",

      //for check product reltaed property validation
      validationPreview: true,

      submitValidation: true,

      //first store product as obejct, when user select a sepecific product from auto complete serach box
      //and this object pust form.product arraw
      preview_products: {
        product_name: "",
        product_id: "",
        product_code: "",
        price: "",
        quantity: "",
        total: "",
        alert_quantity: "",
      },
    };
  },

  methods: {
    //method initial for add sale
    add() {
      this.$Progress.start();
      this.form
        .post("/sale/store")
        .then((resp) => {
          this.$Progress.finish();
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            console.log(resp);
            if (this.form.type == 1) {
              this.$router.push({ name: "officeSale" });
            } else {
              this.$router.push({ name: "compnaySale" });
            }
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 4000,
            });
          } else {
            this.error = "dont saved data. please try again";
          }
        })
        .catch((error) => {
          this.$Progress.finish();
          console.log(error);
          this.error = "some thing want to wrong";
        });
    },

    //method initial for get product data when admin type product code or name
    autocompleteSearh() {
      let length = this.search.length;
      this.validation();

      if (length >= 2) {
        axios
          .get("/search/product/" + this.search)

          .then((resp) => {
            if (resp.data.status == "SUCCESS") {
              let x = resp.data.products.data.length;
              let i = 0;

              if (x >= 1) {
                this.productItems = [];
                for (i; i < x; i++) {
                  this.productItems.push(resp.data.products.data[i]);
                }
              } else {
                let no_found = {
                  name: "No product found",
                  product_code: "404",
                };
                this.productItems = [];
                this.productItems.push(no_found);
              }
            }
          })
          .catch((error) => {
            console.log(error);
          });
        this.automcomplete = true;
      } else {
        this.automcomplete = false;
      }
    },

    //method initial for set product item when admin select specific product item
    selectedProduct(productItem) {
      if (productItem.name == "No product found") {
        alert("please enter product valid code or name");
        this.validation();
        return;
      } else {
        this.automcomplete = false;
        this.preview_products.product_name = productItem.name;
        this.preview_products.product_id = productItem.id;
        this.preview_products.product_code = productItem.product_code;
        this.search = productItem.product_code + "-" + productItem.name;
        this.validation();
      }
    },

    //method initial for calulate sub total  amount, prodict price*quantity
    total() {
      if (this.preview_products.price.length <= 0) {
        this.$toasted.show("sorry! price filed fille up first", {
          type: "error",
          position: "top-center",
          duration: 3000,
        });
        this.$refs.price.focus();
        this.validation();
        return;
      } else {
        let price = this.preview_products.price;
        let quantity = this.preview_products.quantity;

        if (quantity <= 1) {
          quantity = 1;
        }
        let total = price * quantity;
        this.preview_products.total = total;
        this.validation();
      }
    },

    //method initial for product add on form.prodcut arraw
    productAdd() {
      this.form.products.push(this.preview_products);
      this.preview_products = {
        product_id: "",
        product_code: "",
        product_name: "",
        price: "",
        total: "",
        quantity: "",
        alert_quantity: "",
      };
      this.search = "";
      this.totalAmount();
      this.amountDue();
      this.validation();
      this.finalValidation();
    },

    //method initial for validation product data
    validation() {
      //console.log(this.preview_products.price)
      if (
        this.preview_products.price.length > 0 &&
        this.preview_products.quantity.length > 0 &&
        this.preview_products.product_id &&
        this.search.length > 0
      ) {
        this.validationPreview = false;
        return;
      } else {
        this.validationPreview = true;
        return;
        // this.submitValidation=true;
      }
    },

    finalValidation() {
      if (this.form.products.length <= 0) {
        this.submitValidation = true;
        return;
      }

     
      if (this.form.company_id.length <= 0) {
        this.submitValidation = true;
        return;
      }

      if ( this.form.invoice_no.length <= 0) {
        this.submitValidation = true;
        return;
      }

      this.submitValidation = false;
    },

    totalAmount() {
      let i = 0;
      let total = 0;
      let products = this.form.products;
      for (i; i < products.length; i++) {
        total += products[i].price * products[i].quantity;
      }
      this.form.AmountTotal = total;
      this.form.due = total;
    },
    amountDue() {
      let paid = this.form.paid;
      let total = this.form.AmountTotal;
      let due = total - paid;

      this.form.due = due;
    },
    cancel(index) {
      this.form.products.splice(index, 1);
      this.totalAmount();
      this.amountDue();
      this.validation();
      this.finalValidation();
    },
    pDate() {
      let d = new Date();

      let month = d.getMonth() + 1;
      let day = d.getDate();
      let output =
        d.getFullYear() +
        "-" +
        (("" + month).length < 2 ? "0" : "") +
        month +
        "-" +
        (("" + day).length < 2 ? "0" : "") +
        day;
      this.purchase_date = output;
    },

    //method initial for get commany list
    companyList() {
      axios
        .get("/company")
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.companies = resp.data.companies;
          }
        })
        .catch((error) => {
          // console.log(error);
        });
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
