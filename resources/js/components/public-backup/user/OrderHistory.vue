<template>
  <div class="wrapper-wide">
    <!-- <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading> -->

    <frontend-header></frontend-header>

    <div id="container">
      <div class="container">
        <div class="row user-content">
          <div
            class="col-lg-2 col-md-2 col-sm-2 text-white bg-success user-side-bar"
          >
            <sidebar> </sidebar>
          </div>
          <div  class="col-lg-8 col-md-8 col-sm-8 bg-white shadow order-histrory"  >
       
            <div style="overflow-x: hidden">
              <table class="table table-bordered table-responsive table-hover">
                <thead>
                  <tr>
                    <td>#</td>
                    <td class="text-center">Invoice_no</td>
                    <td class="text-center">Total_amount</td>
                    <td class="text-center">Status</td>
                    <td class="text-center">Order_date</td>
                    <td class="text-center"> Action </td>
                  </tr>
                </thead>
                <tbody>
                  <h1 v-if="loading">
                    <i class="fa fa-spin fa-spinner"></i>
                  </h1>
                  <tr
                    v-else
                    v-for="(order, index) in order_lists.data"
                    :key="index"
                  >
                    <td>{{ index + 1 }}</td>
                    <td class="text-center">#{{ order.invoice_no }}</td>
                    <td class="text-left">
                      {{
                        order.total -
                        (order.discount + order.paid) +
                        order.shipping_cost
                      }}
                    </td>
                    <td class="text-center">
                      <span class="badge" v-if="order.status == 1">New</span>
                      <span class="badge" v-if="order.status == 2"
                        >Pending</span
                      >

                      <span class="badge badge-success" v-if="order.status == 3"
                        >Approved</span
                      >
                      <span class="badge badge-success" v-if="order.status == 4"
                        >Shipment</span
                      >
                      <span class="badge badge-warning" v-if="order.status == 5"
                        >Delivered</span
                      >
                      <span class="badge badge-danger" v-if="order.status == 6"
                        >Cancel</span
                      >
                      <span class="badge badge-danger" v-if="order.status == 7"
                        >Return</span
                      >
                    </td>
                    <td class="text-center">{{ order.created_at }}</td>

                    <td class="text-center">
                      <router-link  :to="{ name : 'order_details', params:{ id: order.id }}"  class="btn btn-info"  >
                        <i class="fa fa-eye"></i>
                      </router-link>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-lg-6">
                  <pagination
                    :data="order_lists"
                    @pagination-change-page="getOrderList"
                  ></pagination>
                </div>
                <div
                  class="col-lg-6 mt-1"
                  style="margin-top: 25px; text-align: right"
                >
                  <p>
                    Showing
                    <strong>{{ order_lists.from }}</strong> to
                    <strong>{{ order_lists.to }}</strong> of total
                    <strong>{{ order_lists.total }}</strong> entries
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-2 col-lg-2 col-sm-2"></div>
        </div>
      </div>
      <frontend-footer></frontend-footer>
    </div>
  </div>
</template>

<script>
import sidebar from "./Sidebar";
export default {
  props: ["categories"],

  created() {
    setTimeout(() => {
      this.getOrderList();
    }, 500);
  },

  data() {
    return {
      order_lists: {},
      loading: true,
    };
  },

  methods: {
    getOrderList(page = 1) {
      this.loading = true;
      axios
        .get("/_public/customer/order/list?page=" + page)
        .then((resp) => {
          if (resp.data.status == "SUCCESS") {
            this.order_lists = resp.data.orders;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  components: {
    sidebar,
  },

  beforeRouteEnter(to, from, next) {
    next((vm) => {
      console.log();
      vm.pre_route = from.name;
    });
  },
};
</script>

<style scoped>
.container{

   margin-bottom: 50px;
}
.user-side-bar{
    padding: 10px 10px;
    margin-bottom: 30px;
    margin-top: 11px;
    min-height: 500px;
}

</style>