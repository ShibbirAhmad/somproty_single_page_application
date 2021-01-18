<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'debitAdd' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>
            <router-link :to="{ name: 'credit' }" class="btn btn-info"
            >Credit</router-link>
             <button @click="exportDebit" class="btn btn-success"> <i class="fa fa-download"></i> Exprot Debit</button>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Debit</li>
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
                      <h3 class="box-title">Debit table</h3>
                    </div>
                    <div class="col-lg-2">
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
                        @change="debitList"
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
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                                                <th scope="col">Date</th>

                        <th scope="col">Invoice_no</th>
                         <th scope="col">Purpose</th>
                          <th scope="col">Debit From</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Signature</th>
                        <th scope="col">Insert</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr v-for="(debit, index) in debits.data" :key="index">
                        <td scope="row">{{ index + 1 }}</td>
                          <td style="width:90px;">{{formatDate(debit.date) }}</td>

                         <td>{{"DB-"+debit.id }}</td>
                         <td> <strong v-if="debit.purpose">{{ debit.purpose.text }}</strong> </td>
                          <td>{{ debit.debit_from }}</td>
                        <td>{{ debit.amount }}</td>
                        <td>{{ debit.comment }}</td>
                        <td>
                         <a target="_blank"   v-if="debit.signature" :href="basePath+debit.signature">
                             <img
                            v-if="debit.signature"
                            :src="basePath + debit.signature"
                            style="width:100px;height:40px;"
                            
                          />
                         </a>
                        </td>
                        <td>{{ debit.admin.name }}</td>
                    <td>
                          <router-link
                          v-if="$can('edit debit')"
                            :to="{
                              name: 'debitEdit',
                              params: { id: debit.id },
                            }"
                            class="btn btn-success btn-sm"
                            ><i class="fa fa-edit"></i
                          ></router-link>

                          <a
                            v-if="current_date == debit.date && $can('delete debit')"
                            class="btn btn-sm btn-danger"
                            @click="trash(debit.id, index)"
                            ><i class="fa fa-trash"></i
                          ></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                      <pagination
                        :data="debits"
                        @pagination-change-page="debitList"
                        :limit="4"
                      >
                      </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ debits.from }}</strong> to
                        <strong>{{ debits.to }}</strong> of total
                        <strong>{{ debits.total }}</strong> entries
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
      this.debitList();
    }, 100);
    // this.getResults();
  },
  data() {
    return {
      debits: {},
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
       basePath: this.$store.getters.image_base_link,

    };
  },
  methods: {
    debitList(page = 1) {
      this.loading = true;
      axios
        .get("/debits?page=" + page, {
          params: {
            item: this.item,
            status: this.status,
            search: this.search,
            start_date: this.start_date,
            end_date: this.end_date,
          },
        })
        .then((resp) => {
      
          this.debits = resp.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    trash(debitId, index) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't delete this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/debit/destroy/" + debitId)
            .then((resp) => {
              console.log(resp);
              if (resp.data.status == "SUCCESS") {
                this.debits.data.splice(index, 1);
                this.$toasted.show(resp.data.message, {
                  position: "top-center",
                  type: "success",
                  duration: 200,
                });
              } else {
                this.$toasted.show("some thing want to wrong", {
                  position: "top-center",
                  type: "error",
                  duration: 4000,
                });
              }
            })
            .catch((error) => {
              // console.log(error)
              this.$toasted.show("some thing want to wrong", {
                position: "top-center",
                type: "error",
                duration: 4000,
              });
            });
        } else {
          this.$toasted.show("OK ! no action here", {
            position: "top-center",
            type: "info",
            duration: 3000,
          });
        }
      });
    },
    searchCredit() {
      if (this.search.length >= 2) {
        this.status = "search";
        this.debitList();
      } else {
        this.status = "all";
        this.debitList();
      }
    },
    filter() {
      console.log("hell");
      this.status = "filter";
      this.debitList();
    },
    clearAll(){
        this.$Progress.start()
        this.status="all";
        this.search='',
        this.start_date='',
        this.end_date='',
        this.debitList();
         this.$Progress.finish()
    },
     //method initial for  get current date
    pDate() {
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
      this.current_date = output;
    },
    exportDebit(){

       window.open('/api/export/debit','_blank');
    },
     formatDate(date) {
      let origina_date = date.split("-");
      return `${origina_date[2]}-${origina_date[1]}-${origina_date[0]}`;
    },
  },

  watch: {
    start_date: function () {
      this.status = "filter";
      this.debitList();
    },
    end_date: function () {
      this.status = "filter";
      this.debitList();
    },
  },
  mounted() {
      this.pDate();
  },
};
</script>

<style scoped>
</style>
