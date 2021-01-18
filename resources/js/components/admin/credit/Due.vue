<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'creditAdd' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>

          <router-link :to="{ name: 'debit' }" class="btn btn-info"
            >Debit</router-link
          >
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Credit</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="row">
                    <div class="col-lg-4">
                      <h3 class="box-title">Due Table</h3>
                    </div>
                    <!-- <div class="col-lg-2">
                      <input
                        class="form-control"
                        v-model="search"
                        @keyup="searchCredit"
                        placeholder="purpose,commens...."
                      />
                    </div>
                    <div class="col-lg-4">
                      <div class="row">
                        <div class="col-lg-6">
                          <date-picker
                            autocomplete="off"
                            v-model="start_date"
                            :config="options"
                            placeholder="start_date"
                            @change="filter"
                          ></date-picker>
                        </div>
                        <div class="col-lg-6">
                          <date-picker
                            autocomplete="off"
                            v-model="end_date"
                            :config="options"
                            placeholder="end_date"
                          ></date-picker>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-1">
                      <select
                        class="form-control"
                        v-model="item"
                        @change="dueList"
                      >
                        <option value="20">20</option>
                        <option value="40">40</option>
                        <option value="60">60</option>
                        <option value="80">80</option>
                      </select>
                    </div>
                    <div class="col-lg-1">
                      <button class="btn btn-primary btn-sm" @click="clearAll">
                        <i class="fa fa-refresh"></i>
                      </button>
                    </div> -->
                  </div>
                </div>
                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th>Date</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Mobile No</th>
                        <th>Memo Number</th>

                        <th scope="col">Amount</th>

                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr v-for="(due, index) in credit_dues.data" :key="index">
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ due.created_at }}</td>

                        <td>{{ due.customer_name }}</td>
                        <td>{{ due.customer_mobile_no }}</td>
                        <td> 

                            <router-link
                            :to="{
                              name: 'ViewSale',
                              params: { id: due.memo_no},
                            }">
                          
                          {{ "S-" }} {{ due.memo_no ? due.memo_no : ""   }}
                          
                            </router-link>
                          </td>

                        <td>{{ due.amount }}</td>
                        <!-- <td><strong v-if="due.order_invoice_no">{{ due.order_invoice_no }}</strong></td> -->

                        <td>
                          <a
                            id="paid"
                            class="btn btn-sm btn-success"
                            @click="getPaid(due.id, index)"
                            >Get Paid</a
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
                        :data="credit_dues"
                        @pagination-change-page="dueList"
                      >
                      </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ credit_dues.from }}</strong> to
                        <strong>{{ credit_dues.to }}</strong> of total
                        <strong>{{ credit_dues.total }}</strong> entries
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
export default {
  created() {
    setTimeout(() => {
      this.dueList();
    }, 100);
    // this.getResults();
  },
  data() {
    return {
      credit_dues: {},
      loading: true,
      current_date: "",
      item: 20,
      search: "",
      status: "all",

      //for date picker
      options: {
        format: "YYYY-MM-DD",
        useCurrent: false,
      },

      start_date: "",
      end_date: "",
    };
  },
  methods: {
    getPaid() {},

    dueList(page = 1) {
      this.loading = true;
      axios
        .get("/api/credit/due?page=" + page, {
          params: {
            item: this.item,
          },
        })
        .then((resp) => {
          this.credit_dues = resp.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    searchCredit() {
      if (this.search.length >= 2) {
        this.status = "search";
        this.dueList();
      } else {
        this.status = "all";
        this.dueList();
      }
    },
    getPaid(id, index) {
      //open a dailoge box
      Swal.fire({
        // title:'Get  Paid',
        html: `
          <label>Amount</label>
          <input id="amount" value=${this.credit_dues.data[index].amount} class="swal2-input">
          <label>Paid By</label>
          <select id="paid_by" class="swal2-input">
          <option value="Cash">Cash</option>
          <option value="Bkash(personal)">Bkash(personal)</option>
          <option value="Bkash(merchant)">Bkash(merchant)</option>
          <option value="Bank(AIBL)">Bank(AIBL)</option>
          <option value="Bank(SIBL)">Bank(SIBL)</option>

          </select>
          `,
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          let amount = document.getElementById("amount").value;
          let paid_by = document.getElementById("paid_by").value;
          if (amount > 0 && amount.length > 0 && paid_by.length > 0) {
            //send a request
            axios
              .get("/api/due/to/paid/" + id, {
                params: {
                  paid_by: paid_by,
                  amount: amount,
                },
              })
              .then((resp) => {
                console.log(resp);
                //if resp success from serve
                if (resp.data.status == "SUCCESS") {
                  Swal.fire({
                    type: "info",
                    text: resp.data.message,
                  });
                  //if amount full paid
                  //remove form dom
                  //else update amount
                  if (resp.data.due.status == 1) {
                    this.credit_dues.data.splice(index, 1);
                  } else {
                    console.log(this.credit_dues.data[index].amount);
                    this.credit_dues.data[index].amount = resp.data.due.amount;
                  }
                } else {
                  Swal.fire({
                    type: "warning",
                    text: resp.data,
                  });
                }
              })
              .catch((e) => {
                console.log(e);
              });
          }
        }
        console.log(result);
      });
    },
    clearAll() {
      this.$Progress.start();
      this.status = "all";
      (this.search = ""),
        (this.start_date = ""),
        (this.end_date = ""),
        this.dueList();
      this.$Progress.finish();
    },
  },
};
</script>

<style scoped>
label {
  position: absolute;
  text-align: left;
  margin-bottom: 0px;
}
</style>
