<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'purchase' }" class="btn btn-primary">
            <i class="fa fa-arrow-right"></i>
          </router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Purchase</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-10 col-lg-offset-1">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Add Purchase</h3>
              </div>
              <div class="box-body">
                <h1 v-if="loading">
                  <i class="fa fa-spin fa-spinner"></i>
                </h1>
                <!--                                <form @submit.prevent="add" v-else @keydown="form.onKeydown($event)"-->
                <!--                                      enctype="multipart/form-data">-->
                <div class="alert-danger alert" v-if="error">{{ error }}</div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Purchase_date</label>
                      <date-picker
                        autocomplete="off"
                        v-model="purchase_date"
                        :config="options"
                      ></date-picker>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Invoice_no</label>
                      <input
                        class="form-control"
                        v-model="invoice_no"
                        placeholder="invoice"
                        @keyup="validation"
                        autofocus
                      />
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Supplier</label>
                      <select
                        class="form-control"
                        @change="validation"
                        v-model="supplier_id"
                        name="supplier"
                      >
                        <option value>Select Supplier</option>
                        <option
                          v-for="supplier in suppliers"
                          :value="supplier.id"
                          :key="supplier.id"
                        >
                          {{ supplier.company_name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Document/Memo</label>
                      <input class="form-control" type="file" @change="uploadImage" name="document">
                    </div>
                  </div>
                </div>
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
                              {{ productItem.product_code + "-" + productItem.name }}
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label>Purchase_price</label>
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
                <div class="product_preview" v-if="products.length > 0">
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
                      <tr v-for="(product, index) in products.slice().reverse()" >
                        <td>{{ index + 1 }}</td>
                        <td>{{ product.product_code + "-" + product.product_name }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>{{ product.total }}</td>
                        <td class="text-danger" @click="cancel(index)">
                          <i class="fa fa-trash"></i>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>purchase_type</td>
                        <td>
                          <select class="form-control" v-model="purchase_type">
                            <option value="1">FOB</option>
                            <option value="2">CM</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>Total Amount</td>
                        <td>{{ this.AmountTotal }}</td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>Paid</td>
                        <td>
                          <input
                            class="form-control"
                            placeholder="Paid"
                            @keyup="amountDue"
                            v-model="paid"
                          />
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>Paid By</td>
                        <td>
                          <select
                            name="debit_from"
                            id=""
                            class="form-control"
                            v-model="paid_by"
                          >
                            <option value="Cash">Cash</option>
                            <option value="Bkash(personal)">Bkash(personal)</option>
                            <option value="Bkash(merchant)">Bkash(merchant)</option>
                            <option value="Bank(AIBL)">Bank(AIBL)</option>
                            
                            <option value="Bank(SIBL)">Bank(SIBL)</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>Amount Due</td>
                        <td>{{ due }}</td>
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
    this.pDate();
    this.supplierList();
  },
  data() {
    return {
      purchase_date: "",
      error: "",
      loading: true,
      status: 1,
      options: {
        format: "YYYY-MM-DD",
        useCurrent: false,
      },
      supplier_id: "",
      productItems: [],
      automcomplete: false,
      search: "",
      suppliers: "",
      invoice_no: "",
      validationPreview: true,
      submitValidation: true,
      products: [],
      preview_products: {
        product_name: "",
        product_id: "",
        product_code: "",
        price: "",
        quantity: "",
        total: "",
        alert_quantity: "",
      },
      AmountTotal: 0,
      paid: 0,
      due: 0,
      purchase_type: 1,
      paid_by: "Cash",
      memo:""
    };
  },

  methods: {
    add() {
      this.$Progress.start();
      axios
        .post("/add/purchase", {
          purchase_date: this.purchase_date,
          supplier_id: this.supplier_id,
          total: this.AmountTotal,
          paid: this.paid,
          invoice_no: this.invoice_no,
          products: this.products,
          status: this.status,
          paid_by: this.paid_by,
          memo:this.memo
        })
        .then((resp) => {
          this.$Progress.finish();
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            console.log(resp);
            this.$router.push({ name: "purchase" });
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
    supplierList() {
      axios
        .get("/others", {
          params: {
            type: 1,
          },
        })

        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.suppliers = resp.data.suppliers;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
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
    total() {
      if (this.preview_products.price.length <= 0) {
        this.$toasted.show("sorry! price filed fille up first", {
          type: "error",
          position: "top-center",
          duration: 5000,
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
    productAdd() {
      this.products.push(this.preview_products);
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
    },
    validation() {
      //console.log(this.preview_products.price)
      if (
        this.preview_products.price.length > 0 &&
        this.preview_products.quantity.length > 0 &&
        this.invoice_no.length > 0 &&
        this.preview_products.product_id &&
        this.search.length > 0 &&
        this.supplier_id 
      ) {
        this.validationPreview = false;
      } else {
        this.validationPreview = true;
        // this.submitValidation=true;
      }
      if (this.products.length > 0 && this.invoice_no.length > 0 && this.supplier_id &&  this.memo.length > 0) {
        this.submitValidation = false;
      } else {
        this.submitValidation = true;
      }
      // this.submitValidation();
    },

    totalAmount() {
      let i = 0;
      let total = 0;
      let products = this.products;
      for (i; i < products.length; i++) {
        total += products[i].price * products[i].quantity;
      }
      this.AmountTotal = total;
      this.due = total;
    },
    amountDue() {
      let paid = this.paid;
      let total = this.AmountTotal;
      let due = total - paid;

      this.due = due;
    },
    cancel(index) {
      this.products.splice(index, 1);
      this.totalAmount();
      this.amountDue();
      this.validation();
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
     uploadImage(e) {
      var file = e.target.files[0];
    
    if (!file.type.match("image.*")) {
         Swal.fire({
          type:'warning',
          text:'this is not any kind of image',
        });
        this.memo="";
         this.validation();
        return;
      }

        let reader = new FileReader();
        reader.onload = (e) => {
        this.memo = e.target.result;
         this.validation();
        };
      reader.readAsDataURL(file);
     
    },
  },
  computed: {},
  components: {
    datePicker,
  },
  watch: {
    purchase_type: function (value) {
      if (value == 2) {
        Swal.fire({
          title: "Enter CM Rate 1/pieces",
          input: "text",
        }).then((result) => {
          if (result.value) {
            let quantity = 0;
            console.log(this.products);
            console.log(this.products.length);
            if (this.products.length > 0) {
              this.products.forEach((element) => {
                quantity += parseInt(element.quantity);
                //console.log(element.quantity)
              });
            }
            this.AmountTotal = parseInt(quantity) * parseInt(result.value);
            this.due = parseInt(quantity) * parseInt(result.value) - parseInt(this.paid);
          }
        });
      }
    },
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
