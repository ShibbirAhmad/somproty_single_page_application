<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content">
        <div v-if="loading">
          <h1 class="text-center" v-if="loading">
            <i class="fa fa-spin fa-spinner"></i>
          </h1>
        </div>
        <div v-else class="container">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="row">
                <div
                  class="col-lg-12"
                  style="
                    background: #fff;
                    margin-bottom: 13px;
                    font-weight: bolder;
                    text-align: center;
                    box-shadow: 3px 3px 3px #ddd;
                  "
                >
                  <h3 class="text-uppercase" style="font-weight: bold">
                    Supplier:{{ supplier.company_name }}
                  </h3>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="supplier-box">
                    <h3 class="c-name text-uppercase">Total Purchse Amount</h3>
                    <hr />
                    <h3 class="c-name text-uppercase">
                      {{ amount.total_purchase_amount }}
                    </h3>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="supplier-box">
                    <h3 class="c-name text-uppercase">Total Paid Amount</h3>
                    <hr />
                    <h3 class="c-name text-uppercase">{{ amount.total_paid_amount }}</h3>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="supplier-box">
                    <h3 class="c-name text-uppercase">Total Due Amount</h3>
                    <hr />
                    <h3 class="c-name text-uppercase">
                      {{
                        parseInt(amount.total_purchase_amount) -
                        parseInt(amount.total_paid_amount)
                      }}
                    </h3>
                  </div>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-lg-12">
                  <div class="tab-menu-list">
                    <li
                      @click="payment_history_show = true"
                      :class="[{ active: payment_history_show }]"
                    >
                      Payment history
                      <a
                        :href="'/api/pdf/suplier/amount/' + supplier.id"
                        style="background: #000; color: #fff; cursor: pointer"
                      >
                        PDF
                      </a>
                    </li>
                    <li
                      @click="payment_history_show = false"
                      :class="[{ active: !payment_history_show }]"
                    >
                      Purchase history
                      <a
                        :href="'/api/pdf/suplier/purchase/' + supplier.id"
                        style="background: #000; color: #fff; cursor: pointer"
                      >
                        PDF
                      </a>
                    </li>
                  </div>
                </div>
              </div>
              <div class="row">
                <div
                  class="col-lg-12"
                  v-if="payment_history_show"
                  style="background: #fff; padding: 15px 16px"
                >
                  <h4>Payment History</h4>
                  <table class="table" v-if="paid_items.length > 0">
                    <thead>
                      <tr>
                        <td>#</td>
                        <td>Date</td>
                        <td>Paid By</td>
                        <td>Amount</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(paid_item, index) in paid_items" :key="index">
                        <td>
                          {{ index + 1 }}
                        </td>
                        <td>
                          {{ paid_item.date }}
                        </td>
                        <td>
                          {{ paid_item.paid_by ? paid_item.paid_by : "" }}
                        </td>
                        <td>
                          {{ paid_item.amount }}
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>
                          <strong> = {{ PaymentDue() }}</strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <h3 class="text-center text-uppercase text-bold" v-else>
                    Payment History Is Empty
                  </h3>
                </div>
                <div
                  class="col-lg-12"
                  v-if="!payment_history_show"
                  style="background: #fff; padding: 15px 16px"
                >
                  <h4>Purchase History</h4>
                  <table class="table" v-if="purchase_items.length > 0">
                    <thead>
                      <tr>
                        <td>#</td>
                        <td>Date</td>
                        <td>Invoice_no</td>
                        <td>Product Qty</td>
                        <td>Amount</td>
                        <td>Paid</td>
                        <td>Due</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(purchase_item, index) in purchase_items" :key="index">
                        <td>
                          {{ index + 1 }}
                        </td>
                        <td>
                          {{ purchase_item.purchase_date }}
                        </td>
                        <td>
                          {{ purchase_item.invoice_no }}
                        </td>

                        <td>
                          {{ productQty(purchase_item.purchase_items) }}
                        </td>

                        <td>
                          {{ purchase_item.total }}
                        </td>
                        <td>
                          {{ purchase_item.paid }}
                        </td>
                        <td>
                          {{
                            parseInt(purchase_item.total) - parseInt(purchase_item.paid)
                          }}
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'purchaseView',
                              params: { id: purchase_item.id },
                            }"
                            class="btn btn-primary btn-sm"
                            target="_blank"
                            >Details</router-link
                          >
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>
                          <strong>= {{ productQtyTotal() }}</strong>
                        </td>
                        <td>
                          <strong>= {{ totalAmount() }}</strong>
                        </td>
                        <td>
                          <strong>= {{ totalPaid() }}</strong>
                        </td>
                        <td>
                          <strong>= {{ dueamount() }}</strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <h3 class="text-center text-uppercase text-bold" v-else>
                    Purchas History Is Empty
                  </h3>
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
export default {
  created() {
    this.supplierAmount();
  },
  data() {
    return {
      amount: "",
      loading: true,
      supplier: "",
      paid_items: "",
      purchase_items: "",
      payment_history_show: false,
    };
  },
  methods: {
    supplierAmount(page = 1) {
      axios
        .get("/api/suplier/amount/" + this.$route.params.id)
        .then((resp) => {
          console.log(resp);
          this.supplier = resp.data.supplier;
          this.amount = resp.data.amount;
          this.paid_items = resp.data.paid_items;
          this.purchase_items = resp.data.purchase_items;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    totalAmount() {
      let total = 0;
      this.purchase_items.forEach((element) => {
        total += parseInt(element.total);
      });
      return total;
    },
    dueamount() {
      let total = 0;
      this.purchase_items.forEach((element) => {
        total += parseInt(element.total) - parseInt(element.paid);
      });
      return total;
    },
    PaymentDue() {
      let total = 0;
      this.paid_items.forEach((element) => {
        total += parseInt(element.amount);
      });
      return total;
    },
    productQty(items) {
      let total = 0;
      items.forEach((ele) => {
        total += parseInt(ele.stock);
      });

      return total;
    },
    productQtyTotal() {
      let total = 0;
      this.purchase_items.forEach((ele) => {
        ele.purchase_items.forEach((element) => {
          total += parseInt(element.stock);
        });
      });

      return total;
    },
    totalPaid() {
      let total = 0;
      this.purchase_items.forEach((ele) => {
        total += parseInt(ele.paid);
      });

      return total;
    },
  },
};
</script>

<style scoped>
.supplier-box {
  background: #fff;
  padding: 10px;
  box-shadow: 3px 3px 3px #ddd;
  border-radius: 5px;
  height: 200px;
}
.c-name {
  text-align: center;
  height: 50px;
  font-weight: bold;
}
.tab-menu-list {
  display: flex;
  background: #ecf0f5;
}

.tab-menu-list li {
  list-style: none;
  padding: 15px;
  text-transform: uppercase;
  font-size: 17px;
  font-weight: bold;
  cursor: pointer;
  margin-bottom: 10px;
}
li.active {
  border-bottom: 2px solid #000;
  background: #fff;
}
</style>
