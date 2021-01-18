<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Report | Profit</li>
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
                      <h3 class="box-title">REPORT:PORFIT</h3>
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
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Total Product Sale Price</th>
                       <th scope="col">Total Product Purchase Price</th>
                      <th scope="col">Profit</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          {{ data.total_product_sale_amount }}
                        </td>
                        <td>
                            {{ data.total_product_purchase_amount }}

                        </td>
                        <td>
                     
                           {{parseInt(data.total_product_sale_amount)-parseInt(data.total_product_purchase_amount)  }}
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
      data:"",

      //date picker options ..........
      options: {
        format: "YYYY-MM-DD",
        useCurrent: false,
      },
    };
  },
  methods: {
    filter() {
      this.$Progress.start();
      axios
        .get("/profite/report", {
          params: {
            start_date: this.start_date,
            end_date: this.end_date,
          },
        })
        .then((resp) => {
        console.log(resp)
          if(resp.data){
            this.data=resp.data;
          }
          this.$Progress.finish()
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
