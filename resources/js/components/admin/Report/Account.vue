<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">All Order</li>
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
                      <h3 class="box-title">REPORT:ACCOUNTS</h3>
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
                        <th scope="col">Total Credit</th>
                        <th scope="col">Total Debit</th>

                        <th scope="col">Total Balance</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <h3>{{ account.credit }}</h3>
                        </td>
                        <td>
                          <h3>{{ account.debit }}</h3>
                        </td>
                        <td>
                          <h3
                            :class="{ 'text-danger': account.credit - account.debit < 0 }"
                          >
                            {{ account.credit - account.debit }}
                          </h3>
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
    this.filter();
  },
  data() {
    return {
      loading: true,
      start_date: "",
      end_date: "",
      account: "",

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
        .get("/account/report", {
          params: {
            start_date: this.start_date,
            end_date: this.end_date,
          },
        })
        .then((resp) => {
          console.log(resp);
          this.$Progress.finish();
          if (resp.data) {
            this.account = resp.data;
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
