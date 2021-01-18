<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'AddSale' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Company_Sale</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Company_sale</h3>

                  <div style="margin-top: 10px" class="row">
                    <div class="col-lg-4">
                      <input
                        class="form-control"
                        @keyup="saleSearch"
                        v-model="data_search"
                        placeholder="enter name, phone or address "
                      />
                    </div>
                    <div class="col-lg-6">

                      <form @submit.prevent="filterCompanySale">
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
                        </div>
                      </form>
                    </div>

                    <div class="col-lg-2">
                      <select
                        class="form-control"
                        v-model="item"
                        @change="saleList"
                      >
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="40">40</option>
                        <option value="60">60</option>
                        <option value="40">80</option>
                        <option value="60">100</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Company</th>
                        <th scope="col">Invoice_no</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total</th>

                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-for="(sale, index) in sales.data"
                        :key="index"
                        v-else
                      >
                        <td scope="row">{{ index + 1 }}</td>

                        <td>{{ sale.company ? sale.company.name : "" }}</td>

                        <td>{{ sale.invoice_no ? sale.invoice_no : "" }}</td>

                        <td>
                          <span
                            class="badge badge-primary"
                            v-if="sale.status == 1"
                            >Initial</span
                          >
                          <span
                            class="badge badge-success"
                            v-if="sale.status == 2"
                            >Paid</span
                          >

                          <span
                            class="badge badge-danger"
                            v-if="sale.status == 3"
                            >Retruned</span
                          >
                        </td>

                        <td>
                           Total: {{ sale.total }},
                          <strong>Paid: {{ sale.paid }},</strong> 
                          Due: {{parseInt(sale.total)-parseInt(sale.paid)}}
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'ViewSale',
                              params: { id: sale.id },
                            }"
                            class="btn btn-primary btn-sm"
                            ><i class="fa fa-eye"></i
                          ></router-link>

                          <a
                            class="btn btn-success"
                            @click.prevent="paid(sale.id, index)"
                            v-if="sale.status == 1"
                            >Paid</a
                          >
                          <a
                            class="btn btn-danger"
                            v-if="sale.status == 1"
                            @click.prevent="returned(sale.id, index)"
                            >Returend</a
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
                        :data="sales"
                        @pagination-change-page="saleList"
                      ></pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ sales.from }}</strong> to
                        <strong>{{ sales.to }}</strong> of total
                        <strong>{{ sales.total }}</strong> entries
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

export default {
  components: { Index },

  created() {
    this.saleList();
  },
  data() {
    return {
      sales: {},
      loading: true,
      item: 20,
      sale_type: 2,
      start_date: "",
      end_date: "",
      data_search: "",
      //date picker options ..........
      options: {
        format: "YYYY-MM-DD",
        useCurrent: false,
      },
    };
  },

  methods: {
 
    saleSearch(page = 1) {
      if (this.data_search.length > 1) {
        this.loading = true;
        axios
          .get("/api/company/sale/search/data/" + this.data_search + "?page=" + page)
          .then((resp) => {
            if (resp.data.status == "OK") {
                this.sales = resp.data.sales;
                this.loading = false;
            }
          })
          .catch((error) => {
            console.log(error);
            alert("some thing want wrong");
          });
      }else{
        this.saleList();
      }
    },

    filterCompanySale(page = 1) {
      //fetch data  
      axios
        .get("/api/company/sale/date/wise/filter?page=" + page, {
          //send data
          params: {
            start_date: this.start_date,
            end_date: this.end_date,
            item: this.item,
          },
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "OK") {
            this.sales = resp.data.sales;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    saleList(page = 1) {
      axios
        .get("/api/company/sales/list?page=" + page, {
          params: {
            item: this.item,
            sale_type: this.sale_type,
          },
        })
        .then((resp) => {
          console.log(resp);
          //  console.log(resp.data.admins.data)
          if (resp.data.status == "SUCCESS") {
            this.sales = resp.data.sales;
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
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 4000,
          });
        });
    },

    //method iniitial for sale paid

    paid(sale_id, index) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't make this paid",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/sale/paid/" + sale_id)
            .then((resp) => {
              if (resp.data.success == "OK") {
                this.sales.data[index].status = 2;
                this.$toasted.show(resp.data.message, {
                  position: "top-center",
                  type: "success",
                  duration: 2000,
                });
              }
              //  console.log(sale_id);
            })
            .catch((error) => {
              this.$toasted.show("some thing want to wrong", {
                position: "top-center",
                type: "error",
                duration: 4000,
              });
            });
        } else {
          this.$toasted.show("Ok ! no action here", {
            position: "top-center",
            type: "info",
            duration: 3000,
          });
        }
      });
    },

    returned(sale_id, index) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't make this paid",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/sale/returned/" + sale_id)
            .then((resp) => {
              // console.log(resp)
              if (resp.data.success == "OK") {
                this.sales.data[index].status = 2;
                this.$toasted.show(resp.data.message, {
                  position: "top-center",
                  type: "success",
                  duration: 2000,
                });
              }
            })
            .catch((error) => {
              // console.log(error)
            });
        } else {
          this.$toasted.show("Ok ! no action here", {
            position: "top-center",
            type: "info",
            duration: 3000,
          });
        }
      });
    },
  },
  watch:{
 
    start_date: function (value) {
      if (value.length > 1) {
        this.filterCompanySale();
      }
    },
    end_date: function (value) {
      if (value.length > 1) {
        this.filterCompanySale();
      }
    },    

  }
};
</script>

<style scoped>
</style>
