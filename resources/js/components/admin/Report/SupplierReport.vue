<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Supplier Report</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="row" style="margin-bottom: 3px">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-3 orders-heading">
                      <h3 class="box-title">Supplier REPORT</h3>
                    </div>
                    <div class="col-lg-5">
                      <div class="row">
                        <div class="col-lg-5" style="margin-left: -20px"></div>
                        <div class="col-lg-2">
                          <!-- <button class="btn btn-primary" @click="refresh">
                            <i class="fa fa-refresh"></i>
                          </button> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Supplier</th>
                        <th scope="col">Purchase Count</th>
                        <th scope="col">Total Purchase Amount</th>
                        <th scope="col">Total Paid Amount</th>
                        <th scope="col">Total Due Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-else
                        v-for="(supplier_amount, index) in supplier_amounts"
                        :key="index"
                      >
                        <td>{{ index }}</td>
                        <td>{{ supplier_amount.purchase_count }}</td>
                        <td>{{ supplier_amount.total_purchase_amount }}</td>

                        <td>{{ supplier_amount.total_paid_amount }}</td>

                        <td>
                          {{
                            parseInt(supplier_amount.total_purchase_amount) -
                            parseInt(supplier_amount.total_paid_amount)
                          }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                      <pagination
                        :data="sales"
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
                        <strong>{{ sales.from }}</strong> to
                        <strong>{{ sales.to }}</strong> of total
                        <strong>{{ sales.total }}</strong> entries
                      </p>
                    </div>
                  </div>
                </div> -->
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

      supplier_amounts: "",
    };
  },
  methods: {
    filter(page = 1) {
      this.$Progress.start();
      axios
        .get("/supplier/report")
        .then((resp) => {
          console.log(resp);
          this.$Progress.finish();
          if (resp.data) {
            this.supplier_amounts = resp.data;
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
