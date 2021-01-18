<template>
  <div class="wrapper-wide">
    <!-- <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading> -->

    <frontend-header></frontend-header>

    <div id="container">
      <div class="container">
        <div class="row user-content">
          <div  class="col-lg-2 col-md-2 col-sm-2 text-white bg-success user-side-bar"   >
            <sidebar> </sidebar>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 bg-white shadow order-histrory" >
            <div class="row">
              <div class="col-lg-1"></div>
              <h1 v-if="loading">
                <i class="fa fa-spin fa-spinner"></i>
              </h1>
              <div class="col-lg-12" v-else>
                <table class="table table-bordered">
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
                    <tr v-for="(item, index) in items" :key="index">
                      <td>{{ index + 1 }}</td>
                      <td>
                        {{ item.product.name }}
                        <strong v-if="item.attribute"
                          >-{{ item.attribute.name }}[{{
                            item.variant.name
                          }}]</strong
                        >
                      </td>
                      <td>{{ item.product.product_code }}</td>
                      <td>{{ item.quantity }}</td>
                      <td>{{ item.price }}</td>
                      <td>{{ item.quantity * item.price }}</td>
                    </tr>

                    <tr>
                      <td colspan="4"></td>
                      <td>
                        <b>Sub Total</b>
                      </td>
                      <td>
                        <b>{{ order.total }}</b>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td>
                        <b>Discount</b>
                      </td>
                      <td>
                        <b>{{ order.discount }}</b>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td>
                        <b>Paid</b>
                      </td>
                      <td>
                        <b>{{ order.paid }}</b>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td>
                        <b>Shiiping_cost</b>
                      </td>
                      <td>
                        <b>{{ order.shipping_cost }}</b>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="4"></td>
                      <td>
                        <b>Amount Due</b>
                      </td>
                      <td>
                        <b>{{
                          parseInt(order.total) -
                          (parseInt(order.discount) + parseInt(order.paid)) +
                          parseInt(order.shipping_cost)
                        }}</b>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row bottomBtn">
                <button class="btn btn-success print"  @click="print(order.id)">
                    <i class="fa fa-print"></i>
                </button>
                <button class="btn btn-warning back" @click="back">
                    <i class="fa fa-arrow-circle-right" ></i>
                </button>
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
  created() {
    this.getDetails();
  },

  data() {
    return {
      order: "",
      items: "",
      loading: true,
    };
  },

  methods: {
    back(){
        this.$router.push({ name : 'OrderHistory'});
    },  

   print(order_id) {

     window.open('/_public/customer/order/invoice/print/'+order_id,'_blank')

    },
    getDetails() {
      axios
        .get("/_public/api/user/order/details/" + this.$route.params.id)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.order = resp.data.order;
            this.items = resp.data.items;
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
.mb-2 {
  margin-bottom: 5px !important;
}
.bottomBtn {
  margin-top: 15px;
  margin-left: 20px;
}

.user-side-bar{
    padding: 10px 10px;
    margin-bottom: 30px;
    margin-top: 11px;
    min-height: 500px;
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
