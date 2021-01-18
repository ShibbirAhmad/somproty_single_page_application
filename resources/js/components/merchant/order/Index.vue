<template>
  <div>
    <navbar></navbar>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Order Table</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h4>order table</h4>
                  <div style="margin-top: 10px" class="row">
                    <div class="col-lg-2">
                      <select
                        class="form-control"
                        v-model="item"
                        @change="orderList()"
                      >
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                      </select>
                    </div>
                    <div class="col-lg-2"></div>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer_Name</th>
                        <th scope="col">C_phone</th>
                        <th scope="col">C_address</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Total</th>
                        <th scope="col">created_by</th>
                        <th scope="col">order_palce</th>
                        <th scope="col">order_date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>

                      <tr
                        v-for="(order, index) in orders.data"
                        :key="index"
                      >
                        <td scope="row">{{ index + 1 }}</td>

                        <td scope="row">{{ order.customer.name }}</td>
                        <td scope="row">{{ order.cutomer_phone }}</td>
                        <td scope="row">
                          {{ order.customer ? order.customer.address : "" }}
                        </td>

                        <td scope="row">{{ order.invoice_no }}</td>
                        <td class="two-percent">
                          {{
                            order.total -
                            (order.discount + order.paid) +
                            order.shipping_cost
                          }}
                        </td>

                        <td class="two-percent">
                          <p v-if="order.order_type == 1">customer</p>
                          <p v-if="order.order_type == 2">
                            Admin 
                         
                          </p>
                          <p v-if="order.order_type == 3">
                            Whole sale 
                            
                          </p>
                          <p v-if="order.order_type == 4">Reseller</p>
                        </td>

                        <td class="two-percent">
                          <span class="badge" v-if="order.status == 1"
                            >New</span
                          >
                          <span class="badge" v-if="order.status == 2"
                            >Pending</span
                          >

                          <span
                            class="badge badge-success"
                            v-if="order.status == 3"
                            >Approved</span
                          >
                          <span
                            class="badge badge-success"
                            v-if="order.status == 4"
                            >Shipment</span
                          >
                          <span
                            class="badge badge-warning"
                            v-if="order.status == 5"
                            >Delivered</span
                          >
                          <span
                            class="badge badge-danger"
                            v-if="order.status == 6"
                            >Cancel</span
                          >
                          <span
                            class="badge badge-danger"
                            v-if="order.status == 7"
                            >Return</span
                          >
                        </td>

                        <td class="two-percent">{{ order.created_at }}</td>

                        <td>
                          <router-link
                            class="btn btn-success "
                            :to="{
                              name: 'merchant_order_view',
                              params: { id: order.id },
                            }"
                          >
                            <i class="fa fa-eye"></i> view</router-link
                          >
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
                        @pagination-change-page="orderList"
                        :limit="3"
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
import { Form, HasError, AlertError } from "vform";
import navbar from "../Navbar";
import { jsPDF } from "jspdf";

export default {
  created() {
    this.orderList();
  },
  data() {
    return {
      orders: {},
      loading: true,
      basePath: this.$store.state.image_base_link,
      search: "",
      item: "10",
    };
  },
  methods: {
    orderList(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/merchant/order?page=" + page, {
          params: {
            item: this.item,
          },
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "OK") {
            this.orders = resp.data.orders;
            this.$Progress.finish();
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
          this.$Progress.fial();
        });
    },
  },
  components: {
    navbar,
  },
};
</script>

<style scoped>
.dropbtn {
  width: 100% !important;
  margin-bottom: 5px !important;
}
.dropbtn-active {
  display: block !important;
}
.dropdown-action {
  display: none;
  width: 90px;
  position: absolute;
}
</style>
