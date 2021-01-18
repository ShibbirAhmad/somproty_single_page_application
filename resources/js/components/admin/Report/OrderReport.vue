<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Order Report</li>
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
                      <select v-model="item" @change="filter">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                      </select>
                    </div>
                    <div class="col-lg-2">
                          <button @click="downloadPDF" class="btn btn-info "> <i class="fa fa-download"></i>Download PDF</button>
                    </div>
                    <div class="col-lg-3 orders-heading">
                      <h3 class="box-title">ORDER REPORT</h3>
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
                        <th scope="col">#</th>
                        <th scope="col">Customer_phone</th>
                        <th scope="col">Invoice_no</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr v-else v-for="(order, index) in orders.data" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ order.cutomer_phone }}</td>
                        <td>
                          <a :href="'/backend/view/order/' + order.id" target="_blank">
                            {{ order.invoice_no }}
                          </a>
                        </td>
                        <td>
                          {{ ProductCount(order.order_item) }}
                        </td>
                        <td>{{ order.created_at }}</td>
                        <td>{{ orderStatus(order.status) }}</td>
                        <td>
                          {{
                            parseInt(order.total) -
                            parseInt(order.discount) +
                            parseInt(order.shipping_cost)
                          }}
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>
                          <strong> = {{ totalproductQuantity() }}</strong>
                        </td>
                        <td colspan="2"></td>
                        <td>
                          <strong> ={{ totalAmount() }}</strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                      <pagination
                        :data="orders"
                        @pagination-change-page="filter"
                        :limit="5"
                      ></pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing
                        <strong>{{ orders.from }}</strong> to
                        <strong>{{ orders.to }}</strong> of total
                        <strong>{{ orders.total }}</strong> entries
                      </p>
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
import Index from "../Index";
import { Form } from "vform";

export default {
  components: { Index },

  created() {
    this.filter();
  },
  data() {
    return {
      loading: true,
      start_date: "",
      end_date: "",
      orders: "",
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
        .get("/api/order/report?page=" + page, {
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
            this.orders = resp.data;
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
    orderStatus(status) {
      let order_status = "";
      switch (status) {
        case 1:
          order_status = "New";
          break;
        case 2:
          order_status = "Pending";
          break;
        case 3:
          order_status = "Approved";
          break;
        case 4:
          order_status = "Shipment";
          break;
        case 5:
          order_status = "Delivered";
          break;
        case 6:
          order_status = "Cancel";
          break;
        case 7:
          order_status = "Retrun";
          break;

        default:
          order_status = ""; // code block
      }

      return order_status;
    },
    totalAmount() {
      let total = 0;
      this.orders.data.forEach((element) => {
        total +=
          parseInt(element.total) -
          parseInt(element.discount) +
          parseInt(element.shipping_cost);
      });
      return total;
    },
    ProductCount(items) {
      let total = 0;
      items.forEach((element) => {
        total += parseInt(element.quantity);
      });

      return total;
    },
    totalproductQuantity() {
      let total = 0;
      this.orders.data.forEach((element) => {
        element.order_item.forEach((ele) => {
          total += parseInt(ele.quantity);
        });
      });
      return total;
    },

       downloadPDF(){
      
      let start_date="All";
      let end_date="All";

      if(this.start_date.length>0){
      start_date=this.start_date;
      }
      if(this.end_date.length>0){
        end_date=this.end_date;
      }

       window.open('/api/get/sale/order/pdf/'+start_date+'/'+end_date,'_blank');
    
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
