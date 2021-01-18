<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Office Sale Report</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="row" style="margin-bottom: 3px">
                    <div class="col-lg-2">
                    
                    </div>
                    <div class="col-lg-2">
                      <div class="col-lg-2">
                        <!-- <button @click="downloadPDF" class="btn btn-info "> <i class="fa fa-download"></i>Download PDF</button> -->
                      </div>
                    </div>
                    <div class="col-lg-3 orders-heading">
                      <h3 class="box-title">ORDER PROFIT REPORT</h3>
                    </div>
                    <div class="col-lg-5">
                      <div class="row">
                        <div class="col-lg-5">
                          <date-picker
                            autocomplete="off"
                            v-model="start_date"
                            placeholder="start-date"
                            :config="options"
                          ></date-picker>
                        </div>
                        <div class="col-lg-5" style="margin-left: -20px">
                          <date-picker
                            autocomplete="off"
                            v-model="end_date"
                            placeholder="end-date"
                            :config="options"
                          ></date-picker>
                        </div>
                        <div class="col-lg-2">
                          <button class="btn btn-primary" @click="refresh">
                            <i class="fa fa-refresh"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Order Date</th>
                        <th scope="col">Delivered Date</th>
                        <th scope="col">Sale Invoice</th>
                        <th scope="col">Invoice Product Qty</th>
                        <th scope="col">Invoice Sale Amount</th>
                        <th scope="col">Invoice Purchase Amount</th>
                        <th scope="col">Profit</th>
                        <th scope="col">Profit Rate <strong><small>%</small></strong></th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr v-else v-for="(item, index) in data" :key="index">

                        <td>{{item.order_date}}</td>
                         <td>{{item.order_delivered_date}}</td>
                        <td>
                           {{item.order_invoice }}
                         
                        </td>
                        <td>{{ item.product_count }}</td>
                        <td>{{ parseInt(item.order_total) }}</td>
                        <td>{{ parseInt(item.product_purchase_amount) }}</td>
                        <td>
                          {{
                            parseInt(item.order_total) -
                            parseInt(item.product_purchase_amount)
                          }}
                        </td>
                        <td>
                          {{
                            profitePercntage(
                              item.order_total,
                              item.product_purchase_amount
                            )
                          }}
                        </td>
                      </tr>
                      <tr>
                        <td colspan="4"></td>
                        <td>
                          <strong> = {{ totalproductQuantity() }}</strong>
                        </td>
                        <td>
                          <strong> = {{ totalSalePrie() }}</strong>
                        </td>
                        <td>
                          <strong> = {{ totalPurchasePrie() }}</strong>
                          
                        </td>
                        <td>
                          <strong>
                            <b>{{ totalProfite() }}</b></strong
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
import Index from "../Index";
import { Form } from "vform";

export default {
  components: { Index },

  created() {
    this.t_date();
    this.filter();
  },
  data() {
    return {
      loading: true,
      start_date: "",
      end_date: "",
      data: {},
      item: 50,

      //date picker options ..........
      options: {
        format: "YYYY-MM-DD",
        useCurrent: false,
      },
    };
  },
  methods: {
    filter(page = 1) {
      this.$Progress.start();
      axios
        .get("/order/profite/report", {
          params: {
            start_date: this.start_date,
            end_date: this.end_date,
            item: this.item,
          },
        })
        .then((resp) => {
          console.log(resp);
          this.$Progress.finish();
          if (resp.data) {
            this.data = resp.data;
            this.loading = false;
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    refresh() {
      this.$Progress.start();
      this.start_date = "";
      this.end_date = "";
      this.filter();
      this.$Progress.finish();
    },

    totalproductQuantity() {
      let total = 0;
      for (let obj_property in this.data) {
        total += parseInt(this.data[obj_property].product_count);
        console.log(this.data[obj_property].product_count);
      }
      return total;
    },

    totalProfite() {
      let total = 0;

      for (let obj_property in this.data) {
        total +=
          parseInt(this.data[obj_property].order_total) -
          parseInt(this.data[obj_property].product_purchase_amount);
        console.log(this.data[obj_property].product_count);
      }

      return total;
    },
    totalSalePrie() {
      let total = 0;

      for (let obj_property in this.data) {
        total += parseInt(this.data[obj_property].order_total);
        console.log(this.data[obj_property].product_count);
      }

      return total;
    },
    totalPurchasePrie() {
      let total = 0;

      for (let obj_property in this.data) {
        total += parseInt(this.data[obj_property].product_purchase_amount);
        console.log(this.data[obj_property].product_count);
      }

      return total;
    },
    profitePercntage(sale_price, purchase_price) {
      let profirte = parseFloat(sale_price) - parseFloat(purchase_price);
      let profite_percent =
        (parseFloat(profirte) / parseFloat(purchase_price)) * parseInt(100);

      return profite_percent.toFixed(2);
    },

    t_date() {
      //current date
      let d = new Date();

      //current mount
      //current day
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
      this.start_date = output;
    },
  },
  watch: {
    start_date: function (value) {
      this.filter();
    },
    end_date: function (value) {
      this.filter();
    },
  },
};
</script>

<style>
.orders-heading {
  text-align: center;
  text-transform: uppercase;
  border-bottom: 2px solid #000;
  margin-bottom: 10px;
}
</style>
