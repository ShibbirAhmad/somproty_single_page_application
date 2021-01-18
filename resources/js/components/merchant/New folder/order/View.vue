<template>
  <div>
    <navbar></navbar>
    <div class="content-wrapper">
      <section class="content-header"></section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header"></div>
                <div class="box-body">
                  <div class="row">
                    <div class="invoice-header">
                      <img
                        class="invoice-logo"
                        :src="'/./frontend/image/logo.png'"
                        title="MarketShop"
                        alt="MarketShop"
                      />
                      <div class="address">
                        <p>Office: Houes:36,Road:06,Banarosi Polli,Mirpur-10,Dhaka-1216.</p>
                        <p>EmaiL:support@madinafashionbd.com</p>
                        <p>Mobile:017xxxxxxx</p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4 invoice-body" style="margin-left:27px;">
                      <p class="text-bold">Name: {{order.customer.name}}</p>
                      <p class="text-bold">Phone: {{order.cutomer_phone}}</p>
                      <p
                        class="text-bold"
                      >Address: {{order.customer.address +', ' + order.city.name}}</p>
                      <p class="text-bold">
                        Invoice:
                        <strong>{{order.invoice_no}}</strong>
                      </p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-1"></div>
                    <h1 v-if="loading">
                      <i class="fa fa-spin fa-spinner"></i>
                    </h1>
                    <div class="col-lg-8" v-else>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>P_code</th>
                            <th>quntity</th>
                            <th>price</th>
                            <th>total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(item,index) in items " :key="index">
                            <td>{{index+1}}</td>
                            <td>
                              {{ item.product.name}}
                              <strong
                                v-if="item.attribute"
                              >-{{item.attribute.name}}[{{item.variant.name }}]</strong>
                            </td>
                            <td>{{ item.product.product_code }}</td>
                            <td>{{item.quantity}}</td>
                            <td>{{item.price}}</td>
                            <td>{{item.quantity*item.price}}</td>
                          </tr>

                          <tr>
                            <td colspan="4"></td>
                            <td>
                              <b>Sub Total</b>
                            </td>
                            <td>
                              <b>{{order.total}}</b>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="4"></td>
                            <td>
                              <b>Discount</b>
                            </td>
                            <td>
                              <b>{{order.discount}}</b>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="4"></td>
                            <td>
                              <b>Paid</b>
                            </td>
                            <td>
                              <b>{{order.paid}}</b>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="4"></td>
                            <td>
                              <b>Shiiping_cost</b>
                            </td>
                            <td>
                              <b>{{order.shipping_cost}}</b>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="4"></td>
                            <td>
                              <b>Amount Due</b>
                            </td>
                            <td>
                              <b>{{order.total-(order.discount+order.paid)+order.shipping_cost}}</b>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2" style="margin-left:27px;text-align:center;">
                      <h6
                        style="margin-bottom:0;"
                        v-if="order.approved_by != null"
                      >{{order.approved_by.name}}</h6>
                      <h5 style="border-top:2px dotted #000;margin-top:25;">
                        <strong>Approved By</strong>
                      </h5>
                    </div>
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
import navbar from "../Navbar" ;

export default {
  created() {
    this.getDetails();
    //  this.purchaseDetails();

    this.$Progress.start();
    setTimeout(() => {
      this.$Progress.finish();
      this.loading = false;
    }, 500);
  },
  data() {
    return {
      order: "",
      items: "",
      loading: true,
    };
  },

  methods: {
    getDetails() {
      axios
        .get("/api/merchant/order/view/" + this.$route.params.id)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.order = resp.data.order;
            this.items = resp.data.items;
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
    print() {
      window.print();
    },
    back() {
      //   console.log(window.history);
      window.history.back();
    },
  },
  components:{
      navbar 
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

@media print {
  .navbar {
    display: none;
  }
  .col-lg-2 {
    width: 20% !important;
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
}
</style>
