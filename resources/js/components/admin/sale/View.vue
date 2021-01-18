<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header"></section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header"></div>
                <div class="box-body">
                  <div class="row print_info_container">
                    <div class="col-md-1 col-sm-1"></div>
                    <div class="col-md-3 col-sm-3 description">
                      <div v-if="sale.sale_type == 1">
                        <!-- <p >Sale Type: Office Sale </p> -->
                        <p>Name: {{ sale.name }}</p>
                        <p>
                          Mobile No: <strong> {{ sale.mobile_no }} </strong>
                        </p>
                        <p class="address_line">Address: {{ sale.address }}</p>

                        <p>
                          Invoice No:
                          <strong v-if="sale.invoice_no">{{ sale.invoice_no }}</strong>
                          <strong v-else> {{ "S-" + sale.id }}</strong>
                        </p>
                      </div>
                      <div v-else>
                        <div class="col-lg-4 invoice-body" style="margin-left: 27px">
                          <p>Sale Type:Company_sale</p>
                          <p>Company Name: "Daraz"</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3 col-sm-3 logo">
                      <img
                        :src="base_url + 'images/logo.png'"
                        class="m_logo"
                        alt="logo"
                      />
                      <!-- <p class="m_title"> Trusted Onlinde Shopping In Bangladesh </p> -->
                    </div>
                    <div style="margin-left: 27px" class="col-md-4 col-sm-4 address">
                      <p class="address_line">
                        Office: House:02, Lane:11,Block:A, Banaroshi Polli, section-10,
                        Mirpur,Dhaka.
                      </p>
                      <p>Email: support@mohasagor.com</p>
                      <p>Hot Line: <strong> 09636 203040</strong></p>
                      <p>
                        Date:<strong> {{ sale.created_at}}</strong>
                      </p>
                    </div>
                    <div class="col-md-1 col-sm-1"></div>
                  </div>

                  <div class="row" >
                    <div class="col-lg-1"></div>
                    <h1 v-if="loading">
                      <i class="fa fa-spin fa-spinner"></i>
                    </h1>
                    <div class="col-lg-10" v-else>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Product_code</th>
                            <th>Quntity</th>
                            <th>Price</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(item, index) in details" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>
                              {{ item.product.name }}
                              <small class="badge" v-if="item.status == 2">
                                - exchange</small
                              >
                            </td>
                            <td>{{ item.product.product_code }}</td>
                            <td>{{ item.qty }}</td>
                            <td>{{ item.price }}</td>
                            <td>
                              <span :class="{ 'text-danger': item.status == 2 }">{{
                                item.total
                              }}</span>
                            </td>
                          </tr>
                          <tr v-if="sale.status == 2">
                            <td colspan="4"></td>

                            <td>
                              <b>Sale Amount</b>
                            </td>
                            <td>
                              <b>{{ saleAmount() }}</b>
                            </td>
                          </tr>
                          <tr v-if="sale.status == 2">
                            <td colspan="4"></td>

                            <td>
                              <b>Exchnage Amount</b>
                            </td>
                            <td>
                              <b>{{ exchangeAmount() }}</b>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3"></td>
                            <td>
                              <strong> = {{ totalQuantity() }}</strong>
                            </td>
                            <td>
                              <b>Total Amount</b>
                            </td>
                            <td>
                              <b>{{ sale.total }}</b>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="4"></td>
                            <td>
                              <b>Discount</b>
                            </td>
                            <td>
                              <b>{{ sale.discount }}</b>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="4"></td>
                            <td>
                              <b>Paid</b>
                            </td>
                            <td>
                              <b>{{ sale.paid }}</b>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="4"></td>
                            <td>
                              <b>Amount Due</b>
                            </td>
                            <td>
                              <b>{{
                                parseInt(sale.total) -
                                parseInt(sale.paid) -
                                parseInt(sale.discount)
                              }}</b>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row exchange-memo" v-show="sale.status==2">
                    <img :src="base_url+'images/static/exchange.png'" alt="">
                  </div>

                  <div class="row">
                    <div class="col-lg-2" style="margin-left: 27px; text-align: center">
                      <h5 style="border-top: 2px dotted #000; margin-top: 30px">
                        <strong>Accounts</strong>
                      </h5>
                    </div>
                  </div>

                  <div class="bottomBtn">
                    <button class="btn btn-success print" @click="print">
                      <i class="fa fa-print"></i>
                    </button>
                    <button class="btn btn-warning back" @click="back">
                      <i class="fa fa-arrow-circle-right"></i>
                    </button>
                  </div>
                </div>
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

Vue.component(HasError.name, HasError);
export default {
  name: "Purchase",
  created() {
    //  this.purchaseDetails();
    this.purchaseDetails();
  },
  data() {
    return {
      sale: "",
      details: "",
      error: "",
      loading: true,
      merchant: "",
      base_url: this.$store.state.image_base_link,
    };
  },

  methods: {
    purchaseDetails() {
      axios
        .get("/sale/view/" + this.$route.params.id)
        .then((resp) => {
          if (resp.data.status == "SUCCESS") {
            this.sale = resp.data.sale;
            this.details = resp.data.items;
            this.loading = false;
          } else {
            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 5000,
            });
          }
        })
        .catch((error) => {
          console.log(error);
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 4000,
          });
        });
    },
    formatDate(date) {
      console.log(date);
      let short_date = date.split(" ")[0];
      let origina_date = short_date.split("-");
      return `${origina_date[2]}-${origina_date[1]}-${origina_date[0]}`;
    },
    print() {
      window.print();
    },
    back() {
      //   console.log(window.history);
      window.history.back();
    },
    totalQuantity() {
      let total = 0;
      let sale_product = 0;
      let exchange_product;
      this.details.forEach((element) => {
        if (element.status == 1) {
          total += parseInt(element.qty);
        }
      });

      return total;
    },
    saleAmount() {
      let total = 0;
      this.details.forEach((ele) => {
        if (ele.status == 1) {
          total += parseInt(ele.price) * parseInt(ele.qty);
        }
      });

      return total;
    },
    exchangeAmount() {
      let total = 0;
      this.details.forEach((ele) => {
        if (ele.status == 2) {
          total += parseInt(ele.price) * parseInt(ele.qty);
        }
      });

      return total;
    },
  },
  computed: {},
};
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}
.bottomBtn {
  margin-top: 15px;
  margin-left: 20px;
}
.head_title {
  margin-left: 27px;
  margin-top: -12px;
}
.address_line {
  line-height: 15px;
}
p {
  line-height: 11px;
  font-size: 14px;
}
.m_logo {
  margin-left: 25px;
  margin-top: -21px;
  height: 80px;
}
.m_title {
  margin-top: -15px;
  font-size: 11px;
}
table {
  margin-top: 10px;
}
@media print {
  table {
    margin-top: 0px !important;
  }

  .m_title {
    margin-top: -15px;
    font-size: 10px;
  }
  .navbar {
    display: none;
  }

  .print_info_container {
    display: flex;
    flex-direction: row;
    position: relative;
    width: 100%;
    padding: 10px 10px !important;
    margin-top: -15px;
  }
  .col-sm-1 {
    display: none;
  }
  p {
    line-height: 8px;
    font-size: 14px;
  }
  .logo {
    width: 40% !important;
  }

  .description {
    width: 40% !important;
  }
  .col-lg-2 {
    width: 20% !important;
    margin-top: 20px !important;
  }
  .invoice-header {
    display: block;
  }
  .box {
    border-top: none;
  }
  footer {
    border-top: none !important;
  }
  .bottomBtn {
    display: none;
  }
  .address {
    text-align: right;
  }
}
.exchange-memo {
    position: absolute;
    left: 25%;
    top: 43%;
}
</style>
